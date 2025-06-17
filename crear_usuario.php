<!-- crear_usuario.php -->
<?php
require_once 'actividad.php';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $id = isset($_POST['id']) ? trim($_POST['id']) : '';

    if ($nombre !== '') {
        if (crearUsuario( $id, $nombre)) {
            $mensaje = '✅ Usuario creado correctamente.';
        } else {
            $mensaje = '❌ Error al crear el usuario.';
        }
    } else {
        $mensaje = '⚠️ El nombre no puede estar vacío.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>Agregar Nuevo Usuario</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <form method="post" action="crear_usuario.php">
        <div class="form-group">
            <label for="nombre">Nombre del Usuario:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
            <label for="id">Id del usuario:</label>
            <input type="text" class="form-control" id="id" name="id" required>
        </div>
        <button type="submit" class="btn btn-success">Crear Usuario</button>
        <a href="index.php" class="btn btn-secondary ml-2">Volver</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>