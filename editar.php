<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../public/login.php");
    exit;
}

include("../../config/config.php");

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM equipos WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if($_SERVER["REQUEST_METHOD"]=="POST"){

$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];

$sql="UPDATE equipos 
SET nombre='$nombre', marca='$marca', modelo='$modelo'
WHERE id='$id'";

mysqli_query($conn,$sql);

header("Location:index.php");

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Equipo</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-4">

<h3>Editar Equipo</h3>

<form method="POST">

<div class="mb-3">
<label>Nombre</label>
<input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre']; ?>">
</div>

<div class="mb-3">
<label>Marca</label>
<input type="text" name="marca" class="form-control" value="<?php echo $row['marca']; ?>">
</div>

<div class="mb-3">
<label>Modelo</label>
<input type="text" name="modelo" class="form-control" value="<?php echo $row['modelo']; ?>">
</div>

<button class="btn btn-primary">Actualizar</button>
<a href="index.php" class="btn btn-secondary">Regresar</a>

</form>

</div>

</body>
</html>