<?php
// Datos de conexión a la base de datos
$nombre_servidor = "localhost";
$nombre_usuario = "root";
$contraseña = "";
$nombre_base_datos = "bdwhilly";

// Crear la conexión
$conexion = new mysqli($nombre_servidor, $nombre_usuario, $contraseña, $nombre_base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}