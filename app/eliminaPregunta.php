<?php
    include_once 'models/db.php';

    $dbInfo = new db();
    $conn = new mysqli($dbInfo->servername,$dbInfo->username, $dbInfo->password, $dbInfo->nameDB);
    if ($conn->connect_error) 
    {
        die("La conexión con la db fallo: " . $conn->connect_error);
    } 

    $preguntaId; // auxiliar del id de la pregunta
    $response;
    if(isset($_GET['id'])){
        $preguntaId = $_GET['id'];
    }

    $sql = "DELETE FROM preguntas WHERE id=$preguntaId";
    if($conn->query($sql)) // si elimina la pregunta
    {
        $sql = "DELETE FROM respuestas WHERE pregunta_id=$preguntaId";
        if($conn->query($sql)) // si elimia las respuestas
        {
            $sql = "DELETE FROM pregunta_respuesta WHERE pregunta_id=$preguntaId";
            if($conn->query($sql)) // si la respuesta correcta fue eliminada
            {
                $response = 'Se elimino la pregunta correctamente';
            }else // si la respuesta correcta no fue eliminada
            {
                $response = 'Hubo un error en Respuesta Correcta';
            }
        }else // si las respuestas no fueron eliminadas correctamente
        {
            $response = 'Hubo un error en Respuestas';
        }
    }else // si la pregunta no fue eliminada correctamente 
    {
        $response = 'Hubo un error en Pregunta';
    }	


    echo $response;