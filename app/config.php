<?php
/**
 * Inicialización de sesión de usuario
 */
session_start();
// unset($_SESSION['car']);
/**URL constante */

define('PORT'       ,'7885');
define('BASEPATH'   , '/cursos/hardshoes/');
// define('URL'        , 'http://127.0.0.1:'.PORT.BASEPATH);
define('URL'        , 'https://hardshoesshop.herokuapp.com');     


/**Constante para los paths de archivos */
define('DS'       , DIRECTORY_SEPARATOR);
define('ROOT'     , getcwd().DS);
define('APP'      , ROOT.'app'.DS);
define('INCLUDES' , ROOT.'includes'.DS);
define('VIEWS'    , ROOT.'views'.DS);

define('ASSETS'  , URL.'assets/');
define('CSS'     , ASSETS.'css/');
define('IMAGES'  , ASSETS.'images/');
define('JS'      , ASSETS.'js/');
define('PLUGINS' , ASSETS.'plugins/');


/**Constantes adicionales */

define('SHIPPING_COST' , 10.00);
/**define('COMPANY_NAME'  , 'hardshoes');
define('COMPANY_EMAIL' , 'noreplay@carritow.com');

/**Incluir todas nuestras funciones personalizadas */


$archivo = basename($_SERVER['PHP_SELF']);
$pagina = str_replace('.php',"",$archivo);
if($pagina !== "login"){
    require_once APP.'functions.php';
}

