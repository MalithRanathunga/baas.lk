<!DOCTYPE html>
<html>

<head>

<title>baas.lk</title>
<meta charset="UTF-8">

<!--  
<meta name="viewport" content="width=device-width, initial-scale=1.0">   
<link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script> -->

<link rel="stylesheet" type="text/css" href="css/postjob.css">
<link href="css/header.css" rel="stylesheet">
<link href="css/searchBar.css" rel="stylesheet"> 


<style type="text/css">

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


?>
	

		
	<?php include 'header.php' ?>

	<div id="coverPics"></div>
	<?php include 'includes/searchBar.php' ;?>


	<?php 
	if(isset($_SESSION['Catagory'])){
		if($_SESSION['Catagory'] == 'customer'){
			include 'postjob.php' ;
		}
	}
	?>
	<?php //include 'functions/functions.php'; ?>
	<?php //$message = display_error("SDDS"); ?>
	<?php  //print_r($_SESSION) ; ?>

	

</body>

</html>








