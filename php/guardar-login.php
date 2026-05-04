<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);


    $sql_check = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "<script>alert('El correo electrónico ya está registrado.'); window.location='/choco.html';</script>";
    } else {
        $sql = "INSERT INTO usuarios (nombre, correo, contraseña) 
                VALUES ('$nombre', '$correo', '$contraseña')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Usuario registrado correctamente'); window.location='/choco.html';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>