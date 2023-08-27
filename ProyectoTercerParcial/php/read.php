<?php
include('dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Registro De Usuarios</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/readStyle.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2><b>Detalles de usuario</b></h2>
                    </div>
                     
                </div>
            </div>
<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
               
<tbody>
<?php
$vid=$_GET['viewid'];
$ret=mysqli_query($con,"select * from usuarios where ID =$vid");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
 <tr>
    <th>ID</th>
    <td><?php  echo $row['id'];?></td>
    <th>Nombre y Apellido</th>
    <td><?php  echo $row['nombre'];?> <?php  echo $row['apellido'];?></td>
  </tr>
  <tr>
    <th>Dirección</th>
    <td><?php  echo $row['direccion'];?></td>
    <th>Teléfono</th>
    <td><?php  echo $row['telefono'];?></td>
  </tr>
  <tr>
    <th>Usuario</th>
    <td><?php  echo $row['usuario'];?></td>
    <th>Cargo</th>
    <td><?php
        if($row['id_cargo']==1){
            echo "Administrador";
        }else if($row['id_cargo']==2){
            echo "Bodeguero";
        }else {
            echo "Productor";
        }?></td>
  </tr>
  <tr>
    <th>Estado</th>
    <td>
    <?php if ($row['Active'] == 0) {
        echo 'Inactivo';
    } else {
        echo 'Activo';
    }?>
</td>

  </tr>
<?php 
$cnt=$cnt+1;
}?>
                 
</tbody>
</table>
       
        </div>
    </div>
    <a href="usersCrud.php">REGRESAR</a>
</div>     
</body>
</html>