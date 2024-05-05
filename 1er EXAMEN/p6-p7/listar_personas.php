<?php include 'conexion.php';        
        include_once 'includes/functions.php'; 
        session_start();
        ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Clientes</title>
    <link rel="stylesheet" href="listar_personas2.css">
	<link rel="stylesheet" href="styles_menu.css">
    <link rel="stylesheet" href="styles_head.css">
</head>
<body>

<?php include 'head.php'; ?>
    <div class="container">
        <h1>Listar clientes</h1>
        <?php
        
        // Consulta SQL para obtener las personas con rol de usuario 3
        $sql = "SELECT * FROM persona ";
        $result = $conexion->query($sql);
        
        if ($result->num_rows > 0) {
            echo '<form action="actualizar_persona.php" method="post">';
            echo '<table>';
            echo '<tr><th>ID</th><th>Apellidos</th><th>Nombres</th><th>CI</th><th>Fecha de Nacimiento</th><th>Dirección</th><th>Acciones</th><th>Cuentas</th><th>Eliminar</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["ap_pat"] . ' ' . $row["ap_mat"] . '</td>';
                echo '<td>' . $row["nombres"] . '</td>';
                echo '<td>' . $row["ci"] . '</td>';
                echo '<td>' . $row["fecha_nac"] . '</td>';
                echo '<td>' . $row["direccion"] . '</td>';
                echo '<td><button type="submit" name="persona" value="' . $row["id"] . '" class="modificar-button">Modificar</button></td>'; // Botón para modificar
                echo '<td><a href="administrar_cuentas.php?id=' . $row["id"] . '" class="administrar-button">Cuentas</a></td>'; // Enlace para administrar cuentas
                echo '<td><a href="eliminar_persona.php?id=' . $row["id"] . '" class="eliminar-button">Eliminar</a></td>'; // Enlace para eliminar persona
                echo '</tr>';
            }
            echo '</table>';
            echo '</form>';
        } else {
            echo 'No se encontraron personas con rol de usuario 3.';
        }
        
        $conexion->close();
        ?>
    </div>
</body>
</html>
