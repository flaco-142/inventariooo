<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../public/login.php");
    exit;
}

include("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];

    $sql = "INSERT INTO equipos (nombre, marca, modelo) 
            VALUES ('$nombre','$marca','$modelo')";

    mysqli_query($conn, $sql);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registrar Equipo</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-4">

<h3>Registrar Equipo de Cómputo</h3>

<form method="POST">

<div class="mb-3">
<label>Nombre del Equipo</label>
<input type="text" name="nombre" class="form-control" required>
</div>

<div class="mb-3">
<label>Marca</label>
<input type="text" name="marca" class="form-control" required>
</div>

<div class="mb-3">
<label>Modelo</label>
<input type="text" name="modelo" class="form-control" required>
</div>

<button class="btn btn-success">Guardar</button>
<a href="index.php" class="btn btn-secondary">Regresar</a>

</form>

</div>
</body>
</html>