<?php 
	session_start();
	if(!isset($_SESSION['nombreUsuario']))
	{
		header("Location:http://localhost/rdd/views/login.php");
		die();
	}
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dash</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	</head>
	<body>
		<div class="encabezado">
			<a class="gestionarPreguntas" href="../app/logoutController.php" >
				Cerrar sesión
			</a>
		</div>
		<div>
			<h1>Materias</h1>
			<p>Selecciona un tema del que quieras crear una nueva pregunta</p>
			<ul>
				<h2>Ciencias Naturales</h2>
				<li><a href="addPregunta.php?materia=Ciencias Naturales&tema=Regiones Naturales">Regiones Naturales</a></li>
				<li><a href="addPregunta.php?tema=Flora">Flora</a></li>
				<li><a href="addPregunta.php?tema=Fauna">Fauna</a></li>
				<li><a href="addPregunta.php?tema=Ejes Terrestres">Ejes Terrestres</a></li>
				<li><a href="">Mezclas</a></li>
				<li><a href="">Sonido y Propagación</a></li>
				<h2>Geografía</h2>
				<li><a href="">Capitales</a></li>
				<li><a href="">Idiomas del mundo</a></li>
				<li><a href="">Continentes</a></li>
			</ul>
		</div>
	</body>
</html>