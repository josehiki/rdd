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
        <title>Equipos</title>
		<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
    </head>
    <body>
        <div class="encabezado">
			<a class="gestionarPreguntas" href="../app/logoutController.php" >
				Cerrar sesión
			</a>
		</div>
        <div>
            <?php
                echo "<h3>$tema</h3>";
            ?>
            <h1>¡¡Genial!!</h1>
            <p>Ahora vamos a crear los equipos. (Estos pueden ser de hasta cuatro integrantes)</p>
            <div>
                <h2>Equipo Rojo</h2>
                <div id="equipoRojo">
                    <input type="text" id="r1" placeholder="Nombre del integrante">
                    <input type="text" id="r2" placeholder="Nombre del integrante">
                </div>
                <button onclick="agregarIntegranteRojo()">Agrear integrante</button>
            </div>
            <div>
                <h2>Equipo Azul</h2>
                <div id="equipoAzul">
                    <input type="text" id="a1" placeholder="Nombre del integrante">
                    <input type="text" id="a2" placeholder="Nombre del integrante">
                </div>
                <button onclick="agregarIntegranteAzul()">Agrear integrante</button>
            </div>
            <div>
                <br>
                <button onclick="iniciarJuego()">Comenzar</button>
            </div>
        </div>
    </body>
    <?php
        echo "<script>var temaJs='$tema'</script>";
    ?>
    <script>
        var equipoRojo = 2;
        var equipoAzul = 2;

        function agregarIntegranteRojo()
        {
            if(equipoRojo < 4){
                equipoRojo++;
                var nuevo = document.createElement("INPUT"); 
                nuevo.type = "text";   
                nuevo.id = "r"+equipoRojo;           
                nuevo.placeholder = "Nombre del integrante"; 
                document.getElementById("equipoRojo").appendChild(nuevo);
            }else
            {
                alert('Solo puede agregar un máximo de cuatro integrantes');
            }
        } //agregarIntegrante
        function agregarIntegranteAzul()
        {
            if(equipoAzul < 4){
                equipoAzul++;
                var nuevo = document.createElement("INPUT");   
                nuevo.type = "text";    
                nuevo.id = "a"+equipoAzul;             
                nuevo.placeholder = "Nombre del integrante";
                document.getElementById("equipoAzul").appendChild(nuevo);                
            }else
            {
                alert('Solo puede agregar un máximo de cuatro integrantes');
            }
        } //agregarIntegrante
        function iniciarJuego(){
            var r1 = document.getElementById("r1");
            var a1 = document.getElementById("a1");
            var rojo = new Array();
            var azul = new Array();
            if(r1.value.trim() != "" && a1.value.trim() != "")
            {
                for (var i = 0; i < 4; i++) 
                {
                    var aux = document.getElementById("r"+(i+1));
                    if(aux && aux.value.trim() != ""){
                        
                        rojo[i] = aux.value;
                    }
                    aux = document.getElementById("a"+(i+1));
                    if(aux && aux.value.trim() != ""){
                        
                        azul[i] = aux.value;
                    }                    
                }
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.replace("juego.php?tema="+temaJs);
                }
                };
                xmlhttp.open("GET", "../app/crearEquipos.php?rojo="+ JSON.stringify(rojo)+"&azul="+JSON.stringify(azul), true);
                xmlhttp.send();

            }else
            {
                alert('Cada equipo debe tener al menos un integrante');
            }
            
        }
    </script>
</html>