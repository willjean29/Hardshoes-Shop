<?php
    include_once 'funciones/funciones.php';
    // error_reporting(E_ALL ^ E_NOTICE);
    // Devolver response para le form de registrar administradores  

    if($_POST['registro'] == 'nuevo'){
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];

        $opciones = array(
            'cost' => 12
        );

        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

        try {
            $stmt = $conn->prepare("INSERT INTO admins (usuario, nombre, password) VALUES (?,?,?)");
            $stmt->bind_param('sss',$usuario,$nombre,$password_hashed);
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
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];
        $id = $_POST['id_registro'];

        try {
            if(empty($_POST['password'])){
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, editado = NOW() WHERE id_admin = ?");
                $stmt->bind_param('ssi',$usuario,$nombre,$id);
            }else{
                $opciones = array(
                    'cost' => 12
                );
                $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
                $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, password = ?, editado = NOW() WHERE id_admin = ?");
                $stmt->bind_param('sssi',$usuario,$nombre,$password_hashed,$id);
            }
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
            $stmt = $conn->prepare("DELETE FROM admins WHERE id_admin = ?");
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