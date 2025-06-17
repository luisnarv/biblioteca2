<!-- crear_autor.php -->
<?php
require_once 'actividad.php';
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $id = isset($_POST['id']) ? trim($_POST['id']) : '';
    if ($nombre !== '') {
        $mensaje = crearAutor($id,$nombre)
            ? '✅ Autor creado correctamente.'
            : '❌ Error al crear el autor.';
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
    <title>Crear Autor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>Agregar Nuevo Autor</h2>
    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>
    <form method="post" action="crear_autor.php">
        <div class="form-group">
            
            <label for="id">Id del Autor:</label>
            <input type="text" class="form-control" id="id" name="id" required>
            
            <label for="nombre">Nombre del Autor:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <button type="submit" class="btn btn-warning">Crear Autor</button>
        <a href="index.php" class="btn btn-secondary ml-2">Volver</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>