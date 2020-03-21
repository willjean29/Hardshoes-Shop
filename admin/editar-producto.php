<?php
  include_once 'funciones/sesiones.php'; 
  include_once 'funciones/funciones.php';
  include_once 'templates/header.php';
  $id = $_GET['id'];
  if(!filter_var($id,FILTER_VALIDATE_INT)){
      die('Error!');
  }
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Producto
        <small>Llene el formulario para editar un producto</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Registrar Producto</h3>
                    </div>
                    <div class="box-body">
                        <?php
                            $query = "SELECT * FROM productos WHERE id = $id";
                            $resultado = $conn->query($query);
                            $producto = $resultado->fetch_assoc();
                        ?>
                        <!-- form start -->
                        <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="POST" action="modelo-producto.php">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="usuario">Código SKU:</label>
                                    <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" value="<?php echo $producto['sku'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Producto" value="<?php echo $producto['nombre'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="foto">Imagen de Producto:</label>
                                    <input type="file" class="form-control-file" id="foto" name="foto" required>
                                </div>

                                <div class="form-group">
                                    <label for="precio">Precio:</label>
                                    <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio Producto" value="<?php echo $producto['precio'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock:</label>
                                    <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock Producto" min="1" max="30" value="<?php echo $producto['stock'] ?>">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="registro" value="actualizar">
                                <input type="hidden" name="id_registro" value="<?php echo $id; ?>"> 
                                <button type="submit" class="btn btn-primary" id="crear_evento" name="submit" >Registrar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->  
        </div>
    </div>

  </div>
  <!-- /.content-wrapper -->

<?php 
  include_once 'templates/footer.php';

?>
