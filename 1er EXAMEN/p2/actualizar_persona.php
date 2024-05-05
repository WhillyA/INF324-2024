<?php
include 'conexion.php';

// Verificar si se ha enviado el formulario y si se ha recibido el valor de 'persona'
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['persona'])) {
    // Obtener el ID de la persona seleccionada
    $id_persona = $_POST['persona'];
    
    // Consultar la base de datos para obtener los datos de la persona seleccionada
    $sql = "SELECT * FROM persona WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_persona);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Mostrar los datos de la persona en un formulario para su modificación
        $persona = $resultado->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modificar Datos de Persona</title>
            <link rel="stylesheet" href="actualizar_persona.css">
            <link rel="stylesheet" href="styles_menu.css">
        </head>
        <body>
			<?php include 'menu.php'; ?>
            <div class="container">
                <h1>Modificar Datos de Persona</h1>
				
                <form action="verificar_actualizar_datos.php" method="post">
                    <input type="hidden" name="id_persona" value="<?php echo $persona['id']; ?>">
                    <label for="nombres">Nombres:</label>
                    <input type="text" id="nombres" name="nombres" value="<?php echo $persona['nombres']; ?>" required>
                    
                    <label for="ap_pat">Apellido Paterno:</label>
                    <input type="text" id="ap_pat" name="ap_pat" value="<?php echo $persona['ap_pat']; ?>" required>
                    
                    <label for="ap_mat">Apellido Materno:</label>
                    <input type="text" id="ap_mat" name="ap_mat" value="<?php echo $persona['ap_mat']; ?>" required>
                    
                    <label for="fecha_nac">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nac" name="fecha_nac" value="<?php echo $persona['fecha_nac']; ?>" required>
                    
                    <label for="ci">CI:</label>
                    <input type="text" id="ci" name="ci" value="<?php echo $persona['ci']; ?>" required>
                    
                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="<?php echo $persona['direccion']; ?>" required>
                    
                    <label for="new_password">Nueva Contraseña:</label>
                    <input type="password" id="new_password" name="new_password" required>
                    <input type="checkbox" onclick="mostrarContrasena('new_password')"> Mostrar contraseña
                    
                    <label for="verify_password">Verificar Nueva Contraseña:</label>
                    <input type="password" id="verify_password" name="verify_password" required>
                    <input type="checkbox" onclick="mostrarContrasena('verify_password')"> Mostrar contraseña
                    <h2>verificar datos antes de actualizar</h2>
                    <input type="submit" value="Actualizar Datos">
					
                </form>
            </div>
            <script>
                function mostrarContrasena(inputID) {
                    var input = document.getElementById(inputID);
                    if (input.type === "password") {
                        input.type = "text";
                    } else {
                        input.type = "password";
                    }
                }
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "No se encontraron datos de la persona.";
    }
} else {
    // Si no se ha enviado el formulario o no se ha recibido el valor de 'persona', redirigir al formulario de selección de persona
    header("Location: listar_persona.php");
    exit;
}

// Cerrar la conexión y liberar los recursos
$stmt->close();
$conexion->close();
?>
