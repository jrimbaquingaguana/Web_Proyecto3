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
                <input type="text" name="material" id="material" required>
            </div>
            
            <div class="input-group">
                <label for="cantidad">Cantidad de material necesaria:</label>
                <input type="number" name="cantidad_eliminar" value="1" min="1" max="<?php echo $fila['cantidad']; ?>" style="width: 50px;">
            </div>
			
			<div class="input-group">
    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" min="0.01" step="0.01" required>
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
    function validarFormulario(formulario) {
    var cantidadInput = formulario.cantidad_eliminar;

    if (isNaN(cantidadInput.value) || cantidadInput.value <= 0 || cantidadInput.value > <?php echo $fila['cantidad']; ?>) {
        alert("Por favor, ingrese una cantidad válida.");
        cantidadInput.focus();
        return false;
    }

    return true;
    }
    document.addEventListener("DOMContentLoaded", function() {
    var precioInput = document.getElementById("precio");
    
    precioInput.addEventListener("input", function() {
        var inputValue = precioInput.value.trim();
        
        var regex = /^\d+(\.\d{1,2})?$/;
        
        if (!regex.test(inputValue) || parseFloat(inputValue) <= 0) {
            precioInput.setCustomValidity("Ingrese un número decimal válido mayor que cero.");
        } else {
            precioInput.setCustomValidity("");
        }
    });
});
</script>
	
</body>
</html>