<?php
session_start(); // Para manejo de sesiones
include 'conexion.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$user_id = $_POST['id'];
$password = $_POST['password'];

// Usa la variable correcta para la conexión
$query = "SELECT * FROM persona WHERE id = ? LIMIT 1";
$stmt = $conexion->prepare($query); // Cambio aquí
$stmt->bind_param("i", $user_id); // Asignar el parámetro `id`
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verificar la contraseña cifrada
    if (password_verify($password, $user['password_hash'])) {
        // Contraseña correcta, establecer sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['id_rol_usuario']; // Guardar el rol del usuario en la sesión
        header("Location: intro.php");               
    } else {
        // Contraseña incorrecta
        $error = "Contraseña incorrecta.";
    }
} else {
    // Usuario no encontrado
    $error = "Usuario no encontrado.";
}

$stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Error de Inicio de Sesión</title>
</head>
<body>
<h1>Error</h1>
<p><?php if (isset($error)) echo $error; ?></p>
<a href="index.php">Intentar nuevamente</a>
</body>
</html>
