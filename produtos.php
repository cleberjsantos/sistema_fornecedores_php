<?php
    require_once('config.php');
    require_once('inc/login_require.php');
    require_once('system/produtos.class.php');
    require_once('system/fornecedores.class.php');


    require_once(HEADER_TEMPLATE);
    // https://www.tutorialrepublic.com/snippets/preview.php?topic=bootstrap&file=crud-data-table-for-database-with-modal-form

    // Funções CRUD para produtos / fornecedores
    $fornecedores = new Fornecedores();
    $f = $fornecedores->getFornecedores();

    $produtos = new Produtos();

    if (isset($_POST['action']) && !empty($_POST['action']) ) {
        if ($_POST['action'] == "1") {
            // Adicionar
            if (isset($_POST['id_forn']) && isset($_POST['nome_produto']) && isset($_POST['quantidade'])) {
                $id_forn = strip_tags($_POST['id_forn']);
                $nome_produto = strip_tags($_POST['nome_produto']);
                $modelo = strip_tags($_POST['modelo']);
                $lote = strip_tags($_POST['lote']);
                $preco = strip_tags($_POST['preco']);
                $quantidade = strip_tags($_POST['quantidade']);

                $produtos->cadastrarProdutos($id_forn, $nome_produto, $modelo, $lote, $preco, $quantidade);
            }
        } elseif ($_POST['action'] == "2") {
            // Atualizar
            if (isset($_POST['id_prod']) && isset($_POST['nome_produto']) && isset($_POST['id_forn'])) {
                $id_prod = strip_tags($_POST['id_prod']);
                $id_forn = strip_tags($_POST['id_forn']);
                $nome_produto = strip_tags($_POST['nome_produto']);
                $modelo = strip_tags($_POST['modelo']);
                $lote = strip_tags($_POST['lote']);
                $preco = strip_tags($_POST['preco']);
                $quantidade = strip_tags($_POST['quantidade']);

                $produtos->atualizarProdutos($id_prod, $id_forn, $nome_produto, $modelo, $lote, $preco, $quantidade);
            }
        } elseif ($_POST['action'] == "42") {
            // Remover 
            if (isset($_POST['id_prod'])) {
                $produtos->deleltarProdutos($_POST['id_prod']);
            }
        }
    }
?>

        <div class="table-wrapper">
            <div class="table-title black">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gerenciar <b>Produtos</b></h2>
                    </div>
                    <div class="col-sm-6">

                    <?php
                       if ($f) {
                           echo "<a href='#addProdutosModal' class='btn btn-success' data-toggle='modal'><i class='fa fa-plus-circle' aria-hidden='true'></i> <span>Adicionar novo Produto</span></a>";
                       } else {
                           echo "<div class='alert alert-warning' role='alert'>Antes é necessário adicionar um <strong>Fornecedor!</strong></div>";
                       }
                     ?>
                    </div>
                </div>
            </div>
            <table id="table" class="table table-striped table-hover display">
              <?php
                  $resp = $produtos->getProdutos();
                  if ($resp):
              ?>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Fornecedor</th>
                        <th>Modelo</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($resp as $prod):
                  ?>
                    <tr>
                        <td><?php echo $prod[0]; ?></td>
                        <td><?php echo $prod[2]; ?></td>
                        <td>
                           <?php
                              $f_id = $fornecedores->getIdFornecedores($prod[1]);
                              if ($f_id) {
                                  foreach($f_id as $frn){
                                      echo $frn[2];
                                  }
                              }
                            ?>
                        </td>
                        <td><?php echo $prod[3]; ?></td>
                        <td><?php echo number_format((float)$prod[5], 2, ',', '.'); ?></td>
                        <td>
                            <a href="#editProdutosModal<?php echo $prod[0] ?>" class="edit" data-toggle="modal"><i class="fa fa-pencil" data-toggle="tooltip" title="Editar"></i></a>
                            <a href="#deleteProdutosModal<?php echo $prod[0] ?>" class="delete" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" title="Deletar"></i></a>
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
    <div id="addProdutosModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="post" id="produtoForm" name="frm_func" role="form">
                    <div class="modal-header">
                        <h4 class="modal-title">Adicionar Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group row" >
                            <label for="nome_produto" class="col-form-label" >Produto:</label>
                            <input type="text" class="form-control" maxlength="160" name="nome_produto" required>
                        </div> 

                        <div class="form-group row" >
                            <label for="id_forn" class="col-form-label" >Fornecedor:</label>
                            <select  class="form-control" name="id_forn" required>
                                <option value="">--</option>
                                <?php
                                    if ($f) {
                                        foreach($f as $forn){
                                            echo("<option value='".$forn[0]."'>".$forn[2]."</option>");
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group row" >
                            <label for="modelo" class="col-form-label" >Modelo:</label>
                            <input type="text" class="form-control" maxlength="80" name="modelo" required></br>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="lote" class="col-form-label" >Lote:</label>
                            <input type="text" class="form-control" maxlength="20" placeholder="Ex. 12345" name="lote" required></br>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="preco" class="col-form-label" >Preço:</label>
                            <input type="text" class="form-control" name="preco" placeholder="Ex. 999.99" required></br>
                        </div>
                      
                        <div class="form-group row" >
                            <label for="quantidade" class="col-form-label" >Quantidade:</label>
                            <input type="text" class="form-control" maxlength="20" placeholder="Ex. 99" name="quantidade" required></br>
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
        $prod = $produtos->getProdutos();
        if ($prod):
            foreach($prod as $prods):
    ?>

    <div id="editProdutosModal<?php echo $prods[0]; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" class="editarprodutoForm" name="frm_func" role="form">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group row" >
                            <label for="nome_produto" class="col-form-label" >Produto:</label>
                            <input type="text" class="form-control" maxlength="160" name="nome_produto" value="<?php echo $prods['2'] ?>" required>
                        </div> 

                        <div class="form-group row" >
                            <label for="id_forn" class="col-form-label" >Fornecedor:</label>
                            <select  class="form-control" name="id_forn" required>
                                <option value="">--</option>
                                <?php
                                    if ($f) {
                                        foreach($f as $forn){
                                            if ($forn[0] == $prods['1']){
                                                echo("<option value='".$forn[0]."' selected>".$forn[2]."</option>");
                                            } else {
                                                echo("<option value='".$forn[0]."'>".$forn[2]."</option>");
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group row" >
                            <label for="modelo" class="col-form-label" >Modelo:</label>
                            <input type="text" class="form-control" maxlength="80" name="modelo" value="<?php echo $prods['3'] ?>" required></br>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="lote" class="col-form-label" >Lote:</label>
                            <input type="text" class="form-control" maxlength="20" placeholder="Ex. 12345" name="lote" value="<?php echo $prods['4'] ?>" required></br>
                        </div>
                    
                        <div class="form-group row" >
                            <label for="preco" class="col-form-label" >Preço:</label>
                            <input type="text" class="form-control" name="preco" placeholder="Ex. 999.99" value="<?php echo $prods['5'] ?>" required></br>
                        </div>
                      
                        <div class="form-group row" >
                            <label for="quantidade" class="col-form-label" >Quantidade:</label>
                            <input type="text" class="form-control" maxlength="20" placeholder="Ex. 99" name="quantidade" value="<?php echo $prods['6'] ?>" required></br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control" name="action" value="2">
                        <input type="hidden" class="form-control" name="id_prod" value="<?php echo $prods[0]; ?>">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Atualizar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL DE DELETAR --> 
    <div id="deleteProdutosModal<?php echo $prods[0]; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form method="post" class="deletarprodutoForm" name="frm_func" role="form">
                <!-- Modal content-->          
                <div class="modal-content">    
                    <div class="modal-header">
                        <h4 class="modal-title">Deletar Produto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="action" value="42">
                        <input type="hidden" name="id_prod" value="<?php echo $prods[0]; ?>">
                        <div class="alert alert-danger">Você desejar deletar o produto <strong>
                                <?php echo $prods[2]; ?>?</strong> </div>
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
