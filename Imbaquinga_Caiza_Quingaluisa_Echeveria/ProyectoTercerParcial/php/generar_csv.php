<?php
// Leer el contenido de registro_compras.json
$data = json_decode(file_get_contents('registro_compras.json'), true);

// Si no hay datos en el JSON, terminar el script
if (!$data) {
    die("No hay registros de compras para generar el archivo XLS.");
}

// Configurar las cabeceras para descargar el archivo como XLS
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="registro_compras.xls"');

// Inicio del archivo con etiquetas específicas de Excel
echo "<html xmlns:x=\"urn:schemas-microsoft-com:office:excel\">";
echo "<head>";
echo "[<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">]";
echo "</head><body>";

// Crear tabla
echo '<table border="1">';
echo '<tr><th>Fecha</th><th>Nombre del Producto</th><th>Cantidad</th>';

// Agregar los registros de compra al archivo XLS
foreach ($data as $row) {
    echo '<tr>';
    echo '<td>' . $row['Fecha'] . '</td>';
    echo '<td>' . $row['Nombre del Producto'] . '</td>';
    echo '<td>' . $row['Cantidad'] . '</td>';
  
    echo '</tr>';
}

echo '</table>';

echo "</body></html>";
?>
