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
 	<title>Alta preguntas</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css"/>

 </head>
 <body>
 	<div class="encabezado">
		<a class="gestionarPreguntas" href="../app/logoutController.php" >
			Cerrar sesión
		</a>
	</div>
	<div>
		<h1>Alta Preguntas</h1>
	 	<?php
	 		$materia = $_GET['materia'];
	 		$tema = $_GET['tema'];
	 		echo "<h2>$materia</h2><h3>$tema</h3>"; 
	 	?>
		<form method="post" action="../app/addPreguntaController.php" enctype="multipart/form-data" onsubmit="return beforeSubmit()">
			<?php 
				echo "<input type='text' name='materia' style='display: none;' value='$materia'/>";
				echo "<input type='text' name='tema' style='display: none;' value='$tema'/>"; 
			?>
			<span>Título de la pregunta</span><br>
			<input type="text" name="pregunta" required="" placeholder="Ingrese su pregunta" autocomplete="off"/><br>
			<!-- <span>Imagen de apoyo</span><br>
			<input type="file" name="contra"/><br> -->
			<span>Respuestas</span><br>
			<span>a)</span>
			<input id="a" type="text" name="opcA" onkeyup="setRadioValue(this.id)" autocomplete="off" />
			<input type="radio" id="aR" name="res" name="" style="display: none;" required="" tabindex="-1"><br>
			<span>b)</span>
			<input id="b" type="text" name="opcB" onkeyup="setRadioValue(this.id)" autocomplete="off"/>
			<input type="radio" id="bR" name="res" name="" style="display: none;" tabindex="-1"><br>
			<span>c)</span>
			<input id="c" type="text" name="opcC" onkeyup="setRadioValue(this.id)" autocomplete="off"/>
			<input type="radio" id="cR" name="res" name="" style="display: none;" tabindex="-1"><br>
			<span>d)</span>
			<input id="d" type="text" name="opcD" onkeyup="setRadioValue(this.id)" autocomplete="off"/>
			<input type="radio" id="dR" name="res" name="" style="display: none;" tabindex="-1"><br>
			<button>Crear</button>
		</form>
	</div>
	<script type="text/javascript">
		function beforeSubmit(){
			var validacion;
			var opcA = document.getElementById('a').value;
			var opcB = document.getElementById('b').value;
			var opcC = document.getElementById('c').value;
			var opcD = document.getElementById('d').value;

			if(opcA.trim() != "" && opcB.trim() != "") //evaluar si hay al menos dos respuestas llenas, en caso de que haya mas de dos (3-4) entra a algun if por default
			{
				validacion = true;
			}else if(opcA.trim() != "" && opcC.trim() != ""){
				validacion = true;
			}else if(opcA.trim() != "" && opcD.trim() != ""){
				validacion = true;
			}else if(opcB.trim() != "" && opcC.trim() != ""){
				validacion = true;
			}else if(opcB.trim() != "" && opcD.trim() != ""){
				validacion = true;
			}else if (opcC.trim() != "" && opcD.trim() != ""){
				validacion = true;
			}else{
				alert('debe llenar al menos dos opciones');
				validacion = false;
			}


			if(	(opcA.trim() != opcB.trim()) && 
				(opcA.trim() != opcC.trim()) && 
				(opcA.trim() != opcD.trim()) && 
				(opcB.trim() != opcC.trim()) && 
				(opcB.trim() != opcD.trim()) && 
				(opcC.trim() != opcD.trim())  ) //evalua que no haya dos respuestas iguales
			{
				validacion = true;
			}
			else
			{
				alert('No puede repetir la misma respuesta');
				validacion = false;
			}

			return validacion;
		}//beforeSubmit

		function setRadioValue(inputId){
			var contenido = document.getElementById(inputId).value;
			if (contenido.trim() != 0 && !!contenido) {
				document.getElementById(inputId+'R').style.display = 'inline';
				document.getElementById(inputId+'R').value = contenido;				
			}else{
				document.getElementById(inputId+'R').style.display = 'none';
				document.getElementById(inputId+'R').checked = false;
			}
		}//setRadioValue

	</script>
	<?php 
		if (!empty($_GET['response'])) {
			if($_GET['response'] == 0)
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
				$_GET['response'] = null;
			}
		}
	 ?>
 </body>
 </html>