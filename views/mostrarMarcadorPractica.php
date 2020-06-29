<?php 
    $puntos = $_GET['puntos'];
    $tema = $_GET['tema'];
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
        <div class="encabezado"></div>
        <div>
            <h1>¡¡En hora buena!!</h1>
            <h4>Gran trabajo</h4>
            <h2>Tu marcador es</h2>
            <?php
                echo "<h2>$puntos</h2>";
            ?>
        </div>
        <div>
            <a href="../">Pantalla Principal</a>
        </div>
    </body>
</html>