<!DOCTYPE html>
<html lang='es'>
<head>
    <?php
        $archivo = basename($_SERVER['PHP_SELF']);
        $pagina = str_replace('.php',"",$archivo);
        if($pagina !== "admi_view"){
            echo '<base href="<?php echo BASEPATH; ?>">';
        }else{
            echo '<base href="<?php echo BASEPATH/admin; ?>">';
        }
    ?>
    <meta charset ='UTF-8'>
    <meta name="viewport" content="width-device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> <?php echo (isset($data['title'])? $data['title']:'HARDSHOES_Grupo05'); ?></title>
        
    <!-- // FontAwesome 5 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <?php
        $archivo = basename($_SERVER['PHP_SELF']);
        $pagina = str_replace('.php',"",$archivo);
        if($pagina == "login"){
            // Bootstrap 4
            echo '<link rel="stylesheet" href="../assets/css/bootstrap.min.css">';
            // Customer Styles
            echo '<link rel="stylesheet" href="../assets/css/estilo.css">';
        }else{
            // Bootstrap 4
            echo '<link rel="stylesheet" href="assets/css/bootstrap.min.css">';
            // WaitMe
            echo '<link rel="stylesheet" href="assets/plugins/waitMe/waitMe.min.css">';
        }
    ?>

</head>
<body>