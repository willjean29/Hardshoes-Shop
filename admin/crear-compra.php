<?php
  include_once 'funciones/sesiones.php'; 
  include_once 'funciones/funciones.php';
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Craer Compra
        <small>Llene el formulario para crear una Compra</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Compra</h3>
                    </div>
                    <div class="box-body">
                        <!-- form start -->
                        <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-compra.php">
                            <div class="box-body">
                            <div class="form-group">
                                    <label for="nombre">Cliente:</label>
                                    <select name="cliente" id="cliente" class="form-control seleccionar" data-placeholder="Seleccione un Cliente">
                                        <option value="0">- Seleccione -</option>  
                                        <?php
                                            try {
                                                $query = "SELECT * FROM clientes";
                                                $resultados = $conn->query($query);
                                                while ($cliente = $resultados->fetch_assoc()) {?>
                                                   <option value="<?php echo $cliente['cliente_id'] ?>"><?php echo $cliente['cliente_nombre'] ?></option>
                                        <?php   }
                                            } catch (Exception $e) {
                                                echo "Error ".$e->getMessage();
                                            }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="precio">Precio Total:</label>
                                    <input type="text" class="form-control" id="precio" name="precio"  placeholder="Precio de Compra">
                                </div>
                                <div class="form-group">
                                    <label for="fecha">Fecha de Compra:</label>
                                    <input type="text" class="form-control" id="fecha" name="fecha"  placeholder="Fecha de Compra">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="registro" value="nuevo">
                                <button type="submit" class="btn btn-primary" name="submit" id="crear_compra">Registrar</button>
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
