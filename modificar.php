<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar'])) {
    $modificar_id = isset($_POST['modificar_id']) ? $_POST['modificar_id'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellidoPaterno = isset($_POST['apellidop']) ? $_POST['apellidop'] : '';
    $apellidoMaterno = isset($_POST['apellidom']) ? $_POST['apellidom'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';

    $sql = "UPDATE persona SET nombre='$nombre', apellidop='$apellidoPaterno', apellidom='$apellidoMaterno', telefono='$telefono' WHERE id = $modificar_id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro modificado correctamente.";
    } else {
        echo "Error al modificar el registro: " . $conn->error;
    }
}

$conn->close();
?>
