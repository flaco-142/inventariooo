<?php
include("../../config/config.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=equipos.csv');

$output = fopen('php://output', 'w');

// Encabezados del CSV (ajusta según las columnas de tu tabla equipos)
fputcsv($output, ['ID', 'Nombre', 'Marca', 'Modelo', 'Fecha Registro']);

$result = mysqli_query($conn, "SELECT * FROM equipos");
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}
fclose($output);
?>
