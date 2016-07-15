<?php
	//Start session
	//session_start();
	
	//Check whether the session variable 
	if(!isset($_SESSION['SESS_ADMIN_ID']) || (trim($_SESSION['SESS_ADMIN_ID']) == '')) {
		echo '<script type="text/javascript">alert("You need to sign in first! Please seek assistance from the developer and try again. Administrator!"); location.href="index.php";</script>';
	
		exit();
	}
?>