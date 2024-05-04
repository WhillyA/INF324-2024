<?php
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

// Verificar si se ha proporcionado el parámetro "id" en la URL
if(isset($_GET['id'])) {
    $id_persona = $_GET['id'];

    // Eliminar cuentas bancarias asociadas
    $sql_eliminar_cuentas = "DELETE FROM cuentabancaria WHERE id_persona = ?";
    $stmt_eliminar_cuentas = $conexion->prepare($sql_eliminar_cuentas);
    if ($stmt_eliminar_cuentas) {
        $stmt_eliminar_cuentas->bind_param("i", $id_persona);
        $stmt_eliminar_cuentas->execute();
        $stmt_eliminar_cuentas->close();
    } else {
        echo "Error en la preparación de la consulta para eliminar cuentas: " . $conexion->error;
        exit;
    }

    // Eliminar la persona
    $sql_eliminar_persona = "DELETE FROM persona WHERE id = ?";
    $stmt_eliminar_persona = $conexion->prepare($sql_eliminar_persona);
    if ($stmt_eliminar_persona) {
        $stmt_eliminar_persona->bind_param("i", $id_persona);
        $stmt_eliminar_persona->execute();

        // Redirigir a la página de listar personas
        header("Location: listar_personas.php");
        exit;
    } else {
        echo "Error en la preparación de la consulta para eliminar persona: " . $conexion->error;
        exit;
    }
} else {
    echo "ID de persona no proporcionado.";
    exit;
}
?>