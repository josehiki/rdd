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
	 		$tema = $_GET['tema'];
	 		echo "<h2>$tema</h2>"; ?>
		<form method="post" action="../app/addPreguntaController.php" enctype="multipart/form-data" onsubmit="return beforeSubmit()">
			<span>Título de la pregunta</span><br>
			<input type="text" name="pregunta" required="" placeholder="Ingrese su pregunta" /><br>
			<!-- <span>Imagen de apoyo</span><br>
			<input type="file" name="contra"/><br> -->
			<span>Respuestas</span><br>
			<span>a)</span>
			<input id="a" type="text" name="opcA" onblur="setRadioValue(this.id)" />
			<input type="radio" id="aR" name="res" name="" style="display: none;" required=""><br>
			<span>b)</span>
			<input id="b" type="text" name="opcB" onblur="setRadioValue(this.id)"/>
			<input type="radio" id="bR" name="res" name="" style="display: none;"><br>
			<span>c)</span>
			<input id="c" type="text" name="opcC" onblur="setRadioValue(this.id)"/>
			<input type="radio" id="cR" name="res" name="" style="display: none;"><br>
			<span>d)</span>
			<input id="d" type="text" name="opcD" onblur="setRadioValue(this.id)"/>
			<input type="radio" id="dR" name="res" name="" style="display: none;"><br>
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
			return validacion;
		}//beforeSubmit

		function setRadioValue(inputId){
			var contenido = document.getElementById(inputId).value;
			if (contenido.trim() != 0 || !!contenido)) {
				document.getElementById(inputId+'R').style.display = 'inline';
				document.getElementById(inputId+'R').value = contenido;				
			}else{
				document.getElementById(inputId+'R').style.display = 'inline';
				document.getElementById(inputId+'R').checked = false;
			}
		}//setRadioValue

	</script>
 </body>
 </html>