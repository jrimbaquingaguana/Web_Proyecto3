<?php 
//Databse Connection file
include('dbconnection.php');
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

          $query=mysqli_query($con, "INSERT INTO productos (p_nombre) VALUES ('$imagen')");
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

</head>
<body>
<div class="signup-form">
    <form  method="post" enctype="multipart/form-data">
		<h2>Productos</h2>
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
	<div class="text-center">View Aready Inserted Data!!  <a href="index.php">View</a></div>
</div>
 <script>
        function esNumeroFloat(valor) {
  // Expresión regular para validar números decimales
  const regexNumeroFloat = /^[+-]?([0-9]*[.])?[0-9]+$/;

  // Comprobar si el valor coincide con el formato de número decimal
  return regexNumeroFloat.test(valor);
            
}

        </script>
</body>
</html>