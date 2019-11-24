<?php

    require_once('config.php');
    require_once('bcrypt.class.php');
    require_once(DBAPI);

    class Usuarios {
        public function getUsuarios(){
            $db = new Db();
            $sql = $db->sqlCmd("SELECT * FROM usuarios", "", "rows");

            if($sql){
                return $sql;
            }
        }
        public function deleltarUsuarios($id){
            
            $db = new Db();
            $sql = $db->sqlCmd("DELETE FROM usuarios WHERE id_usuario = ?", array($id), "count");

            if($sql){
                return true;
            }
        }
        public function cadastrarUsuarios($login, $senha, $papel){
            $db = new Db();
            $pwd = Bcrypt::hash($senha);
            $sql = $db->sqlCmd("INSERT INTO usuarios (login, senha, papel) VALUES (?, ?, ?)", array($login, $pwd, $papel), "count");

            if($sql){
                return true;
            }
        }
        public function login($login, $senha) {

            $db = new Db();
            $sql = $db->sqlCmd("SELECT * FROM usuarios WHERE login = ?", array($login), "rows");

            if($sql){

                foreach($sql as $row) {
                    $hash = $row[2];
                    if (Bcrypt::check($senha, $hash)){
                        $_SESSION['loggedin'] = TRUE;
                        $_SESSION['name'] = $login;
                        $_SESSION['id'] = $row[0];
                        $_SESSION['role'] = $row[3];
                        header('Location: index.php');
                    } else {
                        header('Location: login.php?msg=Senha inválida&box=danger');
                    }
                }

            } else {
                header('Location: login.php?msg=Usuário inválido&box=danger');
            }
        }
        public function atualizarUsuario($id_usuario, $senha, $papel) {
            $db = new Db();
            if (isset($senha) && !empty($senha)){
                $pwd = Bcrypt::hash($senha);
                $sql = $db->sqlCmd("UPDATE usuarios SET senha = ?, papel = ? WHERE id_usuario = ?", array($pwd, $papel, $id_usuario), "count");
            } else {
                $sql = $db->sqlCmd("UPDATE usuarios SET papel = ? WHERE id_usuario = ?", array($papel, $id_usuario), "count");
            }

            if($sql){
                return true;
            }
        }
    }
?>
