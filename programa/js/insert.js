$(document).ready(function() {
    $("#opcion").change(function() {
        var opcionSeleccionada = $(this).val();
        mostrarFormulario(opcionSeleccionada);
    });

    $("#formulario1 form, #formulario2 form, #formulario3 form").submit(function(event) {

        var formData = $(this).serialize(); // Obtener datos del formulario

        $.post("procesar_formulario.php", formData, function(data) {
            $("#resultados").html(data);
            $("#resultados").show(); // Mostrar los resultados
        });
    });
});

function mostrarFormulario(opcion) {
    $("#formulario1, #formulario2, #formulario3").hide();
    
    if (opcion === "opcion1") {
        $("#formulario1").show();
    } else if (opcion === "opcion2") {
        $("#formulario2").show();
    } else if (opcion === "opcion3") {
        $("#formulario3").show();
    }
}


function validarNumeros(event) {
    const input = event.target;
    const valor = input.value.trim();
    const numeros = /^[0-9]+$/;
    
    if (!valor.match(numeros)) {
        input.value = valor.replace(/\D/g, ''); // Eliminar caracteres no numéricos
    }
}

function consultarFormulario(event) {
    event.preventDefault(); // Prevenir envío automático del formulario
    
    const consultaInput = document.getElementById("numero");
    const consulta = consultaInput.value.trim();

    if (consulta !== "") {
        // Puedes hacer aquí las acciones necesarias para mostrar los resultados
        // Por ejemplo, mostrando o modificando el contenido de la tabla.
        console.log("Consulta realizada: " + consulta);
    }
}

document.getElementById("cantidad1").addEventListener("input", function() {
    if (this.value <= 0) {
        this.setCustomValidity("La cantidad debe ser mayor que 0");
    } else if (this.value !== "" && parseFloat(document.getElementById("precio").value) <= 0) {
        this.setCustomValidity("El precio debe ser mayor que 0 si la cantidad lo es");
    } else {
        this.setCustomValidity("");
    }
});

document.getElementById("precio1").addEventListener("input", function() {
    if (this.value < 0.01) {
        this.setCustomValidity("El precio debe ser mayor que 0");
    } else if (this.value !== "" && parseInt(document.getElementById("cantidad").value) <= 0) {
        this.setCustomValidity("La cantidad debe ser mayor que 0 si el precio lo es");
    } else {
        this.setCustomValidity("");
    }
});