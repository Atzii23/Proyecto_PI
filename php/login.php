<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$host = "fdb1034.awardspace.net";
$usuario = "4754372_baseproyecto";
$password_db = "contrase123"; // Cambié el nombre para no confundir con la clave del usuario
$base_datos = "4754372_baseproyecto";
$port = "3306";

$conn = new mysqli($host, $usuario, $password_db, $base_datos, $port);

if ($conn->connect_error) {
    die("Conexión falló: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña_ingresada = $_POST['contraseña'];

    // CORRECCIÓN 1: Cambiamos 'password' por 'contraseña' que es el nombre real en tu DB
    $stmt = $conn->prepare("SELECT id, nombre, contraseña FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
        
        // CORRECCIÓN 2: Usamos las variables correctas en password_verify
        // Se compara la contraseña del formulario contra el hash de la DB
        if (password_verify($contraseña_ingresada, $user_data['contraseña'])) {
            
            $_SESSION['usuario'] = $user_data['nombre']; 
            $_SESSION['usuario_id'] = $user_data['id']; 
            
            // Redirección exitosa
            header('Location: /index.html');
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado.'); window.history.back();</script>";
    }
    $stmt->close();
}
$conn->close();
?>