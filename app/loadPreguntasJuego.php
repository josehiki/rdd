<?php
    include_once 'models/db.php';

    $dbInfo = new db();
    $conn = new mysqli($dbInfo->servername,$dbInfo->username, $dbInfo->password, $dbInfo->nameDB);
    if ($conn->connect_error) 
    {
        die("La conexión con la db fallo: " . $conn->connect_error);
    } 

    $tema;
    $preguntas;

    if(isset($_GET['tema'])){
        $tema = $_GET['tema'];
    }

    $sql = "SELECT * FROM preguntas WHERE tema = '$tema'";
    $result = $conn->query($sql);  
    if ($result->num_rows > 0) // si hay registros de preguntas 
    {
        while($row = $result->fetch_assoc())
        {
            $auxP = [
                'id' => $row['id'],
                'titulo' => $row['titulo']
            ];
            $preguntas[] = $auxP;
        }
    }else // no hay preguntas registradas
    {
        $preguntas = null;
    } 
    $conn->close();


    if($preguntas)
    {
        ;
    }else
    {
        echo "No hay preguntas disponibles";
    }