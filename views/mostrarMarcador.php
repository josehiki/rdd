<?php 
    session_start();
    if(!isset($_SESSION['nombreUsuario']))
    {
        header("Location:login.php");
        die();
    }
    $equipoRojo =  $_SESSION['equipoRojo'];
    $equipoAzul =  $_SESSION['equipoAzul'];
    $pRojo = $_SESSION['pRojo'];
    $pAzul = $_SESSION['pAzul'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Marcador</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>

    </head>
    <body>
        <div class="encabezado">
			<a class="gestionarPreguntas" href="../app/logoutController.php" >
				Cerrar sesión
			</a>
		</div>
        <div>
            <h1>¡¡Bien Jugado!!</h1>
            <h2>Marcador Final</h2>
            <div>
                <?php
                    echo "<h2>Equipo Rojo</h2>";
                    echo "<ul>";
                    foreach($equipoRojo as $miembro)
                    {
                        echo "<li>$miembro</li>";
                    }
                    echo "</ul>";
                    echo "<h1>Puntos: $pRojo</h1>";
                ?>
            </div>
            <div>
                <?php
                    echo "<h2>Equipo Azul</h2>";
                    echo "<ul>";
                    foreach($equipoAzul as $miembro)
                    {
                        echo "<li>$miembro</li>";
                    }
                    echo "</ul>";
                    echo "<h1>Puntos: $pAzul</h1>";
                ?>
            </div>
        </div>
        <div>
            <a href="seleccionaTema.php">Volver a jugar</a>
            <a href="dash.php">Pantalla Principal</a>
        </div>
    </body>
</html>