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
	
	$id = $_GET['id'];
	
    $qry="SELECT * FROM users where id = '$id'";
	$result=mysql_query($qry);
	$row = mysql_fetch_array ($result,MYSQL_ASSOC);

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
            <a href="admin_dashboard.php" class="navbar-brand"><img class="profile-img" src="images/logo.png"
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
    <strong><?php echo $_SESSION['SESS_FIRST_NAME']; ?> <?php echo $_SESSION['SESS_LAST_NAME']; ?></strong>
    
   
    </div>
   
    
    
    <div id="exTab2"  >	
<ul class="nav nav-tabs" style="background-color:#eee; padding:2px;">
			<li class="active">
        <a  href="#1" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> Edit User</a>
			</li>
			
            
			
		</ul>
        <br />
        <div class="container-fluid" >

			<div class="tab-content ">
			  <div class="tab-pane active" id="1">
              <div class="col-md-4">
        <div id="p" class="divb">
             <form  method="post" action="process_edit_user.php" enctype="multipart/form-data" >
  <div class="form-group">
  
    <input type="hidden" class="form-control" style="padding:15px;" name="id" id="id" placeholder="Name" value="<?php echo $row['id']; ?>" required="required"><br />
    <input type="text" class="form-control" style="padding:15px;" name="name" id="name" placeholder="Name" value="<?php echo $row['name']; ?>" required="required">
  </div>
  
   <div class="form-group">
    <input type="text" class="form-control" style="padding:15px;" name="surname" id="surname" placeholder="Surname" value="<?php echo $row['surname']; ?>" required="required">
  </div>
  

  
   <div class="form-group">
    <input type="email" class="form-control" style="padding:15px;" name="email" id="email" placeholder="Email" value="<?php echo $row['email']; ?>" required="required">
  </div>
  
  
  <button type="submit" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Update</button>
</form>
			 </div>
             
             
             <div id="p">
           <form method="post" action="process_pass.php" enctype="multipart/form-data">
           
           <input type="hidden" class="form-control" style="padding:15px;" name="id" id="id" placeholder="Name" value="<?php echo $row['id']; ?>" required="required"><br />
                         <p>Enter new password</p>
                         <input type="password" name="password"  id="password"  style="width:230px;" required="required"  >
                         <br /><br />    
                         <p>Confirm new password</p>
                         <input type="password" name="cpassword"  id="cpassword" style="width:230px;" required="required"  >
                        
                         <hr />
                         <button type="submit" class='btn btn-danger btn-xs'><i class="fa fa-cog" aria-hidden="true"></i> Reset password</button>
                         </form>
          </div>
             
          </div>
          <br />
          <br />
          
          
          </div>
          
          <div class="col-md-4">
          <div id="p" class="divb">
          <img src="<?php echo $row['path']; ?>" width="100" height="100"  />
          
          <p>Set New Profile Picture</p>
          <hr />
           <form method="post" action="process_profile_pic.php" enctype="multipart/form-data">
 
                <input type="hidden" class="form-control" style="padding:15px;" name="id" id="id" placeholder="Name" value="<?php echo $row['id']; ?>" required="required">
                <p>Supported files jpg, png</p>
                <input type="file" name="doc"  id="doc" placeholder="Document " title="Choose document to upload" required="required" ><br />
               
               
                
              
              <button type="submit" class='btn btn-info btn-xs'>Upload Profile Picture</button>
            </form>
          </div>
          </div>
          
          <div class="col-md-4">
          <div id="p" class="divb">
          <p>Set New Privileges</p>
          <hr />
          Current Privileges: <?php if($row['privilleges'] == 3){ echo "Administrator";} ?> <?php if($row['privilleges'] == 2){ echo "Middle Management";} ?> <?php if($row['privilleges'] == 1){ echo "Normal Staff";} ?>
          <hr />
           <form method="post" action="processpriv.php" enctype="multipart/form-data">
            <input type="hidden" class="form-control" style="padding:15px;" name="id" id="id" placeholder="Name" value="<?php echo $row['id']; ?>" required="required">
 
                 <div class="form-group">
  
    <select name="priv" id="priv" class="form-control" required="required" >
                    <option value="">Select Privileges</option>
                    <option value="3">Administrator</option>
                     <option value="2">Middle Management </option>
                      <option value="1">Normal Staff</option>
                      
                    
                    </select>
                    
  
  </div><br />
               
               
                
              
              <button type="submit" class='btn btn-info btn-xs'>Set new Privileges</button>
            </form>
          </div>
          </div>
          
          </div>
    </div>
    </div>

<br />

<div class="footer navbar-fixed-bottom" style="background-color:#fafafa; padding:2px; color:#666; text-align:center; font-size:9px; font-family:Verdana, Geneva, sans-serif;">Designed and powered by Dynamic Solutions</div>

</body>
</html>