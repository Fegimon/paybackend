<?php
/**
 * @Author Mirriorminds
 * @Copyright 2015
 */
class createConnection extends AM_Exceptions //create a class for make connection
{
    var $myconn;
	public function __construct($App){
        $this->App = $App;
		self::connectToDatabase();
		set_error_handler(array($this, 'myErrorHandler'));
    }
	
    function connectToDatabase() // create a function for connect database
    {
        $conn= @mysql_connect($this->App->components->db->host,$this->App->components->db->username,$this->App->components->db->password);
        if(!$conn)// testing the connection
        {
		$heading = "Database";
		$message = "Connection Cannot established";
		$this->show_error($heading, $message);
		exit;
        }
        else
        {
            $this->myconn = $conn;
			$this->selectDatabase();
            //echo "Connection established";
        }
        return $this->myconn;
    }

    function selectDatabase() // selecting the database.
    {
        mysql_select_db($this->App->components->db->dbname);  //use php inbuild functions for select database
        if(mysql_error()) // if error occured display the error message
        {
		$heading = "Database";
		$message = "Cannot find the database ".$this->App->components->db->dbname."\n";
		$this->show_error($heading, $message);
		exit;
        }
         //echo "Database selected..";       
    }
    function closeConnection() // close the connection
    {
        mysql_close($this->myconn);

        echo "Connection closed";
    }
	public function __autoload(){
	return $this->mysql_Cache(1);
	}
	function check_admin()
	{
		if(!$_SESSION['admin_id'])
		{
				$this->divert(ADMIN_URL);
		}
	}
	function check_user($url="")
	{
		if(!$_SESSION['ses_userid'])
		{
			$url=($url)?$url:SITE_URL;
			$this->divert($url);
		}
	}
	function check_seller($url="")
	{
		if(!($_SESSION['ses_usertype']=="S"||$_SESSION['ses_usertype']=="O"&&isset($_SESSION['ses_userid'])))
		{
			$url=($url)?$url:SITE_URL;
			$this->divert($url);
		}
	}
	function check_buyer($url="")
	{
		if(!($_SESSION['ses_usertype']=="B"||$_SESSION['ses_usertype']=="O"&&isset($_SESSION['ses_userid'])))
		{
			$url=($url)?$url:SITE_URL;
			$this->divert($url);
		}
	}
    function encpyt($str)
    {
		$this->r=&new AM_Encryption($this->App);
        return $this->r->encode($str);
    }	
    function decpyt($str)
    {
		$this->r=&new AM_Encryption($this->App);
        return $this->r->decode($str);
    }
	
	
	public function encode($value) {

		if (!$value) {
			return false;
		}
		return base64_encode($value);
	}

	public function decode($value)
	{
		if (!$value)
		{
			return false;
		}
		return base64_decode($value);
	}
	function pagination($tbl_name,$fields,$where='',$orderby='',$page_url,$pagesize,$page_no,$print='')
	{
		//STRICT FOR SINGLE TABLE
		$pagesize=($pagesize)?$pagesize:10;
		if($where)$where=" WHERE ".$where;
		if($orderby)$orderby=" ORDER BY ".$orderby;
	    $sql1="SELECT 1 FROM ".$tbl_name.$where.$orderby;
		//$sql1="SELECT ".$fields." FROM ".$tbl_name.$where.$orderby;

		$rowsperpage = $pagesize;
		$website = $page_url; 
		/*
		#valid page no. check  
		$check=$pagesize*$page_no;
		$qsql1 = @mysql_query($sql1) or die("failed");
		$RecordCount = mysql_num_rows($qsql1);
		
		
		if($check>$RecordCount)
		{
			if((($check-$RecordCount)>$pagesize))
			{
				$this->divert($page_url);
			}
		}
		*/
		 
		
		$pagination = new AM_CSSPagination_admin($sql1, $rowsperpage, $website); 
		$pagination->setPage($page_no);
		
		//$qsql1 = @mysql_query($sql1) or die("failed");
		//$RecordCount = mysql_num_rows($qsql1);
		
		
		
		$sql2 = "select ".$fields." FROM ".$tbl_name.$where.$orderby." LIMIT ".$pagination->getLimit() . ", ". $rowsperpage; 
		if($print)
		echo $sql2;
		$result_query = @mysql_query($sql2);
		$page = $pagination->showPage();
		$RecordCount=$pagination->retrunTotalRows();
		
		#valid page no. check
		$check=$pagesize*$page_no;  
		if($check>$RecordCount)
		{
			if((($check-$RecordCount)>$pagesize))
			{
				$this->divert($page_url);
			}
		}
		$resultArr = array();
		if($RecordCount>1)
		{
			while($res = mysql_fetch_assoc($result_query))
			{
				$resultArr[] = $res;
			}
		}
		else if($RecordCount==1)
		{
			$res = mysql_fetch_assoc($result_query);
			$resultArr[] = $res;
		}
		$array_res	=	array('result'=>$resultArr,'page'=>$page,'nr'=>$RecordCount);
		return $array_res;
	}	

  
	public function dlimit($desc,$len)
	{
		$desc=strip_tags($desc);
		$slen=strlen($desc);
		if($slen>$len)
			{
			$tdes=substr($desc, 0, $len-3).'...';
			}
		else
			{
			$tdes=$desc;
			}
	return $tdes;
	}	
	#pagination
	function OrderPaging($tbl_name,$fields,$where='',$orderby='',$page_url,$pagesize,$page_no)
	{
		if($where)$where=" WHERE ".$where;
		if($orderby)$orderby=" ORDER BY ".$orderby;
		 $sql1="SELECT ".$fields." FROM ".$tbl_name.$where.$orderby;
		$rowsperpage = $pagesize;
		$website = $page_url; 
		$pagination = new AM_CSSPagination($sql1, $rowsperpage, $website); 
		$pagination->setPage($page_no); 
		$qsql1 = @mysql_query($sql1) or die("failed");
		$RecordCount = mysql_num_rows($qsql1);
		$sql2 = "select ".$fields." FROM ".$tbl_name.$where.$orderby." LIMIT ".$pagination->getLimit() . ", ". $rowsperpage; 
		$result_query = @mysql_query($sql2);
		$page = $pagination->showPage();
		$pages = $pagination->getLastPage();
		$resultArr = array();
		if($RecordCount>1)
		{
			while($res = mysql_fetch_assoc($result_query))
			{
				$resultArr[] = $res;
			}
		}
		else if($RecordCount==1)
		{
			$res = mysql_fetch_assoc($result_query);
			$resultArr[] = $res;
		}
		$array_res	=	array('result'=>$resultArr,'page'=>$page,'pages'=>$pages,'nr'=>$RecordCount);
		return $array_res;
	}	
	function paging($tbl_name,$fields,$where='',$orderby='',$page_url,$pagesize,$page_no)
	{
		if($where)$where=" WHERE ".$where;
		if($orderby)$orderby=" ORDER BY ".$orderby;
	   	$sql1="SELECT ".$fields." FROM ".$tbl_name.$where.$orderby;
		$rowsperpage = $pagesize;
		$website = $page_url; 
		$pagination = new AM_Paging($sql1, $rowsperpage, $website); 
		$pagination->setPage($page_no); 
		$qsql1 = @mysql_query($sql1) or die("failed");
		$RecordCount = mysql_num_rows($qsql1);
		$sql2 = "select ".$fields." FROM ".$tbl_name.$where.$orderby." LIMIT ".$pagination->getLimit() . ", ". $rowsperpage; 
		$result_query = @mysql_query($sql2);
		$page = $pagination->showPage();
		$pages = $pagination->getLastPage();
		$resultArr = array();
		if($RecordCount>1)
		{
			while($res = mysql_fetch_assoc($result_query))
			{
				$resultArr[] = $res;
			}
		}
		else if($RecordCount==1)
		{
			$res = mysql_fetch_assoc($result_query);
			$resultArr[] = $res;
		}
		$array_res	=	array('result'=>$resultArr,'page'=>$page,'pages'=>$pages,'nr'=>$RecordCount);
		return $array_res;
	}	
	public function select_query($table_name, $field_name, $condition, $limitations='',$print='')
	{
		
		$resultArr=array();
		if($field_name == "")
		{
			$field_name = "*";
		}
		
		$selectQ = "select $field_name from $table_name";
		if($condition!="")
		{
			$selectQ .= " where $condition";
		}
		if($limitations!="")
		{
			$selectQ .= " limit $limitations";
		}
		if($print){echo $selectQ."<br>";}
	   
		$resQuery = mysql_query($selectQ);
		
		if(($_SERVER['HTTP_HOST']=="localhost:81" || $_SERVER['HTTP_HOST']=="localhost") && mysql_error())
		{
			echo $sql,"<br>",mysql_error();
		}
	   
		 $NumRows    =    mysql_num_rows($resQuery);
	   
		if($limitations == 1)
		{
			$fetchArray    =    mysql_fetch_assoc($resQuery);
		   
			$fetchArray['nr']    =    $NumRows;
		   
			return $fetchArray;
		}
		else
		{
			while($res = mysql_fetch_assoc($resQuery))
			{
				$resultArr[] = $res;
			}
			return array('Query' => $resQuery,'nr' => $NumRows,'result'=>$resultArr);
		}
		
	}
	public function select_query_count($table_name, $field_name, $condition, $limitations='',$print='')
	{
		$resultArr=array();
		if($field_name == "")
		{
			$field_name = "*";
		}
		$selfield = mysql_query("show columns from $table_name");
		$rowfield = @mysql_fetch_array($selfield);
		$selectQA = "select COUNT(".$rowfield[0].") as C from $table_name ";
		if($condition!="")
		{
			$selectQA .= " where $condition";
		}
		if($print){echo $selectQA."<br>";}
		$gCQuery=mysql_fetch_assoc(mysql_query($selectQA." LIMIT 1"));
		$gC=$gCQuery['C'];
		return $gC;
		
	}	
	function insert($table, $exist = '', $new_field = '', $up_folder = '',$newfilename='') {
		$insertfield='';
		$insertvalue='';
		if ($up_folder == "") {
			$folder = "upload/";
		} else {
			$folder = "$up_folder/";
			#create dir
			if(!is_dir($folder))
			{
				mkdir($folder, 0777);
			}
		}
	
	
		$selfield = mysql_query("show columns from $table");
		while ($rowfield = @mysql_fetch_assoc($selfield)) {
			$field[] = $rowfield['Field'];
		}
		//print_r($field);
	
		$existcond = substr($exist, 0, strlen($exist) - 5);
	
		//echo $existcond."<br>";
	
		$selexist = mysql_query("select * from $table where $existcond");
	
		//echo "select * from $table where $existcond";
	
		$checkexist = mysql_affected_rows();
	
		if ($checkexist <= 0) {
	
	
			foreach ($_POST as $key => $value) {
				if (@in_array($key, $field)) {
					
					//DIRECT 
					if(!$new_field[$key] && !@array_key_exists ($key,$new_field))
					{
						$insertfield.= "$key, ";
						$insertvalue.= "'" . $this->variable($_POST[$key]) . "', ";
					}
				}
			}
	
			if ($new_field) {
				foreach ($new_field as $key => $value) {
					if (@in_array($key, $field)) {
						$insertfield.= "$key, ";
						$insertvalue.= "'" . $this->variable($new_field[$key]) . "', ";
					}
				}
			}
	
			if ($_FILES) {
	
				foreach ($_FILES as $key => $value) {
					
					if (@in_array($key, $field) && $_FILES[$key]['name']&&!$new_field[$key])
					{
						
						$insertfield.= "$key, ";
						#upload with new filename
						if($newfilename)
						{
							$file_name = $_FILES[$key]['name'];
							$file_name=$this->uploadfilename($file_name,$newfilename);
							
							if($file_name)
							{
								$insertvalue.= "'".$file_name."', ";
								@move_uploaded_file($_FILES[$key]['tmp_name'],$folder.$file_name);
							}else
							{
								$insertvalue.= "'', ";
							}
							
						}else
						{
							
							$file_name = $_FILES[$key]['name'];
							$file_name=$this->uploadfilename($file_name);
							if($file_name)
							{
								$insertvalue.= "'".$file_name."', ";
								@move_uploaded_file($_FILES[$key]['tmp_name'],$folder.$file_name);
							}else
							{
								$insertvalue.= "'', ";
							}
							
							
						}
					}
				}
			}
			if (@in_array("date", $field)) {
				$insert_field = $insertfield . "date";
				$insert_value = $insertvalue . "curdate()";
			} else {
				$insert_field = substr($insertfield, 0, strlen($insertfield) - 2);
				$insert_value = substr($insertvalue, 0, strlen($insertvalue) - 2);
			}
	
			//echo $insert_field,"<br>";
			//echo $insert_value;
			$ins_query = "insert into $table($insert_field) values($insert_value)";
			//echo $ins_query;
			$result = mysql_query($ins_query);
	
			if (mysql_error()) {
				echo mysql_error(), "<br>", $ins_query;
			}
	
			$ar = mysql_affected_rows();
			$insert_id = mysql_insert_id();
	
			return array('ar' => $ar, 'id' => $insert_id);
		} else {
			//echo "Already Exist";
			return array('exist' => '1');
		}
	}
	
	function update($table, $upcond, $new_field = '', $up_folder = '', $checkbox = '',$newfilename = '') {
		
		$updatefield='';
		$field='';
		if ($up_folder == "") {
			$folder = "upload/";
		} else {
			$folder = "$up_folder/";
			#create dir
			if(!is_dir($folder))
			{
				mkdir($folder, 0777);
			}
		}
	
	
		$selfield = mysql_query("show columns from $table");
	
		while ($rowfield = @mysql_fetch_assoc($selfield)) {
			$field[] = $rowfield['Field'];
		}
		//print_r($field);
	
		foreach ($_POST as $key => $value) {
			if (@in_array($key, $field)) {
				//DIRECT 
					if(!$new_field[$key]&&!@array_key_exists ($key,$new_field))
					{
				$updatefield.= "$key = " . "'" . $this->variable($_POST[$key]) . "', ";
					}
			}
		}
	
		if ($new_field) {
			foreach ($new_field as $key => $value) {
				if (@in_array($key, $field)) {
					$updatefield.= "$key = " . "'" . $this->variable($new_field[$key]) . "', ";
				}
			}
		}
	
		if ($_FILES) {
	
			foreach ($_FILES as $key => $value) {
				if (@in_array($key, $field) && $_FILES[$key]['name']&&!$new_field[$key])
				{
					
					if($newfilename)
					{
						$file_name = $_FILES[$key]['name'];
						$file_name=$this->uploadfilename($file_name,$newfilename);
						if($file_name)
						{
							$updatefield.= "$key = "."'".$file_name."', ";
							@move_uploaded_file($_FILES[$key]['tmp_name'],$folder.$file_name);
						}else
						{
							$updatefield.= "$key = "."'', ";
						}
					}else
					{
						$file_name = $_FILES[$key]['name'];
						$file_name=$this->uploadfilename($file_name);
						
						if($file_name)
						{
							$updatefield.= "$key = "."'".$file_name."', ";
							@move_uploaded_file($_FILES[$key]['tmp_name'],$folder.$file_name);
						}else
						{
							$updatefield.= "$key = "."'', ";
						}
					}
					
				}
			}
		}
	
		if ($checkbox) {
	
			$expcheckbox = explode(",", $checkbox);
			foreach ($expcheckbox as $checkboxvar) {
				if (@in_array($checkboxvar, $field) && $_POST[$checkboxvar] == "") {
					$updatefield.= "$checkboxvar = " . "'" . $_POST[$checkboxvar] . "', ";
				}
			}
		}
	
		$insert_field = substr($updatefield, 0, strlen($updatefield) - 2);
	
		//echo $insert_field,"<br>";
		$up_query = "update $table set $insert_field where $upcond";
		
		$result = mysql_query($up_query);
		//echo $up_query."<br>";
	
		if (mysql_error()) {
			echo mysql_error(), "<br>", $ins_query;
		}
	
		$ar = mysql_affected_rows();
	
		return array('ar' => $ar);
	}	
	function delete_query($table_name, $condition) {
		$deleteQ = "delete from $table_name where $condition";
	
		//echo $deleteQ."<br>";
	
		return mysql_query($deleteQ);
	}
	function uploadfilename($file_name,$new_name='')
	{
		$fileinfo=pathinfo($file_name);
		$file_extn =  $fileinfo['extension'];
		$randtoken=$this->get_rand_id(4);
		if($new_name)
		{
			$new_name=@str_replace(' ', '-',trim($new_name));
			$newfilename= @preg_replace('/[^A-Za-z0-9\-]/', '', $new_name);
			
			$newfilename=@substr(strtolower($newfilename),0,200).'-'.$randtoken.uniqid();
			$file_name=$newfilename.'.'.$file_extn;
		}else
		{
			$newfilename=$fileinfo['filename'];
			$newfilename=@str_replace(' ', '-',$newfilename);
			$newfilename= @preg_replace('/[^A-Za-z0-9\-]/', '', $newfilename);
			$newfilename=@substr(strtolower($newfilename),0,200).'-'.$randtoken.uniqid();
			$file_name=$newfilename.'.'.$file_extn;
		}
		
		$newname=@preg_replace('/-+/', '-',$file_name );
		return $newname;
	}
	
	public function check_version()
	{
		if (!defined('PHP_VERSION_ID'))
		{
			$version = explode('.', PHP_VERSION);
			define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
		}
		if (PHP_VERSION_ID > 50300)
		{ 
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function escape_str($str, $like = FALSE)
	{
		if (is_array($str))
		{
			foreach ($str as $key => $val)
	   		{
				$str[$key] = $this->escape_str($val, $like);
	   		}

	   		return $str;
	   	}

		if (function_exists('mysql_real_escape_string') AND is_resource($this->myconn))
		{
			$str = mysql_real_escape_string($str, $this->myconn);
		}
		elseif (function_exists('mysql_escape_string'))
		{
			$str = mysql_escape_string($str);
		}
		else
		{
			$str = addslashes($str);
		}

		// escape LIKE condition wildcards
		if ($like === TRUE)
		{
			$str = str_replace(array('%', '_'), array('\\%', '\\_'), $str);
		}

		return $str;
	}	
	function Execute($sql) {
		$resQ = mysql_query($sql);
	//print_r($sql);
		return($resQ);
	}
	function Execute1($sql) {
		$resQ = mysql_query($sql);
	
		return($resQ);
	}
	function getRow($sqlRow) {
		
		$resArr = mysql_fetch_array(mysql_query($sqlRow));
	
		return $resArr;
	}
	
	function variable($vari) {
		//$varVal = str_replace("'","''",stripslashes($vari));
		//$varVal = mysql_real_escape_string(trim($varVal));
		$varVal = trim($this->escape_str($vari));
		return $varVal;
	}
	function divert($url)
	{
		if (!headers_sent())
		{
			header('Location: '.$url);
			exit;
		}
		else
		{
			echo '<script type="text/javascript">';
			echo 'window.location.href="'.$url.'";';
			echo '</script>';
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
			echo '</noscript>'; exit;
		}
	}

	public function stripval($input,$char='')
	{
		/*if($strval)
		{
			return stripslashes(trim($strval));
		}
		else
		{
			if($char)
			{
				return $char;
			}
			else
			{
				return "";
			}
		}*/
		if (is_array($input))
		{
			
			$input = stripslashesFull($input);
		}
		elseif(is_object($input))
		{
			$input =stripslashesFull($input);
			
		}else
		{
			$input = stripslashes($input);
		}
		return $input;
	}
	public function load($name) {
		$filename = $name.'.php';
		$file = dirname(__FILE__).'/applib/'.$filename;
		if ( ! file_exists($file))
		{
			return FALSE;
		}
		include $file;	
	}	
	public function minval($x,$y){
		if($y<=$x)
		{
		return $y;
		}
		else
		{
		return $x;
		}
	}
	public function mnuLimit($a,$b){
		$x=10;
		$y=5;
		$a=$this->minval($x,$a);
		$b=$this->minval($x,$b);
		$n=$this->minval($y,$b);
		if($b==0)
		{
			$m=$a;
			$n=0;
		}
		elseif($b>0)
		{
			if($a==$b){
				$m=$a;
				if($a>$y){
				$m=$this->minval($y,$a);
				}
				
			}
			elseif($a!=$b)
			{
				$m=$a;
				$r=($a+$b)%10;
				if($a>$y){
					if($b>$a)
					{
					$m=$this->minval($y,$a);
					}
					else
					{
					if($b>$y && $y<$a){
					$m=$y;
					}else{
					$m=($a-$r);
					}
					}
				}
				elseif($b>$y)
				{
					$n=($b-$r);	
				}
	//			$m=($a-$b);
			}
		}
	return array(0=>$m,1=>$n);
	}
	function parseUrl($matches='')
	{
		if($matches!=""){
		if(preg_match("/(https|http|ftp):\/\//i", $matches)){
		$matches= $matches;
		}else{
		$matches= "http://".$matches;
		}}else{$matches="javascript:void(0);";}
	return $matches;
	}
	public function settings()
	{
		$Select_setting=$this->select_query("tbl__admin", "*", "",1);
		return $Select_setting;
	}

	public function lazyload()
	{
	$DataImgSrc = dirname(__FILE__)."/../x.gif";
	$DataImgBinary = fread(fopen($DataImgSrc, "r"), filesize($DataImgSrc));
	$DataImgStr = base64_encode($DataImgBinary);
	return $DataImage="data:image/jpg;base64,".$DataImgStr;
	}
	
	/*****Encrypt Password Start****/
	public function tep_encrypt_password($plain) {
		$password = '';
	
		for ($i=0; $i<10; $i++) {
		  $password .= rand();
		}
	
		$salt = substr(md5($password), 0, 2);
	
		$password = md5($salt . $plain) . ':' . $salt;
	
		return $password;
	  }
	  
	  
	  public function tep_validate_password($plain, $encrypted) {
		if ($this->tep_not_null($plain) && $this->tep_not_null($encrypted)) {
		// split apart the hash / salt
		  $stack = explode(':', $encrypted);
	
		  if (sizeof($stack) != 2) return false;
			//echo $plain."3333".$stack[1]."###".md5($stack[1] . $plain)."###".$stack[0];
		  if (md5($stack[1] . $plain) == $stack[0]) {
			return true;
		  }
		}
	
		return false;
	  }
	
	  public function tep_not_null($value) {
		if (is_array($value)) {
		  if (sizeof($value) > 0) {
			return true;
		  } else {
			return false;
		  }
		} else {
		  if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
			return true;
		  } else {
			return false;
		  }
		}
	  }
	/*****Encrypt Password End****/
	
	/*****Get IP Start****/
	public function getIp()
	{
		$ip = $_SERVER['REMOTE_ADDR'];     
		if($ip){
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			return $ip;
		}
		// There might not be any data
		return false;
	}
	/*****Get IP End****/
	
	/*****Get Own URL Start****/
	public function getOwnURL() 
	{ 
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
		$protocol = $this->strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
$port = ($_SERVER["SERVER_PORT"] == "80" || $_SERVER["SERVER_PORT"] == "82") ? "" : (":".$_SERVER["SERVER_PORT"]);  
		return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 
	} 
	
	public function strleft($s1, $s2) 
	{ 
		return substr($s1, 0, strpos($s1, $s2)); 
	}
	/*****Get Own URL End****/
	
	/*****Check if array Empty Start****/
	function is_array_empty($arr) {
        if (is_array($arr)) {
            foreach ($arr as $key => $value) {
                if (!empty($value) || $value != NULL || $value != "") {
                    return true;
                    break; //stop the process we have seen that at least 1 of the array has value so its not empty
                }
            }
            return false;
        }
    }
	/*****Check if array Empty Ends****/
	
	/*****Get Random Number Start****/
	
	public function get_rand_id($length)
	{
		$passarray=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9","0");
		
		if($length>0) 
		{
			$rand_id="";
			for($i=1; $i<=$length; $i++)
			{
				//mt_srand((double)microtime() * 1000000);
				$num = mt_rand(1,61);
				
				$rand_id .= $passarray[$num];
			}
		}
		return $rand_id;
	}
	public function get_rand_value($length)
	{
		$passarray=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
		
		if($length>0) 
		{
			$rand_id="";
			for($i=1; $i<=$length; $i++)
			{
				//mt_srand((double)microtime() * 1000000);
				$num = mt_rand(1,61);
				$rand_id .= $passarray[$num];
			}
		}
		return $rand_id;
	}	
	/*****Get Random Number End****/
	
	
	/*****Exists Image Checking Starts****/
	function image_exist($file, $path="") {
	if ($file)
	{
		$checkfile=($path)?$path . "/" . $file:$file;
		if (file_exists($checkfile)) {
			return 1;
		}
	}
	}
	/*****Exists Image Checking Ends****/
		
	public function getCount($table_name, $field_name, $condition)
	{$counts=$this->select_query($table_name, "COUNT(".$field_name.") as C", $condition,1);
		return $counts['C'];
	}
	#--------Action Controller-----------#
	public function displayArrayByKey($str, $arr){
		global $CArr;
		foreach($arr as $key=>$array){
			  $string = $str. " " . $key;
			  $CArr[]=$string; 
			  if(count($array)> 0){
				  $this->displayArrayByKey($string, $array);
			  }
		}
	}

	public function strreplace($Sc,$q){
		return str_replace($q, '<span class="highlight-suggestion">'.$q.'</span>',$Sc);
		
	}
	public function urlstrreplace($Sc){
		$sl=str_replace('  ', ' ',$Sc);
		return str_replace(' ', '+',$sl);
		
	}
	function valoperator($feat)
	{
		if($_SESSION['type']=='O')
		{
			$result=$this->select_query(OPERATOR,"*","op_id='".$_SESSION['admin_id']."'",1);
			$menu_feat_id=explode(",",$result['feat_id']);
			if(!in_array($feat, $menu_feat_id))
			{
				echo("<script language='javascript'>window.location.href='".ADMIN_URL."common/home.php'</script>");
			  exit;
			}
		}
	}	

	public function isselected($val1, $val2)
	{
		if($val1==$val2)
		{
			return 'selected="selected"';
		}
		else
		{
			return '';
		}
	}
	public function ischecked($val1, $val2)
	{
		if($val1==$val2)
		{
			return 'checked="checked"';
		}
		else
		{
			return '';
		}
	}	
	public function getStatusCount($tbl,$field,$status)
	{
		$selCount = $this->select_query($tbl,"COUNT(*) as C","$field='".$status."'","1");
		return $selCount['C'];
	}	
	public function PHP_SELF()
	{
		$currentFile = $_SERVER["SCRIPT_NAME"];
		$parts = @explode('/', $currentFile);
		$currentFile = $parts[count($parts) - 1];
		return $currentFile;
	}
	public function addDayswithdate($date,$days)
	{
		$date = strtotime("+".$days." days", strtotime($date));
		
		 return  date("Y-m-d", $date);
	}
	
	public function dateDiff($date1,$date2)
	{
		if($date1!=''&&$date2!='')
		{
			$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);
			$seconds_diff = $ts2 - $ts1;
			$num_days_diff=floor($seconds_diff/(60*60*24));
		}
		return $num_days_diff;
	}
	public function send_newsletterqueue($group,$nletter,$sendtime)
	{
		$group;
		$sendtime;
		$nletter;
		
		#select Newsletter Info
		$Res = $this->select_query(NEWSLETTER,"*","nl_id='".$nletter."'","1");
		$subject=$Res['nl_title'];
		$nlid=$Res['nl_id'];
		$message=$Res['nl_content'];
		$date=NOW;
		
		if($group=="0" || $group=="all"|| $group!="")
		{
			$econd="";
			if($group=="0")
			{
				$title = "Online Subscribers";
				$group_id =$group;
				$econd="group_id='".$group_id."' AND addr_status='Y'";
			}else if($group=="all")
			{
				$title = "Subscribers";
				$econd="addr_status='Y'";
			}else
			{
				$Master =  $this->select_query(NEWSLETTERGROUP,"group_id,group_title","group_id='".$group."'","1");
				$group_id = $Master['group_id'];
				$title = $Master['group_title'];
				$econd="group_id='".$group_id."' AND addr_status='Y'";
			}
			
			$Sql_Adrbook =  $this->select_query(NEWSLETTERADDRESS,"*",$econd,"");
			
			if($Sql_Adrbook['nr'])
			{
				foreach($Sql_Adrbook['result'] as $Res_Adrbook)
				{
					$addremail=$Res_Adrbook['addr_email'];
					$group_id=$Res_Adrbook['group_id'];
					$addr_id=$Res_Adrbook['addr_id'];
					
					$arr=array('group_id'=>$group_id,'nl_id'=>$nlid,'mail_title'=>$title,'addr_id'=>$addr_id,'email_id'=>$addremail,'mail_sendtime'=>$sendtime,'mail_status'=>'W','mail_dt'=>$date);
					$insert= $this->insert(NEWSLETTERMAIL,"",$arr);
				}
			}
		}
		
		if($insert)
		{
			$ret = 'success';
		}else
		{
			$ret = 'failure';
		}
		
		return $ret;
	}
	
	public function randcolor($size)
	{
		$size=($size)?$size:1;
		$rancolor=AM_RandomColor::many($size, array('luminosity'=>'dark','hue'=>'blue')); 
		return $rancolor;
	}
	/*Admin Layout */
	
	public function adminHtmlhead($extra="") {

		include("../layout/htmlhead.php");
		echo $extra.'</head>';
		#alert and upload rest
		unset($_SESSION['alert']);
		unset($_SESSION['uploadtemp']);
	}
	public function admninBody() {
		if($_COOKIE['menuslide']=='1')
		{
			$extracls='sidebar-collapse';
		}
		echo '<body class="skin-custom sidebar-mini '.$extracls.'">';
		
	}
	public function temptoorgfolder($tempfolder,$orgfolder,$filename)
	{
		if(!is_dir($orgfolder))
		{
			@mkdir($orgfolder, 0777);
		}
		if (copy($tempfolder.$filename, $orgfolder.$filename)) {
            @unlink($tempfolder.$filename);
			return 1;
        }else
		{
			return 0;
		}
	}
	public function adminpageoption($bpsize,$current)
	{
		$pagearray=array("10","15","20","25","50","100","200","500");
		$last=0;
		foreach($pagearray as $pagval)
		{
			if($bpsize>$last&&$bpsize<$pagval)
			{
				
				$selecttxt=($current==$bpsize)?'selected="selected"':"";
				echo '<option value="'.$bpsize.'"  '.$selecttxt.'  >'.$bpsize.'</option>';
			}
			$selecttxt=($current==$pagval)?'selected="selected"':"";
			echo '<option value="'.$pagval.'" '.$selecttxt.' >'.$pagval.'</option>';
			$last=$pagval;
		}
	}	
	public function adminpagesession($bpsize,$sessiontype)
	{
		$bpsize=($bpsize)?$bpsize:5;
		$_SESSION['page'][$sessiontype]=($_SESSION['page'][$sessiontype])?$_SESSION['page'][$sessiontype]:$bpsize;
		return $_SESSION['page'][$sessiontype];
		/*$Select_setting=$this->select_query("tbl__admin", "*", "",1);
		$EXTRA_ARG = @unserialize($Select_setting['setting_fields']);
	   array_walk($EXTRA_ARG,'decode_ArrayWalk');
		return $EXTRA_ARG['set_bpsize'];*/
	}
	
	public function adminupload($field,$upfolder,$newfilename="")
	{
		$fname="";
		$file_name = $_FILES[$field]['name'];
		$file_name=$this->uploadfilename($file_name,$newfilename);
		if($file_name)
		{
			@move_uploaded_file($_FILES[$field]['tmp_name'],$upfolder.$file_name);
			$fname=$file_name;
		}
		return $fname;
		
	}
	public function adminuploadmulti($field,$upfolder,$newfilename="")
	{
		$fname="";
		$file_name = $_FILES[$field]['name'][0];
		$file_name=$this->uploadfilename($file_name,$newfilename);
		if($file_name)
		{
			@move_uploaded_file($_FILES[$field]['tmp_name'][0],$upfolder.$file_name);
			$fname=$file_name;
		}
		return $fname;
		
	}
	#New fileupload form Fileupload.js
	public function singlefileupload($field,$folder="")
	{
		$rfilename="";
		if($folder)
		{
			if($_SESSION['uploadtemp'][$field])
			{
				$move=$this->temptoorgfolder('../../'.UPLOADTEMPFOLDER,"../../uploads/".$folder."/",$_SESSION['uploadtemp'][$field]);
				if($move)
				{
					$rfilename=$_SESSION['uploadtemp'][$field];
				}
			}else if($_FILES[$field]['name'])
			{
				$rfilename=$this->adminupload($field,"../../uploads/".$folder."/");
				if($rfilename)
				{
					$rfilename=$rfilename;
				}
			}
		}
		return $rfilename;
	}
	
	public function safeserialize($var)
	{
		if($var)
		{
			$return_value = base64_encode(@serialize($this->escape_str($var)));
		}
		return $return_value;
	}
	public function safeunserialize($var)
	{
		if($var)
		{
			$return_value = @unserialize(base64_decode($var));
		}
		return $return_value;
	}
	
	public function clearadminAlert()
	{
		unset($_SESSION['alert']);
	}
	public function adminAlert($key,$val="")
	{
		$_SESSION['alert'][$key]=$val;
	}
	public function getadminAlert($key)
	{
		if($_SESSION['alert'][$key])
		{
			$val=$_SESSION['alert'][$key];
		}
		return $val;
	}
	public function sqldateformat($var)
	{
		if($var)
		{
			$arr=explode('-',$var);
			$return_value=$arr[2].'-'.$arr[1].'-'.$arr[0];
		}
		return $return_value;
	}
	public function generate_slug($var)
	{
		if($var)
		{
			$var=@str_replace(' ', '-',trim($var));
			$var=@strtolower($this->variable($var));
			$slugname= @preg_replace('/[^A-Za-z0-9\-]/', '', $var);
			$slugname=@preg_replace('/-+/', '-',$slugname );
		}
		return $slugname;
	}
	public function convert_number_to_words($number)
	{
   
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
   
    if (!is_numeric($number)) {
        return false;
    }
   
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . $this->convert_number_to_words(abs($number));
    }
   
    $string = $fraction = null;
   
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
   
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . $this->convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= $this->convert_number_to_words($remainder);
            }
            break;
    }
   
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
   
    return $string;
	}
	
	
	/* FOOTER LINKS  */
	public function footerdetails()
	{
		$resarr='';
		$footerpage=$this->select_query(CMS,"page_name,page_slug,page_column,page_type,page_link,page_linktype","page_status='Y' AND page_column!='' ORDER BY page_pos ASC","");
		if($footerpage['nr'])
		{
			foreach($footerpage['result']as $respage)
			{
				$column=$respage['page_column'];
				$resarr[$column][]=$respage;
			}
		}
		return $resarr;
	}
	
	
	
	
	
	public function unsetusersess()
	{
		unset($_SESSION['ses_userid']);
		unset($_SESSION['ses_username']);
		
	}
	
	public function xss_clean($data)
	{
		$data=$this->variable($data);
		// Fix &entity\n;
		$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

		// Remove any attribute starting with "on" or xmlns
		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
		
		// Remove javascript: and vbscript: protocols
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

		// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
		
		// Remove namespaced elements (we do not need them)
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

		do
		{
			// Remove really unwanted tags
			$old_data = $data;
			$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		}
		while ($old_data !== $data);
		
		// we are done...
		return $data;
	}
	public function getpagebannertype($slug)
	{
		switch($slug)
		{
			case "about-us":
			$reval="aboutcustom";break;
			case "community":
			$reval="communitycustom";break;
			case "membership":break;
			$reval="membershipcustom";break;
			
		}
		return $reval;
	}
	
}
function stripslashesFull($input)
{
	
    if (is_array($input)) {
		
        $input = @array_map('stripslashesFull', $input);
    } elseif (is_object($input)) {
        $vars = @get_object_vars($input);
        foreach ($vars as $k=>$v) {
            $input->{$k} = stripslashesFull($v);
        }
    } else {
        $input = @stripslashes($input);
    }
    return $input;
}
function encode_ArrayWalk(&$string, $x) { $string = base64_encode($string); }
function decode_ArrayWalk(&$string, $x) { $string = ($string!="") ? stripslashes(base64_decode($string)) : ""; }
function newtime($t)
{
	if($t==0)
	{
		$rtime="12 AM";
		return $rtime;
		
	}elseif($t<=11)
	{
		$rtime=$t." AM";
		return $rtime;
	}elseif($t>11)
	{
		$rtime=($t==12)?$t." PM":($t-12)." PM";
		return $rtime;
	}
	
}
?>