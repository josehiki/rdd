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
        <link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>        
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script type="text/javascript" src="js/addValidation.js"></script>
    </head>
    <body onload="loadPregunta()">
        <div class="encabezado">
            <?php
                echo "<a style='float: left;' href='detalleTema.php?materia=$materia&tema=$tema' class='float-left gestionarPreguntas arrow'>
                        <i class='fas fa-arrow-left'></i>
                    </a>";
            ?> 
            <a class="gestionarPreguntas" href="../app/logoutController.php" >
                Cerrar sesión
            </a>
        </div>
        <div class="contenedor-div">
            <h1 class="titulos">Editar Pregunta</h1>
            <?php
                echo"	<h2 class='tag'><span>Materia: </span>$materia</h2>
                        <h3 class='tag'><span>Tema: </span>$tema</h3>"; 
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