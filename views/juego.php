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
    print_r($equipoRojo);
    print_r($equipoAzul);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego</title>
</head>
<body>
    
</body>
</html>