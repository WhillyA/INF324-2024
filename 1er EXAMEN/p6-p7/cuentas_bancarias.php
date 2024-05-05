<?php
include 'conexion.php';
?>


<?php
// Consulta SQL para obtener los datos de las cuentas bancarias y de las personas propietarias
$sql = "SELECT cb.id, tc.nombre AS tipo, cb.saldo, p.nombres, p.ap_pat, p.ap_mat 
        FROM cuentabancaria cb
        INNER JOIN persona p ON cb.id_persona = p.id
        INNER JOIN tipo_cuenta tc ON cb.id_tipo_cuenta = tc.id";

$resultado = $conexion->query($sql);

if ($resultado) {
    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        // Mostrar los datos de las cuentas bancarias y de las personas propietarias en una tabla
        echo '<table>';
        echo '<tr><th>ID</th><th>Tipo de cuenta</th><th>Saldo</th><th>Propietario</th></tr>';
        while ($fila = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $fila["id"] . '</td>';
            echo '<td>' . $fila["tipo"] . '</td>';
            echo '<td>$' . number_format($fila["saldo"], 2) . '</td>';
            echo '<td>' . $fila["nombres"] . ' ' . $fila["ap_pat"] . ' ' . $fila["ap_mat"] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "No se encontraron cuentas bancarias.";
    }
} else {
    // Si hubo un error en la ejecución de la consulta
    echo "Error en la consulta: " . $conexion->error;
}

$conexion->close();
?>

