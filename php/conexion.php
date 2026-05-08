<?php
$host = "fdb1034.awardspace.net";
$usuario = "4754372_baseproyecto";
$password = "contrase123";
$base_datos = "4754372_baseproyecto";
$port = "3306";


$conn = new mysqli($host, $usuario, $password, $base_datos, $port);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

echo "Conexión a la base de datos";
?>