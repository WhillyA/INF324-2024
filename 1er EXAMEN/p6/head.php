<?php
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$modulos = obtener_modulos_usuario($_SESSION['user_id']);
$rol_nombre = obtener_tiporol($_SESSION['user_id']); // Cambiado para obtener el nombre

?>

<ul class="navbar">
    <li><a ><?php echo $rol_nombre ?: 'Sin Rol'; ?></a></li> <!-- Mostrar "Sin Rol" si es null -->
   
    <li><a href="intro.php">Inicio</a></li>
    <?php if ($modulos): ?>
        <?php while ($modulo = $modulos->fetch_assoc()): ?>
            <li><a href="<?php echo $modulo['archivo']; ?>.php"><?php echo $modulo['nombre']; ?></a></li>
        <?php endwhile; ?>
    <?php endif; ?>
    <li><a href="logout.php">Cerrar Sesión</a></li>
</ul>