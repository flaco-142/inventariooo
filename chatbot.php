<?php
include("../config/config.php");

$mensaje = strtolower(trim($_POST['mensaje']));

function tablaEquipos($conn){
    $sql = "SELECT id,nombre,marca,modelo,fecha_registro FROM equipos LIMIT 10";
    $res = mysqli_query($conn,$sql);

    $html = "<table border='1' style='width:100%;font-size:13px'>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Fecha</th>
    </tr>";

    while($row = mysqli_fetch_assoc($res)){
        $html .= "<tr>
            <td>".$row['id']."</td>
            <td>".$row['nombre']."</td>
            <td>".$row['marca']."</td>
            <td>".$row['modelo']."</td>
            <td>".$row['fecha_registro']."</td>
        </tr>";
    }

    $html .= "</table>";

    return $html;
}

function tablaBienes($conn){
    $sql = "SELECT id,nombre,descripcion,fecha_registro FROM bienes LIMIT 10";
    $res = mysqli_query($conn,$sql);

    $html = "<table border='1' style='width:100%;font-size:13px'>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Fecha</th>
    </tr>";

    while($row = mysqli_fetch_assoc($res)){
        $html .= "<tr>
            <td>".$row['id']."</td>
            <td>".$row['nombre']."</td>
            <td>".$row['descripcion']."</td>
            <td>".$row['fecha_registro']."</td>
        </tr>";
    }

    $html .= "</table>";

    return $html;
}

/* SALUDO */

if(strpos($mensaje,"hola")!==false){

echo "Hola 👋 soy el asistente inteligente del sistema de inventarios.<br><br>
Puedes preguntarme por:<br>
• equipos<br>
• bienes<br>
• almacén<br>
• stock<br>
• búsquedas<br><br>
Escribe <b>ayuda</b> para ver ejemplos.";

}

/* AYUDA */

elseif(strpos($mensaje,"ayuda")!==false){

echo "Ejemplos de preguntas:<br><br>

• cuantos equipos hay<br>
• mostrar equipos<br>
• tabla equipos<br>
• cuantos bienes hay<br>
• mostrar bienes<br>
• artículos en almacén<br>
• stock total<br>
• buscar mouse<br>
• buscar laptop";

}

/* CONTAR EQUIPOS */

elseif(strpos($mensaje,"cuantos equipos")!==false){

$r = mysqli_query($conn,"SELECT COUNT(*) total FROM equipos");
$d = mysqli_fetch_assoc($r);

echo "Hay ".$d['total']." equipos de cómputo registrados.";

}

/* MOSTRAR TABLA EQUIPOS */

elseif(strpos($mensaje,"tabla equipos")!==false || strpos($mensaje,"mostrar equipos")!==false){

echo "<b>Lista de equipos registrados:</b><br><br>";
echo tablaEquipos($conn);

}

/* CONTAR BIENES */

elseif(strpos($mensaje,"cuantos bienes")!==false){

$r = mysqli_query($conn,"SELECT COUNT(*) total FROM bienes");
$d = mysqli_fetch_assoc($r);

echo "Hay ".$d['total']." bienes inmuebles registrados.";

}

/* MOSTRAR TABLA BIENES */

elseif(strpos($mensaje,"tabla bienes")!==false || strpos($mensaje,"mostrar bienes")!==false){

echo "<b>Lista de bienes registrados:</b><br><br>";
echo tablaBienes($conn);

}

/* ALMACEN */

elseif(strpos($mensaje,"almacen")!==false || strpos($mensaje,"almacén")!==false){

$r = mysqli_query($conn,"SELECT COUNT(*) total FROM almacen");
$d = mysqli_fetch_assoc($r);

echo "El almacén tiene ".$d['total']." tipos de artículos registrados.";

}

/* STOCK */

elseif(strpos($mensaje,"stock")!==false){

$r = mysqli_query($conn,"SELECT SUM(cantidad) total FROM almacen");
$d = mysqli_fetch_assoc($r);

echo "El stock total en almacén es de ".$d['total']." unidades.";

}

/* BUSQUEDA */

elseif(strpos($mensaje,"buscar")!==false){

$palabra = trim(str_replace("buscar","",$mensaje));

$sql = "SELECT nombre,cantidad FROM almacen WHERE nombre LIKE '%$palabra%' LIMIT 10";
$res = mysqli_query($conn,$sql);

if(mysqli_num_rows($res)>0){

$html = "<b>Resultados encontrados:</b><br><br>";
$html .= "<table border='1' style='width:100%;font-size:13px'>
<tr><th>Artículo</th><th>Cantidad</th></tr>";

while($row=mysqli_fetch_assoc($res)){
$html .= "<tr>
<td>".$row['nombre']."</td>
<td>".$row['cantidad']."</td>
</tr>";
}

$html .= "</table>";

echo $html;

}else{

echo "No se encontraron resultados para <b>".$palabra."</b>";

}

}

/* RESPUESTA GENERAL */

else{

echo "No entendí la pregunta 🤔.<br>
Escribe <b>ayuda</b> para ver ejemplos.";

}

?>