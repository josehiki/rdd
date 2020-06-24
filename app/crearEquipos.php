<?php
    session_start();
    $equipoRojo =json_decode($_GET['rojo'], true);
    $equipoAzul =json_decode($_GET['azul'], true);
    $_SESSION['equipoRojo']=$equipoRojo;
    $_SESSION['equipoAzul']=$equipoAzul;

    echo "todo ok";
    
    