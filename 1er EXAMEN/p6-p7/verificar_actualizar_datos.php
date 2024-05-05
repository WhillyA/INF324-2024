<?php
include 'conexion.php';        
include_once 'includes/functions.php'; 
session_start();

// Verificar si se ha enviado el formulario y si se ha recibido el valor de 'id_persona'
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_persona'])) {
    // Obtener los datos del formulario
    $id_persona = $_POST['id_persona'];
    $nombres = $_POST['nombres'];
    $ap_pat = $_POST['ap_pat'];
    $ap_mat = $_POST['ap_mat'];
    $fecha_nac = $_POST['fecha_nac'];
    $ci = $_POST['ci'];
    $direccion = $_POST['direccion'];
    $new_password = $_POST['new_password'];

    // Verificar si las contraseñas coinciden
    if ($_POST['new_password'] === $_POST['verify_password']) {
        // Las contraseñas coinciden, puedes proceder con la actualización
        // Cifrar la nueva contraseña
        $new_password_hash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        // Construir la consulta SQL para actualizar los datos
        $sql = "UPDATE persona SET nombres=?, ap_pat=?, ap_mat=?, fecha_nac=?, ci=?, direccion=?, password_hash=? WHERE id=?";
        
        // Preparar la consulta SQL
        $stmt = $conexion->prepare($sql);

        // Verificar si la preparación de la consulta tuvo éxito
        if ($stmt === false) {
            // Mostrar el mensaje de error si la preparación falla
            echo "Error en la preparación de la consulta: " . $conexion->error;
        } else {
            // Vincular los parámetros a la consulta preparada
            $stmt->bind_param("sssssssi", $nombres, $ap_pat, $ap_mat, $fecha_nac, $ci, $direccion, $new_password_hash, $id_persona);
            
            // Ejecutar la consulta preparada
            if ($stmt->execute()) {

                // Mostrar los datos actualizados
                echo "<!DOCTYPE html>
                    <html lang=\"es\">
                    <head>
                        <meta charset=\"UTF-8\">
                        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                        <title>Actualización Exitosa</title>
                            
                        <link rel=\"stylesheet\" href=\"styles_menu.css\">
                        <link rel=\"stylesheet\" href=\"verificar_actualizar_datos.css\">
                        <link rel=\"stylesheet\" href=\"styles_head.css\">
                    </head>
                    <body>";

                    include 'head.php';

                    echo "<div class=\"container\">
                        <h1>Actualización Exitosa</h1>
                        <p>Datos actualizados correctamente.</p>
                        <h2>Datos Actualizados:</h2>
                        <p>ID: $id_persona</p>
                        <p>Nombres: $nombres</p>
                        <p>Apellido Paterno: $ap_pat</p>
                        <p>Apellido Materno: $ap_mat</p>
                        <p>Fecha de Nacimiento: $fecha_nac</p>
                        <p>CI: $ci</p>
                        <p>Dirección: $direccion</p>

                    
                        <form action=\"actualizar_persona.php\" method=\"post\">
                            <input type=\"hidden\" name=\"persona\" value=\"$id_persona\">
                            <button type=\"submit\">Volver a Modificar Persona</button>
                        </form>
                    </div>
                    </body>
                    </html>";
            } else {
                echo "Error al actualizar los datos: " . $stmt->error;
            }
        }
    } else {
        // Las contraseñas no coinciden, muestra un mensaje de error al usuario
        echo "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
    }
} else {
    // Si no se ha enviado el formulario o no se ha recibido el valor de 'id_persona', redirigir al formulario de selección de persona
    header("Location: listar_persona.php");
    exit;
}

// Cerrar la conexión y liberar los recursos
$stmt->close();
$conexion->close();
?>
