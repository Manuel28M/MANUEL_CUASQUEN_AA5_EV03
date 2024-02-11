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

// Servicio para iniciar sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["contraseña"];

        // Verificar la contraseña hash
        if (password_verify($password, $hashed_password)) {
            echo "success";
            // Aquí podrías establecer una sesión de usuario si lo necesitas
        } else {
            echo "Nombre de usuario o contraseña incorrectos";
        }
    } else {
        echo "Nombre de usuario o contraseña incorrectos";
    }
}

// Cerrar conexión
$conn->close();
?>
