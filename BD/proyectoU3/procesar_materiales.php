<?php
if (isset($_POST['ingresarMaterial'])) {
    $nombreMaterial = $_POST['material'];
    $cantidad = $_POST['cantidad'];

    $conexion = mysqli_connect("localhost", "admin", "admin", "productos_hogar");
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Verificar si el material ya existe
    $consultaExistencia = "SELECT * FROM inventario WHERE nombre = '$nombreMaterial' AND tipo = 'MATERIAL'";
    $resultadoExistencia = mysqli_query($conexion, $consultaExistencia);

    if (mysqli_num_rows($resultadoExistencia) > 0) {
        // Si el material existe, actualizamos su cantidad
        $consultaActualizar = "UPDATE inventario SET cantidad = cantidad + $cantidad WHERE nombre = '$nombreMaterial' AND tipo = 'MATERIAL'";
        if (mysqli_query($conexion, $consultaActualizar)) {
            echo "Material actualizado con éxito.";
        } else {
            echo "Error al actualizar el material: " . mysqli_error($conexion);
        }
    } else {
        // Si no existe, lo agregamos
        $consultaAgregar = "INSERT INTO inventario (nombre, cantidad, tipo) VALUES ('$nombreMaterial', $cantidad, 'MATERIAL')";
        if (mysqli_query($conexion, $consultaAgregar)) {
            echo "Material registrado con éxito.";
        } else {
            echo "Error al registrar el material: " . mysqli_error($conexion);
        }
    }

    mysqli_close($conexion);
}
?>

