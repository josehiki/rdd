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

    $titulo;
    $imagen;
    $respuestas; 
    $respuestaC; //ID de la respuesta correcta
    $materia;
    $tema;

    //Consulta de la pregunta
    $sql = "SELECT * FROM preguntas where id=$preguntaId";
    $result = $conn->query($sql);	
	if($result->num_rows > 0) 
	{	
        $row = $result->fetch_assoc();
        $titulo = $row['titulo'];
        $imagen = $row['imagen']? base64_decode($row['imagen']) : false;
        $materia = $row['materia'];
        $tema = $row['tema'];
    }
    
    //Consulta de las respuestas con el id de la pregunta
    $sql = "SELECT * FROM respuestas where pregunta_id=$preguntaId";
    $result = $conn->query($sql);	
    if($result->num_rows > 0) 
	{	
        while($row = $result->fetch_assoc())
        {
            $auxR = [
                'id' => $row['id'],
                'res' => $row['respuesta']
            ];

            $respuestas[]=$auxR;
        }
    }
    
    //Consulta de la respuesta correcta con el id de pregunta
    $sql = "SELECT * FROM pregunta_respuesta where pregunta_id=$preguntaId";
    $result = $conn->query($sql);	
	if($result->num_rows > 0) 
	{	
        $row = $result->fetch_assoc();
        $respuestaC = $row['respuesta_id'];
    }

    echo "<span class='close' onclick='hideModal()'>&times;</span>";
    echo "<br><h1 class='titulo-pregunta'>$titulo</h1>";
    if($imagen){
        echo "<img class='imagen-pregunta' src='../app/loadImage.php?id=$preguntaId' alt='img'>";
    }
    echo "<table class='table-detalle-pregunta'>";
    $i=0;
    foreach ($respuestas as $respuesta) {
        
        $auxId = $respuesta['id'];
        $auxName = $respuesta['res'];
        if($i%2==0)
        {
            echo "<tr>";
        }
        if($respuestaC == $auxId){
            echo "<td style='border: 1px solid green'>$auxName</td>";
            
        }else
        {
            echo "<td>$auxName</td>";
        }
       
        $i++;
        if($i%2==0)
        {
            echo "</tr>";
        }
        
    }
    echo "</table><br><br>";
    echo "<a class='button-editar' href='editPregunta.php?materia=$materia&tema=$tema&id=$preguntaId'>Editar</a>"; 
    echo "<a class='button-eliminar' onclick='showConfirmationModal($preguntaId)'>Eliminar</a>";
    
    
    $conn->close();
