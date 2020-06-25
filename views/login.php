<?php 
	session_start();
	if(isset($_SESSION['nombreUsuario']))
	{
		header("Location:dash.php");
		die();
	}
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
		<link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>
	</head>
	<body>
		<div class="encabezado"></div>


		<div class="contenedor">
			<div class="login-form">
			<h1 class="">Inicio de sesi&oacuten</h1>
				<form action="../app/loginController.php" method="post">
					<span>Correo</span>
					<input type="email" class="input-text" name="correo" required="" placeholder="Ingrese el correo registrado" /><br><br>
					<span>Contraseña</span>
					<input type="password" class="input-text" name="contra" required="" placeholder="Ingrese su contraseña" /><br><br>
					<button class="boton-to-a">Iniciar</button>
				</form>
			</div>
		</div>
	

	</body>
	<?php  
		if (!empty($_GET))
		{
			if($_GET['response'] == 0){
				echo "<script type='text/javascript'>
					alert('Usuario o contraseña incorrectos');
				</script>";
			}
		}
	?>
</html>