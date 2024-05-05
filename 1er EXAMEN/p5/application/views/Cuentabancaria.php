<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Cuentas Bancarias</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('plantilla/cuentabancaria.css') ?>">

</head>
<body>
    <h2>Listado de Cuentas Bancarias</h2>

    <!-- Enlace para agregar una nueva cuenta bancaria -->
    <a href="<?= site_url('cuentabancaria/agregarUS') ?>">Agregar Nueva Cuenta</a> <!-- Este es el botón o enlace para agregar -->

    <table border="1">
        <tr>
            <th>Nombres</th>
            <th>Apellido</th>
            <th>CI</th>
            <th>Saldo</th>
            <th>Fecha de Creación</th>
            <th>Tipo de Cuenta</th>
            <th>Acción</th> <!-- Para eliminar -->
        </tr>
        <?php foreach ($cuentas as $cuenta) : ?>
            <tr>
                <td><?= $cuenta->nombres ?></td>
                <td><?= $cuenta->ap_pat ?></td>
                <td><?= $cuenta->ci ?></td>
                <td><?= $cuenta->saldo ?></td>
                <td><?= $cuenta->fecha_creacion ?></td>
                <td><?= $cuenta->tipo_cuenta ?></td>
                <!-- Botón para eliminar la cuenta bancaria -->
                <td>
                <form method="POST" action="<?= site_url('cuentabancaria/eliminar/' . $cuenta->id); ?>" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este empleado?');">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                </form> 
              </td>
         </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
