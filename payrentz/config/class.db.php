<?php
/*------------------------------------------------------------------------------
** File:		class.db.php
** Class:       Simply MySQLi
** Description:	PHP MySQLi wrapper class to handle common database queries and operations
** Version:		1.0
** Updated:     18-Feb-2013
** Author:		Bennett Stone
** Homepage:	www.phpdevtips.com
**------------------------------------------------------------------------------
** COPYRIGHT (c) 2012 - 2013 BENNETT STONE
**
** The source code included in this package is free software; you can
** redistribute it and/or modify it under the terms of the GNU General Public
** License as published by the Free Software Foundation. This license can be
** read at:
**
** http://www.opensource.org/licenses/gpl-license.php
**
** This program is distributed in the hope that it will be useful, but WITHOUT
** ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
** FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
**------------------------------------------------------------------------------ */

class DB
{
    private $link;
    public $filter;

    /**
     * Allow the class to send admins a message alerting them to errors
     * on production sites
     */
    public function log_db_errors( $error, $query, $severity )
    {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'To: Admin <'.SEND_ERRORS_TO.'>' . "\r\n";
        $headers .= 'From: Yoursite <system@your-site.com>' . "\r\n";

        $message = '<p>An error has occurred:</p>';

        $message .= '<p>Error at '. date('Y-m-d H:i:s').': ';
        $message .= 'Query: '. htmlentities( $query ).'<br />';
        $message .= '</p>';
        $message .= '<p>Severity: '. $severity .'</p>';

        mail(SEND_ERRORS_TO, 'Database Error', $message, $headers);

        if(DISPLAY_DEBUG)
        {
            echo $message;
        }
    }


	public function __construct()
	{
	    global $connection;
		mb_internal_encoding( 'UTF-8' );
		mb_regex_encoding( 'UTF-8' );
		//echo DB_HOST."==".DB_NAME."==".DB_PASS."==".DB_USER;
		$this->link = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

        if( mysqli_connect_errno() )
        {
            $this->log_db_errors( "Connect failed: %s\n", mysqli_connect_error(), 'Fatal' );
            exit();
        }
	}

	public function __destruct()
	{
		$this->disconnect();
	}


	/**
     * Sanitize user data
     *
     * @access public
     * @param string, array
     * @return string, array
     *
     */
    public function filter( $data )
    {
        if( !is_array( $data ) )
        {
            $data = trim( htmlentities( $data ) );
        	$data = mysqli_real_escape_string( $this->link, $data );
        }
        else
        {
            //Self call function to sanitize array data
            $data = array_map( array( 'DB', 'filter' ), $data );
        }
    	return $data;
    }


    /**
     * Determine if common non-encapsulated fields are being used
     *
     * @access public
     * @param string
     * @param array
     * @return bool
     *
     */
    public function db_common( $value = '' )
    {
        if( is_array( $value ) )
        {
            foreach( $value as $v )
            {
                if( preg_match( '/AES_DECRYPT/i', $v ) || preg_match( '/AES_ENCRYPT/i', $v ) || preg_match( '/now()/i', $v ) )
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        else
        {
            if( preg_match( '/AES_DECRYPT/i', $value ) || preg_match( '/AES_ENCRYPT/i', $value ) || preg_match( '/now()/i', $value ) )
            {
                return true;
            }
        }
    }


    /**
     * Perform queries
     * All following functions run through this function
     * All data run through this function is automatically sanitized using the filter function
     *
     * @access public
     * @param string
     * @return string
     * @return array
     * @return bool
     *
     */
    public function query( $query )
    {
        $query = $this->link->query( $query );
        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
            return true;
        }
        mysqli_free_result( $query );
    }


    /**
     * Determine if database table exists
     *
     * @access public
     * @param string
     * @return bool
     *
     */
    public function table_exists( $name )
    {
        $check = $this->link->query("SELECT * FROM '$name' LIMIT 1");
        if( $check )
        {
            return true;
        }
        else
        {
            return false;
        }
        mysqli_free_result( $check );
    }


    /**
     * Count number of rows found matching a specific query
     *
     * @access public
     * @param string
     * @return int
     *
     */
    public function num_rows( $query )
    {
        $query = $this->link->query( $query );
        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return mysqli_error( $this->link );
        }
        else
        {
            return mysqli_num_rows( $query );
        }
        mysqli_free_result( $query );
    }


    /**
     * Run check to see if value exists, returns true or false
     *
     * Example Usage:
     * $check_user = array(
     *    'user_email' => 'someuser@gmail.com',
     *    'user_id' => 48
     * );
     * $exists = exists( 'your_table', 'user_id', $check_user );
     *
     * @access public
     * @param string database table name
     * @param string field to check (i.e. 'user_id' or COUNT(user_id))
     * @param array column name => column value to match
     * @return bool
     *
     */
    public function exists( $table = '', $check_val = '', $params = array() )
    {
        if( empty($table) || empty($check_val) || empty($params) )
        {
            return false;
            exit;
        }
        $check = array();
        foreach( $params as $field => $value )
        {

            if( !empty( $field ) && !empty( $value ) )
            {
                //Check for frequently used mysql commands and prevent encapsulation of them
                if( $this->db_common( $value ) )
                {
                    $check[] = "$field = $value";
                }
                else
                {
                    $check[] = "$field = '$value'";
                }
            }

        }
        $check = implode(' AND ', $check);

        $rs_check = "SELECT $check_val FROM ".$table." WHERE $check";
    	$number = $this->num_rows( $rs_check );
        if( $number === 0 )
        {
            return false;
        }
        else
        {
            return true;
        }
        exit;
    }


    /**
     * Return specific row based on db query
     *
     * @access public
     * @param string
     * @return array
     *
     */
    public function get_row( $query )
    {
        $query = $this->link->query( $query );
        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
            $r = mysqli_fetch_row( $query );
            mysqli_free_result( $query );
            return $r;
        }
    }


    /**
     * Perform query to retrieve array of associated results
     *
     * @access public
     * @param string
     * @return array
     *
     */



	public function get_results( $query )
    {
        $row = array();
        $query = $this->link->query( $query );
        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
            while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {
                $row[] = $r;
            }
            mysqli_free_result( $query );
            return $row;
        }
    }


    /**
     * Insert data into database table
     *
     * @access public
     * @param string table name
     * @param array table column => column value
     * @return bool
     *
     */
    public function insert( $table, $variables = array() )
    {

        $sql = "INSERT INTO ". $table;
        $fields = array();
        $values = array();
        foreach( $variables as $field => $value )
        {
            $fields[] = $field;
            $values[] = "'".$value."'";
        }

        $fields = ' (' . implode(', ', $fields) . ')';
        $values = '('. implode(', ', $values) .')';

        $sql .= $fields .' VALUES '. $values;

        $query = mysqli_query( $this->link, $sql );

        if( mysqli_error( $this->link ) )
        {
            //return false;
            $this->log_db_errors( mysqli_error( $this->link ), $sql, 'Fatal' );
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
    * Insert data KNOWN TO BE SECURE into database table
    * Ensure that this function is only used with safe data
    * No class-side sanitizing is performed on values found to contain common sql commands
    * As dictated by the db_common function
    * All fields are assumed to be properly encapsulated before initiating this function
    *
    * @access public
    * @param string table name
    * @param array table column => column value
    * @return bool
    */
    public function insert_safe( $table, $variables = array() )
    {
        $sql = "INSERT INTO ". $table;
        $fields = array();
        $values = array();
        foreach( $variables as $field => $value )
        {
            $fields[] = $this->filter( $field );
            //Check for frequently used mysql commands and prevent encapsulation of them
            $values[] = $value;
        }
        $fields = ' (' . implode(', ', $fields) . ')';
        $values = '('. implode(', ', $values) .')';

        $sql .= $fields .' VALUES '. $values;
        $query = mysqli_query( $this->link, $sql );

        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $sql, 'Fatal' );
            return false;
        }
        else
        {
            return true;
        }
    }


    /**
     * Update data in database table
     *
     * @access public
     * @param string table name
     * @param array values to update table column => column value
     * @param array where parameters table column => column value
     * @param int limit
     * @return bool
     *
     */
    public function update( $table, $variables = array(), $where = array(), $limit = '' )
    {


        $sql = "UPDATE ". $table ." SET ";
        foreach( $variables as $field => $value )
        {

            $updates[] = "`$field` = '$value'
			";
        }
        $sql .= implode(', ', $updates);

        foreach( $where as $field => $value )
        {
            $value = $value;

            $clause[] = "$field = '$value'";
        }
        $sql .= ' WHERE '. implode(' AND ', $clause);

        if( !empty( $limit ) )
        {
            $sql .= ' LIMIT '. $limit;
        }

        $query = mysqli_query( $this->link, $sql );

        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $sql, 'Fatal' );
            return false;
        }
        else
        {
            return true;
        }
    }


    /**
     * Delete data from table
     *
     * @access public
     * @param string table name
     * @param array where parameters table column => column value
     * @param int max number of rows to remove.
     * @return bool
     *
     */
    public function delete( $table, $where = array(), $limit = '' )
    {
        $sql = "DELETE FROM ". $table;
        foreach( $where as $field => $value )
        {
            $value = $value;
            $clause[] = "$field = '$value'";
        }
        $sql .= " WHERE ". implode(' AND ', $clause);

        if( !empty( $limit ) )
        {
            $sql .= " LIMIT ". $limit;
        }

        $query = mysqli_query( $this->link, $sql );

        if( mysqli_error( $this->link ) )
        {
            //return false; //
            $this->log_db_errors( mysqli_error( $this->link ), $sql, 'Fatal' );
            return false;
        }
        else
        {
            return true;
        }
    }


    /**
     * Get last auto-incrementing ID associated with an insertion
     *
     * @access public
     * @param none
     * @return int
     *
     */
    public function lastid()
    {
        return mysqli_insert_id( $this->link );
    }


    /**
     * Get number of fields
     *
     * @access public
     * @param query
     * @return int
     */
    public function num_fields( $query )
    {
        $query = $this->link->query( $query );
        return mysqli_num_fields( $query );
        mysqli_free_result( $query );
    }

    /**
     * Get field names associated with a table
     *
     * @access public
     * @param query
     * @return array
     */
    public function list_fields( $query )
    {
        $query = $this->link->query( $query );
        return mysqli_fetch_fields( $query );
        mysqli_free_result( $query );
    }



    /**
     * Truncate entire tables
     *
     * @access public
     * @param array database table names
     * @return int number of tables truncated
     *
     */
    public function truncate( $tables = array() )
    {
        if( !empty($tables) )
        {
            $truncated = 0;
            foreach( $tables as $table )
            {
				echo $tables;
                $truncate = "TRUNCATE TABLE `".trim($table)."`";
                mysqli_query( $this->link, $truncate );
                if( !mysqli_error( $this->link ) )
                {
                    $truncated++;
                }
            }
            return $truncated;
        }
    }


	//TRUNCATE
	public function truncate1($table)
    {
        if( !empty($table) )
        {
			$truncated = 0;
                $truncate = "TRUNCATE TABLE `".trim($table)."`";
                mysqli_query( $this->link, $truncate );
				if( !mysqli_error( $this->link ) )
                {
                    $truncated++;
                }
				 return $truncated;
        }
    }


    /**
     * Output results of queries
     *
     * @access public
     * @param string variable
     * @param bool echo [true,false] defaults to true
     * @return string
     *
     */
    public function display( $variable, $echo = true )
    {
        $out = '';
        if( !is_array( $variable ) )
        {
            $out .= $variable;
        }
        else
        {
            $out .= '<pre>';
            $out .= print_r( $variable, TRUE );
            $out .= '</pre>';
        }
        if( $echo === true )
        {
            echo $out;
        }
        else
        {
            return $out;
        }
    }

	 public function update_column( $table, $variables = array(), $where = array() )
    {

        $sql = "UPDATE ". $table ." SET ";
        foreach( $variables as $field => $value )
        {

            $updates[] = "`$field` = $value
			";
        }
        $sql .= implode(', ', $updates);

        foreach( $where as $field => $value )
        {
            $value = $value;

            $clause[] = "$field = '$value'";
        }
        $sql .= ' WHERE '. implode(' AND ', $clause);

        if( !empty( $limit ) )
        {
            $sql .= ' LIMIT '. $limit;
        }

        $query = mysqli_query( $this->link, $sql );

        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $sql, 'Fatal' );
            return false;
        }
        else
        {
            return true;
        }
    }


	//

	public function get_results_dt( $query )
    {
        $row = array();
        $query = $this->link->query( $query );

        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
			$output = array('data' => array());
            $i = 1;
			while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {

                if($r['invoice_mail_status']==0)
                {
                  $r['invoice_mail_status'] = 'Not Yet Sent';

                }

                else
                {
                 $r['invoice_mail_status'] = 'Sent';
                }
				  if($r['invoice_sms_status']==0)
                {
                  $r['invoice_sms_status'] = 'Not Yet Sent';

                }

                else
                {
                 $r['invoice_sms_status'] = 'Sent';
                }
                $r['bal'] = $Csgst=sprintf("%01.2f", ($r['total']-$r['recived']));
                $r['sno'] = $r['customer_id'];
                $r['Edit'] = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" style="left: -78px;">
	   <li><a    id="" style="cursor:pointer" onclick="viewInvoiceCost(\''.$r['customer_id'].'\',\''.$r['total_rent_cost'].'\',\''.$r['pending_cost'].'\',\''.$r['extra_amount'].'\',\''.$r['lpc'].'\',\''.$r['tax'].'\')"> <i class="fa fa-inr"></i>Change Cost</a></li>

	  </ul>
	</div>';

				$output['data'][] = array($r['sno'], $r['customer_id'], $r['customer_name'],
 		        sprintf("%01.2f",round($r['total'])),
				sprintf("%01.2f",round($r['recived'])),
				sprintf("%01.2f",round($r['bal'])),
				$r['invoice_sms_status'],
				$r['invoice_mail_status'],
				$r['Edit']
				);


				//$row[] = $r;
			 $i++;

            }
            mysqli_free_result( $query );

            return $output;
        }
    }

	public function get_results_dp($query)
  {
    $row = array();
    $query = $this->link->query( $query );

    if( mysqli_error( $this->link ) )
    {
        $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
        return false;
    }
    else
    {
	      $output = array('data' => array());
        $i = 1;
	      while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
        {
          if($r['invoice_mail_status']==0)
          {
            $r['invoice_mail_status'] = 'Not Yet Sent';
          }
          else
          {
            $r['invoice_mail_status'] = 'Sent';
          }
	        if($r['invoice_sms_status']==0)
          {
            $r['invoice_sms_status'] = 'Not Yet Sent';
          }
          else
          {
            $r['invoice_sms_status'] = 'Sent';
          }
          $r['bal'] = $Csgst=sprintf("%01.2f", ($r['total']-$r['recived']));
          $r['sno'] = $r['customer_id'];
          $r['Edit'] = '<div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button><ul class="dropdown-menu" style="left: -78px;"><li><a id="" style="cursor:pointer" onclick="viewInvoiceCost(\''.$r['customer_id'].'\',\''.$r['total_rent_cost'].'\',\''.$r['pending_cost'].'\',\''.$r['extra_amount'].'\',\''.$r['lpc'].'\',\''.$r['tax'].'\')"><i class="fa fa-inr"></i>Change Cost</a></li><li><a id="" style="cursor:pointer" onclick="rentFollow(\''.$r['customer_id'].'\',\''.$r['customer_name'].'\',\''.$r['total'].'\',\''.$r['recived'].'\',\''.$r['bal'].'\',0)"><i class="fa fa-inr"></i>Rent Followup</a></li><li><a id="" style="cursor:pointer" onclick="rentFollow(\''.$r['customer_id'].'\',\''.$r['customer_name'].'\',\''.$r['total'].'\',\''.$r['recived'].'\',\''.$r['bal'].'\',1)"><i class="fa fa-inr"></i>Rent Followup(FULLY PAIDED)</a></li></ul></div>';
          if($r['bal'] > 0)
	        {
            $r['total'] = sprintf("%01.2f", ($r['total']));
            $output['data'][] = array($r['sno'], $r['customer_id'], $r['customer_name'], $r['total'], $r['recived'], $r['bal'], $r['invoice_sms_status'], $r['invoice_mail_status'],	$r['Edit']);
	        }
        $i++;
      }
      mysqli_free_result( $query );
      return $output;
    }
  }


	public function get_results_dt_customer( $query,$status )
  {
    $row = array();
    $query = $this->link->query( $query );
    if( mysqli_error( $this->link ) )
    {
      $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
      return false;
    }
    else
    {
			$output = array('data' => array());
      $i = 1;
			while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
      {
				if($status == 0)
				{
				  $r['sno'] = $r['enquiry_id'];

          $r['Edit'] = '<div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button><ul class="dropdown-menu" style="left: -78px;"><li><a    id="" onclick="viewCustomer(\''.$r['enquiry_id'].'\',\''.$r['customer_status'].'\')"> <i class="glyphicon glyphicon-eye-open"></i> View</a></li><li><a    id="" data-target="#editProductModal" onclick="editCustomer(\''.$r['enquiry_id'].'\',\''.$r['customer_status'].'\')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li><li><a  onclick="removeCustomer(\''.$r['enquiry_id'].'\',\''.$r['customer_status'].'\')"> <i class="glyphicon glyphicon-trash"></i> remove</a></li></ul></div>';

          $output['data'][] = array($r['sno'], $r['enquiry_id'], $r['customer_name'],

          $r['mobile'],
			    $r['extra_amount'],
			    $r['Edit']);
				}
			  else
			  {
			    $r['sno'] = $r['customer_id'];

          $r['Edit'] = '<div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button><ul class="dropdown-menu" style="left: -78px;"><li><a   style="cursor:pointer"  id="" onclick="viewCustomer(\''.$r['customer_id'].'\',\''.$r['customer_status'].'\')"> <i class="glyphicon glyphicon-eye-open"></i> View</a></li><li><a  style="cursor:pointer"   id="" data-target="#editProductModal" onclick="editCustomer(\''.$r['customer_id'].'\',\''.$r['customer_status'].'\')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li><li><a  style="cursor:pointer"  id="" onclick="Mapped(\''.$r['customer_id'].'\',\''.$r['customer_status'].'\',\''.$r['extra_amount'].'\',\''.$r['pending_cost'].'\')"> <i class="glyphicon glyphicon-list-alt"></i> Mapped Product</a></li><li><a  style="cursor:pointer"  onclick="removeCustomer(\''.$r['customer_id'].'\',\''.$r['customer_status'].'\')"> <i class="glyphicon glyphicon-trash"></i> Close</a></li></ul></div>';

          $output['data'][] = array($r['sno'], $r['customer_id'], $r['customer_name'],
		        $r['mobile'],
			    $r['extra_amount'],
			    $r['Edit']);
			  }
			  $i++;
      }
      mysqli_free_result( $query );
      return $output;
    }
  }


	public function get_results_dt_clo_customer( $query,$status )
    {
        $row = array();
        $query = $this->link->query( $query );

        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
			$output = array('data' => array());
            $i = 1;
			while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {




				    $r['sno'] = $r['customer_id'];
                $r['Edit'] = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" style="left: -78px;">
	   <li><a   style="cursor:pointer"  id="" onclick="viewCustomer(\''.$r['customer_id'].'\',\''.$r['customer_status'].'\')"> <i class="glyphicon glyphicon-eye-open"></i> View</a></li>
	    <li><a  style="cursor:pointer"   id="" data-target="#editProductModal" onclick="editCustomer(\''.$r['customer_id'].'\',\''.$r['customer_status'].'\')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
		<li><a  style="cursor:pointer"  id="" onclick="Mapped(\''.$r['customer_id'].'\',\''.$r['customer_status'].'\',\''.$r['extra_amount'].'\',\''.$r['pending_cost'].'\')"> <i class="glyphicon glyphicon-list-alt"></i> Mapped Product</a></li>
	    <li><a  style="cursor:pointer"  onclick="revoke(\''.$r['customer_id'].'\',\''.$r['customer_status'].'\')"> <i class="fa fa-undo"></i>Move Live Customer</a></li>
	  </ul>
	</div>';

	$newDate = date("d-m-Y", strtotime($r['closed_on']));
	$output['data'][] = array($r['sno'], $r['customer_id'], $r['customer_name'],
 		        $r['email'],
				$newDate,
				$r['Edit']);







				//$row[] = $r;
			 $i++;

            }
            mysqli_free_result( $query );

            return $output;
        }
    }


	public function get_results_dt_new_customer( $query )
    {
        $row = array();
        $query = $this->link->query( $query );

        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
			$output = array('data' => array());
            $i = 1;
			while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {




                $r['sno'] = $r['customer_id'];
                $r['Edit'] = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" style="left: -78px;">
	   <li><a type="button"  href="" id="" onclick="viewCustomer('.$r['customer_id'].')"> <i class="glyphicon glyphicon-eye-open"></i> View</a></li>
	    <li><a type="button"  href="" id=""  onclick="editCustomer('.$r['customer_id'].')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button"  href=""onclick="removeCustomer(\''.$r['customer_id'].'\')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>
	  </ul>
	</div>';

				$output['data'][] = array($r['sno'], $r['customer_id'], $r['customer_name'],
 		        $r['email'],
				$r['extra_amount'],
				$r['Edit']
				);


				//$row[] = $r;
			 $i++;

            }
            mysqli_free_result( $query );

            return $output;
        }
    }

	public function get_mapped_list( $query )
    {
        $row = array();
        $query = $this->link->query( $query );

        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
			$output = array('data' => array());
            $i = 1;
			while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {




                $r['sno'] = $r['product_id'];
                $r['Edit'] = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" style="left: -78px;">
	    <li><a  onclick="reportProduct(\''.$r['product_id'].'\',\''.$r['pending_cost'].'\')"> <i class="fa fa-exchange"></i>Refund</a></li>
	  </ul>
	</div>';

				$output['data'][] = array($r['sno'], $r['product_id'], $r['customer_id'],$r['mobile'],
 		        $r['closure_date'],
				$r['Edit']);


				//$row[] = $r;
			 $i++;

            }
            mysqli_free_result( $query );

            return $output;
        }
    }


	public function get_results_excoustomer( $query,$type,$stat )
  {
    $row = array();
    $query = $this->link->query( $query );
    if( mysqli_error( $this->link ) )
    {
      $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
      return false;
    }
    else
    {
			$output = array();
      $i = 1;
			while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
      {
        $r['sno'] = $r['enquiry_id'];

        $r['Edit'] = '<div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button><ul class="dropdown-menu" style="left: -78px;width:177px;"><li><a type="button" data-toggle="modal" href="" id="editProductModalBtn" onclick="viewEnquiry(\''.$r['enquiry_id'].'\')"> <i class="fa fa-eye"></i> View</a></li><li><a type="button" data-toggle="modal" href="" id=""  onclick="editEnquiry(\''.$r['enquiry_id'].'\')"> <i class="fa fa-pencil"></i> Edit</a></li><li><a type="button" data-toggle="modal" href="" id="editProductModalBtn"  onclick="enquiryPayment(\''.$r['enquiry_id'].'\',\''.$r['enquiry_date'].'\',\''.$r['customer_status'].'\',\''.$r['total_security_amount'].'\',\''.$r['total_processing_fee'].'\',\''.$r['t_installation_fee'].'\',\''.$r['total_amount'].'\',\''.$r['amount_received_from_customer'].'\',\''.$r['customer_id'].'\',\''.$r['customer_name'].'\',\''.$r['mail_status'].'\',\''.$r['is_modified'].'\')"> <i class="fa fa-inr"></i> Payment & Approve</a></li><li><a type="button" data-toggle="modal" href="" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeEnquiry(\''.$r['enquiry_id'].'\')"> <i class="fa fa-ban"></i>Reject</a></li></ul></div>';

				$output= array($r['sno'],$r['enquiry_id'], $r['customer_name'], $r['enquiry_date'], $r['attended_by'], $r['assigned_to'], $stat,$r['Edit']);
			  $i++;
      }
      mysqli_free_result( $query );
      return $output;
    }
  }

	public function get_results_for_verified( $query,$type,$stat )
  {
    $row = array();
    $query = $this->link->query( $query );
    if( mysqli_error( $this->link ) )
    {
      $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
      return false;
    }
    else
    {
			$output = array();
      $i = 1;
			while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
      {
        $r['sno'] = $r['enquiry_id'];

        $r['Edit'] = '<div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button><ul class="dropdown-menu" style="left: -78px;width:70px;"><li><a type="button" data-toggle="modal" href="" id="editProductModalBtn" onclick="viewEnquiry(\''.$r['enquiry_id'].'\')"> <i class="fa fa-eye"></i> View</a></li> <li><a type="button" data-toggle="modal" href="" id="" onclick= "productMaping(\''.$r['enquiry_id'].'\', \''.$r['is_mapped'].'\')"> <i class="fa fa-pencil"></i> Mapping</a></li><li><a type="button" data-toggle="modal" href="" id="editProductModalBtn"  onclick="enquiryPayment(\''.$r['enquiry_id'].'\',\''.$r['enquiry_date'].'\', \''.$r['customer_status'].'\',\''.$r['total_security_amount'].'\',\''.$r['total_processing_fee'].'\',\''.$r['t_installation_fee'].'\',\''.$r['total_amount'].'\',\''.$r['amount_received_from_customer'].'\',\''.$r['customer_id'].'\',\''.$r['customer_name'].'\')"> <i class="fa fa-inr"></i> Payment History</a></li></ul></div>';

				$output= array($r['sno'],$r['enquiry_id'], $r['customer_name'], $r['enquiry_date'], $r['attended_by'], $r['assigned_to'],$stat, $r['Edit']);
			  $i++;
      }
      mysqli_free_result( $query );
      return $output;
    }
  }


	public function get_results_for_rejected( $query,$type,$stat )
    {
        $row = array();
        $query = $this->link->query( $query );

        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
			$output = array();
            $i = 1;
			while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {





                $r['sno'] = $r['enquiry_id'];
                $r['Edit'] = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" style="left: -78px;width:70px;">
	   <li><a type="button" data-toggle="modal" href="" id="editProductModalBtn" onclick="viewEnquiry(\''.$r['enquiry_id'].'\')"> <i class="fa fa-eye"></i> View</a></li>


	  </ul>
	</div>';

				$output= array($r['sno'],$r['enquiry_id'], $r['customer_name'], $r['enquiry_date'],
 		        $r['attended_by'],
				$r['assigned_to'],$stat,
				$r['Edit']
				);



				//$row[] = $r;
			 $i++;

            }
            mysqli_free_result( $query );

            return $output;
        }
    }


	public function get_results_map( $query )
    {
        $row = array();
        $query = $this->link->query( $query );

        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
			$output = array('data' => array());
			$t=date('d-m-Y');
			$c_m=date("m",strtotime($t));
			$c_y=date("y",strtotime($t));
			$t_d = cal_days_in_month(CAL_GREGORIAN, $c_m, $c_y);
			//echo $total_day;


            while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {

			$a =  $r['rent_on_date'];
			$aa = $r['product_id'];
			$aaa = substr($aa, 0, 2);

			if($a!="")
			{

			 $per_day=$r['rent_per_month']/$t_d ;

			 $d=date("d",strtotime($a));
			 $m=date("m",strtotime($a));
			 $y=date("y",strtotime($a));
			 if($c_m == $m && $c_y == $y )
			 {
				 if($d == 1)
				 {

				 }
				 else
				 {

			   $rent_cost = (($t_d-$d+1)*$per_day);
					 	//$row[] = $r;
				if($aaa =='CY')
			    {
				   $tax = (12 / 100) * $rent_cost;
			    }

			//	else if($aaa =='WC' || $aaa =='MT' || $aaa =='TU' || $aaa =='CT' || $aaa =='SO' || $aaa =='DT' || $aaa =='IC' || $aaa =='CC' || $aaa == 'EB' )
      else if($aaa =='AC' || $aaa =='TV'  )
				{
          //EK DT SR
					$tax = (28 / 100) * $rent_cost;
				}
        else if($aaa =='BE' || $aaa =='WD'  )
          {
            //EK DT SR
            $tax = (5 / 100) * $rent_cost;
          }
			    else
			    {
				   $tax = (18 / 100) * $rent_cost;
			    }

				     $invoiceData = $this->updateNewInvoice($rent_cost,$r['id'],$tax);

				  }
				 //echo($r['id']);

			 }
			}


            }
            mysqli_free_result( $query );

            return $output;
        }
    }

	  public function get_results_inall( $query )
    {
        $row = array();
        $query = $this->link->query( $query );
        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
            while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {
                $row[] = $r;
				$c_id = $r["customer_id"];
				$r_c   = $r["total_rent_cost"];
				$p_r  = $r["pending_rent_cost"];
				$p_a  = $r["pending_security_amount"];
				$tax  = $r["tax"];
        $now = new \DateTime('now');
  $month = $now->format('M');
  $year = $now->format('Y');

		$insertimagenames = array( 'customer_id' => $c_id, 'total_rent_cost' =>$r_c, 'pending_rent_cost' =>$p_r, 'pending_security_amount' =>$p_a,'month'=>$month,'year'=>'2018','tax'=>$tax);
		$add_query = $this->insert( 'invoice', $insertimagenames );


            }

		$t=date('d-m-Y');
        $m=date("m",strtotime($t));
		$y=date("y",strtotime($t));
		$insertimagename = array( 'month' => $m,'year' => $y,'status'=>1);
		$add_quer = $this->insert( 'month_invoice', $insertimagename );

            mysqli_free_result( $query );
            return $row;
        }
    }

	public function get_results_invoice_pdf( $query )
    {
        $row  = array();

        $query = $this->link->query( $query );
        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
            while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {
                $row[] = $r;

            }
            mysqli_free_result( $query );
            return $row;
        }
    }

      // Product List
    public function get_results_dt_product( $query )
    {
        $row = array();
        $query = $this->link->query( $query );

        if( mysqli_error($this->link))
        {
            $this->log_db_errors(mysqli_error($this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
            $output = array('data' => array());
            $i = 1;
            while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {
                $r['sno'] = $r['product_id'];
                $r['Edit'] = '<a href="#" onclick="viewproductid(\''.$r['product_id'].'\')">View</a> | <a href="#" onclick="editproductid(\''.$r['product_id'].'\')">Edit</a> | <a href="#" onclick="reportProduct(\''.$r['product_id'].'\')">Report</a>';
                $productiid =  $r['product_id'];
                if($r['prtd_location'] == 0)
                {
                    $r['prtd_location'] = 'Customer Place';
                }
                else
                {
                    $r['prtd_location'] = 'Godown';
                }


                $currentdata = date('Y-m-d');

                if($currentdata > $r['warranty_end_date'])
                {
                     $r['warranty'] = "Close"."(".$r['warranty_end_date'].")";
                }
                else
                {
                    $r['warranty'] = $r['warranty_end_date'];
                }
                $originalDate = $r['purchase_date'];
                $r['purchase_date'] = date("d/m/Y", strtotime($originalDate));
                $output['data'][] = array($r['sno'], $r['product_id'], $r['purchase_date'],
                $r['purchase_cost'],
                $r['prtd_location'],
                $r['warranty'],
                $r['Edit']
                );

             $i++;
            }
            mysqli_free_result( $query );
            return $output;
        }
    }


		 public function return_list_db( $query )
    {
        $row = array();
        $query = $this->link->query( $query );

        if( mysqli_error($this->link))
        {
            $this->log_db_errors(mysqli_error($this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
            $output = array('data' => array());
            $i = 1;
            while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {
                $r['sno'] = $r['product_id'];
                $r['Edit'] = '<a href="#" onclick="reportProduct(\''.$r['product_id'].'\')">Close</a>';
                $productiid =  $r['product_id'];
                $originalDate = $r['return_date'];
                $newDate = date("d/m/Y", strtotime($originalDate));

                $currentdata = date('Y-m-d');



                $output['data'][] = array($r['sno'], $r['product_id'], $r['customer_id'],
                $newDate,
                $r['Edit']
                );

             $i++;
            }
            mysqli_free_result( $query );
            return $output;
        }
    }

	public function get_results_product_report( $query )
    {
        $row = array();
        $query = $this->link->query( $query );
        if( mysqli_error( $this->link ) )
        {
            $this->log_db_errors( mysqli_error( $this->link ), $query, 'Fatal' );
            return false;
        }
        else
        {
            while( $r = mysqli_fetch_array( $query, MYSQLI_ASSOC ) )
            {

				if($r["closure_date"] == 0 )
				{
				 $now = time(); // or your date as well
                $your_date = strtotime($r["rent_on_date"]);
                $datediff = $now - $your_date;
				}
				else
				{
				 $now = strtotime($r["closure_date"]); // or your date as well
				 $your_date =strtotime($r["rent_on_date"]);
               // $your_date = strtotime($r["rent_on_date"]);
                $datediff = $now - $your_date;
				}
				$r["to_days"] = floor($datediff / (60 * 60 * 24));
				$perday       = $r["rent_per_month"] /30;
				$r["to_rent"] = $r["to_days"] * $perday;



                $row[] = $r;
            }
            mysqli_free_result( $query );
            return $row;
        }
    }






    /**
     * Disconnect from db server
     * Called automatically from __destruct function
     */
    public function disconnect()
    {
		mysqli_close( $this->link );
	}

}
