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
        public function atualizarProdutos($id_prod, $id_forn, $nome_produto, $modelo, $lote, $preco, $quantidade){
            
            $db = new Db();
            $sql = $db->sqlCmd("UPDATE produtos SET id_forn = ?, nome_produto = ?, modelo = ?, lote = ?, preco = ?, quantidade = ? WHERE id_produto = ?", array($id_forn, $nome_produto, $modelo, $lote, $preco, $quantidade, $id_prod), "count");

            if($sql){
                return true;
            }
        }
    }
?>
