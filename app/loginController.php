<?php
	include_once 'models/db.php';
	$dbInfo = new db();

	$correoUsuario = $_POST['correo'];
	$contraUsuario = $_POST['contra'];
	$response=false;

	$conn = new mysqli($dbInfo->servername,$dbInfo->username, $dbInfo->password, $dbInfo->nameDB);
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT * FROM usuarios where correo='$correoUsuario'";
	$result = $conn->query($sql);	

	if($result->num_rows > 0) 
	{	
		$row = $result->fetch_assoc();
		if(password_verify($contraUsuario, $row['contrasenia']))
		{
			$response = true;
			$nombreUsuario = $row['nombre'];
		}
	}

	if($response){
		session_start();

		$_SESSION['nombreUsuario'] = $nombreUsuario;
		
		header("Location:http://localhost/rdd/views/dash.php");
		// die();
	}else
	{
		session_destroy();
		header("Location:http://localhost/rdd/views/login.php?response=0");
		die();
	}

	$conn->close();