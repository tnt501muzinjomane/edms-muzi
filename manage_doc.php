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
	
	
	$b='';
	if( isset( $_GET['name'])) {
	$b = $_GET['name'];
	}
	
	$c = '';
	 if( isset( $_GET['cat'])) {
	$c = $_GET['cat'];
	}
	
	
	$z = '';
	if( isset( $_GET['ref'])) {
	$z = $_GET['ref'];
	}
	
	$x = '';
	if( isset( $_GET['company'])) {
	$x = $_GET['company'];
	}
	
	$from = '';
	if( isset( $_GET['from'])) {
	$from = $_GET['from'];
	}
	
	$to = '';
	if( isset( $_GET['to'])) {
	$to = $_GET['to'];
	}
	
	if(($from != '') && ($to != '') && ($c != '')){
		$qry = "select * from documents where doc_date >= '$from' and doc_date <= '$to' and cat_id = '$c' order by id DESC";
	$result = mysql_query($qry);
	
	
	}
	
	if(($b != '') && ($c != '')){
		$qry = "select * from documents where name like '%$b%' or cat_id = '$c' order by id DESC";
	$result = mysql_query($qry);
	}
	else if(($from != '') && ($to != '')){
		$qry = "select * from documents where doc_date >= '$from' and doc_date <= '$to' order by id DESC";
	$result = mysql_query($qry);
	}
	else if($b != '')
	{
		$qry = "select * from documents where name like '%$b%' order by id DESC";
	$result = mysql_query($qry);
	}
	else if($c != '')
	{
		$qry = "select * from documents where cat_id = '$c' order by id DESC";
	$result = mysql_query($qry);
	}
	else if($z != '')
	{
		$qry = "select * from documents where ref like '%$z%' order by id DESC";
	$result = mysql_query($qry);
	}
	else if($x != '')
	{
		$qry = "select * from documents where company like '%$x%' order by id DESC";
	$result = mysql_query($qry);
	}
	else {
	$qry = "select * from documents order by RAND() DESC limit 30";
	$result = mysql_query($qry);
	}

	
	
	$qrycount = "SELECT count(*) from documents";
	$resultcount=mysql_query($qrycount);
	$row222 = mysql_fetch_array($resultcount);
	$total = $row222[0];
	
	$qry1="SELECT * FROM users where id = '".$_SESSION['SESS_ADMIN_ID']."' ";
	$result1=mysql_query($qry1);

	$row = mysql_fetch_array ($result1,MYSQL_ASSOC);
	
	$qry2 = "select * from department";
	$result2 = mysql_query($qry2);
	

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

<link rel="stylesheet" href="datepicker/jquery-ui.css">
  <script src="datepicker/jquery-1.10.2.js"></script>
  <script src="datepicker/jquery-ui.js"></script>

<script>
  $(function() {
    $( "#from" ).datepicker({ dateFormat: 'yy-mm-dd'});
	//$( "#from" ).datepicker("setDate", new Date());
  });
  </script>
  
  <script>
  $(function() {
    $( "#to" ).datepicker({ dateFormat: 'yy-mm-dd'});
	//$( "#to" ).datepicker("setDate", new Date());
  });
  </script>



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

<script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to remove this?");
      if (x)
          return true;
      else
        return false;
    }
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
                
                <!--<li><a href="dashboard.php"><i class="fa fa-file-text big" aria-hidden="true"></i> e-Files</a></li> -->
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
    <strong><?php echo $_SESSION['SESS_ADMIN_FIRST_NAME']; ?> <?php echo $_SESSION['SESS_ADMIN_LAST_NAME']; ?></strong>
    
   
    </div>
   
    
    
    <div id="exTab2"  >	
<ul class="nav nav-tabs" style="background-color:#eee; padding:2px;">
			<li class="active">
        <a  href="#1" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> Manage Documents</a>
			</li>
			
            
			
		</ul>
        <br />
        <div class="container-fluid" >
        <div id="p">
      
        
         <form method="get" action="manage_doc.php" enctype="multipart/form-data">
         
                     <input type="text" name="from"  id="from" placeholder="Date from"  style="width:150px;"  >
                     <input type="text" name="to"  id="to" placeholder="Date to"  style="width:150px;"  >
                     <input type="text" name="ref"  id="ref" placeholder="Search by ref number" style="width:150px;"  >
                     <input type="text" name="company"  id="company" placeholder="Search by clients" style="width:150px;"  >
                     <input type="text" name="name"  id="name" placeholder="Search by name" style="width:150px;"  >
                      <select name="cat" id="cat" style="width:200px;" title="Select category">
                    <option value="">Select Documents Category</option>
                    <?php
                     while ($es1 = mysql_fetch_array ($result2)){
                    ?>
                    <option value="<?php echo $es1['id'] ?>"> <?php echo $es1['name'] ?> </option>
                    <?php
                     }
                    ?>
                    </select>
                       <button type="submit" class='btn btn-success btn-xs'><i class="fa fa-search" aria-hidden="true"></i> Search Files</button>
                </form>
        </div>
        <br />
        <br />

			<div class="tab-content ">
			  <div class="tab-pane active" id="1">
              <div class="col-md-112">
        <div id="p" class="divb">
        <?php
		  if($total > 0){
		?>
        <table class='table table-striped table-striped'>
			<tr>
			</tr>
             <th style="background-color:#eee;">Reference</th>
            <th style="background-color:#eee;">Company/Client</th>
			
            <th style="background-color:#eee;">Name</th>
            <th style="background-color:#eee;">Decription</th>
            
           
            
            <th style="background-color:#eee;">Uploaded By</th>
            <th style="background-color:#eee;">Date</th>
			<th style="background-color:#eee;">Date uploaded</th>
            <th style="background-color:#eee;">Last Updated</th>
            <th style="background-color:#eee;">Action</th>
            <th style="background-color:#eee;">
            <th style="background-color:#eee;">
           
          <?php

  while ($es = mysql_fetch_array ($result)) {
			//Successful
			$f = $es['user_id'];
			$qry4 = "select * from users where id = '$f'";
	$result4 = mysql_query($qry4);
	$row4 = mysql_fetch_array ($result4,MYSQL_ASSOC);
			
			
		echo "
			  <tr ><td>{$es['ref']}</td><td>{$es['company']}</td>
			  <td>{$es['name']}</td><td>{$es['description']}</td><td>{$row4['name']} {$row4['surname']}</td><td>{$es['doc_date']}</td><td>{$es['created_at']}</td><td>{$es['updated_at']}</td><td><a href='{$es['path']}' target='blank'> <button type='button' class='btn btn-info btn-xs'><i class='fa fa-download' aria-hidden='true'></i> download </button>  </a></td>  <td><a href='edit_doc.php?id={$es['id']}' > <button type='button' class='btn btn-success btn-xs'><i class='fa fa-pencil' aria-hidden='true'></i> edit </button>  </a></td>   <td><a href='delete_doc.php?id={$es['id']}' Onclick='return ConfirmDelete();' > <button type='button' class='btn btn-danger btn-xs'><i class='fa fa-trash' aria-hidden='true'></i> delete </button>  </a></td>
			  </tr>
		
			";
			
          }

		  ?>
          </table>
          <?php
		  }
		  else
		  {
			  echo "<p style='color:#f00;'>No results found.... Try searching again....";
		  }
		  ?>
			 </div>
          </div>
          </div>
          </div>
    </div>
    </div>
    <br />
    

<br />

<div class="footer navbar-fixed-bottom" style="background-color:#fafafa; padding:2px; color:#666; text-align:center; font-size:9px; font-family:Verdana, Geneva, sans-serif;"><a href ="#">Back to top</a></div>

</body>
</html>