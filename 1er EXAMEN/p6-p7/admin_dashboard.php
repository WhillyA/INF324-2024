<?php

// Conexión a la base de datos
include 'conexion.php';
include_once 'includes/functions.php';
session_start();

?>

  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página de Bienvenida</title>
    <style>
        /* Estilos para centrar el contenido y establecer el fondo azul */
        body {
            background-color: #3498db; /* Azul */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Ocupa toda la altura de la pantalla */
            margin: 0;
        }

        /* Contenedor para el texto */
        .centered {
            text-align: center;
            color: white; /* Letras blancas para contrastar con el fondo azul */
        }

        /* Estilo para el texto grande */
        .welcome {
            font-size: 88px; /* Tamaño grande para "Bienvenido" */
            font-weight: bold;
        }

        /* Estilo para el texto pequeño */
        .instructions {
            font-size: 18px; /* Tamaño más pequeño para instrucciones */
        }
    </style>
     <link rel="stylesheet" href="styles_head.css">
</head>
<body>   
    <?php include 'head.php';?>
    <div class="centered">
        <div class="welcome">Bienvenido</div>
        <div class="instructions">Seleccione en el menú las opciones</div>
    </div>
</body>
</html>
