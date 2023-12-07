<?php
$servername = "localhost";
$username = "root";  // Reemplaza con tu nombre de usuario de MySQL
$password = "";  // Reemplaza con tu contraseña de MySQL
$dbname = "registro";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
