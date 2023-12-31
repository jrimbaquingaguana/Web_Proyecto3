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
                            }else if($_SESSION["id_cargo"]==5){
                                echo "<br>Super Usuario";

                            }else if($_SESSION["id_cargo"]==4){
                                echo "<br>Invitado";

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


          <?php if($_SESSION["id_cargo"] == 2 or $_SESSION["id_cargo"] == 3 or $_SESSION["id_cargo"] == 5 || strpos($_SESSION["roles"], '2') !== false or strpos($_SESSION["roles"], '3') !== false or strpos($_SESSION["roles"], '5') !== false):?>
              <li class="nav-item">
                  <a class="nav-link collapsed" href="index.php">
                      <i class="bi bi-pencil-square"></i>
                      <span>Inventario</span>
                  </a>
              </li><!-- End Inventario Page Nav -->
          <?php endif; ?>


          <?php if($_SESSION["id_cargo"]==2 or $_SESSION["id_cargo"] == 5 || strpos($_SESSION["roles"], '2') !== false or strpos($_SESSION["roles"], '5') !== false):?>
              <li class="nav-item">
                  <a class="nav-link collapsed" href="insert.php">
                      <i class="bi bi-bag-plus"></i>
                      <span>Insertar Productos a bodega</span>
                  </a>
              </li><!-- End Registro a Bodega Page Nav -->
          <?php endif; ?>

          <?php if($_SESSION["id_cargo"]==1 or $_SESSION["id_cargo"] == 5 || strpos($_SESSION["roles"], '1') !== false or strpos($_SESSION["roles"], '5') !== false):?>
              <li class="nav-item">
                  <a class="nav-link collapsed" href="usersCrud.php">
                      <i class="bi bi-card-list"></i>
                      <span>Administrador de Usuarios</span>
                  </a>
              </li><!-- End Register Page Nav -->
          <?php endif; ?>

          <?php if($_SESSION["id_cargo"]==3 or $_SESSION["id_cargo"] == 5 || strpos($_SESSION["roles"], '3') !== false or strpos($_SESSION["roles"], '5') !== false):?>
              <li class="nav-item">
                  <a class="nav-link collapsed" href="index_despacho.php">
                      <i class="bi bi-card-list"></i>
                      <span>Crear Hoja tecnica</span>
                  </a>
              </li><!-- End Registro a Bodega Page Nav -->
          <?php endif; ?>

          <?php if($_SESSION["id_cargo"]==3 or $_SESSION["id_cargo"] == 5 || strpos($_SESSION["roles"], '3') !== false or strpos($_SESSION["roles"], '5') !== false):?>
              <li class="nav-item">
                  <a class="nav-link collapsed" href="ver_inventario.php">
                      <i class="bi bi-card-list"></i>
                      <span>Ver hoja tecnica</span>
                  </a>
              </li><!-- End Register Page Nav -->
          <?php endif; ?>

          <?php if($_SESSION["id_cargo"]==3 or $_SESSION["id_cargo"] == 5 || strpos($_SESSION["roles"], '3') !== false or strpos($_SESSION["roles"], '5') !== false):?>
              <li class="nav-item">
                  <a class="nav-link collapsed" href="index_tecnico.php">
                      <i class="bi bi-card-list"></i>
                      <span>Crear Productos</span>
                  </a>
              </li><!-- End Register Page Nav -->
          <?php endif; ?>

          <?php if($_SESSION["id_cargo"]==3 or $_SESSION["id_cargo"] == 5 || strpos($_SESSION["roles"], '3') !== false or strpos($_SESSION["roles"], '5') !== false):?>
              <li class="nav-item">
                  <a class="nav-link collapsed" href="ver_inventario2.php">
                      <i class="bi bi-card-list"></i>
                      <span>Registro de creacion de  Productos</span>
                  </a>
              </li><!-- End Register Page Nav -->
          <?php endif; ?>

      </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Perfil</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2>
                  <?php
                  echo $_SESSION["nombre"]." ".$_SESSION["apellido"];
                  ?>
              </h2>
              <h3>
                  <?php
                  if($_SESSION["id_cargo"]==1){
                      echo "Administrador";
                  }else if($_SESSION["id_cargo"]==2){
                      echo "Bodeguero";
                  }else{
                      echo "Productor";
                  }
                  ?></h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Detalles del Perfil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nombre Completo</div>
                    <div class="col-lg-9 col-md-8">
                        <?php
                        echo $_SESSION["nombre"]." ".$_SESSION["apellido"];
                        ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Compañía</div>
                    <div class="col-lg-9 col-md-8">JALD COMPANY</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">CARGO</div>
                    <div class="col-lg-9 col-md-8">
                        <?php
                        if($_SESSION["id_cargo"]==1){
                            echo "Administrador";
                        }else if($_SESSION["id_cargo"]==2){
                            echo "Bodeguero";
                        }else{
                            echo "Productor";
                        }
                        ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Dirección</div>
                    <div class="col-lg-9 col-md-8">
                        <?php
                        echo $_SESSION["direccion"];
                        ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telefono</div>
                    <div class="col-lg-9 col-md-8">
                        <?php
                        echo "(+593) ".$_SESSION["telefono"];
                        ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Correo Electrónico</div>
                    <div class="col-lg-9 col-md-8">
                        <?php
                        echo $_SESSION["usuario"];
                        ?>
                    </div>
                  </div>

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
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
