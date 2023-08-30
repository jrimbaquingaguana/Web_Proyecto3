<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conexion = mysqli_connect("localhost", "admin", "admin", "rol");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

echo "Intentando conectar...";

function registrarCompra($nombreProducto, $cantidad, $tipo) {
    $archivo = 'registro_compras.json';
    $compras = [];

    if (file_exists($archivo)) {
        $contenidoActual = file_get_contents($archivo);
        $compras = json_decode($contenidoActual, true);
    }

    $compra = [
        'Fecha' => date('Y-m-d H:i:s'),
        'Nombre del Producto' => $nombreProducto,
        'Cantidad' => $cantidad,
        'Tipo' => $tipo
    ];

    $compras[] = $compra;
    file_put_contents($archivo, json_encode($compras));
}

if (isset($_POST['crearProducto'])) {
    $nombreProducto = $_POST['nombre'];
    $materiales = $_POST['materiales'];
    $cantidades = $_POST['cantidades'];
    $numProductos = isset($_POST['numProductos']) ? intval($_POST['numProductos']) : 1;
    $materialesAgrupados = implode(', ', $materiales);
    $cantidadesAgrupadas = implode(', ', $cantidades);
    foreach($materiales as $index => $material) {
        $cantidadNecesaria = $cantidades[$index];
        $precioTotal = 0; // Inicializar el precio total

    
        $consultaMaterial = "SELECT cantidad, precio FROM inventario WHERE nombre = '$material' AND tipo = 'MATERIAL'";
        $resultadoMaterial = mysqli_query($conexion, $consultaMaterial);
        $dataMaterial = mysqli_fetch_assoc($resultadoMaterial);
    
        $cantidadDisponible = $dataMaterial['cantidad'];
        $precioMaterialPorUnidad = $dataMaterial['precio'];
    
        if ($cantidadDisponible < $cantidadNecesaria * $numProductos) {
            $mensajeError = "No hay suficiente cantidad de $material disponible.";
            echo "<p>$mensajeError</p>";
            echo "<p>Redirigiendo en 2 segundos...</p>";
            header("refresh:3;url=index_tecnico.php");
            exit();
        }
    
        $precioTotal += $precioMaterialPorUnidad * $cantidadNecesaria * $numProductos;
    }

    foreach($materiales as $index => $material) {
        $cantidadNecesaria = $cantidades[$index];

        $consultaMaterial = "SELECT precio FROM inventario WHERE nombre = '$material' AND tipo = 'MATERIAL'";
        $resultadoMaterial = mysqli_query($conexion, $consultaMaterial);
        $dataMaterial = mysqli_fetch_assoc($resultadoMaterial);

        $precioMaterialPorUnidad = $dataMaterial['precio'];
        $precioTotal += $precioMaterialPorUnidad * $cantidadNecesaria * $numProductos;
    }
    foreach($materiales as $index => $material) {
        $cantidadNecesaria = $cantidades[$index];
        $consultaDescontar = "UPDATE inventario SET cantidad = cantidad - ($cantidadNecesaria * $numProductos) WHERE nombre = '$material' AND tipo = 'MATERIAL'";}
        $consultaAgregar = "INSERT INTO inventario_produccion (nombre_producto,nombre_material,cantidad,precio) VALUES ('$nombreProducto','$materialesAgrupados','$cantidadesAgrupadas','$precioTotal')";

        mysqli_query($conexion, $consultaDescontar);
    }

    registrarCompra($nombreProducto, $numProductos, "creacion");
foreach($materiales as $index => $material) {
        $cantidadNecesaria = $cantidades[$index];
        
        $consultaMaterial = "SELECT cantidad,precio FROM inventario WHERE nombre = '$material' AND tipo = 'MATERIAL'";
        $resultadoMaterial = mysqli_query($conexion, $consultaMaterial);
        $dataMaterial = mysqli_fetch_assoc($resultadoMaterial);
        
        if ($dataMaterial['cantidad'] < ($cantidadNecesaria * $numProductos)) {
            header("Location: index_despacho.php?error=insuficiente_material&material=$material");
            exit;
        }
        $precioMaterialPorUnidad = $dataMaterial['precio'];
        $precioTotal += $precioMaterialPorUnidad * $cantidadNecesaria * $numProductos;
    }
    $consultaExistencia = "SELECT * FROM inventario WHERE nombre = '$nombreProducto' AND tipo = 'PRODUCTO'";
    $resultadoExistencia = mysqli_query($conexion, $consultaExistencia);
    $precio_solito=$precioTotal/$numProductos;
    if(mysqli_num_rows($resultadoExistencia) > 0) {
        $consultaActualizar = "UPDATE inventario SET pendiente = pendiente + $numProductos WHERE nombre = '$nombreProducto' AND tipo = 'PRODUCTO'";
        $consultaActualizar =  "INSERT INTO creación (nombre_producto,veces_creado,precio_total,precio_invdividual) VALUES ('$nombreProducto','$numProductos','$precioTotal','$precio_solito')";

        if(mysqli_query($conexion, $consultaActualizar)) {
            header("Location: index_despacho.php?success=producto_actualizado");
        } else {
            die("Error al actualizar el producto: " . mysqli_error($conexion));
        }
    } else {
        $codigo = uniqid();
        $consultaAgregar = "INSERT INTO inventario (nombre,precio, pendiente,tipo, codigo_registro) VALUES ('$nombreProducto','$precioTotal', '$numProductos', 'PRODUCTO', '$codigo')";


        if (mysqli_query($conexion, $consultaAgregar)) {
            header("Location: index_despacho.php?success=producto_creado");
        } else {
            die("Error al registrar el producto: " . mysqli_error($conexion));
        }
    }


if (isset($_POST['eliminarProducto'])) {
    $productoId = $_POST['producto_id'];
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
    registrarCompra($fila['nombre'], -$cantidadAReducir, "reduccion");

    $consultaReducir = "UPDATE inventario SET cantidad = cantidad - $cantidadAReducir WHERE id = '$productoId'";
    if (mysqli_query($conexion, $consultaReducir)) {
        header("Location: ver_inventario.php?success=producto_reducido");
    } else {
        header("Location: ver_inventario.php?error=error_reducir");
    }
}


mysqli_close($conexion);

?>
