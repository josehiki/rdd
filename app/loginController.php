<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$nameDB = "rdd";

	$correoUsuario = $_POST['correo'];
	$contraUsuario = $_POST['contra'];
	$response=false;

	$conn = new mysqli($servername, $username, $password, $nameDB);
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
		}
	}

	if($response){
		echo "dash";
	}else
	{
		header("Location:http://localhost/rdd/views/login.php?response=0");
		die();
	}

	$conn->close();