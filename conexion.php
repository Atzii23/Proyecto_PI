<?php
$host = "sql101.infinityfree.com";
$usuario = "if0_41299982";
$password = "0uG2Cwjt4R";
$base_datos = "if0_41299982_didi";

$conn = new mysqli($host, $usuario, $password, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

echo "Conexión a la base de datos";
?>