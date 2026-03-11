<?php
$host = "localhost";
$user = "root";          // usuario de MySQL
$password = "";          // contraseña de MySQL (vacía en XAMPP por defecto)
$database = "inventariooo";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
