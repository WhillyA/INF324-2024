
<?php
include 'conexion.php';

if(isset($_GET['id_cuenta'], $_GET['id_persona'])) {
    $id_cuenta = $_GET['id_cuenta'];
    $id_persona = $_GET['id_persona'];

    // Consulta para eliminar la cuenta bancaria
    $sql_eliminar_cuenta = "DELETE FROM cuentabancaria WHERE id = ?";
    $stmt_eliminar_cuenta = $conexion->prepare($sql_eliminar_cuenta);

    if ($stmt_eliminar_cuenta) {
        $stmt_eliminar_cuenta->bind_param("i", $id_cuenta);
        if($stmt_eliminar_cuenta->execute()) {
            // Redirigir a la página de administrar cuentas
            header("Location: administrar_cuentas.php?id={$id_persona}");
            exit;
        } else {
            echo "Error al eliminar la cuenta.";
        }
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }
} else {
    echo "ID de cuenta bancaria o ID de persona no proporcionado.";
    exit;
}
?>
