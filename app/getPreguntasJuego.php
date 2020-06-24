<?php
    include_once 'models/db.php';

    $dbInfo = new db();
    $conn = new mysqli($dbInfo->servername,$dbInfo->username, $dbInfo->password, $dbInfo->nameDB);
    if ($conn->connect_error) 
    {
        die("La conexión con la db fallo: " . $conn->connect_error);
    } 

    $tema       = $_GET['tema'];;
    $preguntasId;
    $auxId; //auxiliar para los id de TODAS las preguntas

    $sql = "SELECT id FROM preguntas WHERE tema = '$tema'";
    $result = $conn->query($sql);  
    if ($result->num_rows > 0) // si hay registros de preguntas 
    {
        while($row = $result->fetch_assoc())
        {
            $auxId[] = $row['id'];
        }
    } 

    $auxPreguntasHechas = [];
    for ($i=0; $i < 6 ; $i++) // obtener los ids de seis preguntas random
    { 
        $flag = true;
        do
        {
            $num = rand(0, (sizeof($auxId)-1));
            if(in_array($auxId[$num], $auxPreguntasHechas) == false) // si el numero no esta entre los id ya obtenidos
            {
                $preguntasId[] = $auxId[$num];
                $auxPreguntasHechas[] = $auxId[$num];
                $flag = false;
            }
        }while($flag);

    }
    
    echo json_encode($preguntasId);
    $conn->close();

