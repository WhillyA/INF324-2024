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
        $sql = "SELECT
        SUM(CASE WHEN P.DEPARTAMENTO = 'LA PAZ' THEN CB.SALDO ELSE 0 END) AS LA_PAZ,
        SUM(CASE WHEN P.DEPARTAMENTO = 'COCHABAMBA' THEN CB.SALDO ELSE 0 END) AS COCHABAMBA,
        SUM(CASE WHEN P.DEPARTAMENTO = 'SANTA CRUZ' THEN CB.SALDO ELSE 0 END) AS SANTA_CRUZ,
        SUM(CASE WHEN P.DEPARTAMENTO = 'ORURO' THEN CB.SALDO ELSE 0 END) AS ORURO,
        SUM(CASE WHEN P.DEPARTAMENTO = 'POTOSI' THEN CB.SALDO ELSE 0 END) AS POTOSI,
        SUM(CASE WHEN P.DEPARTAMENTO = 'TARIJA' THEN CB.SALDO ELSE 0 END) AS TARIJA,
        SUM(CASE WHEN P.DEPARTAMENTO = 'CHUQUISACA' THEN CB.SALDO ELSE 0 END) AS CHUQUISACA,
        SUM(CASE WHEN P.DEPARTAMENTO = 'BENI' THEN CB.SALDO ELSE 0 END) AS BENI,
        SUM(CASE WHEN P.DEPARTAMENTO = 'PANDO' THEN CB.SALDO ELSE 0 END) AS PANDO
    FROM
        CUENTABANCARIA CB
    INNER JOIN
        PERSONA P ON CB.ID_PERSONA = P.ID
    ";
        $result = $conexion->query($sql);
        var_dump($result);
   
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr>
                    <th>La Paz</th>
                    <th>Cochabamba</th>
                    <th>Santa Cruz</th>
                    <th>Oruro</th>
                    <th>Potosí</th>
                    <th>Tarija</th>
                    <th>Chuquisaca</th>
                    <th>Beni</th>
                    <th>Pando</th>
                </tr>";
            
            // Mostrar resultados como una fila
            $row = $result->fetch_assoc(); // Solo hay una fila
            echo "<tr>";
            foreach ($row as $col) {
                echo "<td>$col</td>"; // Mostrar cada columna
            }
            echo "</tr>";
            echo "</table>";
        } else {
            echo "No se encontraron datos.";
        }
        
        $conexion->close();
        ?>
    </div>
</body>
</html>
