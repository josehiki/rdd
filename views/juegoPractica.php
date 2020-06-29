    <?php
     $materia = $_GET['materia'];
     $tema = $_GET['tema'];

    include_once '../app/getPreguntasJuego.php';
    $preguntasLoaded = getPreguntas();
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Juego Pr&aacutectica</title>
        <link href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
    </head>
    <body id="eBody" onload="cargaPregunta()">
        <div class="encabezado"></div>
        <div class="marcador-divPractica">
            <h2 id="marcador">Puntos: 0</h2>
        </div>
        <div id="divPregunta" class="pregunta-div">
            <h1 id="tituloPregunta"></h1>
            <img id= "imagenPregunta" class="imagen-pregunta" onerror="errorCargarImagen()"/>
            <table id="tablePregunta" class="table-pregunta">
                <tr id="row-1"></tr>
                <tr id="row-2"></tr>
            </table> 
        </div>
    </body>
    <?php
        echo "<script>var preguntas= JSON.parse('$preguntasLoaded');
                var tema = '$tema';
              </script>";

    ?>
    <script type="text/javascript">
        var puntos = ronda = 0;
        if(preguntas == null){
            alert('no hay suficientes preguntas');
            ronda = 6;
            window.location.replace('../');
        }

        function cargaPregunta(){
            var row1 = document.getElementById("row-1");
            var row2 = document.getElementById("row-2");
            row1.innerHTML = '';
            row2.innerHTML = '';
            
            document.getElementById("tituloPregunta").innerHTML = preguntas[ronda]['titulo'];
            document.getElementById("imagenPregunta").style.display = "block";
            document.getElementById("imagenPregunta").src = "../app/loadImage.php?id="+preguntas[ronda]['id'];
            // document.getElementById("eBody").background = "../app/loadImage.php?id="+preguntas[ronda]['id'];
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
                document.getElementById(id).style.backgroundColor= "#65E354";
                puntos++;           
            }else{
                document.getElementById(id).style.backgroundColor= "#F7442B";
            }
            document.getElementById("marcador").innerHTML = "Puntos: "+puntos;
            ronda++;
            if(ronda < 6){
                setTimeout(function(){cargaPregunta()},1000);
            }else{
                var xmlhttp = new XMLHttpRequest();
                window.location.replace('mostrarMarcadorPractica.php?puntos='+puntos+'&tema='+tema);
            }
        }

        function errorCargarImagen(){
            document.getElementById("imagenPregunta").style.display = "none";
        }
    </script>
</html>