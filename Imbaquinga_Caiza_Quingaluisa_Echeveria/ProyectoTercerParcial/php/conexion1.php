<?php
$servername = "localhost";
$username = "jose";
$password = "040500";
$dbname = "rol";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
