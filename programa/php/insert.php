<?php 
//Databse Connection file
include('dbconnection.php');

if (isset($_POST['submit2'])) {
    $servername = "localhost";
    $username = "jose";
    $password = "040500";
    $dbname = "proyecto_web";
    
    // Obtener el valor a sumar desde el formulario
    $valorNuevo = $_POST['cantidad1'];
    $valorPrecio = $_POST['precio1'];
    $valorEscogido=$_POST['codigo1'];

    
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Obtener el valor existente desde la base de datos
    $sql = "SELECT cantidad,precio FROM inventario WHERE ID = $valorEscogido"; // Cambiar esto al ID correcto
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $valorPrecio1 = $row['precio'];
        $valorCantidad = $row['cantidad'];
        
        // Calcular la suma
        $sumaTotalCantidad = $valorCantidad + $valorNuevo;
        $sumaTotalPrecio= $valorPrecio1+$valorPrecio;
        
        // Actualizar la base de datos con el nuevo valor
        $sqlActualizar = "UPDATE inventario SET cantidad = $sumaTotalCantidad, precio = $sumaTotalPrecio WHERE ID = $valorEscogido";
        
        if ($conn->query($sqlActualizar) === TRUE) {
        } else {
            echo "Error al actualizar la base de datos: " . $conn->error;
        }
    } else {
        echo "No se encontraron valores en la base de datos.";
    }
        // Cerrar la conexión
        $conn->close();
}
$imagen='';
    if(isset($_FILES["foto"])){
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

          $query=mysqli_query($con, "INSERT INTO inventario (foto) VALUES ('$imagen')");
          if ($query) {
          echo "<script>alert('You have successfully inserted the data');</script>";
          echo "<script type='text/javascript'> document.location ='index.php'; </script>";
        }
  
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">


<title>Insertar Usuarios!</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/estiloinsert.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/insert.js"></script>

</head>
<body>
<div class="signup-form">
<h1>Selección de Formulario</h1>
    <select id="opcion" onchange="mostrarFormulario()">
    <option value="default">Selecciona una opción</option>
        <option value="opcion1">Comprar producto nuevo</option>
        <option value="opcion2">Comprar producto existente</option>
        <option value="opcion3"selected >Consultar compra</option>

    </select>
    
    <div id="formulario1" style="display: none;">
        
    <form  method="post" enctype="multipart/form-data">
		<h2>Comprar</h2>
		<p class="hint-text">Fill below form.</p>
        <div class="form-group">
			<div class="row">
			
			</div>        	
        </div>
        <div class="form-group">
        </div>
        <div class="form-group">
        </div>
        <div class="form-group">
			<label for="unidades">Seleccione una unidad de medida:</label>
			
		</div>
		
    
		      
      
		<div class="form-group">
    <input type="file" name="foto"><br><br>
	<input type="submit" value="Guardar">
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
		<h2>Comprar</h2>
		<p class="hint-text">Fill below form.</p>
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
    
    <label for="codigo">Selecciona un Código:</label>
    <select id="codigo1" name="codigo1">

    <?php
        $servername = "localhost";
        $username = "jose";
        $password = "040500";
        $dbname = "proyecto_web";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Obtener códigos existentes desde la base de datos
        $sql = "SELECT ID,nombre FROM inventario";
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
		<h2>Comprar</h2>
		<p class="hint-text">Fill below form.</p>
        <div class="form-group">
			<div class="row">
			
			</div>        	
        </div>
        <div class="form-group">
        </div>
        <div class="form-group">
        </div>
        <div class="form-group">
        <label for="numero">Ingresa un número:</label>
        <input type="text" id="numero" name="consulta" oninput="validarNumeros(event)">
		</div>
		
    
		      
      
		<div class="form-group">
   
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
                            <th>Codigo del producto </th>
                            <th>Nombre del producto</th>
                            <th>Cantidad comprada </th>
                            <th>Precio unitario </th>
                            <th>Fecha de la compra</th>
                            <th>Persona que compro</th>
                            <th>Rol de la persona</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['submit3'])) {
                            $consulta = $_POST['consulta'];
                            $condicion = "ID_compra = '$consulta'";
                            $ret = mysqli_query($con, "SELECT * FROM compra INNER JOIN usuarios ON usuarios.id_usuario=compra.codigo_usuario INNER JOIN inventario ON compra.codigo_usuario=inventario.id");
                            
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
                                        <td><?php echo $row['codigo_inventario']; ?></td>
                                        <td><?php echo $row['nombre']; ?></td>
                                        <td><?php echo $row['cantidadc']; ?></td>
                                        <td><?php echo $row['precioc']; ?></td>
                                        <td><?php echo $row['fechac']; ?></td>
                                        <td><?php echo $row['nombreu']; ?></td>
                                        <td><?php echo $row['rol']; ?></td>

                                    </tr>
                        <?php
                                    $cnt = $cnt + 1;
                                }
                            } else {
                        ?>
                                <tr>
                                    <td colspan="6" style="text-align:center; color:red;">No hay productos registrados</td>
                                </tr>
                        <?php
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


    </div>
    </div>
</body>
</html>