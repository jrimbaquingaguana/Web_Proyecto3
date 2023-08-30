<?php
// config.php

$servername = "localhost";
$username = "admin";
$password = "admin";
$database = "rol";

// Crear la conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
