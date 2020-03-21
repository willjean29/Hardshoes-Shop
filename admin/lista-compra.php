<?php 
  include_once 'funciones/sesiones.php';
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Listado de Compras
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manejo las compras en esta sección</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="registro" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha Compra</th>
                        <th>Precio Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="table-compras">
                    <?php
                        try {
                            include_once 'funciones/funciones.php';
                            $query = "SELECT * FROM compras";
                            $resultados = $conn->query($query);
                        } catch (Exception $e) {
                            $error = $e->getMessage();
                            echo $error;
                        }
                        while ($compra = $resultados->fetch_assoc()) {?>
                          <tr>
                            <td>                            
                              <button type="button" class="btn btn-primary compra-id" data-toggle="modal" data-target="#compra-detalle" data-id="<?php echo $compra['compra_id'] ?>">
                                <?php echo $compra['compra_id'] ?>
                              </button>
                            </td>
                            <?php
                                $clienteID = $compra['cliente_id'];
                                $query = "SELECT cliente_nombre FROM clientes WHERE cliente_id = $clienteID";
                                $resultado = $conn->query($query);
                                $cliente = $resultado->fetch_assoc();
                                $fechaFormateada = date('d-m-Y',strtotime($compra['compra_fecha']));
                            ?>
                            <td><?php echo $cliente['cliente_nombre'] ?></td>
                            <td><?php echo $fechaFormateada ?></td>
                            <td><?php echo $compra['compra_precio'] ?></td>
                            <td>
                              <a href="editar-compra.php?id=<?php echo $compra['compra_id'] ?>" class="btn bg-orange btn-flat margin"> <i class="fa fa-pencil"></i> </a>
                              <a href="#" data-id="<?php echo $compra['compra_id'] ?>" data-tipo="compra" class="btn bg-maroon btn-flat margin borrar-registro"> <i class="fa fa-trash"></i> </a>
                            </td>
                          </tr>
                          
                        
                    <?php } ?>
                
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha Compra</th>
                    <th>Precio Total</th>
                    <th>Acciones</th>
                </tr>
                </tfoot>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="compra-detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Detalles de la compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="registro" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID-Compra</th>
                        <th>ID-Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody id="table-products" class="modal-productos">

                </tbody>
                <tfoot>
                  <tr>
                    <th>ID-Compra</th>
                    <th>ID-Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                  </tr>
                </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php 
  include_once 'templates/footer.php';
?>
