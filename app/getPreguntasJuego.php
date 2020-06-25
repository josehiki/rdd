<?php
    function getPreguntas()
    {
        include_once 'models/db.php';

        $dbInfo = new db();
        $conn = new mysqli($dbInfo->servername,$dbInfo->username, $dbInfo->password, $dbInfo->nameDB);
        if ($conn->connect_error) 
        {
            die("La conexión con la db fallo: " . $conn->connect_error);
        } 

        $tema       = $_GET['tema'];
        $preguntasId;
        $auxId; //auxiliar para los id de TODAS las preguntas
        $preguntas;

        $sql = "SELECT id FROM preguntas WHERE tema = '$tema'";
        $result = $conn->query($sql);  
        if ($result->num_rows > 0) // si hay registros de preguntas 
        {
            while($row = $result->fetch_assoc())
            {
                $auxId[] = $row['id'];
            }
        } 
        if(sizeof($auxId) >= 6)//si hay 6 o mas preguntas registradas
        {
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
            
            for ($i=0; $i <sizeof($preguntasId) ; $i++) { 
                $auxPregunta;
                $auxId = $preguntasId[$i];
                $id;
                $titulo;
                $respuestas = [];
                $respuestaC;

                //Consulta de la pregunta
                $sql = "SELECT * FROM preguntas where id=$auxId";
                $result = $conn->query($sql);	
                if($result->num_rows > 0) 
                {	
                    $row = $result->fetch_assoc();
                    $id     = $row['id'];
                    $titulo = $row['titulo'];            
                }

                
                //Consulta de las respuestas con el id de la pregunta
                $sql = "SELECT * FROM respuestas where pregunta_id=$auxId";
                $result = $conn->query($sql);	
                if($result->num_rows > 0) 
                {	
                    while($row = $result->fetch_assoc())
                    {
                        $respuestas[]=$row['respuesta'];
                    }
                }

                $respuestaId;
                //Consulta de la respuesta correcta con el id de pregunta
                $sql = "SELECT * FROM pregunta_respuesta where pregunta_id=$auxId";
                $result = $conn->query($sql);	
                if($result->num_rows > 0) 
                {	
                    $row = $result->fetch_assoc();
                    $respuestaId = $row['respuesta_id'];
                }

                //Consulta de la respuesta correcta con el id de pregunta
                $sql = "SELECT * FROM respuestas where id=$respuestaId";
                $result = $conn->query($sql);	
                if($result->num_rows > 0) 
                {	
                    $row = $result->fetch_assoc();
                    $respuestaC = $row['respuesta'];
                }


                $auxPregunta = [
                    'id'            => $id,
                    'titulo'        => $titulo,
                    'respuestas'    => $respuestas,
                    'resC'          => $respuestaC
                ];

                $preguntas[] = $auxPregunta;
            } // fin for

        }else // si hay menos de seis
        {
            $preguntas = null; 
        }
        




        return json_encode($preguntas);
        $conn->close();
    }

