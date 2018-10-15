<?php
require(dirname(__FILE__).'/../../appcore/app-register.php');
$conn->check_admin();
backup_tables(HOST,USERNAME,'',DBNAME);
/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
$fields = mysql_list_fields($name, $table);
$columns = mysql_num_fields($fields);
$field_array=array();
for ($i = 0; $i < $columns; $i++) {
$field_array[] = mysql_field_name($fields, $i);
}
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = str_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
 		$return.="\n\n\n";
	}
	//save file
	$fname='db-backup-'.date("Y-m-d-H-i-s").'.sql';
	$handle = fopen($fname,'w+');
	fwrite($handle,$return);
	fclose($handle);
	header("location:backup_database_download.php?fname=".base64_encode($fname));
}
?>

