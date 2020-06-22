<?php 
	session_start();
	if(!isset($_SESSION['nombreUsuario']))
	{
		header("Location:http://localhost/rdd/views/login.php");
		die();
	}

	$materia = $_GET['materia'];
    $tema = $_GET['tema'];
	
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Pregunta</title>
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
    </head>
    <body>
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
        </div>
    </body>
</html>