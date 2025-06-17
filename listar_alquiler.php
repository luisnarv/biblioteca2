<!-- listar_alquiler.php -->
<?php
require_once 'actividad.php';
$alquileres = listarAlquiler();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Listar Alquileres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>Alquileres Realizados</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID Alquiler</th>
                    <th>Usuario</th>
                    <th>Libro</th>
                    <th>Cantidad Alquilada</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($alquileres)): ?>
                    <?php foreach ($alquileres as $al): ?>
                        <tr>
                            <td><?= htmlspecialchars($al['alquiler_id']) ?></td>
                            <td><?= htmlspecialchars($al['usuario']) ?></td>
                            <td><?= htmlspecialchars($al['libro']) ?></td>
                            <td><?= htmlspecialchars($al['cantidad_alquilada']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">No hay alquileres registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <a href="index.php" class="btn btn-secondary">Volver</a>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
