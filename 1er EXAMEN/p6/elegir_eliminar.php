<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Persona</title>
	<link rel="stylesheet" href="styles_elegir_eliminar2.css">
	<link rel="stylesheet" href="styles_menu.css">
</head>
<body>
<?php include 'menu.php'; ?>

    <h1>Buscar Persona para Eliminar</h1>
    <form action="verficar_eliminar.php" method="GET">
        <label for="ci">Carnet de Identidad:</label>
        <input type="text" id="ci" name="ci" required>
        <br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required>
        <br>
        <button type="submit">Buscar y Eliminar</button>
    </form>
</body>
</html>
