<?php
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

// Verificar si se ha proporcionado el parámetro "id_persona" en la URL
if(isset($_GET['id'])) {
    $id_persona = $_GET['id'];

    // Consulta para obtener las cuentas bancarias de la persona
    $sql_cuentas = "SELECT cb.id, c.nombre AS nombre_cuenta, cb.saldo, cb.fecha_creacion 
                    FROM cuentabancaria cb 
                    INNER JOIN tipo_cuenta c ON cb.id_tipo_cuenta = c.id 
                    WHERE cb.id_persona = ?";
    $stmt_cuentas = $conexion->prepare($sql_cuentas);

    if ($stmt_cuentas) {
        $stmt_cuentas->bind_param("i", $id_persona);
        $stmt_cuentas->execute();
        $result_cuentas = $stmt_cuentas->get_result();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }
} else {
    echo "ID de persona no proporcionado.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cuentas Bancarias</title>
    <!-- Agrega aquí tus estilos CSS -->
    <link rel="stylesheet" href="styles_menu.css">
    <link rel="stylesheet" href="styles_administrar_cuentas.css">
</head>
<body>
<?php include 'menu.php'; ?>
<h1>Cuentas Bancarias</h1>

<?php
// Verificar si se obtuvieron resultados de la consulta
if (isset($result_cuentas) && $result_cuentas->num_rows > 0) {
    // Mostrar tabla de cuentas bancarias
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre de Cuenta</th><th>Saldo</th><th>Fecha de Creación</th><th>Acciones</th></tr>";
    while ($row = $result_cuentas->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombre_cuenta"] . "</td>";
        echo "<td>" . $row["saldo"] . "</td>";
        echo "<td>" . $row["fecha_creacion"] . "</td>";
        echo "<td class='acciones'>";
        echo "<a href='eliminar_cuenta.php?id_cuenta=" . $row["id"] . "&id_persona=" . $id_persona . "' class='accion'>Eliminar</a>";

        echo "<a href='modificar_cuenta.php?id_cuenta=" . $row["id"] . "' class='accion'>Modificar</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "La persona no tiene cuentas bancarias.";
}
?>

<a href="crear_nueva_cuenta.php?id_persona=<?php echo $id_persona; ?>" class="accion">Nueva Cuenta</a>

</body>
</html>

<?php
// Cerrar la conexión y liberar recursos
if (isset($stmt_cuentas)) {
    $stmt_cuentas->close();
}
$conexion->close();
?>
