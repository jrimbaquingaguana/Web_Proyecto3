<?php
//database connection file
include('dbconnection.php');
//Code for deletion


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tabla Usuarios</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/estiloindex.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
    /* Estilo para las filas desactivadas */
    .disabled-row {
        background-color:blue !important;
        color:red !important;

    }
</style>

</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <h2>Administrador de <b>Inventario</b></h2>
                        </div>
                        
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo </th>
                            <th>Nombre </th>
                            <th>Cantidad </th>
                            <th>Precio unitario </th>
                            <th>Precio promedio</th>
                            <th>Fecha de la ultima compra</th>
                            <th>Unidades</th>
                            <th>Foto</th> 
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ret = mysqli_query($con, "SELECT * FROM inventario");
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
                                    
                                        <a href="php/read.php?viewid=<?php echo htmlentities($row['ID']); ?>" class="view" title="Ver" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                                                                                         
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

            </div>
        </div>
    </div>

    
   



   
    
</body>

</html>
