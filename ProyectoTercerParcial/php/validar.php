<?php
$usuario=$_POST['usuario'];
$contraseña=$_POST['contraseña'];
session_start();
$_SESSION['usuario']=$usuario;

$conexion=mysqli_connect("localhost","root","Dark230900.","rol");

session_start();
$consulta="SELECT*FROM usuarios where usuario='$usuario' and contraseña='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);
$filas=mysqli_fetch_array($resultado);

if($filas['id_cargo']==1){ //administrador
    session_start();
    $_SESSION['id'] = $filas['id'];
    $_SESSION['nombre'] = $filas['nombre'];
    $_SESSION['apellido'] = $filas['apellido'];
    $_SESSION['direccion'] = $filas['direccion'];
    $_SESSION['telefono'] = $filas['telefono'];
    $_SESSION['usuario'] = $filas['usuario'];
    $_SESSION['id_cargo'] = $filas['id_cargo'];
    header("location:../php/indexAdministrador.php");
}else
    if($filas['id_cargo']==2){ //cliente
        session_start();
        $_SESSION['id'] = $filas['id'];
        $_SESSION['nombre'] = $filas['nombre'];
        $_SESSION['apellido'] = $filas['apellido'];
        $_SESSION['direccion'] = $filas['direccion'];
        $_SESSION['telefono'] = $filas['telefono'];
        $_SESSION['usuario'] = $filas['usuario'];
        $_SESSION['id_cargo'] = $filas['id_cargo'];
        header("location:../php/indexAdministrador.php");
    }
    else
        if($filas['id_cargo']==3){ //cliente
            session_start();
            $_SESSION['id'] = $filas['id'];
            $_SESSION['nombre'] = $filas['nombre'];
            $_SESSION['apellido'] = $filas['apellido'];
            $_SESSION['direccion'] = $filas['direccion'];
            $_SESSION['telefono'] = $filas['telefono'];
            $_SESSION['usuario'] = $filas['usuario'];
            $_SESSION['id_cargo'] = $filas['id_cargo'];
            header("location:../php/indexAdministrador.php");
        }else{
            
            ?>

        <?php
        include("../login.php");
        ?>
        <h1 class="bad">ERROR EN LA AUTENTIFICACION</h1>
        <?php
    }
mysqli_free_result($resultado);
mysqli_close($conexion);
