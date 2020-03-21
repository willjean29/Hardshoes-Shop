<?php require_once 'includes/inc_header.php' ?>
<?php require_once 'includes/inc_navbar.php' ?>

<!-- Content -->
<?php require_once 'app/db_conexion.php'; ?>
<?php 
  $query = "SELECT * FROM productos";
  $resultados = $conn->query($query);
  
?>
<div class="container-fluid py-5">
      <div class="row">
        <div class="col-xl-7">
          <h1><strong>Productos</strong></h1>
          <div class="row" id="lista-productos">
            <?php while($p = $resultados->fetch_assoc()){ $p['precio'] = (float) $p['precio'] ?>
            <div class="col-4 mb-3">
              <div class="card" id="product-card">
                <img src="<?php echo IMAGES.$p['imagen']?>" alt="<?php echo $p['nombre']; ?>" class="card-img-top">
                <div class="card-body p-2">
                  <h5 class="card-title text-truncate" id="title"><?php echo $p['nombre']?></h5>
                  <h5 id="sku" style="display: none;"><?php echo $p['sku']; ?></h5>
                  <p class="text-success" id="price"><?php echo format_currency($p['precio']); ?></p>
                  <?php if((int)$p['stock'] <= 1) {?>
                    <button class="btn btn-sm btn-primary do_add_to_cart" data-toggle="tooltip" title= "Agregar al carrito" id="btn-comprar" data-cantidad="1" data-id="<?php echo $p['id'] ?>" disabled><i class="fas fa-plus"> Agregar al carrito</i></button>
                  <?php } else { ?>
                  <button class="btn btn-sm btn-primary do_add_to_cart" data-toggle="tooltip" title= "Agregar al carrito" id="btn-comprar" data-cantidad="1" data-id="<?php echo $p['id'] ?>"><i class="fas fa-plus"> Agregar al carrito</i></button>
                  <?php } ?>
                </div>
              </div>
            </div>
            <?php }  ?>
            

          </div>
        </div>
        <div class="col-xl-5 bg-light">
          <h1> <i class="fas fa-clipboard-list"></i> Lista de compra</h1>
              <div class="div" id="wraper">
                <!-- Cart content -->
                <div class="table-responsive" id="tabla-productos">
                  <!-- <table class="table table-hover table-striped table-sm" id="table-loader">
                    <thead id="table-head">
                      <tr>
                        <th>Producto</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-right">Total</th>
                        <th class="text-right"></th>
                      </tr>
                    </thead>
                    <tbody id="table-body"> -->
                      <!-- Contenido del carrito -->
<!--       
                    </tbody>
                  </table> -->
                </div>
                <button class="btn btn-sm btn-danger do_destroy_cart" id="btn-clear">Cancelar compra</button>
                <br><br>
                <!-- END Cart Content -->

                <!-- Cart totals -->
                <table class="table" id="table-pay">
                  <!-- <tr>
                    <th class="border-0">Subtotal</th>
                    <td class="text-primary text-right border-0">S/. 0</td>
                  </tr>
                  <tr>
                    <th>Envio</th>
                    <td class="text-primary text-right">S/. <?php //echo SHIPPING_COST; ?></td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <td class="text-primary text-right "><h3 class="font-weight-bold">S/. 0</h3></td>
                  </tr> -->
                </table>
                <!-- END Cart totals -->


                <!-- Payment form -->
                <form id="do_pay" method="POST" action="ajax.php">
                  <h4>Completa el formulario</h4>
                  <div class="form-group">
                    <label for="card_name">Nombre del titular</label>
                    <input type="text" id="card_name" class="form-control" name="card_name" placeholder="John Doe">
                  </div>
                  <div class="form-group row">
                    <div class="col-xl-6">
                      <label for="card_number">Número en la tarjeta</label>
                      <input type="text" id="card_number" class="form-control" name="card_number" placeholder="5755 6258 4875 6895">
                    </div>
                    <div class="col-xl-3">
                      <label for="card_date">MM/AA</label>
                      <input type="text" id="card_date" class="form-control" name="card_date" placeholder="12/24">
                    </div>
                    <div class="col-xl-3">
                      <label for="card_cvc">CVC</label>
                      <input type="text" id="card_cvc" class="form-control" name="card_cvc" placeholder="568">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="card_email">E-mail</label>
                    <input type="email" id="card_email" class="form-control" name="card_email" placeholder="jslocal@localhost.com">
                  </div>
                  <button type="submit" class="btn btn-success btn-lg btn-block btn-pay"><b>Pagar ahora</b></button>
                </form>
                <!-- END Payment form -->
              </div>

        </div>
      </div>
</div>
    <!-- END Content -->  
<?php require_once 'includes/inc_footer.php' ?>