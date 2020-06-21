<?php
    include_once 'models/db.php';

    $dbInfo = new db();
    $conn = new mysqli($dbInfo->servername,$dbInfo->username, $dbInfo->password, $dbInfo->nameDB);
    if ($conn->connect_error) 
    {
        die("La conexión con la db fallo: " . $conn->connect_error);
    } 

    $preguntaId; // auxiliar del id de la pregunta
    if(isset($_GET['id'])){
        $preguntaId = $_GET['id'];
    }

    $imagen; 
    $sql = "SELECT * FROM preguntas where id=$preguntaId";
    $result = $conn->query($sql);	

	if($result->num_rows > 0) 
	{	
        $row = $result->fetch_assoc();
        $imagen = base64_decode($row['imagen']);
    }
    echo $imagen;