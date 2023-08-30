<?php
//database connection file
include('dbconnection.php');
//Code for deletion

?>

<?php
session_start();
if(empty($_SESSION["id"])){
    header("location: ../login.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>JALD COMPANY</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../img/favicon.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="indexAdministrador.php" class="logo d-flex align-items-center">
        <img src="../img/logo.png" alt="">
        <span class="d-none d-lg-block">JALD COMPANY</span>
      </a>
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


        <?php if($_SESSION["id_cargo"] == 2 || strpos($_SESSION["roles"], '2')!== false):?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php">
                <i class="bi bi-pencil-square"></i>
                <span>Inventario</span>
            </a>
        </li><!-- End Inventario Page Nav -->
        <?php endif; ?>


        <?php if($_SESSION["id_cargo"]==2 || strpos($_SESSION["roles"], '2')!== false):?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="insert.php">
                    <i class="bi bi-bag-plus"></i>
                    <span>Insertar Productos a bodega</span>
                </a>
            </li><!-- End Registro a Bodega Page Nav -->
        <?php endif; ?>


        <?php if($_SESSION["id_cargo"]==3 || strpos($_SESSION["roles"], '3')!== false):?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="index_despacho.php">
                    <i class="bi bi-bag-check"></i>
                    <span>Crear productos</span>
                </a>
            </li><!-- End Registro a Bodega Page Nav -->
        <?php endif; ?>


        <?php if($_SESSION["id_cargo"]==1 || strpos($_SESSION["roles"], '1')!== false):?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Administración de Usuarios</span>
        </a>
      </li><!-- End Register Page Nav -->
        <?php endif; ?>

      <li class="nav-item">
        
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">


  <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <h2>Inventario <b>Actualizado</b></h2>
                        </div>
                        
                    </div>
                </div>
                <form method="GET">
    <label for="nombre">Buscar por nombre: </label>
    <input type="text" name="nombre" id="nombre" placeholder="Ingrese un nombre">
    <button type="submit">Buscar</button>
</form>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo </th>
                            <th>Nombre </th>
                            <th>Cantidad </th>
                            <th>Precio unitario </th>
                            <th>Precio promedio</th>
                            <th>Fecha ingreso</th>
                            <th>Unidades</th>
                            <th>Foto</th> 
                            
                        </tr>
                    </thead>
                    <tbody>
                      
                        <?php
                                $filtro = ""; // Variable para almacenar el filtro de búsqueda
                         if (isset($_GET['nombre'])) {
            $filtro = " AND nombre LIKE '%" . $_GET['nombre'] . "%'";
        }
        $consulta = "SELECT * FROM inventario WHERE tipo='MATERIAL'" . $filtro;
        $ret = mysqli_query($con, $consulta);
        $cnt = 1;
                $row = mysqli_num_rows($ret);

                        if ($row > 0) {
                            while ($row = mysqli_fetch_array($ret)) {

                               
                                // Obtener el ID de la fila actual
                                $usuarioID = $row['ID'];

                              
                        ?>
                                <tr class="<?php echo $fila_clase; ?>">
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['ID']; ?></td>
                                    <td><?php echo $row['nombre']; ?> 
                                    <td><?php echo $row['cantidad']; ?></td>
                                    <td><?php echo $row['precio']; ?></td>
                                    <td><?php echo $row['precio_promedio']; ?></td>
                                    <td><?php echo $row['fecha'];?></td>
                                    <td><?php echo $row['Unidades']; ?></td>
                                    <td><img src="<?php echo $row['foto']; ?>" width=80px $heigh=auto><td>

                                    <td>
                                    
                                                                                                         
                                    </td>
                                </tr>
                        <?php
                                $cnt = $cnt + 1;
                            }
                        } else {
                        ?>
                            <tr>
                                <th style="text-align:center; color:red;" colspan="6">No hay productos registrados </th>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>

<a href="descargar_inventario.php" class="btn btn-primary">Descargar Inventario Actualizado en Excel</a>
                <div class="col-sm-5">
                            <h3>Inventario <b>Original</b></h3>
                        </div>
                       

                        <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo </th>
                            <th>Nombre </th>
                            <th>Cantidad </th>
                            <th>Precio unitario </th>
                            <th>Fecha de ingreso</th>
                            <th>Unidades</th>
                            <th>Foto</th> 
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $filtro = ""; // Variable para almacenar el filtro de búsqueda
                        if (isset($_GET['nombre'])) {
                          $nombre = mysqli_real_escape_string($con, $_GET['nombre']); // Evitar SQL injection
                          $filtro = " WHERE nombre LIKE '%$nombre%'";
       }
          $consulta = "SELECT * FROM inventario_original" . $filtro;
            $ret = mysqli_query($con, $consulta);

       $cnt = 1;
               $row = mysqli_num_rows($ret);
                        if ($row > 0) {
                            while ($row = mysqli_fetch_array($ret)) {

                               
                                // Obtener el ID de la fila actual
                                $usuarioID = $row['ID'];

                              
                        ?>
                                <tr class="<?php echo $fila_clase; ?>">
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['ID']; ?></td>
                                    <td><?php echo $row['nombre']; ?> 
                                    <td><?php echo $row['cantidad']; ?></td>
                                    <td><?php echo $row['precio_inicial']; ?></td>
                                    <td><?php echo $row['fecha'];?></td>
                                    <td><?php echo $row['Unidades']; ?></td>
                                    <td><img src="<?php echo $row['foto']; ?>" width=80px $heigh=auto><td>

                                    <td>
                                    
                                                                                                         
                                    </td>
                                </tr>
                        <?php
                                $cnt = $cnt + 1;
                            }
                        } else {
                        ?>
                            <tr>
                                <th style="text-align:center; color:red;" colspan="6">No hay productos registrados </th>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <a href="descargar_inventario_original.php" class="btn btn-primary">Descargar Inventario Original en Excel</a>
            </div>
        </div>
    </div>

    
   



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
