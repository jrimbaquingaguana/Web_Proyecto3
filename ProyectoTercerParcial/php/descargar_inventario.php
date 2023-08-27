<?php
include('dbconnection.php');

// Consulta para obtener los datos del inventario
$result = mysqli_query($con, "SELECT * FROM inventario WHERE tipo='MATERIAL'");


if (!$result) {
    die("Error en la consulta: " . mysqli_error($con));
}

// Establecer encabezados para la descarga
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=inventario.xls');

// Inicio del archivo HTML
echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
echo '<head><meta http-equiv="Content-type" content="text/html;charset=utf-8"></head>';
echo '<body>';

// Crear tabla

echo '<table border="1">';
echo '<tr><th>#</th><th>Codigo</th><th>Nombre</th><th>Cantidad</th><th>Precio unitario</th><th>Precio promedio</th><th>Fecha ingreso</th><th>Unidades</th><th>Foto</th></tr>';

$counter = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $counter . '</td>';
    echo '<td>' . $row['ID'] . '</td>';
    echo '<td>' . $row['nombre'] . '</td>';
    echo '<td>' . $row['cantidad'] . '</td>';
    echo '<td>' . $row['precio'] . '</td>';
    echo '<td>' . $row['precio_promedio'] . '</td>';
    echo '<td>' . $row['fecha'] . '</td>';
    echo '<td>' . $row['Unidades'] . '</td>';
    echo '<td>' . $row['foto'] . '</td>';
    echo '</tr>';
    $counter++;
}

echo '<td><'
echo '</table>';




echo '</body></html>';
?>
