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
 <html>
 <head>
 	<title>Nueva pregunta</title>
	<link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>
	<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	<script type="text/javascript" src="js/addValidation.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
 </head>
 <body>
 	<div class="encabezado">
		<?php
			echo "<a style='float: left;' href='detalleTema.php?materia=$materia&tema=$tema' class='gestionarPreguntas float-left arrow'>
					<i class='fas fa-arrow-left'></i>
				</a>";
		?> 
	 	<a class="gestionarPreguntas" href="../app/logoutController.php" >
			Cerrar sesión
		</a>
	</div>
	<div class="contenedor-div">
		<h1 class="titulos">Nueva Pregunta</h1>
	 	<?php
	 		echo"	<h2 class='tag'><span>Materia: </span>$materia</h2>
	 			 	<h3 class='tag'><span>Tema: </span>$tema</h3>"; 
	 	?>
	 	<p>Ingrese la informaci&oacuten de su pregunta</p>
		<form class="form-alta" method="post" action="../app/addPreguntaController.php" enctype="multipart/form-data" onsubmit="return beforeSubmit()">
			<?php 
				echo "<input type='text' name='materia' style='display: none;' value='$materia'/>";
				echo "<input type='text' name='tema' style='display: none;' value='$tema'/>"; 
			?>
			<span>Título de la pregunta</span><br>
			<input type="text" class="input-titulo input-text" name="pregunta" required="" placeholder="Ingrese su pregunta" autocomplete="off"/><br><br>

			<span>Imagen de apoyo</span><br>
			<input type="file" class="input-imagen" name="imagen" id="imgFile" onchange="return imageValidation()"/><br>
			<img id="imagePreview" class="imagen-pregunta" style="display: none;"><br>
			
			<span>Respuestas</span><br>
			<div class="wrapper">
				<div class="input-pregunta">
					<input id="a" type="text" class="input-p input-text" name="opcA" onkeyup="setRadioValue(this.id)" autocomplete="off" />
					<input type="radio" id="aR"  name="res" class="radio-pregunta" required="" tabindex="-1">				
				</div>

				<div class="input-pregunta">
					<input id="b" type="text" class="input-p input-text" name="opcB" onkeyup="setRadioValue(this.id)" autocomplete="off"/>
					<input type="radio" id="bR" name="res" class="radio-pregunta" tabindex="-1"><br>
				</div>

				<div class="input-pregunta">
					<input id="c" type="text" class="input-p input-text" name="opcC" onkeyup="setRadioValue(this.id)" autocomplete="off"/>
					<input type="radio" id="cR" name="res" class="radio-pregunta" tabindex="-1">
				</div>
				
				<div class="input-pregunta">
					<input id="d" type="text" class="input-p input-text" name="opcD" onkeyup="setRadioValue(this.id)" autocomplete="off"/>
					<input type="radio" id="dR" name="res" class="radio-pregunta" tabindex="-1"><br>
				</div>
			</div>
			<button class="button-pregunta boton-to-a">Crear</button>
		</form>
	</div>
	<?php 
		if (!empty($_GET['response'])) {
			if($_GET['response'] != 1)
			{
				echo "<script type='text/javascript'>
					alert('algo ha salido mal');
				</script>";
				$_GET['response'] = null;
			}else if($_GET['response'] == 1)
			{
				echo "<script type='text/javascript'>
					alert('Pregunta creada con éxito');
				</script>";
				$_GET['response'] = 2;
			}
		}
	?>
 </body>
 </html>