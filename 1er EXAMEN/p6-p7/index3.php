<?php
// Iniciar sesión
session_start();

// Incluir la conexión a la base de datos y la función para verificar permisos
include 'conexion.php';
include 'includes/functions.php';
// Archivo que contiene la función `usuario_tiene_permiso`

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario']; // Obtener la ID del usuario del formulario
    $permisos = usuario_tiene_permiso($id_usuario); // Obtener todos los permisos del usuario

    // Mostrar los permisos del usuario
    if (count($permisos) > 0) {
        echo "<h2>Permisos para el usuario con ID: $id_usuario</h2>";
        echo "<ul>";
        foreach ($permisos as $permiso) {
            echo "<li>$permiso</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>El usuario con ID: $id_usuario no tiene permisos o no existe.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Permisos del Usuario</title>
</head>
<body>
    <h1>Verificar Permisos del Usuario</h1>
    <form method="POST" action="">
        <label for="id_usuario">ID del Usuario:</label>
        <input type="text" name="id_usuario" id="id_usuario" required>
        <button type="submit">Ver Permisos</button>
    </form>
</body>
</html>
