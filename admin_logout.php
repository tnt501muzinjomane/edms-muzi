<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_ADMIN_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
	unset($_SESSION['SESS_ADMIN_PRIV']);
	
	//session_destroy();
	/* echo '<script type="text/javascript">alert("You have logged out successfully!"); location.href="index.php";</script>';*/
	header("Location:index.php");
?>