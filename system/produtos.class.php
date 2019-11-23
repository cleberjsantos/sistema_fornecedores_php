<?php

    require_once('config.php');
    require_once(DBAPI);

    class Produtos {
        public function getProdutos(){
            
            $db = new Db();
            $sql = $db->sqlCmd("SELECT * FROM produtos", "", "rows");
            
            if($sql){
                return $sql;
            }
        }
        public function cadastrarProdutos($id_forn, $nome_produto, $modelo, $lote, $preco, $quantidade){
            $db = new Db();
            $sql = $db->sqlCmd("INSERT INTO produtos (id_forn, nome_produto, modelo, lote, preco, quantidade) VALUES (?, ?, ?, ?, ?, ?)", array($id_forn, $nome_produto, $modelo, $lote, $preco, $quantidade), "count");

            if($sql){
                return true;
            }

        }
        public function deleltarProdutos($id){
            
            $db = new Db();
            $sql = $db->sqlCmd("DELETE FROM produtos WHERE id_forn = ?", array($id), "count");

            if($sql){
                return true;
            }
        }
        public function getIdProdutos($id){
            
            $db = new Db();
            $sql = $db->sqlCmd("SELECT * FROM produtos WHERE id_forn = ?", array($id), "rows");
            
            if($sql){
                return $sql;
            }
        }
        public function atualizarProdutos($id, $cnpj, $nome_empresa, $nome_fantasia, $cep, $endereco, $email, $contato){
            
            $db = new Db();
            $sql = $db->sqlCmd("UPDATE produtos SET nome_empresa = ?, nome_fantasia = ?,  endereco = ?, cep = ?, cnpj = ?, contato = ?, email = ? WHERE id_forn = ?", array($nome_empresa, $nome_fantasia, $endereco, preg_replace("/[^0-9]/", "", $cep), $cnpj, $contato, $email, $id), "count");

            if($sql){
                return true;
            }
        }
    }
?>
