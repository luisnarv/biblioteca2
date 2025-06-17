<!-- crear.php: Formulario y procesamiento -->
<?php
require_once 'actividad.php';
$mensaje = '';

// Procesar envío usando llamada al método
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn     = isset($_POST['isbn']) ? (int)$_POST['isbn'] : 0;
    $nombre   = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $autor_id = isset($_POST['autor_id']) ? (int)$_POST['autor_id'] : 0;
    $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 0;

    if ($isbn > 0 && $nombre !== '' && $autor_id > 0 && $cantidad >= 0) {
        if (crearLibro($isbn, $nombre, $autor_id, $cantidad)) {
            $mensaje = '✅ Libro creado correctamente.';
        } else {
            $mensaje = '❌ Error al crear el libro.';
        }
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
    <title>Agregar Libro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>Agregar Nuevo Libro</h2>

    <!-- Mensaje de operación -->
    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <form method="post" action="crear.php">
        <div class="form-group">
            <label for="isbn">ISBN (entero):</label>
            <input type="number" class="form-control" id="isbn" name="isbn" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre del Libro:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="autor_id">ID del Autor:</label>
            <input type="number" class="form-control" id="autor_id" name="autor_id" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <button type="submit" class="btn btn-success">Crear Libro</button>
        <a href="index.php" class="btn btn-secondary ml-2">Volver</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>