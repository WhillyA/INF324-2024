<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles_log.css">
</head>
<body>
    
    <img src="banco.jpg" alt="Imagen de fondo" class="image" />
    <h1>Iniciar Sesión</h1>
    <form action="login.php" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" id="id" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
