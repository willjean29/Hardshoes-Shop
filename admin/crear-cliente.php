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
        Craer Cliente
        <small>Llene el formulario para crear un cliente</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Cliente</h3>
                    </div>
                    <div class="box-body">
                        <!-- form start -->
                        <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-cliente.php">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre ">
                                </div>
                                <div class="form-group">
                                    <label for="tarjeta">N° Tarjeta:</label>
                                    <input type="text" class="form-control" id="tarjeta" name="tarjeta"  placeholder="Número de Tarjeta - 16 digitos">
                                </div>
                                <div class="form-group">
                                    <label for="fechas">Fecha Vencimiento:</label>
                                    <input type="text" class="form-control" id="fechas" name="fechas"  placeholder="12/24">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email"  placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">CVC:</label>
                                    <input type="password" class="form-control" id="password"  name="password" placeholder="CVC para la tarjeta">
                                </div>
                                <div class="form-group">
                                    <label for="repetir_password">Repetir CVC:</label>
                                    <input type="password" class="form-control" id="repetir_password"  name="repetir_password" placeholder="CVC de la tarjeta">
                                    <span id="resultado_password" class="help-block"></span>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="registro" value="nuevo">
                                <button type="submit" class="btn btn-primary" name="submit" id="crear_registro">Registrar</button>
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
