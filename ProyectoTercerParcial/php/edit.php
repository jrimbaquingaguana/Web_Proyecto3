<?php
session_start();
if(empty($_SESSION["id"])){
    header("location: ../login.php");
}
?>
<?php
if($_SESSION["id_cargo"]==1){
    echo "Administrador";
}else if($_SESSION["id_cargo"]==2){
    echo "Bodeguero";
}else{
    echo "Productor";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Perfil</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../img/favicon.png" rel="icon">
    <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../css/stylebootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/styleIndex.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/editStyle.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="indexAdministrador.php" class="logo d-flex align-items-center">
            <img src="../img/logo.png" alt="">
            <span class="d-none d-lg-block">JALD COMPANY</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="../img/profile-img.jpg" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                <?php
                echo $_SESSION["nombre"];
                ?>
            </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php
                            echo $_SESSION["nombre"]." ".$_SESSION["apellido"];

                            if($_SESSION["id_cargo"]==1){
                                echo " <br>Administrador";
                            }else if($_SESSION["id_cargo"]==2){
                                echo "<br>Bodeguero";
                            }else{
                                echo "<br>Productor";
                            }
                            ?></h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                            <i class="bi bi-person"></i>
                            <span>Mi perfil</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="../controladores/controlador_cerrar_sesion.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Cerrar Sesión</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>Perfil</span>
            </a>
        </li><!-- End Profile Page Nav -->


        <?php if($_SESSION["id_cargo"] == 2):?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php">
                    <i class="bi bi-pencil-square"></i>
                    <span>Inventario</span>
                </a>
            </li><!-- End Inventario Page Nav -->
        <?php endif; ?>


        <?php if($_SESSION["id_cargo"]==2):?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="insert.php">
                    <i class="bi bi-bag-plus"></i>
                    <span>Insertar Productos a bodega</span>
                </a>
            </li><!-- End Registro a Bodega Page Nav -->
        <?php endif; ?>


        <?php if($_SESSION["id_cargo"]==3 or $_SESSION["id_cargo"]==1):?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="index_despacho.php">
                    <i class="bi bi-bag-check"></i>
                    <span>Crear productos</span>
                </a>
            </li><!-- End Registro a Bodega Page Nav -->
        <?php endif; ?>


        <?php if($_SESSION["id_cargo"]==1):?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="usersCrud.php">
                    <i class="bi bi-card-list"></i>
                    <span>Registrar Nuevos Usuarios</span>
                </a>
            </li><!-- End Register Page Nav -->
        <?php endif; ?>



    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <section class="section profile">
        <div class="row">
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <div class="tab-content pt-2">

                        <?php
                        //Database Connection
                        include('dbconnection.php');
                        if(isset($_POST['submit']))
                        {
                            $eid=$_GET['editid'];
                            //Getting Post Values
                            $fname=$_POST['fname'];
                            $lname=$_POST['lname'];
                            $add=$_POST['direccion'];
                            $contno=$_POST['contacto'];
                            $email=$_POST['usuario'];
                            $contraseña=$_POST['pass'];


                            // Generar el hash de la contraseña
                            $hashedPassword = password_hash($contraseña, PASSWORD_BCRYPT);

                            // Query for data updation
                            $query = mysqli_query($con, "UPDATE usuarios SET nombre='$fname', apellido='$lname', direccion='$add', telefono='$contno', usuario='$email', contraseña='$hashedPassword' WHERE ID='$eid'");


                            if ($query) {
                                echo "<script>alert('Se actualizo la información correctamente');</script>";
                                echo "<script type='text/javascript'> document.location ='usersCrud.php'; </script>";
                            }
                            else
                            {
                                echo "<script>alert('Algo salio mal, intenta nuevamente.');</script>";
                            }
                        }
                        ?>
                        <div class="signup-form">
                            <form  method="POST">
                                <?php
                                $eid=$_GET['editid'];
                                $ret=mysqli_query($con,"select * from usuarios where ID='$eid'");
                                while ($row=mysqli_fetch_array($ret)) {
                                    ?>
                                    <h2>Actualizar </h2>
                                    <div class="form-group">
                                        <label for="fname">Nombre y Apellido:</label>
                                        <div class="row">
                                            <div class="col"><input type="text" class="form-control" name="fname"  pattern="[A-Za-z]+" title="Ingresa solo un nombre sin numeros ni espacios" value="<?php  echo $row['nombre'];?>" required="true"></div>
                                            <div class="col"><input type="text" class="form-control" name="lname" pattern="[A-Za-z]+"  title="Ingresa solo un apellido sin numeros ni espacios" value="<?php  echo $row['apellido'];?>" required="true"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección:</label>
                                        <textarea class="form-control" name="direccion" required="true"><?php  echo $row['direccion'];?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="contacto">Número de Celular:</label>
                                        <input type="text" class="form-control" name="contacto" title="Ingresa exactamente 10 numeros que constan como numero celular" maxlength="10" pattern="^[0-9]{9,10}$" value="<?php  echo $row['telefono'];?>" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="usuario">Correo Electrónico:</label>
                                        <input type="email" class="form-control" name="usuario" title="Ingresa un correo valido porfavor" pattern="^\S+@\S+\.\S+$" value="<?php  echo $row['usuario'];?>" required="true">
                                    </div>

                                    <div class="form-group">
                                        <label for="pass">Contraseña:</label>
                                        <input type="text" class="form-control" name="pass" value="<?php  echo $row['contraseña'];?>" required="true">
                                    </div>

                                    <?php
                                }?>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Actualizar</button>
                                </div>
                            </form>
                            <a href="usersCrud.php" style="color: cornflowerblue">REGRESAR</a>
                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>
        </div>
    </section>


</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>JALD COMPANY</span></strong>. Todos los derechos reservados
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Diseñado por <a href="https://www.espe.edu.ec/">Estudiantes Espe</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../vendor/apexcharts/apexcharts.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/chart.js/chart.umd.js"></script>
<script src="../vendor/echarts/echarts.min.js"></script>
<script src="../vendor/quill/quill.min.js"></script>
<script src="../vendor/simple-datatables/simple-datatables.js"></script>
<script src="../vendor/tinymce/tinymce.min.js"></script>
<script src="../vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../js/main.js"></script>

</body>

</html>
