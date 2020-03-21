  <?php 
    require_once '../app/config.php' ;
    if(isset($_GET['cerrar_sesion'])){
      $cerrar_sesion = $_GET['cerrar_sesion'];
      if($cerrar_sesion == 'true'){
        session_destroy();
      }
    }

    include_once 'funciones/funciones.php' ;
    include_once '../includes/inc_header.php'; 
    include_once '../includes/inc_navbar.php'; 
  ?>
  
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
          <img class="direct" src="../assets/images/director.png"  />  
        </div>

        <!-- Login Form -->
        <form role="form" name="login-admin-form" id="login-admin" method="POST" action="login-admin.php">
          <label for="login">Usuario: </label>
          <span class=""><i class="fas fa-user"></i></span>
          <input type="text" id="login" class="fadeIn second" name="usuario" placeholder="Usuario">
          
          <label for="password">Contraseña: </label>
          <span class=""><i class="fas fa-key"></i></span>
          <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
          <input type="hidden" name="registro" value="login">
          <input type="submit" class="fadeIn fourth" value="Ingresar"> 

        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
          <a class="underlineHover" href="#">¿Olvidaste la contraseña?</a>
        </div>

      </div>
    </div>
  
<?php require_once '../includes/inc_footer.php' ?>