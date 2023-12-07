<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['alta'])) {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellidoPaterno = isset($_POST['apellidop']) ? $_POST['apellidop'] : '';
    $apellidoMaterno = isset($_POST['apellidom']) ? $_POST['apellidom'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';

    $sql = "INSERT INTO persona (nombre, apellidop, apellidom, telefono) VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', '$telefono')";
    
    if ($conn->query($sql) === TRUE) {
        // No es necesario imprimir mensajes aquí, se manejará en el index.php
    } else {
        echo "Error al crear el registro: " . $conn->error;
    }
}

$conn->close();
?>
