<?php include 'actividad.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Listado de Libros</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Libros</h2>
       
        <a href="index.php" class="btn btn-secondary ml-2">Volver</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ISBN</th>
                    <th>Nombre del Libro</th>
                    <th>Autor</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $libros = obtenerLibrosConAutores();
                if (!empty($libros)) {
                    foreach ($libros as $libro) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($libro['ISBN']) . "</td>";
                        echo "<td>" . htmlspecialchars($libro['nombre_libro']) . "</td>";
                        echo "<td>" . htmlspecialchars($libro['autor_nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($libro['cantidad']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No hay libros disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>