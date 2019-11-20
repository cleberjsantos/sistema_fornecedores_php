<?php
    require_once('system/usuarios.class.php');
  	$usuarios = new Usuarios();

    session_start();

    $login = $_POST['usuario'];
    $senha = $_POST['senha'];

    if ( !isset($login, $senha) || empty($login) || empty($senha) ) {
        header('Location: login.php?msg=Entre com o usuário e a senha&box=danger');
    } else {
        $usuarios->login($login, $senha);
    }
?>
