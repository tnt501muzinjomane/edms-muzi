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
	
	
	$id = clean($_POST['id']);
	$r_id = $_POST['r_id'];
	

   
	$date = date('Y-m-d H:i:s');

	//Create update query
	if($r_id == 3){
	$qry = "update documents set ad  = '', updated_at = '$date' where id = '$id'";

	$result = @mysql_query($qry);
	}
	
	if($r_id == 2){
	$qry = "update documents set mi  = '', updated_at = '$date' where id = '$id'";

	$result = @mysql_query($qry);
	}
	
	if($r_id == 1){
	$qry = "update documents set lo  = '', updated_at = '$date' where id = '$id'";

	$result = @mysql_query($qry);
	}
	
	//Check whether the query was successful or not
	if($result) {
		echo '<script type="text/javascript">alert("Rights removed successfully."); location.href="manage_doc.php";</script>';
		
		exit();
	}else {
		die("Sorry! The system failed to process your request!");
	}

?>