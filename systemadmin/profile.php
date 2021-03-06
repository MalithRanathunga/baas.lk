<!DOCTYPE html >
<html>
<!-- systemadmin look profile of service provider -->
<head>
	<title>baas.lk</title>
	<meta charset="UTF-8">

	<!-- Bootstrap  -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">   
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
	
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<!-- rating  -->
	<link rel="stylesheet" href="../star-rating.css" media="all" type="text/css"/>  
    <script src="../star-rating.js" type="text/javascript"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- calendar  -->
    <link href="../calendar/calendar.css" rel="stylesheet" type="text/css" />

	<link href="../Gallery/_css/Icomoon/style.css" rel="stylesheet" type="text/css" />
	<link href="../Gallery/_css/Icomoon/style.css" rel="stylesheet" type="text/css" />
	<link href="../Gallery/_css/main.css" rel="stylesheet" type="text/css"/>
	<link href="../Gallery/_css/pop-up-gallery3.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../Gallery/_scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../Gallery/_scripts/pop-up-gallery3.js"></script>
	<link href="../css/profile.css" rel="stylesheet" />
</head>

<body>

	<?php 
	include_once('header.php'); 	
	include_once('../_database/database.php'); 
	include_once('../functions/functions.php');
	?>

	<?php 	
	if(isset($_SESSION['userID']))	{
		$userID = $_SESSION['userID'];	
	}
	if(isset($_GET['user'])){
		$userID = $_GET['user'];	
	}

	$result = get_user_details($userID);
	$user = mysqli_fetch_assoc($result);	

	$result2 = get_serviceprovider_details($userID);
	$sp = mysqli_fetch_assoc($result2);	
	?>



	<div id="fullscreen">
		<div id="fullscreen-inner">
			<div id="fullscreen-inner-left" class="fullscreen-inner-button"><span class="icon-caret-left"></span></div>
			<div id="fullscreen-inner-right" class="fullscreen-inner-button"><span class="icon-caret-right"></span></div>
			<div id="fullscreen-inner-close" class="fullscreen-inner-button"><span class="icon-close"></span></div>
			<div id="fullscreen-image"></div>
		</div>
	</div>

	<?php if(!isset($_GET['user']))	{	?>
		<div id="subMenu">
			<ul class="nav nav-tabs">
			  	<li role="presentation" class="active"><a href="../profile.php"> <?php echo OVERVIEW ; ?> </a></li>
			 	<li role="presentation"><a href="../spProfEdit.php"> <?php echo EDITPROFILE ; ?> </a></li>
			 	<li role="presentation"><a href="../list_pm.php"> <?php echo MESSAGES ; ?></a> </li>
			</ul>
		</div>
	<?php } ?>

	<div id="apDivContainer">
	    <div id="apDivMainInfo">
	    	<div id="apDivTitle">
		        <p style="font-size:30px; margin-top:0px"> 
		        	<?php         	
		        	if(isset($user['user_firstname'])){ 
		        		echo $user['user_firstname']." ".$user['user_lastname'] ;
		        	}?>        	
		      	</p>    
		        <p style="margin-top:0px" >MEMBER SINCE :<?php if(isset($user['user_registration_datetime'])) { echo $user['user_registration_datetime'] ;} ?></p> 
		        <p>CATEGORY : <?php if(isset($sp['category'])) { echo $sp['category'] ;} ?></p>
		        <p>AREA : <?php if(isset($sp['area'])) { echo $sp['area'] ;} ?></p>  		      
			    <p><?php include('../includes/rating.php') ?></p> 	        			      
			    <p class="bubble"><span style='padding:5px' class="glyphicon glyphicon-user"><?php echo " ".$sp['ratingCount']." Votes"; ?></span></p>
	    	</div> 
	      	<div id="apDivProfPic2"><img class="img-circle2"  src= ../<?php if(isset($user['user_avatar'])) { echo $user['user_avatar'] ;} ?>  > </div>    	
	    </div>
	    
	    <div id="apDivContactBox">    
	        <p style="font-size:20px">CONTACT DETAILS </p>
		        <?php
			        if(isset($_GET['user']))
					{
					echo "<p><font align='right'><a href='../new_pm.php' class='link_new_pm'>Send a message</a></font></p> " ;
					}
				?>		 
	        <p>CONTACT NUMBER : <?php if(isset($sp['contactNo'])) { echo $sp['contactNo'];} ?></p>    
	        <p>EMAIL : <?php if(isset($user['user_email'])) {  echo $user['user_email'];} ?></p>
	        <p>ADDRESS : <?php if(isset($sp['address'])) { echo $sp['address'];} ?></p>  
	        <p>OPTIONALCONTACTNO : <?php if(isset($sp['opContactNo'])) { echo $sp['opContactNo'];} ?></p>    
	        <p>OPTIONALEMAIL : <?php if(isset($sp['opEmail'])) {  echo $sp['opEmail'];} ?></p>  		       
	    </div>   
	    
	    <div id="apDivShortDesc"> 
		    <p style="font-size:20px">ABOUT US</p> 
		    <p style="line-height: 130%;"><?php if(isset($sp['descr'])) { echo $sp['descr']; }?>
	    </div>
	    
	    
	</div>
    
    <div id="apDivContainerCol2">

	    <div id="calendarBox">	
			<?php
				if(isset($_GET['user'])){
					include('../calendar/customer_calendar.php');		
				}
				else{	
					include('../calendar/sp_calendar.php');	
				}
			?>	
		</div>
	  	

		<div id="galleryBox">
		<?php 
			$result = get_user_details($userID); //need this otherwise not working
			$user = mysqli_fetch_assoc($result); //need this otherwise not working
			$foldername = "../Gallery/galleryUploads/".$user['user_name']."/"; 	
		?>	  
			<div class="wrapper-inner-content-image">    
				<img src="
					<?php 
				  		$target_file = $foldername."9.jpg";
				  		if (file_exists($target_file)){
				   		 echo $target_file; 
				  		} 
				  		else{
				    		echo "../Gallery/galleryUploads/default.gif";
				 		} 
					?>
				"/>
				<img src="  
					<?php 
				  		$target_file = $foldername."8.jpg";
				  		if (file_exists($target_file)){
				   		 echo $target_file; 
				  		} 
				  		else{
				    		echo "../Gallery/galleryUploads/default.gif";
				 		} 
					?>
				"/>
				<img src="  
					<?php 
				  		$target_file = $foldername."7.jpg";
				  		if (file_exists($target_file)){
				   		 echo $target_file; 
				  		} 
				  		else{
				    		echo "../Gallery/galleryUploads/default.gif";
				 		} 
					?>
				"/>
				<img src="  
					<?php 
				  		$target_file = $foldername."6.jpg";
				  		if (file_exists($target_file)){
				   		 echo $target_file; 
				  		} 
				  		else{
				    		echo "../Gallery/galleryUploads/default.gif";
				 		} 
					?>
				"/>
				<img src="  
					<?php 
				  		$target_file = $foldername."5.jpg";
				  		if (file_exists($target_file)){
				   		 echo $target_file; 
				  		} 
				  		else{
				    		echo "../Gallery/galleryUploads/default.gif";
				 		} 
					?>
				"/>
				<img src="  
					<?php 
				  		$target_file = $foldername."4.jpg";
				  		if (file_exists($target_file)){
				   		 echo $target_file; 
				  		} 
				  		else{
				    		echo "../Gallery/galleryUploads/default.gif";
				 		} 
					?>
				"/>
				<img src="  
					<?php 
				  		$target_file = $foldername."3.jpg";
				  		if (file_exists($target_file)){
				   		 echo $target_file; 
				  		} 
				  		else{
				    		echo "../Gallery/galleryUploads/default.gif";
				 		} 
					?>
				"/>
				<img src="  
					<?php 
				  		$target_file = $foldername."2.jpg";
				  		if (file_exists($target_file)){
				   		 echo $target_file; 
				  		} 
				  		else{
				    		echo "../Gallery/galleryUploads/default.gif";
				 		} 
					?>
				"/>
				<img src="  
					<?php 
				  		$target_file = $foldername."1.jpg";
				  		if (file_exists($target_file)){
				   		 echo $target_file; 
				  		} 
				  		else{
				    		echo "../Gallery/galleryUploads/default.gif";
				 		} 
					?>
				"/>
				
				<div class="wrapper-inner-content-image-hover">
					<div class="wrapper-inner-content-image-hover-cercle"><span class="icon-search"></span></div>           
				</div>  
			</div>
		</div>

		<div id="apDivWorkHistory"> 
		    <p style="font-size:20px">WORK HISTORY</p>  
		    <p style="line-height: 130%;"> <?php if(isset($sp['workInfo'])) { echo $sp['workInfo'];} ?>
	    </div>
	</div>	
</div>        

<div id="apDivContainerCol3"></div>
</body>
</html>