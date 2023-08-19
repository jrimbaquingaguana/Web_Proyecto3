<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container">

    <h2>Inventario</h2>
    
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
				<th>Precio</th> 
                <th>Actualizar</th>
                <th>Confirmar</th>
                <th>Acciones</th>
                <th>Reducir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conexion = mysqli_connect("localhost", "admin", "admin", "productos_hogar");
            if (!$conexion) {
                die("Error de conexión: " . mysqli_connect_error());
            }

            $consulta = "SELECT * FROM inventario WHERE tipo = 'PRODUCTO'";
            $resultado = mysqli_query($conexion, $consulta);
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['cantidad'] . "</td>";
				echo "<td>" . $fila['precio'] . "</td>";
                echo "<td>" . $fila['pendiente'] . "</td>";

                // Comprobamos si hay cantidad pendiente para ser confirmada
                if ($fila['pendiente'] > 0) {
                    echo "<td><a href='confirmar.php?id=" . $fila['id'] . "'>Confirmar</a></td>";
                } else {
                    echo "<td>No hay ningún producto para actualizar</td>";
                }

                // Columna de acciones
                echo "<td>
                        <form action='procesar.php' method='post'>
                            <input type='hidden' name='producto_id' value='".$fila['id']."'>
                            <input type='submit' name='eliminarProducto' value='Eliminar'>
                        </form>
                      </td>";

                // Columna para reducir cantidad
                echo "<td>
                        <form action='procesar.php' method='post'>
                            <input type='hidden' name='producto_id' value='".$fila['id']."'>
                            <input type='number' name='cantidad_eliminar' value='1' min='1' max='".$fila['cantidad']."' style='width: 50px;'>
                            <input type='submit' name='reducirProducto' value='Reducir'>
                        </form>
                      </td>";

                echo "</tr>";
            }
            mysqli_close($conexion);
            ?>
        </tbody>
    </table>

    <!-- Enlace para regresar y crear un nuevo producto -->
    <a href="index.php" class="create-product-btn">Crear Producto</a>

    <!-- Mostramos un mensaje si no se ha creado un producto recientemente -->
    <?php 
    if (isset($_GET['error']) && $_GET['error'] == "no_creation") {
        echo "<p>No se ha creado un producto recientemente.</p>";
    }
    ?>

    <!-- Añadir scripts para alertas en base a la URL (similar a lo que hemos hecho anteriormente) -->
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            if (urlParams.get('success') === 'producto_eliminado') {
                alert('Producto eliminado con éxito.');
            }
        } else if (urlParams.has('error')) {
            if (urlParams.get('error') === 'error_eliminar') {
                alert('Error al eliminar el producto.');
            }
        }
    </script>

</div>

</body>
</html>
