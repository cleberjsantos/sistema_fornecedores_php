<?php
    require_once('config.php');

    $install_me = 'INSTALL_ME.txt';

    if (!file_exists($install_me)){
      header('Location: install.php');
    }

    require_once(HEADER_TEMPLATE);
?>

   <div class="wrapper fadeInDown">
     <div id="formContent">
       <!-- Tabs Titles -->
   
       <!-- Icon -->
       <div class="fadeIn first">
         <img src="<?php echo BASEURL; ?>/content/img/logo_login.jpg" id="icon" alt="Logo" />
       </div>
   
       <!-- Login Form -->
       <form action="authenticate.php" method="post">
         <input type="text" id="login" class="fadeIn second" name="usuario" placeholder="Usuário">
         <input type="password" id="password" class="fadeIn third" name="senha" placeholder="Senha">
         <input type="submit" class="fadeIn fourth" value="Entra">
       </form>
   
       <div id="formFooter">
         <?php
             if (isset($_GET['msg'])){
                 echo "<div class='alert alert-". $_GET['box'] ." alert-dismissible fade show' role='alert'>
                   ". $_GET['msg'] ."
                   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                     <span aria-hidden='true'>&times;</span>
                   </button>
                 </div>";
             } 
         ?>
         &nbsp;
       </div>
   
     </div>
   </div>

<?php require_once(FOOTER_TEMPLATE); ?>
