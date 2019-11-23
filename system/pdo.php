<?php

    require_once('system/bcrypt.class.php');
    mysqli_report(MYSQLI_REPORT_STRICT);

    class Db {

        public function installDb($db) {
            $senha = Bcrypt::hash('123mudar4');

            $TABELAS = ["CREATE TABLE IF NOT EXISTS `". DB_NAME ."`.usuarios (
                            id_usuario INT PRIMARY KEY AUTO_INCREMENT,
                            login VARCHAR(30),
                            senha VARCHAR(60)) ENGINE = MyISAM;
                            INSERT INTO ". DB_NAME .".usuarios(login, senha) VALUES ('root', '$senha')",
                        "CREATE TABLE IF NOT EXISTS `". DB_NAME ."`.fornecedores(
                            id_forn INT PRIMARY KEY AUTO_INCREMENT,
                            nome_empresa VARCHAR (160),
                            nome_fantasia VARCHAR (160),
                            endereco VARCHAR (130),
                            cep INT(20),
                            cnpj VARCHAR(20),
                            contato VARCHAR (20),
                            email VARCHAR (60)) ENGINE = MyISAM;",
                        "CREATE TABLE IF NOT EXISTS `". DB_NAME ."`.produtos(
                            id_produto INT PRIMARY KEY AUTO_INCREMENT,
                            id_forn INT (10),
                            nome_produto VARCHAR (160),
                            modelo VARCHAR (80),
                            lote INT (20),
                            preco FLOAT (5, 2),
                            quantidade INT (20),
                            constraint fornecedores_produtos_fk FOREIGN KEY (id_forn)
                            REFERENCES fornecedores (id_forn)) ENGINE = MyISAM;"
                       ];

              // Prepare statement
              $db_base = $db->prepare("CREATE DATABASE IF NOT EXISTS `". DB_NAME ."`;
                                       GRANT ALL ON `". DB_NAME ."`.* TO '". DB_USER ."'@'localhost';
                                       FLUSH PRIVILEGES;");
              $db_base->execute();
              if ((int)$db_base->rowCount() == 1){

                  // Executa a criação das tabelas
                  foreach ($TABELAS as $command) {
                      try {
                          $db_base = $db->prepare($command);
                          $db_base->execute();
                      } catch (Exception $e) {
                            echo "Erro: " . $e->getMessage() . "<br/>";
                            die();
                      }
                  }

              }
        }

        public function dbRoot() {
            // Cria a conexão PDO como root e tenta conectar
            try {

                $conexao_pdo = new PDO('mysql:host=' . DB_HOST, DB_USER, DB_PASSW);
                $conexao_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // PDO fetch docs: http://php.net/manual/en/pdostatement.fetch.php
                $conexao_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                return $conexao_pdo;

            } catch (PDOException $e) {
                // Se der algo errado, mostra o erro PDO
                echo "Erro: " . $e->getMessage() . "<br/>";                               
                // Mata o script
                //die();
                return null;
            }
        }

        public function openDb() {
            // Cria a conexão PDO e tenta conectar
            try {
                $conexao_pdo = new PDO(DB_DSN, DB_USER, DB_PASSW);
                $conexao_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // PDO fetch docs: http://php.net/manual/en/pdostatement.fetch.php
                $conexao_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                return $conexao_pdo;

            } catch (PDOException $e) {
                $unknown = strstr(strtolower($e->getMessage()), 'unknown database');

                if((int)$e->getCode() == 1049 and $unknown){
                    // Vamos criar a estrutura
                    $db = $this->dbRoot();
                    $conn = $this->installDb($db);
                    $db->query("use ". DB_NAME);

                    return $db;

                } else {
                    // Se der algo errado, mostra o erro PDO
                    echo "Erro: " . $e->getMessage() . "<br/>";
                    // Mata o script
                    //die();
                    return null;
                }
            }
        }

        // Simple function to handle PDO prepared statements
        // https://codepen.io/terf/post/php-pdo-functions
        public function sqlCmd($q, $params, $return) {
              $db = $this->openDb();
              // Prepare statement
              $stmt = $db->prepare($q);

              if($params) {
                  // Execute statement
                  $stmt->execute($params);
              } else {
                  $stmt->execute();
              }
              // Decide whether to return the rows themselves, or just count the rows
              if ($return == "rows") {
                return $stmt->fetchAll(PDO::FETCH_NUM);
              }
              //elseif ($return == "count") {
              else {
                return $stmt->rowCount();
              }
        }
    }

?>
