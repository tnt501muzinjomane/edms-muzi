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
	
	//Sanitize the POST values
	$login = clean($_POST['email']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Email missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		//header("location: login.php");
		echo '<script type="text/javascript">alert("Something went wrong. Check presence of your email and password.!"); location.href="admin_sign_in.php";</script>';
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM users WHERE email='$login' AND password='".md5($_POST['password'])."'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			
			if($member['privilleges'] == 3){
			
			$_SESSION['SESS_ADMIN_ID'] = $member['id'];
			$_SESSION['SESS_ADMIN_FIRST_NAME'] = $member['name'];
			$_SESSION['SESS_ADMIN_LAST_NAME'] = $member['surname'];
			
			$_SESSION['SESS_ADMIN_PRIV'] = $member['privilleges'];
			
			$_SESSION['login_time'] = time();
			session_write_close();
			header("location: admin_dashboard.php");
			exit();
			}
			else{
				echo '<script type="text/javascript">alert("Your account does not have rights to login here"); location.href="index.php";</script>';
			}
		}else {
			
			echo '<script type="text/javascript">alert("Wrong email or password. Try again!"); location.href="admin_sign_in.php";</script>';
			
			exit();
		}
	}else {
		die("Query failed");
	}
?>