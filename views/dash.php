<?php 
	session_start();
	if(!isset($_SESSION['nombreUsuario']))
	{
		header("Location:login.php");
		die();
	}
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dash</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
		<link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>
	</head>
	<body>
		<div class="encabezado">
			<a class="gestionarPreguntas" href="../app/logoutController.php" >
				Cerrar sesión
			</a>
			<a class="gestionarPreguntas" href="seleccionaTema.php" >
                Jugar
            </a>
		</div>
		<div class="contenedor-div">
			<h1 class="titulos">Gestión de preguntas</h1>
			<p>Selecciona un tema para mostrar sus preguntas y sus opciones</p>
			<ul>
				<h2>Ciencias Naturales</h2>
				<li><a href="detalleTema.php?materia=Ciencias Naturales&tema=Regiones Naturales">Regiones Naturales</a></li>
				<li><a href="detalleTema.php?materia=Ciencias Naturales&tema=Flora">Flora</a></li>
				<li><a href="detalleTema.php?materia=Ciencias Naturales&tema=Fauna">Fauna</a></li>
				<li><a href="detalleTema.php?materia=Ciencias Naturales&tema=Ejes Terrestres">Ejes Terrestres</a></li>
				<li><a href="detalleTema.php?materia=Ciencias Naturales&tema=Mezclas">Mezclas</a></li>
				<li><a href="detalleTema.php?materia=Ciencias Naturales&tema=Sonido y Propagación">Sonido y Propagación</a></li>
				
				<h2>Geografía</h2>
				<li><a href="detalleTema.php?materia=Geografía&tema=Capitales">Capitales</a></li>
				<li><a href="detalleTema.php?materia=Geografía&tema=Idiomas del mundo">Idiomas del mundo</a></li>
				<li><a href="detalleTema.php?materia=Geografía&tema=Continentes">Continentes</a></li>
			</ul>
		</div>
	</body>
</html>