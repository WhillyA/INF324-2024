<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Cuenta Bancaria</title>
</head>
<body>
    <h2>Agregar Nueva Cuenta Bancaria</h2>
    <form action="<?= site_url('cuentabancaria/agregarUS') ?>" method="post">

        <label for="id_persona">ID Persona:</label>
        <input type="text" name="id_persona" id="id_persona" required>

        <label for="saldo">Saldo Inicial:</label>
        <input type="number" name="saldo" id="saldo" step="0.01" required>

        <label for="id_tipo_cuenta">Tipo de Cuenta:</label>
        <input type="text" name="id_tipo_cuenta" id="id_tipo_cuenta" required>

        <input type="submit" value="Agregar Cuenta">
    </form>
</body>
</html>
