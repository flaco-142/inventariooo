<?php
session_start();
include("../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM usuarios WHERE correo = ?");
    mysqli_stmt_bind_param($stmt, "s", $correo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($clave, $row['clave'])) {
        $_SESSION['usuario'] = $correo;
        header("Location: inicio.php");
        exit;
    } else {
        echo "<div style='color:red; text-align:center; margin-top:20px;'>Correo o contraseña incorrectos</div>";
        echo "<div style='text-align:center;'><a href='login.php'>Volver al login</a></div>";
    }
}
?>
