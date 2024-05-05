<?php
include 'conexion.php';

// Función para limpiar y validar datos
function limpiar_datos($datos) {
    $datos = array_map('trim', $datos);
    $datos = array_map('stripslashes', $datos);
    $datos = array_map('htmlspecialchars', $datos);
    return $datos;
}

// Función para insertar una nueva persona y devolver el ID recién creado
function insertar_persona($conexion, $datos) {
    // Consulta SQL para insertar persona
    $sql_persona = "INSERT INTO persona (nombres, ap_pat, ap_mat, fecha_nac, ci, direccion, password_hash, id_rol_usuario,departamento) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = $conexion->prepare($sql_persona);
    if (!$stmt) {
        throw new Exception("Error al preparar la inserción de persona: " . $conexion->error);
    }

    // Cifrar la contraseña
    $password_hash = password_hash($datos['password'], PASSWORD_DEFAULT);

    // Asociar los parámetros para bind_param
    $nombres = $datos['nombres'];
    $ap_pat = $datos['ap_pat'];
    $ap_mat = $datos['ap_mat'];
    $fecha_nac = $datos['fecha_nac'];
    $ci = $datos['ci'];
    $direccion = $datos['direccion'];
    $id_rol_usuario = 3; // ID de rol de usuario
    $departamento = $datos['departamento'];
    // Enlace de parámetros
    $stmt->bind_param(
        "sssssssis",
        $nombres,
        $ap_pat,
        $ap_mat,
        $fecha_nac,
        $ci,
        $direccion,
        $password_hash,
        $id_rol_usuario,
        $departamento
    );

    // Ejecutar la declaración
    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la inserción de persona: " . $stmt->error);
    }

    // Obtener el ID de la persona recién creada
    $id_persona = $conexion->insert_id;
    $stmt->close(); // Cerrar la declaración

    return $id_persona; // Devolver el ID
}

// Función para insertar cuenta bancaria
function insertar_cuenta_bancaria($conexion, $id_persona, $tipo_cuenta, $saldo) {
    $sql_cuenta = "INSERT INTO cuentabancaria (id_tipo_cuenta, id_persona, saldo) 
                   VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql_cuenta);

    if (!$stmt) {
        throw new Exception("Error al preparar la inserción de cuenta bancaria: " . $conexion->error);
    }

    // Asociar los parámetros para bind_param
    $stmt->bind_param("iid", $tipo_cuenta, $id_persona, $saldo);

    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la inserción de cuenta bancaria: " . $stmt->error);
    }

    $stmt->close(); // Cerrar la declaración
}

// Limpiar y validar los datos del formulario
$datos_limpios = limpiar_datos($_POST);

try {
    // Insertar la persona y la cuenta bancaria
    $id_persona = insertar_persona($conexion, $datos_limpios);
    insertar_cuenta_bancaria($conexion, $id_persona, $datos_limpios['tipo_cuenta'], $datos_limpios['saldo']);

    // Consulta para obtener datos de persona y tipo de cuenta
    $sql_consulta = "SELECT p.nombres, p.ap_pat, p.ap_mat, c.nombre AS tipo_cuenta 
                     FROM persona p 
                     INNER JOIN cuentabancaria cb 
                     ON p.id = cb.id_persona 
                     INNER JOIN tipo_cuenta c 
                     ON cb.id_tipo_cuenta = c.id 
                     WHERE p.id = ?";

    $stmt_consulta = $conexion->prepare($sql_consulta);

    if (!$stmt_consulta) {
        throw new Exception("Error al preparar la consulta: " . $conexion->error);
    }

    // Pasar el ID de la persona recién creada
    $stmt_consulta->bind_param("i", $id_persona);

    if (!$stmt_consulta->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt_consulta->error);
    }

    $resultado = $stmt_consulta->get_result();

    if ($resultado && $fila = $resultado->fetch_assoc()) {
        echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Información de Nueva Persona y Cuenta Bancaria</title>
    <link rel=\"stylesheet\" href=\"styles_agregar_persona.css\">
	<link rel=\"stylesheet\" href=\"styles_menu.css\">
</head>
<body>";

include 'menu.php';

echo "<h2>Información de Nueva Persona y Cuenta Bancaria</h2>
    <table>
        <tr>
            <th>Nombre de Persona</th>
            <th>Tipo de Cuenta Bancaria</th>
        </tr>
        <tr>
            <td>{$fila['ap_pat']} {$fila['ap_mat']}{$fila['nombres']} </td>
            <td>{$fila['tipo_cuenta']}</td>
        </tr>
    </table>
</body>
</html>";
    } else {
        echo "No se encontraron datos para la persona recién creada.";
    }

    $stmt_consulta->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
$conexion->close();
