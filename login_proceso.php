<?php
$servidor = "fdb1034.awardspace.net";
$usuario_db = "4754372_baseproyecto"; 
$password_db = "contrase123"; 
$nombre_db = "4754372_baseproyecto";

$conexion = mysqli_connect($servidor, $usuario_db, $password_db, $nombre_db);

// Recibimos el correo del formulario de login
$correo = $_POST['correo']; 

// 1. Buscamos al usuario
$sql_user = "SELECT id FROM usuarios WHERE correo = '$correo'";
$res = mysqli_query($conexion, $sql_user);
$user = mysqli_fetch_assoc($res);

if ($user) {
    $id = $user['id'];
    // 2. INSERTAMOS AUTOMÁTICAMENTE el acceso
    mysqli_query($conexion, "INSERT INTO historial_accesos (id_usuario) VALUES ('$id')");
    
    // 3. Mandamos al usuario a la página de historial
    header("Location: registroSesi.html");
} else {
    echo "Usuario no encontrado";
}
?>