<?php

// Conexión a la base de datos
include 'conexion.php';
include_once 'includes/functions.php';
session_start();


// Consulta para obtener a todos los usuarios
$query = "SELECT id, nombres, ap_pat, ap_mat, id_rol_usuario FROM persona";
$result = $conexion->query($query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listar Usuarios</title>
</head>
<body>
<?php
 include 'head.php';?>
    <h1>Lista de Usuarios</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Rol</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar a los usuarios en la tabla
            while ($usuario = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$usuario['id']}</td>";
                echo "<td>{$usuario['nombres']}</td>";
                echo "<td>{$usuario['ap_pat']}</td>";
                echo "<td>{$usuario['ap_mat']}</td>";
                echo "<td>{$usuario['id_rol_usuario']}</td>";
                echo "<td><a href='modificar_usuario.php?id={$usuario['id']}'>Modificar</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
