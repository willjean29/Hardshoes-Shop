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
        Editar Administrador
        <small>Llene el formulario para editar un administrador</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Administrdor</h3>
                    </div>
                    <div class="box-body">
                        <?php 
                            $query = "SELECT * FROM admins WHERE id_admin = $id";
                            $resultado = $conn->query($query);
                            $admin = $resultado->fetch_assoc();
                        ?>
                        <!-- form start -->
                        <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-admin.php">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario " value="<?php echo $admin['usuario'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Tu Nombre Completo" value="<?php echo $admin['nombre'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password"  name="password" placeholder="Password para Iniciar Sesión">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="registro" value="actualizar"> 
                                <input type="hidden" name="id_registro" value="<?php echo $id; ?>"> 
                                <button type="submit" class="btn btn-primary" name="submit">Registrar</button>
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
