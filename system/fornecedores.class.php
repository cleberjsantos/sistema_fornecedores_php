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
        public function deleltarFornecedores($id){
            
            $db = new Db();
            $sql = $db->sqlCmd("DELETE FROM fornecedores WHERE id_forn = ?", array($id), "count");

            if($sql){
                return true;
            }
        }
        public function getIdFornecedores($id){
            
            $db = new Db();
            $sql = $db->sqlCmd("SELECT * FROM fornecedores WHERE id_forn = ?", array($id), "rows");
            
            if($sql){
                return $sql;
            }
        }
        public function atualizarFornecedores($id, $cnpj, $nome_empresa, $nome_fantasia, $cep, $endereco, $email, $contato){
            
            $db = new Db();
            $sql = $db->sqlCmd("UPDATE fornecedores SET nome_empresa = ?, nome_fantasia = ?,  endereco = ?, cep = ?, cnpj = ?, contato = ?, email = ? WHERE id_forn = ?", array($nome_empresa, $nome_fantasia, $endereco, preg_replace("/[^0-9]/", "", $cep), $cnpj, $contato, $email, $id), "count");

            if($sql){
                return true;
            }
        }
    }
?>
