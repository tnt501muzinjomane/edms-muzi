<?php
	//Start session
	//session_start();
	
	//Check whether the session variable 
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		echo '<script type="text/javascript">alert("You need to sign in first! Please seek assistance from the Administrator and try again."); location.href="index.php";</script>';
	
		exit();
	}
?>