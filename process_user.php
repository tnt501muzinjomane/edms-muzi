<?php
	//Start session
	//session_start();
	
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
	
	//Sanitize the POST values
	$fname = ucwords(clean($_POST['name']));
	$lname = ucwords(clean($_POST['surname']));
	$priv = clean($_POST['priv']);
	
	
	$doc = $_POST['doc'];
	
	$login = clean($_POST['email']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	
	
	
	
	
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
		echo '<script type="text/javascript">alert("Passwords do not match"); location.href="users.php";</script>';
		exit();
	}
	
	
	
	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM users WHERE email='$login'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Email already in use';
				$errflag = true;
				echo '<script type="text/javascript">alert("Email already in use!"); location.href="users.php";</script>';
				exit();
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	
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
	if (($extension != "jpg") && ($extension != "JPG") && ($extension != "png") && ($extension != "PNG") && ($extension != "jpeg") && ($extension != "JPEG")) 
	{
		echo '<h3>Unknown extension! Please attach a jpg or png image!</h3>';
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
		$newname="profiles/".$image_name;
 
		$copied = copy($_FILES['doc']['tmp_name'], $newname);
		
	}
}
	

	//Create INSERT query
	$qry = "INSERT INTO users(name, surname, path, privilleges, email, password, created_at, updated_at) VALUES('$fname', '$lname','".$newname."',$priv,'$login','".md5($_POST['password'])."', NOW(), NOW())";
	
	
	
	
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		
		echo '<script type="text/javascript">alert("Registration successful!"); location.href="users.php";</script>';
		exit();
		exit();
	}else {
		die("Query failed");
	}
?>