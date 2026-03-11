<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../../public/login.php");
    exit;
}

include("../../config/config.php");

$id = $_GET['id'];

$sql = "DELETE FROM equipos WHERE id='$id'";
mysqli_query($conn,$sql);

header("Location:index.php");

?>