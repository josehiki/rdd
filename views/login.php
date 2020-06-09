<?php 
	session_start();
	if(isset($_SESSION['nombreUsuario']))
	{
		header("Location:http://localhost/rdd/views/dash.php");
		die();
	}
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	</head>
	<body>
		<div class="encabezado">
		</div>
		<h1>Inicia sesion</h1>
		<form action="../app/loginController.php" method="post">
			<span>Correo</span><br>
			<input type="email" name="correo" required="" /><br>
			<span>Contraseña</span><br>
			<input type="password" name="contra" required="" /><br>
			<button>Iniciar</button>
		</form>
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