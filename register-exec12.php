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
	
	$login = clean($_POST['email']);
	$password = clean($_POST['pass']);
	$cpassword = clean($_POST['password']);
	
	
	
	
	
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
		echo '<script type="text/javascript">alert("Passwords do not match"); location.href="admin_sign_up.php";</script>';
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
				echo '<script type="text/javascript">alert("Email already in use!"); location.href="admin_sign_up.php";</script>';
				exit();
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	

	//Create INSERT query
	$qry = "INSERT INTO users(name, surname, path, department_id, privilleges, email, password, created_at, updated_at) VALUES('$fname', '$lname','',0,3,'$login','".md5($_POST['password'])."', NOW(), NOW())";
	
	
	
	
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		
		echo '<script type="text/javascript">alert("Registration successful!"); location.href="admin_sign_up.php";</script>';
		exit();
		exit();
	}else {
		die("Query failed");
	}
?>