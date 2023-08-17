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
    $codigo_Usuario=$_POST['codigo2'];
    

    
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
        $sumaTotalPrecio= ($valorPrecio1+$valorPrecio)/2;
        
        // Actualizar la base de datos con el nuevo valor
        $sqlActualizar = "UPDATE inventario SET cantidad = $sumaTotalCantidad, precio_promedio = $sumaTotalPrecio WHERE ID = $valorEscogido";

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
        $query=mysqli_query($con, "insert into compra(codigo_usuario,codigo_inventario, cantidadc, precioc) value('$codigo_Usuario','$valorEscogido', '$valorNuevo', '$valorPrecio')");
        
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
      $uni=$_POST['unidad'];
      $nombre1=$_POST["nombre"];
      $cantidad=$_POST["cantidad4"];
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
            
            $query=mysqli_query($con, "INSERT INTO inventario (nombre,cantidad,precio,foto,Unidades) VALUES ('$nombre1','$cantidad','$precio','$imagen','$uni')");
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
    
        <option value="opcion1">Comprar producto nuevo</option>
        <option value="opcion2">Comprar producto existente</option>
        <option value="opcion3"selected >Consultar compra</option>

    </select>
    
    <div id="formulario1" style="display: none;">
        
    <form  method="post" enctype="multipart/form-data" onsubmit="return validarNombre()">
		<h2>Comprar</h2>
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
    <input type="file" name="foto"><br><br>
    <label for="codigo">Selecciona la persona encargada de comprar el producto:</label>
    <select id="codigo2" name="codigo2">

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
        $sql = "SELECT id_usuario,nombreu FROM usuarios WHERE rol='Comprador' or rol='Administrador' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id_usuario'] . '">' . $row['nombreu'] . '</option>';
            }
        }

        // Cerrar la conexión
        $conn->close();
        ?>
        

        
    
    
    </select>
    <br>
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
    
    <label for="codigo">Selecciona un Código del material:</label>
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
        $sql = "SELECT ID,nombre,Unidades FROM inventario";
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
    <label for="codigo">Selecciona la persona encargada de comprar el producto:</label>
    <select id="codigo2" name="codigo2">

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
        $sql = "SELECT id_usuario,nombreu FROM usuarios WHERE rol='Comprador' or rol='Administrador' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id_usuario'] . '">' . $row['nombreu'] . '</option>';
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
        <label for="unidad">Selecciona un codigo de compra:</label>

        <select id="consulta" name="consulta">


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
        $sql = "SELECT ID_compra FROM compra ORDER BY ID_compra ASC ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['ID_compra'] . '">' . $row['ID_compra'] . '</option>';
            }
        }

        // Cerrar la conexión
        $conn->close();
        ?>
        

        
    
    
    </select>
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
                            <th>Unidades</th>
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
                            $ret = mysqli_query($con, "SELECT * FROM compra INNER JOIN usuarios ON usuarios.id_usuario=compra.codigo_usuario INNER JOIN inventario ON compra.codigo_usuario=inventario.id WHERE $condicion ");
                            
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
                                        <td><?php echo $row['Unidades']; ?></td>
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