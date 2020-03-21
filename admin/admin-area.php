<?php 
  include_once 'funciones/sesiones.php';
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  include_once 'funciones/funciones.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Panel del Administrador
        <small>Panel de Control</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Resumen Estadistico</h3>
        </div>
        <div class="box-body">
           <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <?php
                        $query = "SELECT COUNT(id_admin) AS registros FROM admins";
                        $resultados = $conn->query($query);
                        $registrados = $resultados->fetch_assoc();
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo $registrados['registros'] ?></h3>

                            <p>Administradores</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <?php
                        $query = "SELECT COUNT(cliente_id) AS registros FROM clientes";
                        $resultados = $conn->query($query);
                        $registrados = $resultados->fetch_assoc();
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $registrados['registros'] ?></h3>

                            <p>Clientes</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-address-card"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <?php
                        $query = "SELECT COUNT(compra_id) AS registros FROM compras";
                        $resultados = $conn->query($query);
                        $registrados = $resultados->fetch_assoc();
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $registrados['registros'] ?></h3>

                            <p>Ordenes de Compras</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <?php
                        $query = "SELECT COUNT(id) AS registros FROM productos";
                        $resultados = $conn->query($query);
                        $registrados = $resultados->fetch_assoc();
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $registrados['registros'] ?></h3>

                            <p>Productos</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tags"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <?php
                        $query = "SELECT SUM(compra_precio) AS registros FROM compras";
                        $resultados = $conn->query($query);
                        $registrados = $resultados->fetch_assoc();
                    ?>
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>S/. <?php echo $registrados['registros'] ?></h3>

                            <p>Productos</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tags"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
           </div> 
           <!-- row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          HARDSHOES - Derecho Reservados
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php 
  include_once 'templates/footer.php';
?>
