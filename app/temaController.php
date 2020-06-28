<?php
    include_once 'models/db.php';
	
    
    $dbInfo = new db();
    $conn = new mysqli($dbInfo->servername,$dbInfo->username, $dbInfo->password, $dbInfo->nameDB);
    if ($conn->connect_error) 
    {
        die("La conexión con la db fallo: " . $conn->connect_error);
    } 

    $tema;
    if(isset($_GET['tema'])){
        $tema = $_GET['tema'];
    }

    $sql = "SELECT * FROM preguntas WHERE tema = '$tema'";
    $result = $conn->query($sql);  

    $preguntas; //auxiliar para imprimir las preguntas

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
        echo "<table style='width: 100%'>";
        foreach ($preguntas as $pregunta) {
            $titulo = $pregunta['titulo'];
            $id = $pregunta['id'];
            echo "<tr>";
            echo "<td onclick='showModal($id)' class='pregunta-td'>$titulo</td>";
            echo "</tr>";
            echo "<tr class='pregunta-tr'></tr>";
        }
        echo "</table>";
    }else
    {
        echo "<h4>No hay preguntas registradas</h4>";
    }