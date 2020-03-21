<!-- Navbar -->
<div class="w-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="<?php echo URL.'index.php'; ?>"><i class="fas fa-shoe-prints"></i> HARDSHOES </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
              data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="<?php echo URL.'index.php'; ?>"> Inicio <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL.'admin/login.php'; ?>"> Admi.</a>
                  </li>
                </ul>

              <?php
                $archivo = basename($_SERVER['PHP_SELF']);
                $pagina = str_replace('.php',"",$archivo);
                if($pagina != "login"){?>
                <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="text" placeholder="Buscar...">
                  <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
                </form>
               <?php }?>
            </div>
        </nav>     
</div>
<!-- END Navbar -->