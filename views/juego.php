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
        <link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>  
    </head>
    <body onload="cargaPreguntas()">
        <div class="encabezado">
			<a class="gestionarPreguntas" href="../app/logoutController.php" >
				Cerrar sesión
			</a>
		</div>
        <div id="div-pregunta">
            
        </div>
    </body>
    <?php
        echo "<script>var temaJs='$tema'</script>";
    ?>
    <script type="text/javascript">
        var puntosRojos = 0;
        var puntosAzul  = 0;
        var ronda       = 0;
        var turno       = 'rojo';

        function cargaPreguntas()
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var preguntasId = JSON.parse(this.responseText);   
                    iniciaJuego(preguntasId);
                }
            };
            xmlhttp.open("GET", "../app/getPreguntasJuego.php?tema="+temaJs, true);
            xmlhttp.send();
        }

        function iniciaJuego(preguntasId){
            alert(preguntasId);
            siguienteTurno = false;
            do
            {
                if(turno == 'rojo')
                {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("div-pregunta").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "../app/loadPreguntaJuego.php?id="+preguntasId[ronda]+"&turno="+turno, true);
                    xmlhttp.send();
                    
                    turno == 'azul';

                }else if(turno == 'azul')
                {

                    turno == 'rojo';
                }
                ronda++;
            }while(ronda < 6 && siguienteTurno == true);
        }
    </script>
</html>