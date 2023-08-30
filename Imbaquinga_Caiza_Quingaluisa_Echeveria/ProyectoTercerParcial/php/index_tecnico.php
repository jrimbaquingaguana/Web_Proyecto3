<?php
session_start();
if(empty($_SESSION["id"])){
    header("location: ../login.php");
}
$servername = "localhost";
$username = "jose";
$password = "040500";
$dbname = "rol";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los valores
$sql = "SELECT nombre_material,cantidad FROM inventario_produccion WHERE nombre_producto='$valorNuevo'";
$result = $conn->query($sql);

if (isset($_POST['consulta'])) {
  $valorNuevo = $_POST['nombre'];

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "jose";
$password = "040500";
$dbname = "rol";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los valores
$sql = "SELECT nombre_material,cantidad FROM inventario_produccion WHERE nombre_producto='$valorNuevo'";
$result = $conn->query($sql);
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
  <link rel="stylesheet" href="../css/estilo_productos.css">

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
                    echo "<br>Administrador";
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


        <?php if($_SESSION["id_cargo"] == 2 || strpos($_SESSION["roles"], '2') !== false):?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php">
                <i class="bi bi-pencil-square"></i>
                <span>Inventario</span>
            </a>
        </li><!-- End Inventario Page Nav -->
        <?php endif; ?>


        <?php if($_SESSION["id_cargo"]==2 || strpos($_SESSION["roles"], '2') !== false):?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="insert.php">
                    <i class="bi bi-bag-plus"></i>
                    <span>Insertar Productos a bodega</span>
                </a>
            </li><!-- End Registro a Bodega Page Nav -->
        <?php endif; ?>


        <?php if($_SESSION["id_cargo"]==3 || strpos($_SESSION["roles"], '3') !== false):?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="index_despacho.php">
                    <i class="bi bi-bag-check"></i>
                    <span>Crear Hoja tecnica</span>
                </a>
            </li><!-- End Registro a Bodega Page Nav -->
        <?php endif; ?>
        <?php if($_SESSION["id_cargo"]==3 || strpos($_SESSION["roles"], '3') !== false):?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="ver_inventario.php">
                    <i class="bi bi-bag-check"></i>
                    <span>Crear Productos</span>
                </a>
            </li><!-- End Registro a Bodega Page Nav -->
        <?php endif; ?>


        <?php if($_SESSION["id_cargo"]==1 || strpos($_SESSION["roles"], '1') !== false):?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="usersCrud.php">
          <i class="bi bi-card-list"></i>
          <span>Administración de Usuarios</span>
        </a>
      </li><!-- End Register Page Nav -->
        <?php endif; ?>

      

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

  <div class="container">
  <form  method="post" enctype="multipart/form-data">

  <div class="input-group">
        <label for="producto">Nombre del Producto:</label>
        <input type="text" name="nombre" id="nombre" required>
    </div>
    <input type="submit" name="consulta" value="Consultar Materiales">

    
        </form>
<!-- Formulario para crear un producto -->
<div class="form-section">
        <h2>Hoja Tecnica</h2>
        <form action="procesar1.php" method="post">
        <?php
    // Procesar el formulario después del envío
    if (isset($_POST['consulta'])) {
        $nombre = $_POST['nombre'];
        
        // Aquí puedes realizar cualquier acción con el valor del producto
        // Por ejemplo, mostrar un mensaje con el producto consultado
        echo "Producto consultado: $nombre";
        
        // Muestra el valor en otro campo de entrada
        echo '<div class="input-group">';
        echo '<label>Producto consultado:</label>';
        echo '<input type="text" name="nombre" value="' . $nombre . '" readonly>';
        echo '</div>';
    }
    ?>
    <!-- Sección de Materiales -->
    <div class="input-group">
        <label>Materiales necesarios:</label>
        <div id="materials-list">
            <div class="material-item">
                <?php while ($row = $result->fetch_assoc()) {
                    $materiales = explode(', ', $row['nombre_material']);
                    for ($i = 0; $i < count($materiales); $i++) { ?>
                        <select name="materiales[]">
                            <option value="<?php echo $materiales[$i]; ?>">
                                <?php echo $materiales[$i]; ?>
                            </option>
                        </select>
                        <br>
                    <?php }
                } ?>
            </div>
        </div>
    </div>

    <!-- Sección de Cantidades -->
    <div class="input-group">
        <label>Cantidades necesarias:</label>
        <div id="quantities-list">
            <div class="quantity-item">
                <?php
                $result->data_seek(0); // Reiniciar el puntero del resultado a la posición inicial

                while ($row = $result->fetch_assoc()) {
                    $cantidades = explode(', ', $row['cantidad']);
                    for ($i = 0; $i < count($cantidades); $i++) { ?>
                        <select name="cantidades[]">
                            <option value="<?php echo $cantidades[$i]; ?>">
                                <?php echo $cantidades[$i]; ?>
                            </option>
                        </select>
                        <br>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
    <div class="input-group">
                <label for="numProductos">Número de productos a crear:</label>
                <input type="number" name="numProductos" id="numProductos" value="1" min="1" required>
            </div>


    <input type="submit" name="crearProducto" value="Crear Producto">
</form>

    </div>
<div class="buttons-group">
    <a href="ver_inventario.php" class="view-inventory-btn">Ver Inventario</a>
</div>

</div>

<script>
  function addMaterialField() {
    const materialsList = document.getElementById('materials-list');
    const newItem = document.createElement('div');
    newItem.classList.add('material-item');
    newItem.innerHTML = `
        <select name="material[]" required>
            <?php
                include('conexion1.php');

                // Obtener códigos existentes desde la base de datos
                $sql = "SELECT ID, nombre, Unidades FROM inventario WHERE tipo='MATERIAL' ORDER BY nombre ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['nombre'] . '">' . $row['nombre'] . '</option>';
                    }
                }

                // Cerrar la conexión
                $conn->close();
            ?>
        </select>
        <input type="number" name="cantidad[]" placeholder="Cantidad" required>
    `;
    materialsList.appendChild(newItem);
}




    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        if (urlParams.get('success') === 'producto_creado') {
            alert('Producto creado con éxito.');
        } else if (urlParams.get('success') === 'producto_actualizado') {
            alert('Producto actualizado con éxito.');
        } else if (urlParams.get('success') === 'codigo_encontrado') {
            alert('Producto creado: ' + urlParams.get('producto'));
        }
    } else if (urlParams.has('error')) {
        if (urlParams.get('error') === 'insuficiente_material') {
            alert('No hay suficiente material (' + urlParams.get('material') + ') para crear el producto.');
        } else if (urlParams.get('error') === 'error_actualizar') {
            alert('Error al actualizar el producto.');
        } else if (urlParams.get('error') === 'error_crear') {
            alert('Error al crear el producto.');
        } else if (urlParams.get('error') === 'codigo_no_encontrado') {
            alert('Código no encontrado.');
        }
    }
</script>
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
  <script>
        // Obtener elementos del DOM
        const formulario = document.getElementById('miFormulario');
        const nombreInput = document.getElementById('nombre');
        const nombreMostradoInput = document.getElementById('nombreMostrado');

        // Escuchar el evento "submit" en el formulario
        formulario.addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe

            // Copiar el valor del campo de entrada al campo no editable
            nombreMostradoInput.value = nombreInput.value;
        });
    </script>

    
</body>

</html>
