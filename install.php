<?php
    require_once('config.php');
    require_once(DBAPI);

    $db = new Db();
    $install_me = 'INSTALL_ME.txt';

    if (file_exists($install_me)){
      header('Location: login.php');
    } else {
      header('refresh:'. INSTALL_TIMEOUT .';url=login.php');
    }

    require_once(HEADER_TEMPLATE);
?>

    <div class="row border_blue">
      <div class="loading">
        <img src="<?php echo  BASEURL; ?>/content/img/loading.gif">
      </div>

      <div class="col-sm-8 col-md-8 py-4">
        <h1 class="text-white">Sistema de Fornecedores e Produtos</h1>
        <p class="text-muted">

            No momento está sendo criada a estrutura de base de dados necessário para que o sistema funcione, aguarde alguns instântes
            e você será automaticamente redirecionado para a página de login.</p>
      </div>
    </div>
    <script>
        <?php echo "var contador =" . INSTALL_TIMEOUT; ?>
    </script>

    <h2 class="jumbotron-heading">Instalando... <span id="contador"></span> </h2>

    <table class="table table-bordered">
        <thead>
            <tr>
              <th>Tabelas</th>                
            </tr>
          </thead>
      <tbody>
        <?php
            $rows = $db->sqlCmd("SHOW TABLES", null , "rows");
            // Get results
            foreach($rows as $row) : ?>    
              <tr>
                <td>
                    <?php echo $row[0], '<br>'; ?> 
                </td>
              </tr>
        <?php 
             endforeach;
             file_put_contents($install_me,'# REMOVA ESTE ARQUIVO SE DESEJAR EXECUTAR A INSTALAÇÃO'); 
         ?>

      </tbody>
    </table>

<?php require_once(FOOTER_TEMPLATE); ?>
