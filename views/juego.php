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

    include_once '../app/getPreguntasJuego.php';

    $preguntasLoaded = getPreguntas();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Juego</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
        <link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>  
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    </head>
    <body onload="cargaPregunta()">
        <div class="encabezado">
            <a href="seleccionaTema.php" class="gestionarPreguntas float-left arrow">
				<i class='fas fa-arrow-left'></i>
			</a>
			<a class="gestionarPreguntas" href="../app/logoutController.php" >
				Cerrar sesión
			</a>
		</div>
        <div class="marcador">
            <h2 id="marcadorRojo">Equipo Rojo: 0</h2>
            <h2 id="marcadorAzul">0: Equipo Azul</h2>
        </div>
        <div id="divPregunta" class="pregunta-div">
            <h2 id="colorEquipo"></h2>
            <h1 id="tituloPregunta"></h1>
            <img id= "imagenPregunta" class="imagen-pregunta" onerror="errorCargarImagen()" />
            <table id="tablePregunta" class="table-pregunta">
                <tr id="row-1"></tr>
                <tr id="row-2"></tr>
            </table> 
        </div>
    </body>
    <?php
        echo "<script>var preguntas= JSON.parse('$preguntasLoaded')</script>";
    ?>
    <script type="text/javascript">
        var puntosRojo = puntosAzul = ronda = 0;
        var turno = 'rojo';

        if(preguntas == null){
            alert('no hay suficientes preguntas (min. 6)');
            ronda = 6;
            window.location.replace('seleccionaTema.php');
        }

        function cargaPregunta(){
            var row1 = document.getElementById("row-1");
            var row2 = document.getElementById("row-2");
            row1.innerHTML = '';
            row2.innerHTML = '';
            
            document.getElementById("colorEquipo").innerHTML = "Turno: Equipo "+turno;
            document.getElementById("tituloPregunta").innerHTML = preguntas[ronda]['titulo'];
            document.getElementById("imagenPregunta").style.display = "block";
            document.getElementById("imagenPregunta").src = "../app/loadImage.php?id="+preguntas[ronda]['id'];
            for (var i = 0; i < preguntas[ronda]['respuestas'].length; i++) 
            {
                var nuevoTd = document.createElement("td");
                var button = document.createElement("button");
                button.innerHTML = preguntas[ronda]['respuestas'][i];
                button.value = preguntas[ronda]['respuestas'][i];
                button.setAttribute('onclick','tiroJugador(this.value , this.id)');
                button.setAttribute('id',i+'td');
                button.setAttribute('class', 'boton-to-a');
                nuevoTd.appendChild(button);
                if(i < 2){
                    document.getElementById("row-1").appendChild(nuevoTd);
                }else{
                    document.getElementById("row-2").appendChild(nuevoTd);
                }
            }
        } // cargaPregunta

        function tiroJugador(value, id){
            if(value == preguntas[ronda]['resC'])
            {
                if(turno == 'rojo')
                {
                    puntosRojo++;
                }else{
                    puntosAzul++;
                }                
                    document.getElementById(id).style.backgroundColor= "#65E354";
            }else{
                document.getElementById(id).style.backgroundColor= "#F7442B";
            }
            document.getElementById("marcadorRojo").innerHTML = "Equipo Rojo: "+puntosRojo;
            document.getElementById("marcadorAzul").innerHTML = puntosAzul+" :Equpo Azul";
            turno = turno == 'rojo' ? 'azul' : 'rojo';
            ronda++;
            if(ronda < 6){
                setTimeout(function(){cargaPregunta()},1000);
            }else{
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        window.location.replace('mostrarMarcador.php');
                    }
                };
                xmlhttp.open("GET", "../app/guardarMarcador.php?pRojo="+puntosRojo+"&pAzul="+puntosAzul, true);
                xmlhttp.send();
            }
        }

        function errorCargarImagen(){
            document.getElementById("imagenPregunta").style.display = "none";
        }
    // alert(preguntas[0]['id']);
    // alert(preguntas[0]['titulo']);
    // alert(preguntas[0]['respuestas'].length);
    // alert(preguntas[0]['resC']);
    </script>
</html>