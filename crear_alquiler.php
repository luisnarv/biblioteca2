<!-- crear_alquiler.php -->
<?php
require_once 'actividad.php';
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $alquiler_id = isset($_POST['alquiler_id']) ? (int)$_POST['alquiler_id'] : 0;
    $usuario_id  = isset($_POST['usuario_id'])  ? (int)$_POST['usuario_id']  : 0;
    $libro_id    = isset($_POST['libro_id'])    ? (int)$_POST['libro_id']    : 0;
    $cantidad    = isset($_POST['cantidad'])    ? (int)$_POST['cantidad']    : 0;

    if ($alquiler_id > 0 && $usuario_id > 0 && $libro_id > 0 && $cantidad > 0) {
        $mensaje = crearAlquiler($alquiler_id, $usuario_id, $libro_id, $cantidad)
            ? '✅ Alquiler creado correctamente.'
            : '❌ Error al crear el alquiler o stock insuficiente.';
    } else {
        $mensaje = '⚠️ Completa todos los campos correctamente.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Crear Alquiler</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>Realizar Nuevo Alquiler</h2>
    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>
    <form method="post" action="crear_alquiler.php">
        <div class="form-group">
            <label for="alquiler_id">ID del Alquiler:</label>
            <input type="number" class="form-control" id="alquiler_id" name="alquiler_id" required>
        </div>
        <div class="form-group">
            <label for="usuario_id">ID del Usuario:</label>
            <input type="number" class="form-control" id="usuario_id" name="usuario_id" required>
        </div>
        <div class="form-group">
            <label for="libro_id">ID del Libro:</label>
            <input type="number" class="form-control" id="libro_id" name="libro_id" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad a Alquilar:</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <button type="submit" class="btn btn-secondary">Crear Alquiler</button>
        <a href="index.php" class="btn btn-secondary ml-2">Volver</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
