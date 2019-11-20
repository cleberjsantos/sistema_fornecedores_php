<?php

    require_once('config.php');
    require_once('bcrypt.class.php');
    require_once(DBAPI);

    class Usuarios {
        public function getUsuarios(){
            
            $db = new Db();
            $sql = $db->query("SELECT * FROM usuarios");
            $row = $sql->fetchAll();
            return $row;
        }
        public function delUsuarios($id){
            
            $db = new Db();
            $sql = $db->prepare("DELETE FROM usuarios WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            return true;
        }
        public function cadastrar($nome, $email, $senha,$cep, $rua, $bairro, $cidade , $telefone) {
            
            $db = new Db();
            $sql = $db->prepare("SELECT id FROM usuarios WHERE email = :email");
            $sql->bindValue(":email", $email);
            $sql->execute();
            if($sql->rowCount() == 0) {
                $sql = $db->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, senha = :senha,  cep = :cep, rua = :rua, bairro = :bairro, cidade = :cidade,telefone = :telefone");
                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":email", $email);
                $sql->bindValue(":senha", $senha);
                $sql->bindValue(":cep", $cep);
                $sql->bindValue(":rua", $rua);
                $sql->bindValue(":bairro", $bairro);
                $sql->bindValue(":cidade", $cidade);
                $sql->bindValue(":telefone", $telefone);
                
                $sql->execute();
                return true;
            } else {
                return false;
            }
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
