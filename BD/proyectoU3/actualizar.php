<?php
if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    $conexion = mysqli_connect("localhost", "admin", "admin", "productos_hogar");
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Verificamos si el producto tiene un código de registro reciente
    $consultaCodigo = "SELECT codigo_registro FROM inventario WHERE id = $idProducto AND tipo = 'PRODUCTO'";
    $resultadoCodigo = mysqli_query($conexion, $consultaCodigo);
    $dataCodigo = mysqli_fetch_assoc($resultadoCodigo);

    if ($dataCodigo['codigo_registro']) {
        $consultaActualizar = "UPDATE inventario SET cantidad = cantidad + 1, codigo_registro = NULL WHERE id = $idProducto AND tipo = 'PRODUCTO'";
        if (mysqli_query($conexion, $consultaActualizar)) {
            header("Location: ver_inventario.php"); // Redirecciona de vuelta al inventario
        } else {
            echo "Error al actualizar el producto: " . mysqli_error($conexion);
        }
    } else {
        header("Location: ver_inventario.php?error=no_creation"); // Redirecciona de vuelta al inventario con un mensaje de error
    }

    mysqli_close($conexion);
}
?>
