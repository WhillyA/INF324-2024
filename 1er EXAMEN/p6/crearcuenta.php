<?php include 'conexion.php';        
        include_once 'includes/functions.php'; 
        session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Cuenta</title>
	<link rel="stylesheet" href="styles_agregar_perosa.css">
	<link rel="stylesheet" href="styles_menu.css">
    <link rel="stylesheet" href="styles_head.css">
</head>
<body>
<?php include 'head.php'; ?>

    <h1>nueva cuenta bancaria</h1>
    <form action="agregar_persona.php" method="post">
        <label for="nombres">Nombres:</label>
        <input type="text" id="nombres" name="nombres" required><br><br>
        
        <label for="ap_pat">Apellido Paterno:</label>
        <input type="text" id="ap_pat" name="ap_pat" required><br><br>
        
        <label for="ap_mat">Apellido Materno:</label>
        <input type="text" id="ap_mat" name="ap_mat" required><br><br>
        
        <label for="fecha_nac">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nac" name="fecha_nac" required><br><br>
        
        <label for="ci">CI:</label>
        <input type="text" id="ci" name="ci" required><br><br>
        
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required><br><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="tipo_cuenta">Tipo de Cuenta:</label>
        <select id="tipo_cuenta" name="tipo_cuenta">
            <option value="1">Cuenta de ahorros</option>
            <option value="2">Cuenta corriente</option>
            <option value="3">Cuenta de inversión</option>
        </select><br><br>
        <label for="departamento">Departamento:</label>
        <select id="departamento" name="departamento">
            <option value="la paz">La Paz</option>
            <option value="cochabamba">Cochabamba</option>
            <option value="santa cruz">Santa Cruz</option>
            <option value="oruro">Oruro</option>
            <option value="potosí">Potosí</option>
            <option value="tarija">Tarija</option>
            <option value="chuquisaca">Chuquisaca</option>
            <option value="beni">Beni</option>
            <option value="pando">Pando</option>
        </select><br><br>     
        <label for="saldo">Saldo:</label>
        <input type="number" id="saldo" name="saldo" step="0.01" min="0" placeholder="Ingrese el saldo" required>
        <br><br> 
        <input type="submit" value="Agregar Persona y Cuenta Bancaria">
    </form>
</body>
</html>
