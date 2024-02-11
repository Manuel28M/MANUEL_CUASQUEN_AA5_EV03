<?php
// Conexión a la base de datos
$servername = "127.0.0.1";
$db_username = "root";
$db_password = "12345678";
$database = "login";
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Servicio para registrar un nuevo usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validación de datos, por ejemplo, longitud mínima de contraseña, etc.

    // Hash de la contraseña antes de guardarla en la base de datos
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (usuario, contraseña) VALUES ('$username', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado exitosamente";
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
