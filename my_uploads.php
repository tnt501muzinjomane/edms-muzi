<?php
//Start session
session_start();


    //Include database connection details
	require_once('config.php');
	
	require_once('auth.php');
	
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
	
	
	$qry1="SELECT * FROM users where id = '".$_SESSION['SESS_MEMBER_ID']."' ";
	$result1=mysql_query($qry1);

	$row = mysql_fetch_array ($result1,MYSQL_ASSOC);
	
	$qry2 = "select * from department";
	$result2 = mysql_query($qry2);
	
	
	$qry = "select * from department";
	$result = mysql_query($qry);

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

<link rel="stylesheet" href="datepicker/jquery-ui.css">
  <script src="datepicker/jquery-1.10.2.js"></script>
  <script src="datepicker/jquery-ui.js"></script>

<script>
  $(function() {
    $( "#doc_date" ).datepicker({ dateFormat: 'yy-mm-dd'});
	//$( "#doc_date" ).datepicker("setDate", new Date());
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
                
               
               
                
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
             <li class="dropdown"  >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><img src="<?php echo $row['path']; ?>" width="25px" height="25px" class="img-circle" title="<?php echo $row['name']; ?> <?php echo $row['surname']; ?>" /> <span class="caret"></span></a>
          <ul class="dropdown-menu" style="background-color:#f1f1f1;" >
            
            <li><a href="logout.php" ><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
            
          </ul>
        </li>
       
      </ul>
        </div>
    </nav>
    
   <div style="width:100%; text-align:center; font-size:large;">
   <h3 ><b>e-DOCUMENT MANAGEMENT SYSTEM</b></h3>
    <strong><?php echo $_SESSION['SESS_FIRST_NAME']; ?> <?php echo $_SESSION['SESS_LAST_NAME']; ?></strong>
    
   
    </div>
   
    
    
    <div id="exTab2"  >	
<ul class="nav nav-tabs" style="background-color:#eee; padding:2px;">
			<li class="active">
        <a  href="#1" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> Upload Documents</a>
			</li>
			
		</ul>
        <br />
        <div class="container-fluid" >
        <div class="col-md-12">
        <div id='p'><a href="manage_your_doc.php"><button type="submit" class='btn btn-success btn-xs'>Manage Documents</button></a></div><br /><br />
        </div>
        

			<div class="tab-content ">
			  <div class="tab-pane active" id="1">
              <div class="col-md-6">
        <div id="p" class="divb">
             <form method="post" action="processdoc1.php" enctype="multipart/form-data">
 
                <input type="text" name="name1"  id="name1" placeholder="Document name" style="width:300px;" required="required" autofocus="autofocus"><br /><br />
                <input type="text" name="ref"  id="ref" placeholder="Reference number" style="width:300px;" required="required" ><br /><br />
                <input type="text" name="company"  id="company" placeholder="Client OR Company Name" style="width:300px;" required="required"><br /><br />
                 <p>Document date</p>
                 <input type="date" name="doc_date"  id="doc_date" placeholder="Date of the document" style="width:300px;" required="required"><br /><br />
                
                <p>Supported files pdf, docx, txt</p>
                <input type="file" name="doc"  id="doc" placeholder="Document " title="Choose document to upload" required="required" ><br />
                <div class="form-group">
  
    <select name="cat_id" id="cat_id" class="form-control" required="required" >
                    <option value="">Select Document Category</option>
                    <?php
                     while ($es = mysql_fetch_array ($result)){
                    ?>
                    <option value="<?php echo $es['id'] ?>"><?php echo $es['name'] ?> </option>
                    <?php
                     }
                    ?>
                    </select>
                    
  
  </div>
                
                <p>Description</p>
                <textarea name="description" id="description" placeholder="Document description"></textarea><br />
                
              
              <button type="submit" class='btn btn-info btn-xs'>Upload Document</button>
            </form>
			 </div>
          </div>
          </div>
          </div>
    </div>
    </div>

<br />

<div class="col-md-12" style="background-color:#fafafa; padding:2px; color:#666; text-align:center; font-size:9px; font-family:Verdana, Geneva, sans-serif;">Designed and powered by Dynamic Solutions</div>

</body>
</html>