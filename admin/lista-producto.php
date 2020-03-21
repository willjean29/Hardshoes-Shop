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
        Listado de Productos
        <small>Aqui poodras editar o borrar los productos</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manejo los productos en esta sección</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="registro" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="table-products">
                    <?php
                        try {
                            include_once 'funciones/funciones.php';
                            $query = "SELECT * FROM productos
                            ORDER BY id";
                            $resultados = $conn->query($query);
                        } catch (Exception $e) {
                            $error = $e->getMessage();
                            echo $error;
                        }
                        while ($producto = $resultados->fetch_assoc()) {?>
                          <tr>
                            <td><?php echo $producto['sku'] ?></td>
                            <td><?php echo $producto['nombre'] ?></td>
                            <td>
                              <img src="../assets/fotos/<?php echo $producto['imagen'] ?>" alt="">
                            </td>
                            <td><?php echo $producto['precio'] ?></td>
                            <td><?php echo $producto['stock']?></td>
                            <td>
                              <a href="editar-producto.php?id=<?php echo $producto['id'] ?>" class="btn bg-orange btn-flat margin"> <i class="fa fa-pencil"></i> </a>
                              <a href="#" data-id="<?php echo $producto['id'] ?>" data-tipo="producto" class="btn bg-maroon btn-flat margin borrar-registro"> <i class="fa fa-trash"></i> </a>
                            </td>
                          </tr>
                    <?php } ?>
                
                </tbody>
                <tfoot>
                <tr>
                    <th>SKU</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Stock</th>
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
