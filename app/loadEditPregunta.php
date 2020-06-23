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

    //AUXILIARES PARA LA IMPRESION DE LAS RESPUESTAS//
    $inputLabel 	= ['a)', 'b)', 'c)', 'd)'];
    $inputId 		= ['a', 'b', 'c', 'd'];
    $inputName 		= ['A', 'B', 'C', 'D'];


    echo "<form method='post' action='../app/editPreguntaController.php' enctype='multipart/form-data' onsubmit='return beforeSubmit()''>";
        echo "<input name='idPregunta' style='display: none;' value='$preguntaId' />";
        echo "<input name='materia' style='display: none;' value='$materia' />";
    	echo "<input name='tema' style='display: none;' value='$tema' />";
        echo "<span>Título de la pregunta</span><br>";
    	echo "<input type='text' name='pregunta' required='' placeholder='Ingrese su pregunta' autocomplete='off' value='$titulo' /><br>";
    	echo "<span>Imagen de apoyo</span><br>";
    	echo "<input type='file' name='imagenEdit' id='imgFile' onchange='return imageValidationEdit()'/><br>";
        if ($imagen) {
            echo "<img id='imagePreview'  style='width: 200px;' src='../app/loadImage.php?id=$preguntaId' /><br>";            
        }else{
            echo "<img id='imagePreview'  style='width: 200px;' src='' /><br>";
        }		
        echo "<span>Eliminar imagenes</span>";
        echo "<input type='checkbox' id='checkImage' onclick='eraseImage($preguntaId)' name='checkImagen' value='true'/> <br>";
		echo "<span>Respuestas</span><br>";
		echo "<table>";
		for ($i=0; $i <4 ; $i++) // imprimir las 4 espacios para respuestas 
		{ 
			$auxId = isset($respuestas[$i]['id'])? $respuestas[$i]['id'] :null;
        	$auxName = isset($respuestas[$i]['res'])? $respuestas[$i]['res'] :null;
			$auxInputLabel = $inputLabel[$i];
			$auxInputId = $inputId[$i];
			$auxInputName = $inputName[$i]; 

			if ($i%2==0) // si i es par inicia una nueva fila
			{
				echo "<tr>";
			}
			echo "<span>$auxInputLabel</span>";
			echo "<input id='$auxInputId' type='text' name='opc$auxInputName'  autocomplete='off' onkeyup='setRadioValue(this.id)' value='$auxName' />";
			if($respuestaC == $auxId) // si es la respuesta correcta imprime el radio button seleccionado
			{
				echo "<input type='radio' id='aR' name='res' required='' tabindex='-1' checked='true' onclick='onCheckRadio(this.id' value='$auxName' ><br>";
			}else // no es la respuesta imprime normal
			{
				echo "<input type='radio' id='$auxInputId"."R' name='res' required='' tabindex='-1' onclick='onCheckRadio(this.id)' value='$auxName'><br>";
			}

		}
		echo "</table>";

	        
        echo "<button>Guardar Cambios</button>";
    echo "</form>";