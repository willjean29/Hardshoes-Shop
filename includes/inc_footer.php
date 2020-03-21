<!-- footer -->
<footer class="page-footer font-small bg-secondary pt-4">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Social buttons -->
    <ul class="list-unstyled list-inline text-center">
      <li class="list-inline-item">
        <a class="btn-floating btn-fb mx-1 text-light bg-dark">
          <i class="fab fa-facebook-f"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-tw mx-1 text-light bg-dark">
          <i class="fab fa-twitter"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-gplus mx-1 text-light bg-dark">
          <i class="fab fa-google-plus-g"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-li mx-1 text-light bg-dark">
          <i class="fab fa-linkedin-in"> </i>
        </a>
      </li>
      <li class="list-inline-item">
        <a class="btn-floating btn-dribbble mx-1 text-light bg-dark">
          <i class="fab fa-dribbble"> </i>
        </a>
      </li>
    </ul>
    <!-- Social buttons -->

  </div>
  <!-- Footer Elements -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 text-light ">© 2019 :
    <a class ="text-light ">  Plataforma HARDSHOES</a>
  </div>
  <!-- Copyright -->

</footer>
    <!-- END footer -->

    <!-- jQuery de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Sweet alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>


    <!-- waitMe -->

    <?php
        $archivo = basename($_SERVER['PHP_SELF']);
        $pagina = str_replace('.php',"",$archivo);
        if($pagina !== "login"){
          echo '<script src="assets/plugins/waitMe/waitMe.min.js"></script>';
          echo '<script src="assets/js/app.js"></script>';
        }else{
          echo '<script src="../admin/js/login-ajax.js"></script>';
        }
    ?>


<!-- Main script -->
<!-- <script src="assets/js/main.js"></script> -->


</body>
</html>