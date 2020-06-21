<?php
    include_once 'models/db.php';
	
    

    function loadPreguntas($tema)
    {
        $dbInfo = new db();
        $conn = new mysqli($dbInfo->servername,$dbInfo->username, $dbInfo->password, $dbInfo->nameDB);
        if ($conn->connect_error) 
        {
            die("La conexión con la db fallo: " . $conn->connect_error);
        } 

        $sql = "SELECT * FROM preguntas WHERE tema = '$tema'";
        $result = $conn->query($sql);	
        $preguntas; //auxiliar para imprimir las preguntas
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc())
            {
                $auxP = [
                    'id' => $row['id'],
                    'titulo' => $row['titulo']
                ];
                $preguntas[] = $auxP;
            }
            return $preguntas;
        }else
        {
            return false;
        } 

        $conn->close();
    }// loadPreguntas
