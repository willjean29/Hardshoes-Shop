  <?php
    if(isset($_SESSION['usuario'])){
      $usuario =$_SESSION['nombre'];
    }else{
      $usuario = 'admin';
    }
    include_once 'funciones/funciones.php';
  ?>
  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left info">
          <p><?php echo $usuario ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu de Administración</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard.php"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
          </ul>
        </li>

        <li class="treeview">
          <?php
            $query = "SELECT COUNT(id) AS registros FROM productos";
            $resultados = $conn->query($query);
            $registrados = $resultados->fetch_assoc();
          ?>
          <a href="#">
            <i class="fa fa-tags" aria-hidden="true"></i>
            <span>Productos</span>
            <span class="pull-right-container">
              <span class="label bg-primary pull-right "><?php echo $registrados['registros'] ?></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-producto.php"><i class="fa fa-list-ul"></i>Ver Todos</a></li>
            <li><a href="crear-producto.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
          </ul>
        </li>

        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Categoria Productos</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-list-ul"></i>Ver Todos</a></li>
            <li><a href="#"><i class="fa fa-plus-circle"></i> Agregar</a></li>
          </ul>
        </li> -->

        <li class="treeview">
          <?php
              $query = "SELECT COUNT(compra_id) AS registros FROM compras";
              $resultados = $conn->query($query);
              $registrados = $resultados->fetch_assoc();
          ?>
          <a href="#">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span>Ordenes de Compra</span>
            <span class="pull-right-container">
              <span class="label bg-red pull-right"><?php echo $registrados['registros'] ?></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-compra.php"><i class="fa fa-list-ul"></i>Ver Todos</a></li>
            <li><a href="crear-compra.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
          </ul>
        </li>

        <li class="treeview">
          <?php
              $query = "SELECT COUNT(cliente_id) AS registros FROM clientes";
              $resultados = $conn->query($query);
              $registrados = $resultados->fetch_assoc();
          ?>
          <a href="#">
            <i class="fa fa-address-card"></i>
            <span>Clientes</span>
            <span class="pull-right-container">
              <span class="label bg-yellow pull-right"><?php echo $registrados['registros'] ?></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-cliente.php"><i class="fa fa-list-ul"></i>Ver Todos</a></li>
            <li><a href="crear-cliente.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
          </ul>
        </li>
        <?php if($_SESSION['nivel'] == 1): ?>
        <li class="treeview">
          <?php
            $query = "SELECT COUNT(id_admin) AS registros FROM admins";
            $resultados = $conn->query($query);
            $registrados = $resultados->fetch_assoc();
          ?>
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Administradores</span>
            <span class="pull-right-container">
              <span class="label bg-aqua pull-right"><?php echo $registrados['registros'] ?></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-admin.php"><i class="fa fa-list-ul"></i>Ver Todos</a></li>
            <li><a href="crear-admin.php"><i class="fa fa-plus-circle"></i> Agregar</a></li>
          </ul>
        </li>
        <?php endif ?>
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-comments"></i>
            <span>Testimoniales</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-list-ul"></i>Ver Todos</a></li>
            <li><a href="#"><i class="fa fa-plus-circle"></i> Agregar</a></li>
          </ul>
        </li> -->

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->