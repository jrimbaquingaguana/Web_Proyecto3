<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiales</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container">

    <h2>Materiales en Inventario</h2>
    
    <table>
        <thead>
            <tr>
                <th>Material</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conexion = mysqli_connect("localhost", "admin", "admin", "productos_hogar");
            if (!$conexion) {
                die("Error de conexión: " . mysqli_connect_error());
            }

            $consulta = "SELECT * FROM inventario WHERE tipo = 'MATERIAL'";
            $resultado = mysqli_query($conexion, $consulta);
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['cantidad'] . "</td>";
                echo "</tr>";
            }
            mysqli_close($conexion);
            ?>
        </tbody>
    </table>

    <!-- Enlace para regresar y crear un nuevo producto -->
    <a href="index.php" class="create-product-btn">Regresar a Crear Producto</a>

</div>

</body>
</html>
