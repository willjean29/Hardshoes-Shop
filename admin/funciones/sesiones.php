<?php
    function usuario_auntentificado(){
        if(!revisar_usuario()){
            header('Location: login.php');
            exit();
        }
    }

    function revisar_usuario(){
        return isset($_SESSION['usuario']);
    }

    session_start();
    usuario_auntentificado();
?>