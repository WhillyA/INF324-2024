<?php
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

// Verificar si se ha proporcionado el parámetro "id_cuenta" en la URL
if(isset($_GET['id_persona'])) {
    $id_persona = $_GET['id_persona'];
} else {
    echo "ID de cuenta bancaria no proporcionado.";
    exit;
}

// Consulta para obtener los tipos de cuenta disponibles
$sql_tipos_cuenta = "SELECT id, nombre FROM tipo_cuenta";
$result_tipos_cuenta = $conexion->query($sql_tipos_cuenta);

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Cuenta</title>
    <!-- Agrega aquí tus estilos CSS -->
  
	<link rel="stylesheet" href="styles_menu.css">
    
	<link rel="stylesheet" href="styles_agregar_perosa.css">
</head>
<body>

<?php include 'menu.php'; ?>
<h1>Crear Nueva Cuenta Bancaria</h1>

<form action="crear_cuenta.php" method="post">
    <label for="tipo_cuenta">Tipo de Cuenta:</label>
    <select name="tipo_cuenta" id="tipo_cuenta" required>
        <?php
        // Mostrar opciones de tipos de cuenta
        if ($result_tipos_cuenta->num_rows > 0) {
            while ($row = $result_tipos_cuenta->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
            }
        } else {
            echo "<option value=''>No hay tipos de cuenta disponibles</option>";
        }
        ?>
    </select>
    <br>
    <label for="saldo">Saldo:</label>
    <input type="number" name="saldo" id="saldo" min="0" step="0.01" required>
    <br>
    <br>
    <input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
    <button type="submit">Crear Nueva Cuenta</button>

</form>

</body>
</html>
