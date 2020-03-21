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
        Listado de Clientes
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manejo los clientes en esta sección</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="registro" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tarjeta</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="table-clientes">
                    <?php
                        try {
                            include_once 'funciones/funciones.php';
                            $query = "SELECT * FROM clientes";
                            $resultados = $conn->query($query);
                        } catch (Exception $e) {
                            $error = $e->getMessage();
                            echo $error;
                        }
                        while ($cliente = $resultados->fetch_assoc()) {?>
                          <tr>
                            <td><?php echo $cliente['cliente_id'] ?></td>
                            <td><?php echo $cliente['cliente_nombre'] ?></td>
                            <td><?php echo $cliente['cliente_num'] ?></td>
                            <td><?php echo $cliente['cliente_email'] ?></td>
                            <td>
                              <a href="editar-cliente.php?id=<?php echo $cliente['cliente_id'] ?>" class="btn bg-orange btn-flat margin"> <i class="fa fa-pencil"></i> </a>
                              <a href="#" data-id="<?php echo $cliente['cliente_id'] ?>" data-tipo="cliente" class="btn bg-maroon btn-flat margin borrar-registro"> <i class="fa fa-trash"></i> </a>
                            </td>
                          </tr>
                          
                        
                    <?php } ?>
                
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tarjeta</th>
                    <th>Email</th>
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

<?php 
  include_once 'templates/footer.php';
?>
