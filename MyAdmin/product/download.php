
<?php  
require(dirname(__FILE__).'/../../appcore/app-register.php');
//$conn->check_admin();
//include ("common_submit.php");
?>
<?php 
 /* if(!isset($_SESSION['user_id'])){$conn->divert($RES_SURL['set_url']."login.php");}

  if(isset($_SESSION['user_id'])){
      $checkuser = $conn->select_query(USER,"*","user_id='".$_SESSION['user_id']."' AND user_status='Y'","1");
  }

  if(!$checkuser['nr']){
    $conn->divert($RES_SURL['set_url']."login.php");
  }*/
?>
<?php
$name= $_GET['name'];

   /* header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($name));
    ob_clean();
    flush();
    readfile("uploads/post/".$name); //showing the path to the server where the file is to be download
    exit; */

            $filename = $_GET['name'];
            //$filename = realpath($filename);
           // echo $filename; exit;
            $file_extension = strtolower(substr(strrchr($filename,"."),1));
          
            switch ($file_extension) {
                case "pdf": $ctype="application/pdf"; break;
                case "exe": $ctype="application/octet-stream"; break;
                case "zip": $ctype="application/zip"; break;
                case "doc": $ctype="application/msword"; break;
                case "xls": $ctype="application/vnd.ms-excel"; break;
                case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
                case "gif": $ctype="image/gif"; break;
                case "png": $ctype="image/png"; break;
                case "jpe": case "jpeg":
                case "jpg": $ctype="image/jpg"; break;
                default: $ctype="application/force-download";
            }

            if (!file_exists("../../uploads/post/".$filename)) {
                die("NO FILE HERE");
            }
            //echo @filesize($filename);
            //echo $ctype; exit;
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
            header("Content-Type: $ctype");  
            header("Content-Disposition: attachment; filename=\"".basename($filename)."\";");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".@filesize("../../uploads/post/".$filename));
            //set_time_limit(0);            
            ob_clean();
            flush();
            @readfile("../../uploads/post/".$filename) or die("File not found.");
?>
