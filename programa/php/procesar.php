<?php
$conexion = mysqli_connect("localhost", "admin", "admin", "proyecto_web");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Procesamiento de Creación de Producto
if (isset($_POST['crearProducto'])) {
    $nombreProducto = $_POST['nombre'];
    $material = $_POST['material'];
    $cantidadNecesaria = $_POST['cantidad']; // Cantidad de material necesario para 1 producto
    $precio = $_POST['precio'];
    $numProductos = isset($_POST['numProductos']) ? intval($_POST['numProductos']) : 1;  // Número de productos que quieres añadir.

    // Verificar cantidad de material disponible
    $consultaMaterial = "SELECT cantidad FROM inventario WHERE nombre = '$material' AND tipo = 'MATERIAL'";
    $resultadoMaterial = mysqli_query($conexion, $consultaMaterial);
    $dataMaterial = mysqli_fetch_assoc($resultadoMaterial);
    
    if ($dataMaterial['cantidad'] < ($cantidadNecesaria * $numProductos)) {
        header("Location: index_despacho.php?error=insuficiente_material");
    } else {
        // Descontar material
        $consultaDescontar = "UPDATE inventario SET cantidad = cantidad - ($cantidadNecesaria * $numProductos) WHERE nombre = '$material' AND tipo = 'MATERIAL'";
        mysqli_query($conexion, $consultaDescontar);

        // Verificar si el producto ya existe
        $consultaExistencia = "SELECT * FROM inventario WHERE nombre = '$nombreProducto' AND tipo = 'PRODUCTO'";
        $resultadoExistencia = mysqli_query($conexion, $consultaExistencia);

        if(mysqli_num_rows($resultadoExistencia) > 0) {
            // Si el producto ya existe
            $consultaActualizar = "UPDATE inventario SET pendiente = pendiente + $numProductos, precio = precio + ($precio * $numProductos) WHERE nombre = '$nombreProducto' AND tipo = 'PRODUCTO'";

            if(mysqli_query($conexion, $consultaActualizar)) {
                header("Location: index_despacho.php?success=producto_actualizado");
            } else {
                die("Error al actualizar el producto: " . mysqli_error($conexion));
            }
        } else {
            // Si no existe, lo agregamos
            $codigo = uniqid();
            $consultaAgregar = "INSERT INTO inventario (nombre, pendiente, tipo, codigo_registro, precio) VALUES ('$nombreProducto', $numProductos, 'PRODUCTO', '$codigo', $precio * $numProductos)";
            
            if (mysqli_query($conexion, $consultaAgregar)) {
                header("Location: index.php?success=producto_creado");
            } else {
                die("Error al registrar el producto: " . mysqli_error($conexion));
            }
        }
    }
}

// Procesamiento para Eliminar Producto
if (isset($_POST['eliminarProducto'])) {
    $productoId = $_POST['producto_id']; // El ID del producto a eliminar
    $consultaEliminar = "DELETE FROM inventario WHERE id = '$productoId'";
    if (mysqli_query($conexion, $consultaEliminar)) {
        header("Location: ver_inventario.php?success=producto_eliminado");
    } else {
        header("Location: ver_inventario.php?error=error_eliminar");
    }
}

if (isset($_POST['reducirProducto'])) {
    $productoId = $_POST['producto_id'];
    $cantidadAReducir = intval($_POST['cantidad_eliminar']);

    // Obtener precio por unidad
    $consultaPrecio = "SELECT precio, cantidad FROM inventario WHERE id = '$productoId'";
    $resultadoPrecio = mysqli_query($conexion, $consultaPrecio);
    $filaPrecio = mysqli_fetch_assoc($resultadoPrecio);
    $precioPorUnidad = $filaPrecio['precio'] / $filaPrecio['cantidad'];

    // Calcular nuevo precio total
    $nuevoPrecio = $filaPrecio['precio'] - ($precioPorUnidad * $cantidadAReducir);

    // Actualizar cantidad y precio
    $consultaReducir = "UPDATE inventario SET cantidad = cantidad - $cantidadAReducir, precio = $nuevoPrecio WHERE id = '$productoId'";
    if (mysqli_query($conexion, $consultaReducir)) {
        header("Location: ver_inventario.php?success=producto_reducido");
    } else {
        header("Location: ver_inventario.php?error=error_reducir");
    }
}

mysqli_close($conexion);
?>