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
	<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	<link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>
	<script type="text/javascript" src="js/addValidation.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
 </head>
 <body>
 	<div class="encabezado">
		<?php
			echo "<a href='detalleTema.php?materia=$materia&tema=$tema' class='gestionarPreguntas float-left arrow'>
					<i class='fas fa-arrow-left'></i>
				</a>";
		?> 
	 	<a class="gestionarPreguntas" href="../app/logoutController.php" >
			Cerrar sesión
		</a>
	</div>
	<div>
		<h1>Alta Preguntas</h1>
	 	<?php
	 		echo "<h2>$materia</h2><h3>$tema</h3>"; 
	 	?>
		<form method="post" action="../app/addPreguntaController.php" enctype="multipart/form-data" onsubmit="return beforeSubmit()">
			<?php 
				echo "<input type='text' name='materia' style='display: none;' value='$materia'/>";
				echo "<input type='text' name='tema' style='display: none;' value='$tema'/>"; 
			?>
			<span>Título de la pregunta</span><br>
			<input type="text" name="pregunta" required="" placeholder="Ingrese su pregunta" autocomplete="off"/><br>
			<span>Imagen de apoyo</span><br>
			<input type="file" name="imagen" id="imgFile" onchange="return imageValidation()"/><br>
			<!-- <div id="imagePreview" ></div> -->
			<img id="imagePreview"  style="width: 200px;" src=""><br>
			<span>Respuestas</span><br>
			<span>a)</span>
			<input id="a" type="text" name="opcA" onkeyup="setRadioValue(this.id)" autocomplete="off" />
			<input type="radio" id="aR" name="res" style="display: none;" required="" tabindex="-1"><br>
			<span>b)</span>
			<input id="b" type="text" name="opcB" onkeyup="setRadioValue(this.id)" autocomplete="off"/>
			<input type="radio" id="bR" name="res" style="display: none;" tabindex="-1"><br>
			<span>c)</span>
			<input id="c" type="text" name="opcC" onkeyup="setRadioValue(this.id)" autocomplete="off"/>
			<input type="radio" id="cR" name="res" style="display: none;" tabindex="-1"><br>
			<span>d)</span>
			<input id="d" type="text" name="opcD" onkeyup="setRadioValue(this.id)" autocomplete="off"/>
			<input type="radio" id="dR" name="res" style="display: none;" tabindex="-1"><br>
			<button>Crear</button>
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