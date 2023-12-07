<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD PHP</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: #3498db;
        }

        h3 {
            color: #2ecc71;
        }

        form {
            display: inline-block;
            text-align: left;
            margin: 20px;
        }

        input {
            margin: 5px 0;
        }

        button {
            background-color: #27ae60;
            color: #fff;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #3498db;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        a {
            color: #e74c3c;
            text-decoration: none;
            margin-right: 10px;
        }

        p {
            color: #555;
        }
    </style>
</head>
<body>

    <h2>Consultorio Dental</h2>
        <a href="dentista.php">Pagina Principal</a>
    <!-- Formulario para Alta -->
    <h3>Alta</h3>
    <form method="post" action="index.php">
        Nombre: <input type="text" name="nombre" required><br>
        Apellido Paterno: <input type="text" name="apellidop" required><br>
        Apellido Materno: <input type="text" name="apellidom" required><br>
        Teléfono: <input type="text" name="telefono" required><br>
        <input type="submit" name="alta" value="Agregar">
    </form>

    <?php
    // Manejo de la acción de agregar en el mismo archivo
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['alta'])) {
        include 'alta.php'; // Incluye la lógica para agregar
    }
    ?>

    <!-- Muestra la tabla actualizada -->
    <?php
    include 'conexion.php';

    // Manejo de la acción de editar en el mismo archivo
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['editar'])) {
        $editar_id = $_GET['editar'];
        $result = $conn->query("SELECT * FROM persona WHERE id = $editar_id");
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo "<h3>Editar Registro</h3>";
            echo "<form method='post' action='index.php'>";
            echo "Nombre: <input type='text' name='nombre' value='{$row['nombre']}' required><br>";
            echo "Apellido Paterno: <input type='text' name='apellidop' value='{$row['apellidop']}' required><br>";
            echo "Apellido Materno: <input type='text' name='apellidom' value='{$row['apellidom']}' required><br>";
            echo "Teléfono: <input type='text' name='telefono' value='{$row['telefono']}' required><br>";
            echo "<input type='hidden' name='editar_id' value='$editar_id'>";
            echo "<input type='submit' name='editar' value='Guardar Cambios'>";
            echo "</form>";
        }
    }

    // Manejo de la acción de editar en el mismo archivo
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
        $editar_id = $_POST['editar_id'];
        $nombre = $_POST['nombre'];
        $apellidop = $_POST['apellidop'];
        $apellidom = $_POST['apellidom'];
        $telefono = $_POST['telefono'];

        $sql = "UPDATE persona SET nombre='$nombre', apellidop='$apellidop', apellidom='$apellidom', telefono='$telefono' WHERE id = $editar_id";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Registro modificado correctamente.</p>";
        } else {
            echo "<p>Error al modificar el registro: " . $conn->error . "</p>";
        }
    }

    // Manejo de la acción de eliminar en el mismo archivo
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['eliminar'])) {
        $eliminar_id = $_GET['eliminar'];
        $sql = "DELETE FROM persona WHERE id = $eliminar_id";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Registro eliminado correctamente.</p>";
        } else {
            echo "<p>Error al eliminar el registro: " . $conn->error . "</p>";
        }
    }

    // Muestra la tabla actualizada
    $result = $conn->query("SELECT * FROM persona");

    if ($result->num_rows > 0) {
        echo "<h3>Citas Del Dia De Hoy</h3>";
        echo "<table border='1'><tr><th>ID</th><th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Teléfono</th><th>Acciones</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['nombre']}</td>";
            echo "<td>{$row['apellidop']}</td>";
            echo "<td>{$row['apellidom']}</td>";
            echo "<td>{$row['telefono']}</td>";
            echo "<td><a href='index.php?editar={$row['id']}'>Editar</a> | <a href='index.php?eliminar={$row['id']}'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay registros.</p>";
    }

    $conn->close();
    ?>

</body>
</html>