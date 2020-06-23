<?php  
	session_start();
	session_destroy();
	
	header("Location:http://18.222.24.254/rdd");
	die();