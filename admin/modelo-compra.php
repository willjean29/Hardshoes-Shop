<?php
    include_once 'funciones/funciones.php';
    // error_reporting(E_ALL ^ E_NOTICE);
    // Devolver response para le form de registrar administradores  

    if($_POST['registro'] == 'nuevo'){
        $cliente = (int)$_POST['cliente'];
        $precio = (float)$_POST['precio'];
        $fecha = $_POST['fecha'];
        $fechaFormateada = date('Y-m-d',strtotime($fecha));

        try {
            $stmt = $conn->prepare("INSERT INTO compras (cliente_id,compra_fecha,compra_precio) VALUES (?,?,?)");
            $stmt->bind_param('isi',$cliente,$fechaFormateada,$precio);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if($id_registro > 0){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_admn' => $id_registro
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                );
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo 'Error: '.$e-getMessage();
        }

        die(json_encode($respuesta));
    }
    
    // Devolver response para le form de actualizar administradores  
    if($_POST['registro'] == 'actualizar'){
        $cliente = (int)$_POST['cliente'];
        $precio = (float)$_POST['precio'];
        $fecha = $_POST['fecha'];
        $fechaFormateada = date('Y-m-d',strtotime($fecha));
        $id = $_POST['id_registro'];

        try {
            $stmt = $conn->prepare("UPDATE compras SET cliente_id = ?, compra_fecha = ?, compra_precio = ?, editado = NOW() WHERE compra_id = ?");
            $stmt->bind_param('isii',$cliente,$fechaFormateada,$precio,$id);
            $stmt->execute();
            if($stmt->affected_rows){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_actualizado' => $stmt->insert_id
                );
            }else{
                $respuesta = array(
                    'respuesta' => $stmt->affected_rows
                );
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo 'Error: '.$e-getMessage();
        }

        die(json_encode($respuesta));
    }
    
    // Devolver response para le form de eliminar administradores  
    if($_POST['registro'] == 'eliminar'){
        $id_borrar = $_POST['id'];
        try {
            $stmt = $conn->prepare("DELETE FROM compras WHERE compra_id = ?");
            $stmt->bind_param('i',$id_borrar);
            $stmt->execute();
            if($stmt->affected_rows){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_eliminado' => $id_borrar
                );
            }else{
                $respuesta = array(
                    'repuesta' => 'error'
                );
            }
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        die(json_encode($respuesta));
    }

    // Devolver response para el modal detalles compras
    if($_POST['registro'] == 'compra'){
        $id_compra = (int)$_POST['id'];
        try {
            $stmt = $conn->prepare("SELECT * FROM compra_detalle WHERE compra_id = ?");
            $stmt->bind_param('i',$id_compra);
            $stmt->execute();
            if($stmt->affected_rows){
                $resultados = $stmt->get_result();
                $productos = [];
                while ($compra = $resultados->fetch_assoc()) {
                    $producto = array(
                        'compra' =>$compra['compra_id'],
                        'producto_id' => $compra['producto_id'],
                        'cantidad' => $compra['cantidad'],
                        'precio' => $compra['precio']
                    );

                    $productos[] = $producto;
                }
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_compra' => $id_compra,
                    'productos' => $productos
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                );
            }
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        die(json_encode($respuesta));
    }
    
?>