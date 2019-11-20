<?php
    require_once('config.php');
    $install_me = 'INSTALL_ME.txt';
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        if (file_exists($install_me)){
          header('Location: login.php');
          exit();
        } else {
          header('Location: install.php');
        }
    }

    header('Location: fornecedores.php') 
?>
