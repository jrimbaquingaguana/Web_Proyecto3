<?php
if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    $conexion = mysqli_connect("localhost", "admin", "admin", "productos_hogar");
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Obtener la cantidad pendiente del producto
    $consultaPendiente = "SELECT pendiente FROM inventario WHERE id = $idProducto AND tipo = 'PRODUCTO'";
    $resultadoPendiente = mysqli_query($conexion, $consultaPendiente);
    $filaPendiente = mysqli_fetch_assoc($resultadoPendiente);
    $cantidadPendiente = $filaPendiente['pendiente'];

    // Trasladar la cantidad pendiente a la cantidad confirmada y resetear el valor pendiente a 0
    $consultaConfirmar = "UPDATE inventario SET cantidad = cantidad + $cantidadPendiente, pendiente = 0 WHERE id = $idProducto AND tipo = 'PRODUCTO'";
    
    // Ejecutamos la consulta para actualizar la base de datos
    if (mysqli_query($conexion, $consultaConfirmar)) {
        header("Location: ver_inventario.php"); // Redirigimos al usuario de vuelta al inventario una vez que se haya confirmado
    } else {
        echo "Error al confirmar el producto: " . mysqli_error($conexion);
    }

    // Cerramos la conexión a la base de datos
    mysqli_close($conexion);
}
?>
