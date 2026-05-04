<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir conexión
include("conexion.php");

// Verificar que $conn exista
if (!isset($conn) || $conn === null) {
    die("Error: La conexión a la base de datos no se ha establecido.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $contraseña = $_POST['contraseña'];
    
    // Validar campos
    if (empty($nombre) || empty($correo) || empty($contraseña)) {
        die("Todos los campos son obligatorios");
    }
    
    // Verificar si el correo existe
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
    if (!$stmt) {
        die("Error en la consulta: " . $conn->error);
    }
    
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "El correo ya está registrado";
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();
    
    // Hashear contraseña
    $password_hash = password_hash($contraseña, PASSWORD_DEFAULT);
    
    // Insertar usuario
    $sql = $conn->prepare("INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)");
    
    if (!$sql) {
        die("Error al preparar la consulta: " . $conn->error);
    }
    
    $sql->bind_param("sss", $nombre, $correo, $password_hash);
    
    if ($sql->execute()) {
        echo "Registro exitoso. <a href='login.html'>Iniciar sesión</a>";
    } else {
        echo "Error al registrar: " . $sql->error;
    }
    
    $sql->close();
    $conn->close();
}
?>