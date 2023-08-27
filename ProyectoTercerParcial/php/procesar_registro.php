<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Aquí puedes realizar validaciones y procesar los datos, como guardar en una base de datos
    
    // Por ejemplo, imprimir los datos recibidos
    echo "Nombre: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Usuario: " . $username . "<br>";
    // ¡No imprimas la contraseña en producción!
    
    // Aquí podrías redirigir al usuario a una página de éxito, por ejemplo:
    // header("Location: users-profile");
}
?>
