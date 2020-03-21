<?php
    include_once 'funciones/funciones.php';
    // error_reporting(E_ALL ^ E_NOTICE);
    // Devolver response para le form de registrar administradores  

    if($_POST['registro'] == 'nuevo'){
        $nombre = $_POST['nombre'];
        $tarjeta = $_POST['tarjeta'];
        $fecha = $_POST['fechas'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        try {
            $stmt = $conn->prepare("INSERT INTO clientes (cliente_nombre,cliente_num,cliente_fecha,cliente_cvc,cliente_email) VALUES (?,?,?,?,?)");
            $stmt->bind_param('sssss',$nombre,$tarjeta,$fecha,$password,$email);
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
        $nombre = $_POST['nombre'];
        $tarjeta = $_POST['tarjeta'];
        $fecha = $_POST['fechas'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $id = $_POST['id_registro'];

        try {
            $stmt = $conn->prepare("UPDATE clientes SET cliente_nombre = ?, cliente_num = ?, cliente_fecha = ?, cliente_cvc = ?, cliente_email = ? WHERE cliente_id = ?");
            $stmt->bind_param('sssssi',$nombre,$tarjeta,$fecha,$password,$email,$id);
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
            $stmt = $conn->prepare("DELETE FROM clientes WHERE cliente_id = ?");
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
    
?>