<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
include("../config/config.php");

// Consultas para contar registros
$sql_bienes = "SELECT COUNT(*) AS total_bienes FROM bienes";
$sql_equipos = "SELECT COUNT(*) AS total_equipos FROM equipos";
$sql_almacen = "SELECT COUNT(*) AS total_almacen, SUM(cantidad) AS stock_total FROM almacen";

$res_bienes = mysqli_query($conn, $sql_bienes);
$res_equipos = mysqli_query($conn, $sql_equipos);
$res_almacen = mysqli_query($conn, $sql_almacen);

$total_bienes = mysqli_fetch_assoc($res_bienes)['total_bienes'];
$total_equipos = mysqli_fetch_assoc($res_equipos)['total_equipos'];
$row_almacen = mysqli_fetch_assoc($res_almacen);
$total_almacen = $row_almacen['total_almacen'];
$stock_total = $row_almacen['stock_total'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Control</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .card-custom { border: 1px solid #ddd; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .card-strip { height: 6px; }
    .strip-bienes { background-color: #0d6efd; }   /* azul */
    .strip-equipos { background-color: #198754; }  /* verde */
    .strip-almacen { background-color: #ffc107; }  /* amarillo */
    .btn-vino { background-color: #7B1F1F; color: #fff; }
    .btn-vino:hover { background-color: #5a1414; color: #fff; }
    .card-body h5 { font-weight: normal; font-size: 1rem; }
    .card-body strong { font-size: 1.1rem; }
    footer { background-color:#f8f9fa; text-align:center; padding:15px; margin-top:30px; border-top:1px solid #ddd; }
  </style>
</head>
<body>
<!-- Barra de navegación superior -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#7B1F1F;">
  <div class="container-fluid">
    <ul class="navbar-nav me-auto">
      <li class="nav-item"><a class="nav-link text-white" href="inicio.php"><i class="fas fa-home"></i> Inicio</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="../modules/bienes/index.php"><i class="fas fa-building"></i> Bienes Inmuebles</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="../modules/equipos/index.php"><i class="fas fa-laptop"></i> Equipos de Cómputo</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="../modules/almacen/index.php"><i class="fas fa-cube"></i> Almacén</a></li>
    </ul>
    <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Buscar por inventario o artículo..." aria-label="Buscar">
    </form>
    <a href="logout.php" class="btn btn-dark ms-3">Cerrar Sesión</a>
  </div>
</nav>

<div class="container mt-4">
  <h2><strong>Panel de Control</strong></h2>
  <p class="text-muted">Resumen del sistema de inventarios</p>

  <div class="row mt-4">
    <!-- Tarjeta Bienes -->
    <div class="col-md-4">
      <div class="card card-custom text-center">
        <div class="card-strip strip-bienes"></div>
        <div class="card-body">
          <strong><i class="fas fa-building me-2"></i> Bienes Inmuebles</strong>
          <h5><?php echo $total_bienes; ?> registros totales</h5>
          <a href="../modules/bienes/index.php" class="btn btn-vino">Ver Registros</a>
        </div>
      </div>
    </div>

    <!-- Tarjeta Equipos -->
    <div class="col-md-4">
      <div class="card card-custom text-center">
        <div class="card-strip strip-equipos"></div>
        <div class="card-body">
          <strong><i class="fas fa-laptop me-2"></i> Equipos de Cómputo</strong>
          <h5><?php echo $total_equipos; ?> equipos registrados</h5>
          <a href="../modules/equipos/index.php" class="btn btn-vino">Ver Equipos</a>
        </div>
      </div>
    </div>

    <!-- Tarjeta Almacén -->
    <div class="col-md-4">
      <div class="card card-custom text-center">
        <div class="card-strip strip-almacen"></div>
        <div class="card-body">
          <strong><i class="fas fa-cube me-2"></i> Almacén</strong>
          <h5><?php echo $total_almacen; ?> artículos distintos (<?php echo $stock_total; ?> en stock)</h5>
          <a href="../modules/almacen/index.php" class="btn btn-vino">Ver Almacén</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Sección de exportación -->
  <div class="card mt-5">
    <div class="card-header bg-light">
      <h4>Exportación de Datos</h4>
    </div>
    <div class="card-body">
      <p>Descarga los registros completos en formato CSV para análisis o respaldo.</p>
      <a href="../modules/bienes/export.php" class="btn btn-outline-dark">Exportar Inmuebles</a>
      <a href="../modules/equipos/export.php" class="btn btn-outline-dark">Exportar Cómputo</a>
      <a href="../modules/almacen/export.php" class="btn btn-outline-dark">Exportar Almacén</a>
    </div>
  </div>
</div>

<!-- Footer institucional -->
<footer>
  © 2026 H. Ayuntamiento de Valle de Chalco Solidaridad.<br>
  "Gobernemos con el Corazón"<br>
  Todos los derechos reservados. Sistema de Gestión de Inventarios.
</footer>
<!-- CHATBOT IA -->
<div id="chatbot">
  <div id="chat-header">Asistente IA</div>

  <div id="chat-messages"></div>

  <div id="chat-input">
    <input type="text" id="userInput" placeholder="Escribe tu pregunta...">
    <button onclick="sendMessage()">Enviar</button>
  </div>
</div>

<button id="chat-toggle" onclick="toggleChat()">
<i class="fas fa-robot"></i>
</button>

<style>

#chat-toggle{
position:fixed;
bottom:20px;
right:20px;
background:#7B1F1F;
color:white;
border:none;
padding:15px;
border-radius:50%;
font-size:20px;
cursor:pointer;
}

#chatbot{
display:none;
position:fixed;
bottom:80px;
right:20px;
width:320px;
background:white;
border:1px solid #ccc;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.2);
}

#chat-header{
background:#7B1F1F;
color:white;
padding:10px;
font-weight:bold;
border-radius:10px 10px 0 0;
}

#chat-messages{
height:220px;
overflow-y:auto;
padding:10px;
font-size:14px;
}

#chat-input{
display:flex;
border-top:1px solid #ccc;
}

#chat-input input{
flex:1;
border:none;
padding:10px;
}

#chat-input button{
background:#7B1F1F;
color:white;
border:none;
padding:10px;
}

</style>

<script>

function toggleChat(){

let chat = document.getElementById("chatbot");

if(chat.style.display === "block"){
chat.style.display = "none";
}else{
chat.style.display = "block";
}

}

function sendMessage(){

let input = document.getElementById("userInput");
let mensaje = input.value.trim();

if(mensaje == "") return;

let chat = document.getElementById("chat-messages");

/* mensaje usuario */

chat.innerHTML += `
<div style="text-align:right;margin-bottom:8px;">
<span style="background:#7B1F1F;color:white;padding:6px 10px;border-radius:8px;display:inline-block;">
${mensaje}
</span>
</div>
`;

fetch("../chatbot/chatbot.php",{

method:"POST",

headers:{
'Content-Type':'application/x-www-form-urlencoded'
},

body:"mensaje="+encodeURIComponent(mensaje)

})

.then(res=>res.text())

.then(data=>{

/* respuesta bot con HTML permitido */

chat.innerHTML += `
<div style="text-align:left;margin-bottom:10px;">
<span style="background:#f1f1f1;padding:8px;border-radius:8px;display:inline-block;">
${data}
</span>
</div>
`;

chat.scrollTop = chat.scrollHeight;

});

input.value="";

}

/* permitir enviar con ENTER */

window.onload = function(){

document.getElementById("userInput")
.addEventListener("keypress", function(e){

if(e.key === "Enter"){
sendMessage();
}

});

};


</script>

</body>
</html>
