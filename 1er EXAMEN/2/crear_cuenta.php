<?php
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

// Verificar si se ha proporcionado el parámetro "id_persona" en la URL
if(isset($_POST['id_persona'])) {
    $id_persona = $_POST['id_persona'];
} else {
    echo "ID de persona no proporcionado.";
    exit;
}

// Obtener los datos del formulario
$tipo_cuenta = $_POST['tipo_cuenta'];
$saldo = $_POST['saldo'];

// Consulta para insertar una nueva cuenta bancaria
$sql_insertar_cuenta = "INSERT INTO cuentabancaria (id_tipo_cuenta, saldo, id_persona, fecha_creacion) VALUES (?, ?, ?, NOW())";
$stmt_insertar_cuenta = $conexion->prepare($sql_insertar_cuenta);

if ($stmt_insertar_cuenta) {
    $stmt_insertar_cuenta->bind_param("idi", $tipo_cuenta, $saldo, $id_persona);
    $stmt_insertar_cuenta->execute();
    
    // Verificar si se insertó correctamente
    if ($stmt_insertar_cuenta->affected_rows > 0) {
        // Redireccionar a la página de administrar cuentas con la ID de la persona
        header("Location: administrar_cuentas.php?id=$id_persona");
        exit;
    } else {
        echo "Error al crear la nueva cuenta bancaria.";
    }

    // Cerrar el statement
    $stmt_insertar_cuenta->close();
} else {
    echo "Error en la preparación de la consulta: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>
