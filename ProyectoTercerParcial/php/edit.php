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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Registro De Usuarios</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/editStyle.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="signup-form">
    <form  method="POST">
 <?php
$eid=$_GET['editid'];
$ret=mysqli_query($con,"select * from usuarios where ID='$eid'");
while ($row=mysqli_fetch_array($ret)) {
?>
		<h2>Actualizar </h2>
		<p class="hint-text">Actualiza tu información.</p>
        <div class="form-group">
			<div class="row">
				<div class="col"><input type="text" class="form-control" name="fname" value="<?php  echo $row['nombre'];?>" required="true"></div>
				<div class="col"><input type="text" class="form-control" name="lname" value="<?php  echo $row['apellido'];?>" required="true"></div>
			</div>        	
        </div>
        <div class="form-group">
        <textarea class="form-control" name="direccion" required="true"><?php  echo $row['direccion'];?></textarea>
    </div>
        <div class="form-group">
            <input type="text" class="form-control" name="contacto" value="<?php  echo $row['telefono'];?>" required="true" maxlength="10" pattern="[0-9]+">
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="usuario" value="<?php  echo $row['usuario'];?>" required="true">
        </div>

        <div class="form-group">
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
</body>
</html>
