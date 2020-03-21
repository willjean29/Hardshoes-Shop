<?php

require_once 'app/config.php';
require_once 'app/db_conexion.php';

if(!isset($_POST['action'])){
    $respuesta = array(
        'respuesta' => 'Indefinido'
    );
    die(json_encode($respuesta));
}

$action = $_POST['action'];

switch($action){
    case 'get':
        $car = get_cart();
        if(!empty($car['products'])){
            $carrito = [];
            foreach($car['products'] as $p){
                $producto = array(
                    'id' => $p['id'],
                    'sku' => $p['sku'],
                    'nombre' => $p['nombre'],
                    'cantidad' => $p['cantidad'],
                    'precio' => $p['precio'],
                    'imagen' => $p['imagen']
                );
                $carrito[] = $producto;
            }
            $respuesta = array(
                'respuesta' => 'exito',
                'carrito' => $carrito,
                'pagos' => $car['car_totals']
            );

        }else{
            $respuesta = array(
                'respuesta' => 'no hay productos'
            );
        }
        die(json_encode($respuesta));
        break;
    case 'post':
        if(!isset($_POST['id'],$_POST['cantidad'])){
            $respuesta = array(
                'respuesta' => 'Indefinido'
            );
            die(json_encode($respuesta));
        }
        if(!add_to_cart((int)$_POST['id'], (int)$_POST['cantidad'])){
            $respuesta = array(
                'respuesta' => 'error'
            );
            die(json_encode($respuesta));
        }


        $respuesta = array(
            'respuesta' => 'exito'
        );
        die(json_encode($respuesta));
        break;
    
    case 'delete':
        if(!isset($_POST['id'])){
            $respuesta = array(
                'respuesta' => 'Indefinido'
            );
            die(json_encode($respuesta));
        }
        $id = (int)$_POST['id'];
        if(!delete_from_cart($id)){
            $respuesta = array(
                'respuesta' => 'error'
            );
            die(json_encode($respuesta));
        }

        $respuesta = array(
            'respuesta' => 'exito',
            'id_eliminado' => $id
        );
        die(json_encode($respuesta));
        break;
    
    case 'destroy':
        if(!destroy_cart()){
            $respuesta = array(
                'respuesta' => 'error'
            );
            die(json_encode($respuesta));
        }

        $respuesta = array(
            'respuesta' => 'exito'
        );
        die(json_encode($respuesta));
        break;

    case 'put':
        if(!isset($_POST['id'],$_POST['cantidad'])){
            $respuesta = array(
                'respuesta' => 'Indefinido'
            );
            die(json_encode($respuesta));
        }

        if(!update_cart_product((int)$_POST['id'],(int)$_POST['cantidad'])){
            $respuesta = array(
                'respuesta' => 'error'
            );
            die(json_encode($respuesta));
        }

        $respuesta = array(
            'respuesta' => 'exito',
            'id_actualizado' => (int)$_POST['id']
        );
        die(json_encode($respuesta));
        break;
    case 'pay':
        // Insertando los datos del cliente
        $nombre = $_POST['nombre'];
        $tarjeta = $_POST['tarjeta'];
        $fecha = $_POST['fecha'];
        $cvc = $_POST['cvc'];
        $email = $_POST['email'];

        $compra = false;
        $resp = 0;
        $car = get_cart();
        try {
            $stmt = $conn->prepare("INSERT INTO clientes (cliente_nombre,cliente_num,cliente_fecha,cliente_cvc,cliente_email) VALUES (?,?,?,?,?)");
            $stmt->bind_param('sssss',$nombre,$tarjeta,$fecha,$cvc,$email);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if($stmt->affected_rows){
                $resp = insertarCompra($id_registro,$car,$conn);
                if($resp['resp']){
                    $compra = true;
                }else{  
                    $compra = false;
                }
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_insertado' => $id_registro,
                    'compra' => $compra,
                    'resp_id' => $resp['id']
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                );
            }
            $stmt->close();
            $conn->close();

        } catch (Exception $e) {
            $error = $e->getMessage();
            $respuesta = array(
                'respuesta' => 'error',
                'error' => $error
            );
        }
       
        die(json_encode($respuesta));
        break;
}

function insertarCompra($id,$car,$conn){
    $id = (int) $id;
    $total = $car['car_totals']['total'];
    $resp = array(
        'resp' => false,
        "id" => 0,
    );
    $query = "INSERT INTO compras (cliente_id,compra_fecha,compra_precio) VALUES ($id,CURDATE(),$total)";
    $results = $conn->query($query);
    $id_registrado = $conn->insert_id;
    if($results){
        insertarDetalle($id_registrado,$car,$conn);
        $resp = array(
            'resp' => true,
            "id" => $id_registrado,
        );
        
    }
    return $resp;
}

function insertarDetalle($id,$car,$conn){
    $id = (int) $id;
    foreach ($car['products'] as $p) {
        $idProducto = $p['id'];
        $cantidad = $p['cantidad'];
        $precio = (float)$p['precio'];
        $query = "INSERT INTO compra_detalle (compra_id,producto_id,cantidad,precio) VALUES ($id,$idProducto,$cantidad,$precio)";
        $conn->query($query);
    }
}

?>