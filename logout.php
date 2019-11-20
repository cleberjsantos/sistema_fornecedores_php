<?php
    session_start();
    session_destroy();
    // Redirect to the login page:
    header('Location: login.php?msg=Você não está mais autenticado&box=success');
?>

