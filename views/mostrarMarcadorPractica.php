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
        <link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    </head>
    <body class="body-marcador">
        <div class="encabezado"></div>
        <div class="contenedor-div contenedor-marcadorP">
            <h1 class="titulos titulo-marcadorP"><span>¡¡</span> En hora buena <span>!!</span></h1>
            <h3>Gran trabajo</h3>
            <br>
            <?php
                echo "<h2>Tu marcador es<br>$puntos</h2>";
            ?>
        </div>
        <div class="marcador-footer">
            <a href="">
                <i class='fas fa-redo-alt'></i>
                Volver a jugar
            </a>
            <a href="">
                <i class='fas fa-book'></i>
                Cambiar tema
            </a>
            <a href="../">
                <i class='fas fa-home'></i>
                Pantalla Principal
            </a>
        </div>            
    </body>
</html>