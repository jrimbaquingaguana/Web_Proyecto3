<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Despacho de Inventario</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>

<div class="container">

    <!-- Formulario para crear un producto -->
    <div class="form-section">
        <h2>Crear Producto</h2>
        <form action="procesar.php" method="post">
            <div class="input-group">
                <label for="producto">Nombre del Producto:</label>
                <input type="text" name="nombre" id="producto" required>
            </div>
            
            <div class="input-group">
                <label for="material">Material necesario:</label>
                <select id="material" name="material">

    <?php
        $servername = "localhost";
        $username = "jose";
        $password = "040500";
        $dbname = "proyecto_web";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Obtener códigos existentes desde la base de datos
        $sql = "SELECT nombre FROM inventario WHERE tipo='MATERIAL' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
            }
        }

        // Cerrar la conexión
        $conn->close();
        ?>
        

        
    
    
    </select>
                
            </div>
            
            <div class="input-group">
                <label for="cantidad">Cantidad de material necesaria:</label>
                <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="<?php echo $fila['cantidad']; ?>" style="width: 50px;">
            </div>
			
			<div class="input-group">
    <label for="precio">Precio:</label>
    <input type="number" id="precio"  name="precio" id="precio" min="0.01" step="0.01" required>
</div>
			
			<div class="input-group">
    <label for="numProductos">Número de productos a crear:</label>
    <input type="number" name="numProductos" id="numProductos" value="1" min="1" required>
</div>

            
            <input type="submit" name="crearProducto" value="Crear Producto">
			
        </form>
    </div>
	<div class="buttons-group">
    
		<a href="ver_inventario.php" class="view-inventory-btn">Ver Inventario</a>
</div>



</div>

	<script>
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        if (urlParams.get('success') === 'producto_creado') {
            alert('Producto creado con éxito.');
        } else if (urlParams.get('success') === 'producto_actualizado') {
            alert('Producto actualizado con éxito.');
        } else if (urlParams.get('success') === 'codigo_encontrado') {
            alert('Producto creado: ' + urlParams.get('producto'));
        }
    } else if (urlParams.has('error')) {
        if (urlParams.get('error') === 'insuficiente_material') {
            alert('No hay suficiente material para crear el producto.');
        } else if (urlParams.get('error') === 'error_actualizar') {
            alert('Error al actualizar el producto.');
        } else if (urlParams.get('error') === 'error_crear') {
            alert('Error al crear el producto.');
        } else if (urlParams.get('error') === 'codigo_no_encontrado') {
            alert('Código no encontrado.');
        }
    }    
</script>
	
</body>
</html>