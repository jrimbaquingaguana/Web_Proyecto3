<?php
session_start();
if(empty($_SESSION["id"])){
    header("location: ../login.php");
}
?>


<?php
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$conexion = mysqli_connect("localhost", "jose", "040500", "rol");

$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_fetch_array($resultado);

if ($filas && password_verify($contraseña, $filas['contraseña'])) { // Si las credenciales son correctas
    session_start();
    $_SESSION['usuario'] = $usuario;
    $_SESSION['roles'] = $filas['roles'];
    $_SESSION['id'] = $filas['id'];
    $_SESSION['nombre'] = $filas['nombre'];
    $_SESSION['apellido'] = $filas['apellido'];
    $_SESSION['direccion'] = $filas['direccion'];
    $_SESSION['telefono'] = $filas['telefono'];
    $_SESSION['usuario'] = $filas['usuario'];
    $_SESSION['id_cargo'] = $filas['id_cargo'];


    if ($filas['id_cargo'] == 1) { // Administrador
        header("location: ../php/indexAdministrador.php");
    } else if ($filas['id_cargo'] == 2 || $filas['id_cargo'] == 3 || $filas['id_cargo'] == 4 || $filas['id_cargo'] == 5) { // Cliente
        header("location: ../php/indexAdministrador.php");
    }
} else { // Credenciales incorrectas
    session_start();
    $_SESSION['error_message'] = "Error en la autenticación";

    header("location: ../login.php");
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>
