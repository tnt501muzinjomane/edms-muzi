<?php
	//Start session
session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect($mysql_host, $mysql_user, $mysql_password);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db($mysql_database);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values Button1
	
	
	$attpath = clean($_POST['doc']);
	$id = clean($_POST['id']);
	

    define ("MAX_SIZE","1000"); 
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
 
$errors=0;
$image=$_FILES['doc']['name'];
if ($image) 
{
	$filename = stripslashes($_FILES['doc']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "pdf") && ($extension != "PDF") && ($extension != "docx") && ($extension != "DOCX") && ($extension != "txt")) 
	{
		echo '<h3>Unknown extension! Please attach a pdf!</h3>';
		$errors=1;
		exit();
	}
	else
	{
		$size=filesize($_FILES['doc']['tmp_name']);
 
		if ($size > MAX_SIZE*1024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
			exit();
		}
 
		$image_name=time().'.'.$extension;
		$newname="documents/".$image_name;
 
		$copied = copy($_FILES['doc']['tmp_name'], $newname);
		
	}
}
	$date = date('Y-m-d H:i:s');

	//Create INSERT query
	$qry = "update documents set path = '".$newname."', updated_at = '$date' where id = '$id'";

	$result = @mysql_query($qry);
	
	
	//Check whether the query was successful or not
	if($result) {
		echo '<script type="text/javascript">alert("File updated successfully."); location.href="manage_doc.php";</script>';
		
		exit();
	}else {
		die("Sorry! The system failed to process !");
	}

?>