<?php
error_reporting(0); // Para que los errores no rompan el JSON
header('Content-Type: application/json');

$servidor = "fdb1034.awardspace.net";
$usuario_db = "4754372_baseproyecto"; 
$password_db = "contrase123"; 
$nombre_db = "4754372_baseproyecto";

$conexion = mysqli_connect($servidor, $usuario_db, $password_db, $nombre_db);

if (!$conexion) {
    die(json_encode([]));
}


$sql = "SELECT u.nombre, u.correo, h.fecha_entrada 
        FROM usuarios u
        INNER JOIN historial_accesos h ON u.id = h.id_usuario
        ORDER BY h.fecha_entrada DESC";

$resultado = mysqli_query($conexion, $sql);
$logs = [];

while ($fila = mysqli_fetch_assoc($resultado)) {
    $logs[] = $fila;
}

echo json_encode($logs);
mysqli_close($conexion);