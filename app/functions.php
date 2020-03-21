<?php 

function get_product_by_id($id) {
  include('db_conexion.php');
  $id = (int)$id;
  try {
    $query = "SELECT * FROM productos WHERE id = $id";
    $resultado = $conn->query($query);
    $producto = $resultado->fetch_assoc();
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  return $producto;
}


// render_view(carrito_view)
function render_view($view , $data = []) {
  if(!is_file(VIEWS.$view.'.php')) {
    //si no existe la vista, yo quiero que hagas esto:
    echo 'No existe la vista '.$view;
    die;
  }
  
  require_once VIEWS.$view.'.php';
}


function format_currency($number, $symbol = 'S/.') {
  if(!is_float($number) && !is_integer($number)) {
    $number = 0;
  }

  return $symbol.number_format($number,2,'.',',');
}
// --------------------------------------
//
// FUNCIONES DEL CARRITO
//
// --------------------------------------
function get_cart() {
  // Products
  // - ID
  // - SKU
  // - IMAGEN
  // - NOMBRE
  // - PRECIO
  // - CANTIDAD
  // Total products
  // Subtotal
  // Shipment
  // Total
  // Payment url
  if(isset($_SESSION['car'])) {
    $_SESSION['car']['car_totals'] = calculate_cart_totals();
    return $_SESSION['car'];
  }

  $car =
  [
    'products'       => [],
    'car_totals'    => calculate_cart_totals(),
    'payment_url'    => NULL
  ];

  $_SESSION['car'] = $car;
  return $_SESSION['car'];
}

function calculate_cart_totals(){
  // El carro no existe, se inicializa
  // Si no hay productos aun pero el carrito si existe ya
  if(!isset($_SESSION['car']) || empty($_SESSION['car']['products'])) {
    $car_totals =
    [
      'subtotales'       => 0,
      'shipment'       => 0,
      'total'          => 0
    ];
    return $car_totals;
  }
  
  // Calcular los totales según los products en carrito
  $subtotal = 0;
  $shipment = SHIPPING_COST;
  $total    = 0;

  // Si ya hay productos hay que sumar las cantidades
  foreach ($_SESSION['car']['products'] as $p) {
    $_total = floatval((int)$p['cantidad'] * (float)$p['precio']);
    $subtotal = floatval($subtotal + $_total);
  }

  $total = floatval($subtotal + $shipment);  
  $car_totals =
  [
    'subtotal'       => $subtotal,
    'shipment'       => $shipment,
    'total'          => $total
  ];
  return $car_totals;
}

function add_to_cart($id_producto , $cantidad = 1) {
  $new_product =
  [
    'id'       => NULL,
    'sku'      => NULL,
    'nombre'   => NULL,
    'cantidad' => NULL,
    'precio'   => NULL,
    'imagen'   => NULL
  ];

  $product = get_product_by_id($id_producto);

  // Algo paso, o no existe el producto
  if(!$product) {
    return false;
  }

  $new_product =
  [
    'id'       => (int)$product['id'],
    'sku'      => $product['sku'],
    'nombre'   => $product['nombre'],
    'cantidad' => $cantidad,
    'precio'   => $product['precio'],
    'imagen'   => $product['imagen']
  ];

  // Si no existe el carro, es obvio que no existe el producto
  // entonces lo agregamos directamente
  if(!isset($_SESSION['car']) || empty($_SESSION['car']['products'])) {
    $_SESSION['car']['products'][] = $new_product;
    return true;
  }

  // Si se agrega pero vamos primero a loopear en el array de todos los productos
  // para buscar uno con el mismo id sí existe
  foreach ($_SESSION['car']['products'] as $i => $p) {
    if($id_producto === $p['id']) {
      $_cantidad = $p['cantidad'] + $cantidad;
      $p['cantidad'] = $_cantidad;
      $_SESSION['car']['products'][$i] = $p;
      return true;
    }
  }
  
  $_SESSION['car']['products'][] = $new_product;
  return true;
}

function update_cart_product($id_producto , $cantidad = 1) {
  // Si no existe el carro, es obvio que no existe el producto
  // entonces lo agregamos directamente
  if(!isset($_SESSION['car']) || empty($_SESSION['car']['products'])) {
    return false;
  }

  // Si se agrega pero vamos primero a loopear en el array de todos los productos
  // para buscar uno con el mismo id sí existe
  foreach ($_SESSION['car']['products'] as $i => $p) {
    if($id_producto === $p['id']) {
      $p['cantidad'] = (int) $cantidad;
      $_SESSION['car']['products'][$i] = $p;
      return true;
    }
  }
  
  return false;
}

function delete_from_cart($id_producto) {
  if(!isset($_SESSION['car']) || empty($_SESSION['car']['products'])) {
    return false;
  }

  foreach ($_SESSION['car']['products'] as $index => $p) {
    if($id_producto == $p['id']) {
      unset($_SESSION['car']['products'][$index]);
      return true;
    }
  }
  return false;
}

function destroy_cart() {
  unset($_SESSION['car']);
  //session_destroy();
  return true;
}


