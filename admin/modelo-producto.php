<?php
    include_once 'funciones/funciones.php';
    // error_reporting(E_ALL ^ E_NOTICE);
    // Devolver response para le form de registar eventos



    if($_POST['registro'] == 'nuevo'){
        $sku = $_POST['sku'];
        $nombre = $_POST['nombre'];
        $imagen = $_FILES['foto']['name'];
        // Obener precio
        $precio = (float)$_POST['precio'];
        // Stock
        $stock = (int)$_POST['stock'];
    
        // Configurando donde se guardarn las imagenes
        $carpeta_destino = '../assets/fotos/';
        $archivo_subido = $carpeta_destino.$imagen;
        try {
            // moviendo la imagen al destino
            
            if(!file_exists($archivo_subido)){
                move_uploaded_file($_FILES['foto']['tmp_name'],$archivo_subido);
            }
            $stmt = $conn->prepare("INSERT INTO productos (sku,nombre,imagen,precio,stock)VALUES (?,?,?,?,?)");
            $stmt->bind_param('sssii',$sku,$nombre,$imagen,$precio,$stock);
            $stmt->execute();
            $id_insertado = $stmt->insert_id;
            if($stmt->affected_rows){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_insertado' => $id_insertado
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e-getMessage()
            );
        }
        die(json_encode($respuesta));
    }
    
    if($_POST['registro'] == 'actualizar'){
        $sku = $_POST['sku'];
        $nombre = $_POST['nombre'];
        $imagen = $_FILES['foto']['name'];
        // Obener precio
        $precio = (float)$_POST['precio'];
        // Stock
        $stock = (int)$_POST['stock'];
    
        // Configurando donde se guardarn las imagenes
        $carpeta_destino = '../assets/fotos/';
        $archivo_subido = $carpeta_destino.$imagen;

        $id = $_POST['id_registro'];
        try {
            if(!file_exists($archivo_subido)){
                move_uploaded_file($_FILES['foto']['tmp_name'],$archivo_subido);
            }
            $stmt = $conn->prepare("UPDATE productos SET sku = ?, nombre = ?, imagen = ?, precio = ?, stock = ?,editado = NOW() WHERE id = ?");
            $stmt->bind_param('sssiii',$sku,$nombre,$imagen,$precio,$stock,$id);
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
    
    if($_POST['registro'] == 'eliminar'){
        $id_borrar = $_POST['id'];
        try {
            $stmt= $conn->prepare("DELETE FROM productos WHERE id = ?");
            $stmt->bind_param('i',$id_borrar);
            $stmt->execute();
            if($stmt->affected_rows){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_eliminado' => $id_borrar
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
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
