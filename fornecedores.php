<?php
    require_once('config.php');
    require_once('inc/login_require.php');
    require_once('system/fornecedores.class.php');

    require_once(HEADER_TEMPLATE);
    // https://www.tutorialrepublic.com/snippets/preview.php?topic=bootstrap&file=crud-data-table-for-database-with-modal-form

    // Funções CRUD para forncedores
    $fornecedores = new Fornecedores();

    if (isset($_POST['action']) && !empty($_POST['action']) ) {
        if ($_POST['action'] == "1") {
            // Adicionar
            if (isset($_POST['cnpj']) && isset($_POST['nome_empresa']) && isset($_POST['cep']) && isset($_POST['endereco']) && isset($_POST['email']) && isset($_POST['contato'])) {
                $cnpj = strip_tags($_POST['cnpj']);
                $nome_empresa = strip_tags($_POST['nome_empresa']);
                $nome_fantasia = strip_tags($_POST['nome_fantasia']);
                $cep = strip_tags($_POST['cep']);
                $endereco = strip_tags($_POST['endereco']);
                $email = strip_tags($_POST['email']);
                $contato = strip_tags($_POST['contato']);

                $fornecedores->cadastrarFornecedores($cnpj, $nome_empresa, $nome_fantasia, $cep, $endereco, $email, $contato);
            }
        } elseif ($_POST['action'] == "2") {
            // Atualizar
            if (isset($_POST['cnpj']) && isset($_POST['nome_empresa']) && isset($_POST['cep']) && isset($_POST['endereco']) && isset($_POST['email']) && isset($_POST['contato'])) {
                $cnpj = strip_tags($_POST['cnpj']);
                $nome_empresa = strip_tags($_POST['nome_empresa']);
                $nome_fantasia = strip_tags($_POST['nome_fantasia']);
                $cep = strip_tags($_POST['cep']);
                $endereco = strip_tags($_POST['endereco']);
                $email = strip_tags($_POST['email']);
                $contato = strip_tags($_POST['contato']);

                $fornecedores->atualizarFornecedores($_POST['id_forn'], $cnpj, $nome_empresa, $nome_fantasia, $cep, $endereco, $email, $contato);
            }
        } elseif ($_POST['action'] == "42") {
            // Remover 
            if (isset($_POST['id_forn'])) {
                $fornecedores->deleltarFornecedores($_POST['id_forn']);
            }
        }
    }
?>

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gerenciar <b>Fornecedores</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addFornecedoresModal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus-circle" aria-hidden="true"></i> <span>Adicionar novo Fornecedor</span></a>
                    </div>
                </div>
            </div>
            <table id="table" class="table table-striped table-hover display">
              <?php
                  $resp = $fornecedores->getFornecedores();
                  if ($resp):
              ?>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Empresa</th>
                        <th>Email</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($resp as $forn):
                  ?>
                    <tr>
                        <td><?php echo $forn[0]; ?></td>
                        <td><?php echo $forn[2]; ?></td>
                        <td><?php echo $forn[7]; ?></td>
                        <td><?php echo $forn[3]; ?></td>
                        <td><?php echo $forn[6]; ?></td>
                        <td>
                            <a href="#editFornecedoresModal<?php echo $forn[0] ?>" class="edit" data-toggle="modal"><i class="fa fa-pencil" data-toggle="tooltip" title="Editar"></i></a>
                            <a href="#deleteFornecedoresModal<?php echo $forn[0] ?>" class="delete" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" title="Deletar"></i></a>
                        </td>
                    </tr>
                </tbody>
              <?php
                  endforeach;
                  else:
                ?>

                <thead>
                    <tr>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="alert alert-warning" role="alert">
                                 Nenhum registro encontrado.
                             </div>
                        </td>
                    </tr>
                </tbody>

              <?php
                  endif;
              ?>
            </table>
        </div>
    </div>
    <!-- MODAL DE ADIÇÃO  -->
    <div id="addFornecedoresModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="post" id="fornecedorForm" name="frm_func" role="form">
                    <div class="modal-header">                      
                        <h4 class="modal-title">Adicionar Fornecedor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group row" >
                            <label for="cnpj" class="col-form-label" >CNPJ:</label>
                            <input type="text" class="form-control" placeholder="Ex. 12.123.123/0001-00" maxlength="18" name="cnpj" required autofocus>
                        </div>

                        <div class="form-group row" >
                            <label for="nome_empresa" class="col-form-label" >Empresa:</label>
                            <input type="text" class="form-control" maxlength="160" name="nome_empresa" required>
                        </div> 
                    
                        <div class="form-group row" >
                            <label for="nome_fantasia" class="col-form-label" >Nome Fantasia:</label>   
                            <input type="text" class="form-control" maxlength="160" name="nome_fantasia"></br>
                        </div>
                           
                        <div class="form-group row" >
                            <label for="cep" class="col-form-label" >CEP:</label>   
                            <input type="text" class="form-control" maxlength="8" placeholder="Ex. 08123456" name="cep" required></br>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="endereco" class="col-form-label" >Endereço:</label>
                            <textarea class="form-control" maxlength="130" name="endereco" required></textarea>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="email" class="col-form-label" >email:</label>   
                            <input type="email" class="form-control" maxlength="60" name="email" required></br>
                        </div>
                      
                        <div class="form-group row" >
                            <label for="contato" class="col-form-label" >Telefone:</label>   
                            <input type="text" class="form-control" maxlength="14" placeholder="Ex. 011 91234-4567" name="contato" required></br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control" name="action" value="1">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Adicionar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL DE EDIÇÃO -->
    <?php
        $forn = $fornecedores->getFornecedores();
        if ($forn):
            foreach($forn as $forns):
    ?>

    <div id="editFornecedoresModal<?php echo $forns[0]; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="editarfornecedorForm" name="frm_func" role="form">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Fornecedor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group row" >
                            <label for="cnpj" class="col-form-label" >CNPJ:</label>
                            <input type="text" class="form-control" placeholder="Ex. 12.123.123/0001-00" maxlength="18" name="cnpj" value="<?php echo $forns[5]; ?>" required autofocus>
                        </div>

                        <div class="form-group row" >
                            <label for="nome_empresa" class="col-form-label" >Empresa:</label>
                            <input type="text" class="form-control" maxlength="160" name="nome_empresa" value="<?php echo $forns[1]; ?>" required autofocus>
                        </div> 
                    
                        <div class="form-group row" >
                            <label for="nome_fantasia" class="col-form-label" >Nome Fantasia:</label>   
                            <input type="text" class="form-control" maxlength="160" name="nome_fantasia" value="<?php echo $forns[2]; ?>" autofocus></br>
                        </div>
                           
                        <div class="form-group row" >
                            <label for="cep" class="col-form-label" >CEP:</label>   
                            <input type="text" class="form-control" maxlength="8" placeholder="Ex. 08123456" name="cep" value="<?php echo $forns[4]; ?>" required autofocus></br>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="endereco" class="col-form-label" >Endereço:</label>
                            <textarea class="form-control" maxlength="130" name="endereco" required autofocus><?php echo $forns[3]; ?></textarea>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="email" class="col-form-label" >email:</label>   
                            <input type="email" class="form-control" maxlength="60" name="email" value="<?php echo $forns[7]; ?>" required autofocus></br>
                        </div>
                      
                        <div class="form-group row" >
                            <label for="contato" class="col-form-label" >Telefone:</label>   
                            <input type="text" class="form-control" maxlength="14" placeholder="Ex. 011 91234-4567" name="contato" value="<?php echo $forns[6]; ?>" required autofocus></br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control" name="action" value="2">
                        <input type="hidden" class="form-control" name="id_forn" value="<?php echo $forns[0]; ?>">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Atualizar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL DE DELETAR --> 
    <div id="deleteFornecedoresModal<?php echo $forns[0]; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form method="post" class="deletarfornecedorForm" name="frm_func" role="form">
                <!-- Modal content-->          
                <div class="modal-content">    
                    <div class="modal-header">
                        <h4 class="modal-title">Deletar Fornecedor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="action" value="42">
                        <input type="hidden" name="id_forn" value="<?php echo $forns[0]; ?>">
                        <div class="alert alert-danger">Você desejar deletar o fornecedor <strong>
                                <?php echo $forns[2]; ?>?</strong> </div>
                        <div class="modal-footer">     
                            <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                            <button type="submit" name="delete" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Deletar</button>
                        </div>                         
                    </div>                         
                </div>                         
            </form>                        
        </div>
    </div>

    <?php
        endforeach;
        endif;
    ?>

<?php require_once(FOOTER_TEMPLATE); ?>