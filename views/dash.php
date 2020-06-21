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