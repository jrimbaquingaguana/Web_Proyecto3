<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Materiales</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container">

    <h2>Ingresar Materiales</h2>
    
    <form action="procesar_materiales.php" method="post">
        <div class="input-group">
            <label for="material">Material:</label>
            <input type="text" name="material" id="material" required>
        </div>
        
        <div class="input-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" required>
        </div>
        
        <input type="submit" name="ingresarMaterial" value="Ingresar Material">
    </form>

    <!-- Botón para regresar a la página de creación de producto -->
    <a href="index.php" class="create-product-btn">Volver a Crear Producto</a>
    
</div>

	<script>
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('material')) {
        if (urlParams.get('material') === 'ingresado') {
            alert('Material ingresado con éxito.');
        } else if (urlParams.get('material') === 'error_actualizar') {
            alert('Hubo un error al actualizar el material en el inventario.');
        } else if (urlParams.get('material') === 'error_insertar') {
            alert('Hubo un error al ingresar el nuevo material al inventario.');
        }
    }
</script>
	
</body>
</html>
