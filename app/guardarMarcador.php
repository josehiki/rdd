<?php
    session_start();
    $puntosRojo =$_GET['pRojo'];
    $puntosAzul =$_GET['pAzul'];
    $_SESSION['pRojo']=$puntosRojo;
    $_SESSION['pAzul']=$puntosAzul;

    echo "todo ok";