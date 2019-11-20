<?php

    require_once('config.php');
    require_once(DBAPI);

    class Fornecedores {
        public function getFornecedores(){
            
            $db = new Db();
            $sql = $db->sqlCmd("SELECT * FROM fornecedores", "", "rows");
            
            if($sql){
                return $sql;
            }
        }
        public function cadastrarFornecedores($cnpj, $nome_empresa, $nome_fantasia, $cep, $endereco, $email, $contato){
            $db = new Db();
            $sql = $db->sqlCmd("INSERT INTO fornecedores (nome_empresa, nome_fantasia, endereco, cep, cnpj, contato, email) VALUES (?, ?, ?, ?, ?, ?, ?)", array($nome_empresa, $nome_fantasia, $endereco, preg_replace("/[^0-9]/", "", $cep), $cnpj, $contato, $email), "count");

            if($sql){
                return true;
            }

        }
        public function delFornecedores($id){
            
            $db = new Db();
            $sql = $db->prepare("DELETE FROM usuarios WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            return true;
        }
        public function login($login, $senha) {

            $db = new Db();
            $sql = $db->sqlCmd("SELECT id_usuario, login, senha FROM usuarios WHERE login = ?", array($login), "rows");

            if($sql){

                foreach($sql as $row) {
                    $hash = $row[2];
                    if (Bcrypt::check($senha, $hash)){
                        $_SESSION['loggedin'] = TRUE;
                        $_SESSION['name'] = $login;
                        $_SESSION['id'] = $row[0];
                        header('Location: index.php');
                    } else {
                        header('Location: login.php?msg=Senha inválida&box=danger');
                    }
                }

            } else {
                header('Location: login.php?msg=Usuário inválido&box=danger');
            }
        }
        public function getIdUsuario($id){
            
            $db = new Db();
            $sql = $db->prepare("SELECT * from usuarios where id = :id ");
            $sql->bindValue(":id", $id);
            $sql->execute();
            $row = $sql->fetch();
            return $row;
        }
        public function atualizarUsuario($nome, $email, $senha,$cep, $rua, $bairro, $cidade, $telefone, $id) {
            
            $db = new Db();
            $sql = $db->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha,  cep = :cep, rua = :rua, bairro = :bairro, cidade = :cidade, telefone = :telefone where id = :id");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", $senha);
            $sql->bindValue(":cep", $cep);
            $sql->bindValue(":rua", $rua);
            $sql->bindValue(":bairro", $bairro);
            $sql->bindValue(":cidade", $cidade);
            $sql->bindValue(":telefone", $telefone);
            $sql->bindValue(":id", $id);
            $sql->execute();
            return true;
        }
    }
?>
