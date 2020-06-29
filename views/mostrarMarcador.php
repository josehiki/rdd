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
        <link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    </head>
    <body>
        <div class="encabezado">
            <a href="seleccionaTema.php" class="gestionarPreguntas float-left arrow" style='float: left;'>
				<i class='fas fa-arrow-left'></i>
			</a>
			<a class="gestionarPreguntas" href="../app/logoutController.php" >
				Cerrar sesión
			</a>
		</div>
        <div class="contenedor-div">
            <h1 class='titulos'>¡¡Bien Jugado!!</h1>
            <h2 class="titulos">Marcador Final</h2>
            <div class="equipos">
                <div class="equipos-marcador">
                    <?php
                        echo "<h2 class='rojo'>Equipo Rojo</h2>";
                        echo "<table>";
                        foreach($equipoRojo as $miembro)
                        {
                            echo "<tr>";
                                echo "<td>$miembro</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "<h1 class='rojo'>Puntos: $pRojo</h1>";
                    ?>
                </div>
                <div class="equipos-marcador">
                    <?php
                        echo "<h2 class='azul'>Equipo Azul</h2>";
                        echo "<table>";
                        foreach($equipoAzul as $miembro)
                        {
                            echo "<tr>";
                                echo "<td>$miembro</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "<h1 class='azul'>Puntos: $pAzul</h1>";
                    ?>
                </div>
            </div>
        </div>
        <div class="marcador-footer">
            <a href="seleccionaTema.php">
                <i class='fas fa-redo-alt'></i>
                Volver a jugar
            </a>
            <a href="dash.php">
                <i class='fas fa-home'></i>
                Pantalla Principal
            </a>
        </div>
    </body>
</html>