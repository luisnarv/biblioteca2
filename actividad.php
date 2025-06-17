<?php
function obtenerLibrosConAutores() {
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $basededatos = "biblioteca"; // <-- cambia esto

    $conexion = new mysqli($host, $usuario, $contrasena, $basededatos);
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT 
                libro.ISBN, 
                libro.nombre AS nombre_libro, 
                autor.nombre AS autor_nombre, 
                libro.cantidad
            FROM libro
            INNER JOIN autor ON libro.autor = autor.id";

    $resultado = $conexion->query($sql);

    $libros = [];
    if ($resultado && $resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            $libros[] = $fila;
        }
    }

    $conexion->close();
    return $libros;
}

function conectar() {
    $host = "localhost";
    $usuario = "root";
    $contrasena = ""; // sin contraseña en phpMyAdmin local
    $basededatos = "biblioteca"; // <- Cambia al nombre de tu BD

    // Crear objeto mysqli con los parámetros de conexión
    $conexion = new mysqli($host, $usuario, $contrasena, $basededatos);

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    return $conexion;
}

/**
 * Inserta un nuevo libro en la tabla 'libro'
 * @param int $isbn        ISBN del libro (entero)
 * @param string $nombre   Nombre del libro
 * @param int $autor_id    ID del autor (entero)
 * @param int $cantidad    Cantidad en inventario (entero)
 * @return bool            true si se insertó correctamente
 */
function crearLibro($isbn, $nombre, $autor_id, $cantidad) {
    $conexion = conectar(); // Conexión usando parámetros de 'conectar()'

    // Prepara la consulta con marcadores
    $stmt = $conexion->prepare(
        "INSERT INTO libro (ISBN, nombre, autor, cantidad) VALUES (?, ?, ?, ?)"
    );

    // Vincula parámetros: "i" para enteros, "s" para string
    $stmt->bind_param("isii", $isbn, $nombre, $autor_id, $cantidad);

    $exito = $stmt->execute();

    $stmt->close();
    $conexion->close();

    return $exito;
}

/**
 * Inserta un nuevo usuario en la tabla 'usuario'
 */
function crearUsuario($id, $nombre) {
    $conexion = conectar();
    $stmt = $conexion->prepare(
        "INSERT INTO usuario (id,nombre) VALUES (?,?)"
    );
    $stmt->bind_param("is", $id, $nombre);
    $exito = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $exito;
}

function crearAutor($id,$nombre) {
    $conexion = conectar();
    $stmt = $conexion->prepare(
        "INSERT INTO autor (id,nombre) VALUES (?,?)"
    );
    $stmt->bind_param("is",$id, $nombre);
    $exito = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $exito;
}

/**
 * Crea un nuevo alquiler si hay stock suficiente y descuenta la cantidad
 */
function crearAlquiler($alquiler_id, $usuario_id, $libro_id, $cantidad) {
    $conexion = conectar();
    $conexion->begin_transaction();
    try {
        // Verificar stock actual
        $stmt = $conexion->prepare("SELECT cantidad FROM libro WHERE ISBN = ? FOR UPDATE");
        $stmt->bind_param("i", $libro_id);
        $stmt->execute();
        $stmt->bind_result($stock_actual);
        if (!$stmt->fetch()) {
            throw new Exception("Libro no encontrado.");
        }
        $stmt->close();

        if ($cantidad > $stock_actual) {
            throw new Exception("Cantidad solicitada excesiva. Stock disponible: $stock_actual");
        }

        // Insertar en tabla alquiler
        $stmt = $conexion->prepare(
            "INSERT INTO alquiler (id, usuario, libro, cantidad) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("iiii", $alquiler_id, $usuario_id, $libro_id, $cantidad);
        $stmt->execute();
        $stmt->close();

        // Actualizar stock en libro
        $nuevo_stock = $stock_actual - $cantidad;
        $stmt = $conexion->prepare("UPDATE libro SET cantidad = ? WHERE ISBN = ?");
        $stmt->bind_param("ii", $nuevo_stock, $libro_id);
        $stmt->execute();
        $stmt->close();

        $conexion->commit();
        $conexion->close();
        return true;
    } catch (Exception $e) {
        $conexion->rollback();
        $conexion->close();
        return false;
    }
}
// Listar alquileres con JOINs
function listarAlquiler() {
    $conexion = conectar();
    $sql = "SELECT 
                a.id AS alquiler_id,
                u.nombre AS usuario,
                l.nombre AS libro,
                a.cantidad AS cantidad_alquilada
            FROM alquiler a
            INNER JOIN usuario u ON a.usuario = u.id
            INNER JOIN libro l ON a.libro = l.ISBN";
    $resultado = $conexion->query($sql);
    $alquileres = [];
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $alquileres[] = $fila;
        }
    }
    $conexion->close();
    return $alquileres;
}
?>



