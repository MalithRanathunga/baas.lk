<?php 
// session check (login status)
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if(!$_SESSION["adminusername"]){
        header("location:login.php?session=notset");
	
    }
	?>