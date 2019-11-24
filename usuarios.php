<?php
    require_once('config.php');
    require_once('inc/login_require.php');
    require_once('system/usuarios.class.php');

    require_once(HEADER_TEMPLATE);

    $usuarios = new Usuarios();
    $all_users = $usuarios->getUsuarios();

    if ($_SESSION['role'] == 'admin'):

        if (isset($_POST['action']) && !empty($_POST['action']) ) {
            if ($_POST['action'] == "1") {
                // Adicionar
                if (isset($_POST['login']) && isset($_POST['senha'])) {
                    $login = strip_tags($_POST['login']);
                    $senha = strip_tags($_POST['senha']);
                    $papel = strip_tags($_POST['papel']);

                    $usuarios->cadastrarUsuarios($login, $senha, $papel);
                }
            } elseif ($_POST['action'] == "2") {
                // Atualizar 
                if (isset($_POST['id_usuario']) ) {
                    $id_usuario = strip_tags($_POST['id_usuario']);
                    $senha = strip_tags($_POST['senha']);
                    $papel = strip_tags($_POST['papel']);

                    $usuarios->atualizarUsuario($id_usuario, $senha, $papel);
                }

            } elseif ($_POST['action'] == "42") {
                // Remover 
                if (isset($_POST['id_usuario'])) {
                    $usuarios->deleltarUsuarios($_POST['id_usuario']);
                }
            }
        }
?>

        <div class="table-wrapper">
            <div class="table-title orange">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gerenciar <b>Usuários</b></h2>
                    </div>
                    <div class="col-sm-6">
                       <?php
                          if ($all_users) {
                              echo "<a href='#addUsuariosModal' class='btn btn-success' data-toggle='modal'><i class='fa fa-plus-circle' aria-hidden='true'></i> <span>Adicionar novo Usuário</span></a>";
                          }
                       ?>
                    </div>
                </div>
            </div>
            <table id="table" class="table table-striped table-hover display">
              <?php
                  if ($all_users):
              ?>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Papel</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($all_users as $users):
                  ?>
                    <tr>
                        <td><?php echo $users[0]; ?></td>
                        <td><?php echo $users[1]; ?></td>
                        <td><?php echo $users[3]; ?></td>
                        <td>
                            <a href="#editUsuariosModal<?php echo $users[0] ?>" class="edit" data-toggle="modal"><i class="fa fa-pencil" data-toggle="tooltip" title="Editar"></i></a>
                            <?php
                              if ($users[0] != $_SESSION['id']){
                                  echo "<a href='#deleteUsuariosModal$users[0]' class='delete' data-toggle='modal'><i class='fa fa-trash' aria-hidden='true' data-toggle='tooltip' title='Deletar'></i></a>";
                              }
                            ?>
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
    <div id="addUsuariosModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="post" id="usuarioForm" name="frm_func" role="form">
                    <div class="modal-header">
                        <h4 class="modal-title">Adicionar Usuário</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group row" >
                            <label for="login" class="col-form-label" >Login:</label>
                            <input type="text" class="form-control" maxlength="60" name="login" required>
                        </div> 

                        <div class="form-group row" >
                            <label for="papel" class="col-form-label" >Papel:</label>
                            <select  class="form-control" name="papel">
                                <option value="">Usuário normal</option>
                                <option value="admin">Administrativo</option>
                            </select>
                        </div>

                        <div class="form-group row" >
                            <label for="senha" class="col-form-label" >Senha:</label>
                            <input type="password" class="form-control" maxlength="60" name="senha" required></br>
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

    <!-- MODAL DE EDIÇÃO  -->
    <?php
        if ($all_users):
            foreach($all_users as $us):
    ?>
    <div id="editUsuariosModal<?php echo $us[0]; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="post" id="editarusuarioForm" name="frm_func" role="form">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Usuário</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group row" >
                            <label for="login" class="col-form-label" >Login:</label>
                            <input type="text" class="form-control" maxlength="60" name="login" value="<?php echo $us[1] ?>" readonly>
                        </div> 

                        <div class="form-group row" >
                            <label for="papel" class="col-form-label" >Papel:</label>
                            <select  class="form-control" name="papel">
                                <option value="" <?=($us[3] !== 'admin')?'selected':''?> >Usuário normal</option>
                                <option value="admin" <?=($us[3] == 'admin')?'selected':''?> >Administrativo</option>
                            </select>
                        </div>

                        <div class="form-group row" >
                            <label for="senha" class="col-form-label" >Senha:</label>
                            <input type="password" class="form-control" maxlength="60" name="senha"></br>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control" name="action" value="2">
                        <input type="hidden" class="form-control" name="id_usuario" value="<?php echo $us[0]; ?>">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" value="Atualizar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL DE DELETAR --> 
    <div id="deleteUsuariosModal<?php echo $us[0]; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form method="post" class="deletarusuarioForm" name="frm_func" role="form">
                <!-- Modal content-->          
                <div class="modal-content">    
                    <div class="modal-header">
                        <h4 class="modal-title">Deletar Usuário</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="action" value="42">
                        <input type="hidden" name="id_usuario" value="<?php echo $us[0]; ?>">
                        <div class="alert alert-danger">Você desejar deletar o usuário <strong>
                                <?php echo $us[1]; ?>?</strong> </div>
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

    require_once(FOOTER_TEMPLATE);
    endif;
?>
