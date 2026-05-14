<?php
// 1. Configuración de conexión
$host = "sql101.infinityfree.com";
$usuario = "if0_41299982";
$password = "0uG2Cwjt4R";
$base_datos = "if0_41299982_didi";

$conn = new mysqli($host, $usuario, $password, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// 2. Verificar que los datos vienen del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recibir datos 
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $pass   = $_POST['password'];

    // 3. Preparar la consulta SQL 
    
    $sql = "INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $pass);

    if ($stmt->execute()) {
        // 4. SI TODO SALIÓ BIEN, REDIRECCIONAR:
        // Cambia 'bienvenido.html' por la página a la que quieres que vaya
        header("Location: index.html");
        exit(); 
    } else {
        echo "Error al guardar: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>