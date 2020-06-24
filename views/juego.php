<?php 
    session_start();
    if(!isset($_SESSION['nombreUsuario']))
    {
        header("Location:login.php");
        die();
    }
    $tema = $_GET['tema'];
    $equipoRojo =  $_SESSION['equipoRojo'];
    $equipoAzul =  $_SESSION['equipoAzul'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Juego</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>

    </head>
    <body onload="cargaPreguntas()">
        <div class="encabezado">
			<a class="gestionarPreguntas" href="../app/logoutController.php" >
				Cerrar sesión
			</a>
		</div>
    </body>
    <?php
        echo "<script>var temaJs='$tema'</script>";
    ?>
    <script type="text/javascript">

        function cargaPreguntas()
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }
            };
            xmlhttp.open("GET", "../app/loadPreguntasJuego.php?tema="+temaJs, true);
            xmlhttp.send();
        }
    </script>
</html>