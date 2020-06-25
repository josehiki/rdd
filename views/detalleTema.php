<?php 
	session_start();
	if(!isset($_SESSION['nombreUsuario']))
	{
		header("Location:login.php");
		die();
    }
    $materia = $_GET['materia'];
    $tema = $_GET['tema'];
    
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
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    </head>
    <body onload="loadPreguntas()">
        <div class="encabezado">
            <a href="dash.php" class="gestionarPreguntas float-left arrow">
				<i class='fas fa-arrow-left'></i>
			</a>
            <a class="gestionarPreguntas" href="../app/logoutController.php" >
                Cerrar sesión
            </a>
        </div>
        <div class="contenedor-div">
            <?php
                echo "<h1 id='uno' class='titulos'>$materia</h1>";
                echo "<h3>$tema</h3>";
            ?>
            <div id="listaPreguntas"></div>
        </div>
        <div class="footer">
            <br>
            <?php
                echo "<a href='addPregunta.php?materia=$materia&tema=$tema' class='gestionarPreguntas add-button'>Nueva Pregunta</a>";
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
    <?php
        echo "<script>var temaJs='$tema'</script>";
    ?>
    <script>
        var preguntaId;
            function loadPreguntas()
            {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("listaPreguntas").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "../app/temaController.php?tema="+temaJs, true);
                xmlhttp.send(); 
            }

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
                        hideConfirmationModal();
                        hideModal();
                        loadPreguntas();
                        alert(this.responseText);

                    }
                };
                xmlhttp.open("GET", "../app/eliminaPregunta.php?id="+id, true);
                xmlhttp.send();

                
            }
        </script>
        <?php 
            if (!empty($_GET['response'])) {
                if($_GET['response'] != 1)
                {
                    echo "<script type='text/javascript'>
                        alert('algo ha salido mal');
                    </script>";
                    $_GET['response'] = null;
                }else if($_GET['response'] == 1)
                {
                    echo "<script type='text/javascript'>
                        alert('Pregunta editada con éxito');
                    </script>";
                    $_GET['response'] = 2;
                }
            }
        ?>
 </html>