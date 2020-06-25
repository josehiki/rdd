<?php 
    session_start();
    if(!isset($_SESSION['nombreUsuario']))
    {
        header("Location:login.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Selecciona un tema</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
		<link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>
    </head>
    <body>
        <div class="encabezado">
			<a class="gestionarPreguntas" href="../app/logoutController.php" >
				Cerrar sesión
			</a>
		</div>
        <div class="contenedor-div">
            <h1 class="titulos">¡Vamos a jugar!</h1>
            <p>Primero selecciona un tema para jugar</p>
            <ul>
            <h2>Ciencias Naturales</h2>
				<li><a href="armarEquipos.php?materia=Ciencias Naturales&tema=Regiones Naturales">Regiones Naturales</a></li>
				<li><a href="armarEquipos.php?materia=Ciencias Naturales&tema=Flora">Flora</a></li>
				<li><a href="armarEquipos.php?materia=Ciencias Naturales&tema=Fauna">Fauna</a></li>
				<li><a href="armarEquipos.php?materia=Ciencias Naturales&tema=Ejes Terrestres">Ejes Terrestres</a></li>
				<li><a href="armarEquipos.php?materia=Ciencias Naturales&tema=Mezclas">Mezclas</a></li>
				<li><a href="armarEquipos.php?materia=Ciencias Naturales&tema=Sonido y Propagación">Sonido y Propagación</a></li>
				
				<h2>Geografía</h2>
				<li><a href="armarEquipos.php?materia=Geografía&tema=Capitales">Capitales</a></li>
				<li><a href="armarEquipos.php?materia=Geografía&tema=Idiomas del mundo">Idiomas del mundo</a></li>
				<li><a href="armarEquipos.php?materia=Geografía&tema=Continentes">Continentes</a></li>
            </ul>
        </div>
    </body>
</html>
