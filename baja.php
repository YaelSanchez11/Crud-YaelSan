<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['baja'])) {
    $baja_id = isset($_POST['baja_id']) ? $_POST['baja_id'] : '';

    $sql = "DELETE FROM persona WHERE id = $baja_id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
}

$conn->close();
?>
