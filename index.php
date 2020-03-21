<?php 
//PHP Y SUS FUNCIONES PREDEFINIDAS ESTÁN TODAS ATRAS DE ESTO

require_once 'app/config.php';

$data =
[
  'title' => 'HARDSHOES - Grupo 5',
  // 'products' => get_products()
];


// renderizado LA VISTA
render_view('hardshoes_view', $data);
//require_once 'views/hardshoes_view.php';
// echo '<pre>';
// var_dump($_SESSION['car']['products']);
// echo '</pre>';


