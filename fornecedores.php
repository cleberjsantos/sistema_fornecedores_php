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
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar novo Fornecedor</span></a>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Deletar</span></a>                        
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
              <?php
                  $resp = $fornecedores->getFornecedores();
                  if ($resp):
              ?>
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
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
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox1" name="options[]" value="<?php echo $forn[0]; ?>">
                                <label for="checkbox1"></label>
                            </span>
                        </td>
                        <td><?php echo $forn[2]; ?></td>
                        <td><?php echo $forn[7]; ?></td>
                        <td><?php echo $forn[3]; ?></td>
                        <td><?php echo $forn[6]; ?></td>
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>
                        </td>
                    </tr>
                </tbody>
              <?php
                  endforeach;
                  else:
                      echo "Não existem registros na base de dados"; 
                  endif;
              ?>
            </table>
        </div>
    </div>
    <!-- MODAL DE ADIÇÃO  -->
    <div id="addEmployeeModal" class="modal fade">
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
                            <input type="text" class="form-control" placeholder="Ex. 12.123.123/0001-00" maxlength="18" name="cnpj" required>
                        </div>

                        <div class="form-group row" >
                            <label for="nome_empresa" class="col-form-label" >Empresa:</label>
                            <input type="text" class="form-control" maxlength="80" name="nome_empresa" required>
                        </div> 
                    
                        <div class="form-group row" >
                            <label for="nome_fantasia" class="col-form-label" >Nome Fantasia:</label>   
                            <input type="text" class="form-control" maxlength="80" name="nome_fantasia"></br>
                        </div>
                           
                        <div class="form-group row" >
                            <label for="cep" class="col-form-label" >CEP:</label>   
                            <input type="text" class="form-control" maxlength="8" placeholder="Ex. 08123456" name="cep" required></br>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="endereco" class="col-form-label" >Endereço:</label>
                            <textarea class="form-control" maxlength="50" name="endereco" required></textarea>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="email" class="col-form-label" >email:</label>   
                            <input type="email" class="form-control" maxlength="30" name="email" required></br>
                        </div>
                      
                        <div class="form-group row" >
                            <label for="contato" class="col-form-label" >Telefone:</label>   
                            <input type="text" class="form-control" maxlength="14" placeholder="Ex. 011 91234-4567" name="contato" required></br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control" name="action" value="1"></br>
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Adicionar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL DE EDIÇÃO -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="fornecedorForm" name="frm_func" role="form">
                    <div class="modal-header">                      
                        <h4 class="modal-title">Editar Fornecedor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group row" >
                            <label for="cnpj" class="col-form-label" >CNPJ:</label>
                            <input type="text" class="form-control" placeholder="Ex. 12.123.123/0001-00" maxlength="18" name="cnpj" required>
                        </div>

                        <div class="form-group row" >
                            <label for="nome_empresa" class="col-form-label" >Empresa:</label>
                            <input type="text" class="form-control" maxlength="80" name="nome_empresa" required>
                        </div> 
                    
                        <div class="form-group row" >
                            <label for="nome_fantasia" class="col-form-label" >Nome Fantasia:</label>   
                            <input type="text" class="form-control" maxlength="80" name="nome_fantasia"></br>
                        </div>
                           
                        <div class="form-group row" >
                            <label for="cep" class="col-form-label" >CEP:</label>   
                            <input type="text" class="form-control" maxlength="8" placeholder="Ex. 08123456" name="cep" required></br>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="endereco" class="col-form-label" >Endereço:</label>
                            <textarea class="form-control" maxlength="50" name="endereco" required></textarea>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="email" class="col-form-label" >email:</label>   
                            <input type="email" class="form-control" maxlength="30" name="email" required></br>
                        </div>
                      
                        <div class="form-group row" >
                            <label for="contato" class="col-form-label" >Telefone:</label>   
                            <input type="text" class="form-control" maxlength="14" placeholder="Ex. 011 91234-4567" name="contato" required></br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control" name="action" value="1"></br>
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Adicionar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL DE DELETAR  -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">                      
                        <h4 class="modal-title">Delete Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">                    
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
<!--





    <div class="row">
        <form class="form-group" name="frm_func" method="post">
            
            <center><h2>Cadastro de Fonecedores</h2></center>
            
            <div class="form-group row" >
                <label for="cnpj" class="col-sm-2 col-form-label" >CNPJ:   </label>   
                <input type="text" style="width:200px;" class="form-control" name="cnpj"></br>
            </div>

            <div class="form-group row" >
                <label for="nome_empresa" class="col-sm-2 col-form-label" >Empresa:</label>   
                <input type="text" style="width:500px;" class="form-control" name="nome_empresa">
            </div> 
        
            <div class="form-group row" >
                <label for="nome_fantasia" class="col-sm-2 col-form-label" >Nome Fantasia:</label>   
                <input type="text" style="width:500px;" class="form-control" name="nome_fantasia"></br>
            </div>
               
            <div class="form-group row" >
                <label for="cep" class="col-sm-2 col-form-label" >CEP:</label>   
                <input type="text" style="width:200px;" class="form-control" name="cep"></br>
            </div>
        
            <div class="form-group row" >
                <label for="endereco" class="col-sm-2 col-form-label" >Endereço:</label>   
                <input type="text"  class="form-control" style="width:500px;" class="form-control" name="endereco"></br>
            </div>
        
            <div class="form-group row" >
                <label for="email" class="col-sm-2 col-form-label" >email:</label>   
                <input type="text"  class="form-control" style="width:500px;" class="form-control" name="txtEmail"></br>
            </div>
          
            <div class="form-group row" >
                <label for="Tel" class="col-sm-2 col-form-label" >Telefone:</label>   
                <input type="text"  class="form-control" style="width:200px;" class="form-control" name="txtTel"></br>
            </div>
                
            <button class="btn btn-primary" type="submit">Cadastrar</button>	

        </form>
    </div>-->
<?php require_once(FOOTER_TEMPLATE); ?>
