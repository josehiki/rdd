<?php 
	include_once 'models/db.php';
	
	$dbInfo = new db();
	$conn = new mysqli($dbInfo->servername,$dbInfo->username, $dbInfo->password, $dbInfo->nameDB);
	if ($conn->connect_error) 
	{
		die("La conexión con la db fallo: " . $conn->connect_error);
	} 

	$response;
	$materia	= $_POST['materia'];
	$tema		= $_POST['tema'];
	$titulo		= $_POST['pregunta'];
	$respuestas = [];
	$imagen		= false; 
	$contenido;

	//Recibir la imagen si fue agregada
	if (isset($_FILES['imagen'])) {
		$contenido = base64_encode(file_get_contents($_FILES['imagen']['tmp_name']));
		$imagen = true;
	}

	if (!empty($_POST['opcA'])) 
	{
		$respuestas[] = $_POST['opcA'];
	}
	if (!empty($_POST['opcB'])) 
	{
		$respuestas[] = $_POST['opcB'];
	}
	if (!empty($_POST['opcC'])) 
	{
		$respuestas[] = $_POST['opcC'];
	}
	if (!empty($_POST['opcD'])) 
	{
		$respuestas[] = $_POST['opcD'];
	}

	$respuestaC		= $_POST['res']; //respuesta correcta
	$pregunta_id;	//auxiliar para el id de la pregunta creada
	$respuesta_id;	//auxiliar para el id de la respuesta correcta creada
	$error;
	if($imagen)//si fue agregada una imagen
	{
		$sql = "insert into preguntas (materia,tema,titulo, imagen) values ('$materia', '$tema', '$titulo', '$contenido')";
	}else // si no se agrego una imagen
	{
		$sql = "insert into preguntas (materia,tema,titulo) values ('$materia', '$tema', '$titulo')";
	}
	if($conn->query($sql) === true) //inserta correctamente la pregunta
	{
		$sql = "select last_insert_id() as lastId"; //obtener el id de la pregunta recien insertada
		$result = $conn->query($sql);
		$last_id = $result->fetch_assoc(); // $last_id['lastId'] para acceder solo al id como string 
		$pregunta_id =  $last_id['lastId'];
		foreach ($respuestas as $respuesta) {
			$sql = "insert into respuestas (pregunta_id, respuesta) values ($pregunta_id, '$respuesta')";
			if ($conn->query($sql) === true) //inserta la respuesta
			{
				if ($respuesta == $respuestaC) // si la respuesta recien insertada coincide con la respuesta correcta, recupera el id
				{
					$sql = "select last_insert_id() as lastId";
					$result = $conn->query($sql);
					$last_id = $result->fetch_assoc();
					$respuesta_id =  $last_id['lastId'];


					$sql = "insert into pregunta_respuesta (pregunta_id, respuesta_id) values ($pregunta_id, $respuesta_id)";
					
					if ($conn->query($sql) === true) //inserta la respuesta
					{
						$response=1;
					}else
					{
						$response = 2;
						$error = "respuestaC: ".$conn->error;
						// echo "error: ".$conn->error;
					}
				}
			}else // error al insertar la respuesta
			{
				$response = 2;
				$error = "respuesta: ".$conn->error;
				// echo "error: ".$conn->error;
			}
		}
	}else //error al insertar la materia
	{
		$response = 2;
		$error = "pregunta: ".$conn->error;
		// echo "error: ".$conn->error;
	}

	$conn->close();
	// echo $error;
	// echo "$response";
	header("Location:../views/addPregunta.php?materia=$materia&tema=$tema&response=$response");
	

	

