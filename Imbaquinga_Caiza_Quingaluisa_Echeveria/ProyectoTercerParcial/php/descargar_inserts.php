<?php
include('dbconnection.php');

// Consulta para obtener los datos del inventario
$result = mysqli_query($con, "SELECT * FROM compra  INNER JOIN usuarios ON usuarios.id=compra.codigo_usuario");


if (!$result) {
    die("Error en la consulta: " . mysqli_error($con));
}

// Establecer encabezados para la descarga
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=ingreso_material.xls');

// Inicio del archivo HTML
echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
echo '<head><meta http-equiv="Content-type" content="text/html;charset=utf-8"></head>';
echo '<body>';

// Crear tabla

echo '<table border="1">';
echo '<tr><th>#</th>><th>Id compra</th><th>Nombre</th><th>Codigo del usuario</th><th>Cantidad</th><th>Precio unitario</th><th>Fecha</th><th>Persona encargada</th></tr>';

$counter = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $counter . '</td>';
    echo '<td>' . $row['ID_compra'] . '</td>';
    echo '<td>' . $row['nombrec'] . '</td>';
    echo '<td>' . $row['codigo_usuario'] . '</td>';
    echo '<td>' . $row['cantidadc'] . '</td>';
    echo '<td>' . $row['precioc'] . '</td>';
    echo '<td>' . $row['fechac'] . '</td>';
    echo '<td>' . $row['apellido'] . '</td>';
    echo '</tr>';
    $counter++;
}

echo '</table>';




echo '</body></html>';
?>
