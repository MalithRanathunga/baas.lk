
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<?php require '_database/database.php';?>
<head>
<title>baas.lk</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">   
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<link href="main.css" rel="stylesheet">
<link href="login.css" rel="stylesheet">
<link href="css/header.css" rel="stylesheet">
<style type="text/css">
#apDiv1 {
	position:absolute;
	width:200px;
	height:30px;
	z-index:6;
	left: 400px;
	top: 230px;
	font-size:15px;
	color:red;
	   font-weight: bold;
}

#apDivRand {
	position:relative;
	}
	
#coverPics{
	width: 100%;
	top:0px;
	background-image: url('images/cover.jpg');
	height: 768px;
	

}
	
	
</style>
</head>


<body>

	
	


	

<?php 

	session_start();


	if(isset($_SESSION['language'])){
		if($_SESSION['language'] == 'sinhala')
		{
			include 'translations/si.php' ;
		}

		else if($_SESSION['language'] == 'tamil')
		{
			include 'translations/ta.php' ;
		}

		else if($_SESSION['language'] == 'english')
		{
			include 'translations/en.php' ;
		}
	}

	else
	{
		include 'translations/en.php' ;
		//

	}



require_once('libraries/password_compatibility_library.php');
require_once('config/config.php');
require_once('libraries/PHPMailer.php');
require_once('classes/Login.php');



?>

<script>
function myFunction() {
    location.reload(true);
}
</script>





<div id="coverPics"></div>



<div id="apDiv1">
<?php $login = new Login(); 	?>
</div>

<script>
//myFunction(); 
</script>





<div id="login-form-box">

	
  
  <div id="login-form">
  
<?php

if ($login->checkloginstatus() == true) {
   	

		header("Location:http://localhost/BAAS_LK/index.php");
	}
	
	else 
	{

    include "views/not_logged_in.php" ;
	
	}
	
	?>
	
 </div>
  
  
 
  
  <a href = "fbLogin/fbSignupStatus_login.php">
  <div id="facebook"><img src="images/facebook-login.png" alt="" width="150" height="33" /></div>
  </a>
</div>	
 

<?php include_once('header.php'); ?>

</html>

