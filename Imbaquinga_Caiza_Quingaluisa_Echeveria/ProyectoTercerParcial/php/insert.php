<?php
session_start();
if(empty($_SESSION["id"])){
    header("location: ../login.php");
}
?>
<?php 
//Databse Connection file
include('dbconnection.php');

if (isset($_POST['submit2'])) {
  include ('conexion1.php');
    // Obtener el valor a sumar desde el formulario
    $valorNuevo = $_POST['cantidad1'];
    $valorPrecio = $_POST['precio1'];
    $valorEscogido=$_POST['codigo1'];
    $codigo_Usuario=$_POST['codigo2'];
    

    
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Obtener el valor existente desde la base de datos
    $sql = "SELECT cantidad,precio FROM inventario WHERE ID = $valorEscogido and tipo='MATERIAL'"; // Cambiar esto al ID correcto
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $valorPrecio1 = $row['precio'];
        $valorCantidad = $row['cantidad'];
        
        // Calcular la suma
        $sumaTotalCantidad = $valorCantidad + $valorNuevo;
        $sumaTotalPrecio= ($valorPrecio1+$valorPrecio)/2;
        
        // Actualizar la base de datos con el nuevo valor
        $sqlActualizar = "UPDATE inventario SET cantidad = $sumaTotalCantidad, precio_promedio = $sumaTotalPrecio, precio=$sumaTotalPrecio WHERE ID = $valorEscogido and tipo='MATERIAL'";

        if ($conn->query($sqlActualizar) === TRUE) {
        } else {
            echo "Error al actualizar la base de datos: " . $conn->error;
        }
    } else {
        echo "No se encontraron valores en la base de datos.";
    }
        // Cerrar la conexión
        $conn->close();
       
        $valorNuevo = $_POST['cantidad1'];
    $valorPrecio = $_POST['precio1'];
    $valorEscogido=$_POST['codigo1'];
    $codigo_Usuario=$_POST['codigo2'];
   
        $query=mysqli_query($con, "INSERT INTO compra(codigo_usuario,codigo_inventario, cantidadc, precioc) VALUES ('$codigo_Usuario','$valorEscogido', '$valorNuevo', '$valorPrecio')");
        
        if ($query) {
        echo "<script>alert('You have successfully inserted the data');</script>";
       // echo "<script type='text/javascript'> document.location ='../index.php'; </script>";
      }
      else
        {
          echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }

}
$imagen='';
    if(isset($_FILES["foto"])){
      include ('conexion1.php');
      $uni=$_POST['unidad'];
      $nombre1=$_POST["nombre"];
      $cantidad=$_POST["cantidad4"];
      $codigo_Usuario=$_POST["codigo2"];
      $precio=$_POST["precio4"];
      $file=$_FILES["foto"];
      $nombre=$file["name"];
      $tipo=$file["type"];
      $ruta_provicional=$file["tmp_name"];
      $size=$file["size"];
      $dimensiones= getimagesize($ruta_provicional);
      $width=$dimensiones[0];
      $heigh=$dimensiones[1];
      $carpeta="../fotos/";
      if($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo !=
          'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif'
      )
      {   
          echo  "Error,el archivo no es una imagen";
      }
      else if($size>3*1024*1024){
          echo "Error, el tamaño máxmo permito es un 3MB";
  
        }else{
            $src=$carpeta.$nombre;
            move_uploaded_file($ruta_provicional, $src);
            $imagen="../fotos/".$nombre;
            
            $query=mysqli_query($con, "INSERT INTO inventario (nombre,cantidad,precio,foto,Unidades,tipo) VALUES ('$nombre1','$cantidad','$precio','$imagen','$uni','MATERIAL')");
            $query=mysqli_query($con, "INSERT INTO inventario_original (nombre,cantidad,precio_inicial,foto,Unidades) VALUES ('$nombre1','$cantidad','$precio','$imagen','$uni')");
            $query=mysqli_query($con, "INSERT INTO compra(codigo_usuario, cantidadc, precioc,nombrec,unidadesc) VALUES ('$codigo_Usuario', '$cantidad', '$precio','$nombre1','$uni')");

            if ($query) {
            echo "<script>alert('You have successfully inserted the data');</script>";
          }
  
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>

</body>
</html>




<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>JALD COMPANY</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">

    <style>

</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="../js/insert.js"></script>

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


        <?php if($_SESSION["id_cargo"] == 2 ):?>
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


        <?php if($_SESSION["id_cargo"]==3 or $_SESSION["id_cargo"]==1  ):?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="index_despacho.php">
                    <i class="bi bi-bag-check"></i>
                    <span>Crear productos</span>
                </a>
            </li><!-- End Registro a Bodega Page Nav -->
        <?php endif; ?>


        <?php if($_SESSION["id_cargo"]==1):?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Administración de Usuarios</span>
        </a>
      </li><!-- End Register Page Nav -->
        <?php endif; ?>

      

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
  <div class="signup-form">
<h1>Ingreso de material</h1>
    <select id="opcion" onchange="mostrarFormulario()">
    
        <option value="opcion1">Comprar material nuevo</option>
        <option value="opcion2">Comprar material existente</option>
        <option value="opcion3"selected >Consultar compra</option>

    </select>
    
    <div id="formulario1" style="display: none;">
        
    <form  method="post" enctype="multipart/form-data" >
		<h2>Nuevo Material</h2>
        <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    <br><br>
    
    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad4" name="cantidad4" min="1" required>
    <br><br>
    
    <label for="precio">Precio:</label>
    <input type="number" id="precio4" name="precio4" min="0.01" step="0.01" required>
    <br><br>
		
    
		      
      
		<div class="form-group">
    <label for="codigo">Inserte foto:</label>

    <input type="file" name="foto"><br><br>
    <label for="codigo">Persona encargada:</label>

    <select id="codigo2" name="codigo2">
      
    <?php
    include ('conexion1.php');

    // Imprimir la opción con el valor de $_SESSION["nombre"]
    echo '<option value="' . $_SESSION["id"] . '">' . $_SESSION["nombre"] . '</option>';

    // Cerrar la conexión
    $conn->close();
    ?>
</select>
    
    
    <br><br>
  <label >Selecciona la unidad:</label>
  <select id="unidad" name="unidad">
    <optgroup label="Volumen">
      <option value="litros">Litros</option>
      <option value="mililitros">Mililitros</option>
      <option value="decilitros">Decilitros</option>
      <option value="centilitros">Centilitros</option>
      <option value="microlitros">Microlitros</option>
    </optgroup>
    <optgroup label="Peso">
      <option value="kilogramos">Kilogramos</option>
      <option value="gramos">Gramos</option>
      <option value="hectogramos">Hectogramos</option>
      <option value="decagramos">Decagramos</option>
      <option value="decigramos">Decigramos</option>
    </optgroup>
    <optgroup label="Peso">
      <option value="Entero">Entero</option>
    </optgroup>
    
  </select>
  <br>



   

    </select>

    
    <button type="submit" class="btn btn-success btn-lg btn-block" name="foto">Enviar</button>

        </div>
		<div class="form-group">
        <?php

          date_default_timezone_set('America/Guayaquil');
          $hora_actual = date('H:i:s');
          $fecha_actual = date('d-m-Y');
         ?>
          <p>Hora actual: <?php echo $hora_actual; ?></p>
          <p>Fecha actual: <?php echo $fecha_actual; ?></p>
        </div>

    </form>

</div> 
    
    

      
    <div id="formulario2" style="display: none;">
        
    <form  method="post" enctype="multipart/form-data">
		<h2>Producto Existente</h2>
		<p class="hint-text"></p>
        <div class="form-group">
			<div class="row">
			
			</div>        	
        </div>
        <div class="form-group">
        </div>
        <div class="form-group">
        </div>
        
        
        <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad1" name="cantidad1" min="1" required>
    <br><br>
    
    <label for="precio">Precio:</label>
    <input type="number" id="precio1" name="precio1" step="0.01" min="0.01" required>
    <br><br>
    
    <label for="codigo">Material a utilizar:</label>
    <select id="codigo1" name="codigo1">

    <?php
         include ('conexion1.php');

        // Obtener códigos existentes desde la base de datos
        $sql = "SELECT ID,nombre,Unidades FROM inventario WHERE tipo='MATERIAL' ORDER BY nombre ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['ID'] . '">' . $row['nombre'] . '</option>';
                

            }
        }
        
        // Cerrar la conexión
        $conn->close();
        ?>

        
    
    
    </select>

    <script>
        const codigo1Select = document.getElementById('codigo1');
        const resultadoConsultaDiv = document.getElementById('resultado_consulta');

        codigo1Select.addEventListener('change', () => {
            const valorSeleccionado = codigo1Select.value;

            // Hacer una solicitud AJAX para obtener los resultados de la consulta
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `consulta.php?valor=${valorSeleccionado}`, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    resultadoConsultaDiv.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        });
    </script>
    <br><br>
    <label for="codigo">Persona encargada:</label>
    <select id="codigo2" name="codigo2">
    <?php
    include ('conexion1.php');

    // Imprimir la opción con el valor de $_SESSION["nombre"]
    echo '<option value="' . $_SESSION["id"] . '">' . $_SESSION["nombre"] . '</option>';

    // Cerrar la conexión
    $conn->close();
    ?>
</select>

    

    
    
	        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="submit2">Enviar</button>
        </div>
		<div class="form-group">
        <?php

          date_default_timezone_set('America/Guayaquil');
          $hora_actual = date('H:i:s');
          $fecha_actual = date('d-m-Y');
         ?>
          <p>Hora actual: <?php echo $hora_actual; ?></p>
          <p>Fecha actual: <?php echo $fecha_actual; ?></p>
        </div>
    </form>
    
</div>
   
    <div id="formulario3" >
        
    <form  method="post" enctype="multipart/form-data">
		<h2>Consultas Compra</h2>
		<p class="hint-text"></p>
        <div class="form-group">
			<div class="row">
			
			</div>        	
        </div>
        <div class="form-group">
        </div>
        <div class="form-group">
        </div>
        <div class="form-group">
        <label for="unidad">Selecciona la persona encarga del ingreso:</label>

        <select id="consulta" name="consulta">


       
        <?php
            include('conexion1.php');

            // Obtener nombres y apellidos desde la base de datos
            $sql = "SELECT DISTINCT codigo_usuario, nombre, apellido FROM compra INNER JOIN usuarios ON usuarios.id = compra.codigo_usuario INNER JOIN cargo ON usuarios.id_cargo = cargo.id ORDER BY codigo_usuario ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['codigo_usuario'] . '">' . $row['nombre'] . ' ' . $row['apellido'] . '</option>';
                }
            }

            // Cerrar la conexión
            $conn->close();
        ?>
    </select>
    <br>
    <br>
    <label for="unidad">Selecciona cuando realizo el ingreso:</label>

<select id="consulta2" name="consulta2">



<?php
    include('conexion1.php');

    // Obtener nombres y apellidos desde la base de datos
    $sql = "SELECT fechac,ID_compra FROM compra  ORDER BY fechac ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['ID_compra'] . '">' . $row['fechac'] . '</option>';
        }
    }

    // Cerrar la conexión
    $conn->close();
?>
</select>
    
        

        
    
    
    </select>
		</div>
		
    
		      
      
		<div class="form-group">


          </forn>
        
        </div>
        <div class="form-group">
        <button  class="btn btn-success btn-lg btn-block" name="submit3">Consultar</button>
        </div>
        
       

        
		<div class="form-group">
        <?php

          date_default_timezone_set('America/Guayaquil');
          $hora_actual = date('H:i:s');
          $fecha_actual = date('d-m-Y');
         ?>
          <p>Hora actual: <?php echo $hora_actual; ?></p>
          <p>Fecha actual: <?php echo $fecha_actual; ?></p>
          <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo compra </th>
                            <th>Persona encargada</th>
                            <th>Codigo del producto </th>
                            <th>Nombre del producto</th>
                            <th>Cantidad comprada </th>
                            <th>Precio unitario </th>
                            <th>Unidades</th>
                            <th>Fecha de la compra</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                      
                        <?php
                        if (isset($_POST['submit3'])) {
    
                            $consulta = $_POST['consulta'];
                            $consulta1=$_POST['consulta2'];
                            $condicion = "codigo_usuario = '$consulta'";
                            $condicionf="ID_compra='$consulta1'";
                            $ret = mysqli_query($con, "SELECT * FROM compra INNER JOIN usuarios ON usuarios.id=compra.codigo_usuario INNER JOIN inventario ON compra.codigo_inventario=inventario.ID WHERE $condicion and $condicionf ");
                            
                            $cnt = 1;
                            $row = mysqli_num_rows($ret);
                            if ($row > 0) {
                              
                                while ($row = mysqli_fetch_array($ret)) {
                                    // Obtener el ID de la fila actual
                                    $usuarioID = $row['ID_compra'];
                        ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['ID_compra']; ?></td>
                                        <th><?php echo $row['apellido'];?></th>
                                        <td><?php echo $row['codigo_inventario']; ?></td>
                                        <td><?php echo $row['nombre']; ?></td>
                                        <td><?php echo $row['cantidadc']; ?></td>
                                        <td><?php echo $row['precioc']; ?></td>
                                        <td><?php echo $row['Unidades']; ?></td>
                                        <td><?php echo $row['fechac']; ?></td>

                                    </tr>
                        <?php
                                    $cnt = $cnt + 1;
                                }
                            } 
                            else  {
                              $consulta = $_POST['consulta'];
                              $consulta1=$_POST['consulta2'];
                              $condicion = "codigo_usuario = '$consulta'";
                              $condicionf="ID_compra='$consulta1'";
                                $ret = mysqli_query($con, "SELECT * FROM compra INNER JOIN usuarios ON usuarios.id=compra.codigo_usuario  WHERE $condicion and $condicionf  ");
                                
                                $cnt = 1;
                                $row = mysqli_num_rows($ret);
                                


                                while ($row = mysqli_fetch_array($ret)) {
                                    // Obtener el ID de la fila actual
                                    $usuarioID = $row['ID_compra'];
                        ?>

                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['ID_compra']; ?></td>
                                        <th><?php echo $row['apellido'];?></th>
                                        <td>Primera Vez</td>
                                        <td><?php echo $row['nombrec']; ?></td>
                                        <td><?php echo $row['cantidadc']; ?></td>
                                        <td><?php echo $row['precioc']; ?></td>
                                        <td><?php echo $row['unidadesc']; ?></td>
                                        <td><?php echo $row['fechac']; ?></td>
                                    
                                    </tr>
                        <?php
                                    $cnt = $cnt + 1;
                                }

                                }
                       
                            }
                        

                        
                        mysqli_close($con);
                        ?>

                    </tbody>
                </table>
        </div>
    </form>


</div>
    </div>
    <a href="descargar_inserts.php" class="btn btn-primary">Descargar Ingreso de material</a>


    </div>
    </div>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
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
  <script>
        $(document).ready(function() {
            $('#consulta').select2({
                ajax: {
                    url: 'autocomplete.php', // Cambia esto a la URL de tu servidor
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: 'Selecciona un usuario',
                minimumInputLength: 1
            });
        });
    </script>

  <!-- Template Main JS File -->
  <script src="../js/main.js"></script>

</body>

</html>