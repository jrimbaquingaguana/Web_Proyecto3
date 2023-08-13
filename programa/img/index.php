<?php
//database connection file
include('dbconnection.php');
//Code for deletion
if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    $sql = mysqli_query($con, "UPDATE `productos` SET `p_activo`='0' Where ID= $rid ");
    echo "<script>window.location.href = 'index.php'</script>";
}
if (isset($_GET['activeid'])) {
    $rid = intval($_GET['activeid']);
    $sql = mysqli_query($con, "UPDATE `productos` SET `p_activo`='1' Where ID= $rid ");
    echo "<script>window.location.href = 'index.php'</script>";
}
if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    $sql = mysqli_query($con, "UPDATE `compras` SET `c_activo`='0' Where ID= $rid ");
    echo "<script>window.location.href = 'index.php'</script>";
}
if (isset($_GET['activeid'])) {
    $rid = intval($_GET['activeid']);
    $sql = mysqli_query($con, "UPDATE `compras` SET `c_activo`='1' Where ID= $rid ");
    echo "<script>window.location.href = 'index.php'</script>";
}

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
    <link rel="stylesheet" href="css/estiloindex.css">

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
                            <h2>Administrador de <b>Productos</b></h2>
                        </div>
                        <div class="col-sm-7" align="right">
                            <a href="insert.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i>
                                <span>Agregar Nuevo Producto</span></a>

                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo producto</th>
                            <th>Nombre producto</th>
                            <th>Costo producto</th>
                            <th>Stock producto</th>
                            <th>Unidades</th>
                            <th>Activo</th>
                            <th>Hora actual</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ret = mysqli_query($con, "SELECT * FROM productos");
                        $cnt = 1;
                        $row = mysqli_num_rows($ret);
                        if ($row > 0) {
                            while ($row = mysqli_fetch_array($ret)) {

                                // Obtener el estado activo de la fila actual
                                $activo = intval($row['p_activo']);
                                // Obtener el ID de la fila actual
                                $usuarioID = $row['ID'];

                                // Definir una variable para el estado en texto
                                $estado_texto = ($activo === 1) ? 'Activo' : 'Inactivo';

                                // Definir una clase para la fila según el estado
                                $fila_clase = ($activo === 1) ? '' : 'disabled-row';
                        ?>
                                <tr class="<?php echo $fila_clase; ?>">
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['p_codigo']; ?> 
                                    <td><img src="<?php echo $row['p_nombre']; ?>" width=80px $heigh=auto><td>
                                    <td><?php echo $row['p_costo']; ?></td>
                                    <td><?php echo $row['p_stock']; ?></td>
                                    
                                    <td><?php echo $estado_texto; ?></td>
                                    <td><?php echo $row['p_ingreso'];?></td>
                                    <td>
                                    <?php if ($activo === 1) : ?>
                                        <a href="php/read.php?viewid=<?php echo htmlentities($row['ID']); ?>" class="view" title="Ver" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                        <a href="php/edit.php?editid=<?php echo htmlentities($row['ID']); ?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                         <a href="index.php?delid=<?php echo ($row['ID']); ?>" class="delete" title="Desactivar" data-toggle="tooltip" onclick="return confirm('Desea desactivar?');"><i class="material-icons">&#xe9f5;</i></a>
                                          <!-- Agregar el enlace de borrado aquí -->
                                           <a href="php/delete.php?deleteid=<?php echo ($row['ID']); ?>" class="delete" title="Borrar" data-toggle="tooltip" onclick="return confirm('Desea borrar esta fila?');"><i class="material-icons">&#xe872;</i></a>
                                    <?php else : ?>
                                         <a href="php/read.php?viewid=<?php echo htmlentities($row['ID']); ?>" class="view" title="Ver" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
        							        <a href="index.php?activeid=<?php echo ($row['ID']); ?>" class="delete" title="Activar" data-toggle="tooltip" onclick="return confirm('Desea Activar?');"><i class="material-icons">&#xe9f6;</i></a>
                                           <a href="php/compras/delete.php?deleteid=<?php echo ($row['ID']); ?>" class="delete" title="Borrar" data-toggle="tooltip" onclick="return confirm('Desea borrar esta fila?');"><i class="material-icons">&#xe872;</i></a>
                                       <?php endif; ?>
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

    <script>
        $(document).ready(function() {
            // Función para cambiar el color de fondo de la fila cuando se hace clic en "Desactivar"
            $('a.delete').on('click', function() {
                var row = $(this).closest('tr');
                row.toggleClass('disabled-row');

                // Deshabilitar todos los botones excepto el botón "Activar" y "Ver" en la fila correspondiente
                if (row.hasClass('disabled-row')) {
                    row.find('a.edit, a.delete:not([title="Activar"])').attr('disabled', true);
                } else {
                    row.find('a.edit, a.delete:not([title="Activar"])').removeAttr('disabled');
                }
            });
        });
    </script>
   
   <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <h2>Administrador de <b>Compras</b></h2>
                        </div>
                        <div class="col-sm-7" align="right">
                            <a href="php/compras/insert.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i>
                                <span>Agregar Nueva Compra
                                </span></a>

                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Codigo producto</th>
                            <th>Costo compra del producto</th>
                            <th>Cantidad producto</th>
                            <th>unidad de la compra</th> 
                            <th>Activo</th>
                            <th>Hora de la compra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ret = mysqli_query($con, "SELECT * FROM compras");
                        $cnt = 1;
                        $row = mysqli_num_rows($ret);
                        if ($row > 0) {
                            while ($row = mysqli_fetch_array($ret)) {

                                // Obtener el estado activo de la fila actual
                                $activo = intval($row['c_activo']);
                                // Obtener el ID de la fila actual
                                $usuarioID = $row['ID'];

                                // Definir una variable para el estado en texto
                                $estado_texto = ($activo === 1) ? 'Activo' : 'Inactivo';

                                // Definir una clase para la fila según el estado
                                $fila_clase = ($activo === 1) ? '' : 'disabled-row';
                        ?>
                                <tr class="<?php echo $fila_clase; ?>">
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['p_codigo']; ?> 
                                    <td><?php echo $row['p_costoc']; ?></td>
                                    <td><?php echo $row['p_cantidad']; ?></td>
                                    <td><?php echo $row['unidadc']; ?></td>
                                    <td><?php echo $estado_texto; ?></td>
                                    <td><?php echo $row['p_fecha_compra'];?></td>
                                    <td>
                                    <?php if ($activo === 1) : ?>
                                            <a href="php/compras/read.php?viewid=<?php echo htmlentities($row['ID']); ?>" class="view" title="Ver" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                            <a href="php/compras/edit.php?editid=<?php echo htmlentities($row['ID']); ?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                            <a href="index.php?delid=<?php echo ($row['ID']); ?>" class="delete" title="Desactivar" data-toggle="tooltip" onclick="return confirm('Desea desactivar?');"><i class="material-icons">&#xe9f5;</i></a>
                                            <!-- Agregar el enlace de borrado aquí -->
                                            <a href="php/compras/delete.php?deleteid=<?php echo ($row['ID']); ?>" class="delete" title="Borrar" data-toggle="tooltip" onclick="return confirm('Desea borrar esta fila?');"><i class="material-icons">&#xe872;</i></a>
                                    <?php else : ?>
                                              <a href="php/compras/read.php?viewid=<?php echo htmlentities($row['ID']); ?>" class="view" title="Ver" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
        									<a href="index.php?activeid=<?php echo ($row['ID']); ?>" class="delete" title="Activar" data-toggle="tooltip" onclick="return confirm('Desea Activar?');"><i class="material-icons">&#xe9f6;</i></a>
                                            <a href="php/compras/delete.php?deleteid=<?php echo ($row['ID']); ?>" class="delete" title="Borrar" data-toggle="tooltip" onclick="return confirm('Desea borrar esta fila?');"><i class="material-icons">&#xe872;</i></a>
                                     <?php endif; ?>
                                    </td>
                                </tr>
                        <?php
                                $cnt = $cnt + 1;
                            }
                        } else {
                        ?>
                            <tr>
                                <th style="text-align:center; color:red;" colspan="6">No hay compras registradas </th>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>    
            </div>
        </div>
    </div>
                    </tbody>
                </table>

            </div>
        </div>
    </div>



   
    
</body>

</html>
