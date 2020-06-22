<?php 
	session_start();
	if(!isset($_SESSION['nombreUsuario']))
	{
		header("Location:http://localhost/rdd/views/login.php");
		die();
	}

	$materia = $_GET['materia'];
    $tema = $_GET['tema'];
	$preguntaId = $_GET['id'];
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Pregunta</title>
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
        <script type="text/javascript" src="js/addValidation.js"></script>
    </head>
    <body onload="loadPregunta()">
        <div class="encabezado">
            <a class="gestionarPreguntas" href="../app/logoutController.php" >
                Cerrar sesión
            </a>
        </div>
        <div>
            <?php
                echo "<h1 id='uno'>$materia</h1>";
                echo "<h3>$tema</h3>";
            ?>
            <div id="editPregunta"></div>
        </div>
    </body>
    <?php
        echo "<script>var id='$preguntaId'</script>";
    ?>
    <script type="text/javascript">
        function loadPregunta(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("editPregunta").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "../app/loadEditPregunta.php?id="+id, true);
            xmlhttp.send(); 
        }
    </script>
</html>