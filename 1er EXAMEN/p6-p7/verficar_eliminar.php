<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Eliminado Persona y Cuenta Bancaria</title>
    <link rel="stylesheet" href="styles_menu.css">
    <link rel="stylesheet" href="styles_verificar_eliminar2.css">
</head>
<body>
<?php
include 'conexion.php';
include 'menu.php';
// Verificar si se han proporcionado los parámetros "ci" y "apellidos" en la URL
if(isset($_GET['ci']) && isset($_GET['apellidos'])) {
    $ci = $_GET['ci'];
    $apellidos = $_GET['apellidos'];

    // Consulta para obtener las personas con el carnet de identidad y apellidos dados
    $sql = "SELECT id, nombres, ap_pat FROM persona WHERE ci = ? AND ap_pat = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $ci, $apellidos);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h1>Coincidencias</h1>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nombres</th><th>Apellidos</th><th>Acción</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombres"] . "</td>";
                echo "<td>" . $row["ap_pat"] . "</td>";
                echo "<td><a href='eliminar_persona.php?id=" . $row["id"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar a esta persona y todas sus cuentas?\")' class='accion'>Eliminar</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron personas con el carnet de identidad y apellidos ingresados.</p>";
        }
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "<p>Debe proporcionar el carnet de identidad y los apellidos.</p>";
}
?>
</body>
</html>
