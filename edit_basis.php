<?php
//Start session
session_start();


    //Include database connection details
	require_once('config.php');
	
	require_once('admin_auth.php');
	
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
	
	$b = $_GET['id'];
	
	
	$qry1="SELECT * FROM documents where id = '$b' ";
	$result1=mysql_query($qry1);
	$row = mysql_fetch_array ($result1,MYSQL_ASSOC);
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-DMS</title>
<link rel="stylesheet" href="css/boot.css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/style2.css" />
<link rel="shortcut icon" href="images/icon.ico"/>
<link rel="stylesheet" href="css/jquery.mobile-1.4.5.min.css">



<script src="js/jquery.js"></script>
<script src="js/nav.js"></script>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery.mobile-1.4.5.min.js"></script>

<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/bootstrap-theme.min.css">
<script src="bootsyrap/jquery.min.js"></script>
<script src="bootstrap/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

<style type="text/css">
	.navbar1{
		margin-top: 20px;
	}
</style>

<script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>

</head>

<body id="d">


    <nav role="navigation" class="navbar navbar-default" style="border-radius:0px; background-color:#041651;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="dashboard.php" class="navbar-brand"><img class="profile-img" src="images/logo.png"
                    title="Turbo Diesel" style="margin-top:0px; width:150px;"></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                
                <li><a href="admin_dashboard.php"><i class="fa fa-file-text big" aria-hidden="true"></i> e-Files</a></li>
                <li><a href="categories.php"><i class="fa fa-file-text big" aria-hidden="true"></i> Categories</a></li>
                <li><a href="users.php"><i class="fa fa-users big" aria-hidden="true"></i> Users</a></li>
                
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
            <li><a href="admin_logout.php" ><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
       
       
      </ul>
        </div>
    </nav>
    
   <div style="width:100%; text-align:center; font-size:large;">
    <h3 ><b>e-DOCUMENT MANAGEMENT SYSTEM</b></h3>
    <?php echo $_SESSION['SESS_ADMIN_FIRST_NAME']; ?> <?php echo $_SESSION['SESS_ADMIN_LAST_NAME']; ?>
    
   
    </div>
   
    
    
    <div id="exTab2"  >	
<ul class="nav nav-tabs" style="background-color:#F5F6CE; padding:2px;">
			<li class="active">
        <a  href="#1" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> Edit Details</a>
			</li>
			
            
			
		</ul>
        <br />
        <div class="container-fluid" >

			<div class="tab-content ">
			  <div class="tab-pane active" id="1">
              <div class="col-md-8">
        <div id="p" class="divb">
           <form  method="post" action="update_details.php" enctype="multipart/form-data" >
  <div class="form-group">
  <input type="hidden" name="id"  id="id"  value="<?php echo $row['id']; ?>" style="width:300px;" required="required">
   <input type="text" name="name"  id="name" placeholder="Document name" value="<?php echo $row['name']; ?>" style="width:300px;" required="required" autofocus="autofocus"><br /><br />
   
   <input type="text" name="ref"  id="ref" value="<?php echo $row['ref']; ?>" style="width:300px;" required="required" autofocus="autofocus"><br /><br />
   <input type="text" name="company"  id="company" value="<?php echo $row['company']; ?>" style="width:300px;" required="required" autofocus="autofocus"><br /><br />
   <p>Document date</p>
                <input type="text" name="doc_date"  id="doc_date" value="<?php echo $row['doc_date']; ?>" style="width:300px;" required="required"><br /><br />
             <p>Description</p>
                <textarea name="description" id="description" placeholder="Document description"><?php echo $row['description']; ?></textarea><br />
  </div>
  <button type="submit" class="btn btn-info"><i class="fa fa-cloud" aria-hidden="true"></i> Update Details</button>
</form>

<br />
<br />
			 </div>
          </div>
          </div>
          </div>
    </div>
    </div>

<br />

<div class="footer navbar-fixed-bottom" style="background-color:#fafafa; padding:2px; color:#666; text-align:center; font-size:9px; font-family:Verdana, Geneva, sans-serif;">Designed and powered by Dynamic Solutions</div>

</body>
</html>