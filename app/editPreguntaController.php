<?php
	//Conexion bd 
	include_once 'models/db.php';
	
	$dbInfo = new db();
	$conn = new mysqli($dbInfo->servername,$dbInfo->username, $dbInfo->password, $dbInfo->nameDB);
	if ($conn->connect_error) 
	{
		die("La conexión con la db fallo: " . $conn->connect_error);
	}

	//variables 
	$response;
	$materia	= $_POST['materia'];
	$tema		= $_POST['tema'];
	$preguntaId	= $_POST['idPregunta'];
	$titulo		= $_POST['pregunta'];
	$imagen		= false;
	$sinImagen 	= isset($_POST['checkImagen']) ?$_POST['checkImagen']:false;
	$contenido;
	$respuestaC	= $_POST['res']; //respuesta correcta
	$nuevasRespuestas = [];

	$error;

	if(!$sinImagen) // si se dejo sin seleccionar la casilla para imagenes
	{
		if (isset($_FILES['imagenEdit']) && $_FILES['imagenEdit']['error'] !=4) // si se selecciono una imagen
		{
			$contenido = base64_encode(file_get_contents($_FILES['imagenEdit']['tmp_name']));
			$imagen = true;
		}
	}

	if (!empty($_POST['opcA'])) 
	{
		$nuevasRespuestas[] = $_POST['opcA'];
	}
	if (!empty($_POST['opcB'])) 
	{
		$nuevasRespuestas[] = $_POST['opcB'];
	}
	if (!empty($_POST['opcC'])) 
	{
		$nuevasRespuestas[] = $_POST['opcC'];
	}
	if (!empty($_POST['opcD'])) 
	{
		$nuevasRespuestas[] = $_POST['opcD'];
	}

	
	//Modifica el nombre y la imagen si existe

	if($sinImagen) // si elimina cualquier imagen
	{
		$sql = "UPDATE preguntas SET titulo='$titulo', imagen=null WHERE id=$preguntaId";
	}else if($imagen) // si hay una imagen nueva
	{
		$sql = "UPDATE preguntas SET titulo='$titulo', imagen='$contenido' WHERE id=$preguntaId";
	}else // si no hay una imagen nueva y no se selecciono eliminar imagenes
	{
		$sql = "UPDATE preguntas SET titulo='$titulo' WHERE id=$preguntaId";

	}
	if($conn->query($sql)) // modifica el titulo y la imagen correctamente 
	{	
    	//recuperamos las respuestas origininales
		$sql = "SELECT * FROM respuestas WHERE pregunta_id=$preguntaId";
		$result = $conn->query($sql);	
	    if($result->num_rows > 0) 
		{	
			//crea arreglo de id de las respuestas actuales
			$respuestas;
			while($row = $result->fetch_assoc())
			{
				$respuestas[] = $row['id'];
			}
			

	        if(sizeof($nuevasRespuestas) == sizeof($respuestas)) // si la cantidad de nuevas respuestas es igual a las antiguas respuestas
	        {
	        	for ($i=0; $i < sizeof($nuevasRespuestas); $i++) 
	        	{ 
	        		$auxNRespuesta = $nuevasRespuestas[$i];
	        		$auxRespuesta  = $respuestas[$i];
	        		$sql = "UPDATE respuestas SET respuesta='$auxNRespuesta' WHERE id=$auxRespuesta";
	        		
	        		if ($conn->query($sql)) // si la actualizacion es correcta 
	        		{
	        			if($auxNRespuesta == $respuestaC) // si la respuesta de esta iteración es la correcta
	        			{
	        				$sql = "UPDATE pregunta_respuesta SET respuesta_id=$auxRespuesta WHERE pregunta_id=$preguntaId";
	        				$conn->query($sql);
	        			}	
	        		}else // si falla al actualizar 
	        		{
	        			$response = 2;
						$error = $conn->error();
	        		}
	        	}
	        	$response = 1;
	        } // si las nuevasRespuestas y las respuestas son del mismo tamaño

	        if(sizeof($nuevasRespuestas) < sizeof($respuestas)) // si las nuevas respuestas es menor que las antiguas
	        {
	        	for ($i=0; $i < sizeof($nuevasRespuestas) ; $i++) { 
	        		$auxNRespuesta = $nuevasRespuestas[$i];
	        		$auxRespuesta  = $respuestas[$i];
	        		$sql = "UPDATE respuestas SET respuesta='$auxNRespuesta' WHERE id=$auxRespuesta";
	        		if ($conn->query($sql)) // si la actualizacion es correcta 
	        		{
	        			if($auxNRespuesta == $respuestaC) // si la respuesta de esta iteración es la correcta
	        			{
	        				$sql = "UPDATE pregunta_respuesta SET respuesta_id=$auxRespuesta WHERE pregunta_id=$preguntaId";
	        				$conn->query($sql);
	        			}	
	        		}else // si falla al actualizar 
	        		{
	        			$response = 2;
						$error = $conn->error();
	        		}
	        	} // for del tamaño de las nuevas respuestas

	        	for ($i=sizeof($nuevasRespuestas); $i <sizeof($respuestas) ; $i++) // se elimina las respuestas sobrantes 
	        	{ 
	        		$auxRespuesta  = $respuestas[$i];
	        		$sql = "DELETE FROM respuestas WHERE id=$auxRespuesta";
	        		$conn->query($sql);
	        	}
	        	$response = 1;
	        } // if nuevasRespuestas < respuestas 

	        if(sizeof($nuevasRespuestas) > sizeof($respuestas)) 
	        {
	        	for ($i=0; $i <sizeof($respuestas) ; $i++) 
	        	{ 
	        		$auxNRespuesta = $nuevasRespuestas[$i];
	        		$auxRespuesta  = $respuestas[$i];
	        		$sql = "UPDATE respuestas SET respuesta='$auxNRespuesta' WHERE id=$auxRespuesta";
	        		
	        		if ($conn->query($sql)) // si la actualizacion es correcta 
	        		{
	        			if($auxNRespuesta == $respuestaC) // si la respuesta de esta iteración es la correcta
	        			{
	        				$sql = "UPDATE pregunta_respuesta SET respuesta_id=$auxRespuesta WHERE pregunta_id=$preguntaId";
	        				$conn->query($sql);
	        			}	
	        		}else // si falla al actualizar 
	        		{
	        			$response = 2;
						$error = $conn->error();
	        		}
	        	}

	        	for ($i=sizeof($respuestas); $i <sizeof($nuevasRespuestas) ; $i++) 
	        	{ 
	        		$auxNRespuesta = $nuevasRespuestas[$i];
	        		$sql = "INSERT INTO respuestas (pregunta_id, respuesta) VALUES ($preguntaId, '$auxNRespuesta')";

	        		if ($conn->query($sql)) //inserta la respuesta
					{
						if ($auxNRespuesta == $respuestaC) // si la respuesta recien insertada coincide con la respuesta correcta, recupera el id
						{
							$sql = "select last_insert_id() as lastId";
							$result = $conn->query($sql);
							$last_id = $result->fetch_assoc();
							$respuesta_id =  $last_id['lastId'];


							$sql = "UPDATE pregunta_respuesta SET respuesta_id=$respuesta_id WHERE pregunta_id=$preguntaId";
							$conn->query($sql);
						}
					}else // error al insertar la respuesta
					{
						$response = 2;
						$error = "respuesta: ".$conn->error;
						// echo "error: ".$conn->error;
					}
	        	} // miestras nuevasRespuestas tamaño
	        	$response = 1;
	        } // if nuevasRespuestas > Respuestas
	    }
    }else // error al modificar el titulo o la imagen
	{
		$response = 2;
		$error = $conn->error();
	}

	$conn->close();
	// echo $error;
	// echo "$response";
	header("Location:../views/detalleTema.php?materia=$materia&tema=$tema&response=$response");