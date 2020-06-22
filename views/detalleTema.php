<?php 
	session_start();
	if(!isset($_SESSION['nombreUsuario']))
	{
		header("Location:http://localhost/rdd/views/login.php");
		die();
    }
    $materia = $_GET['materia'];
    $tema = $_GET['tema'];
    
    require_once '../app/temaController.php';
    $preguntas = loadPreguntas($tema);
 ?>
 <!DOCTYPE html>
 <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php  
            echo "<title>$tema</title>";
        ?>
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
        <link rel="stylesheet" type="text/css" href="css/miscelanea.css"/>  
    </head>
    <body>
        <div class="encabezado">
            <a class="gestionarPreguntas" href="../app/logoutController.php" >
                Cerrar sesión
            </a>
        </div>
        <div>
            <?php
                echo "<h1 id='uno'>$materia</h1>";
                echo "<h3>$tema</h3>";

                if($preguntas)
                {
                    echo "<table>";
                    foreach ($preguntas as $pregunta) {
                        $titulo = $pregunta['titulo'];
                        $id = $pregunta['id'];
                        echo "<tr>";
                        echo "<td onclick='showModal($id)'>$titulo</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }else
                {
                    echo "<h4>No hay preguntas registradas</h4>";
                }
            ?>
        </div>
        <div>
            <br>
            <?php
                echo "<a href='addPregunta.php?materia=$materia&tema=$tema'>Nueva Pregunta</a>";
            ?>
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content" id="modalContent">
            </div>
        </div>
        <div id="confirmationModal" class="modal-confirmation">
            <div class="modal-confirmation-content" id="confirmationContent">
                <span class='close' onclick='hideConfirmationModal()'>&times;</span>
                <h3>¿Seguro desea eliminar esta pregunta?</h3>
                <button onclick="hideConfirmationModal()">Cancelar</button>
                <button onclick="callEliminarPregunta()">Eliminar</button>
            </div>
        </div>
        
    </body>
    <script>
        var preguntaId;
            function showModal(id)
            {
                document.getElementById("myModal").style.display = "block";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("modalContent").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "../app/detallePregunta.php?id="+id, true);
                xmlhttp.send();
            }
            function hideModal()
            {
                document.getElementById("myModal").style.display = "none";
            }
            window.onclick = function(event) 
            {
                if (event.target == document.getElementById("myModal")) {
                    document.getElementById("myModal").style.display = "none";
                }
            }
            function showConfirmationModal(id)
            {
                document.getElementById("confirmationModal").style.display = "block";
                preguntaId = id;
            }
            function hideConfirmationModal()
            {
                document.getElementById("confirmationModal").style.display = "none";
            }
            
            function callEliminarPregunta()
            {
                id=preguntaId;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        location.reload();
                        // document.getElementById("uno").innerHTML = this.responseText;                        
                        alert(this.responseText);
                    }
                };
                xmlhttp.open("GET", "../app/eliminaPregunta.php?id="+id, true);
                xmlhttp.send();

                
            }
        </script>
 </html>