CREATE DATABASE IF NOT EXISTS 7thorsystems;
GRANT ALL ON 7thorsystems.* TO 'root'@'localhost';
FLUSH PRIVILEGES;

-- ***trocar pelo nome do banco, não serão criados outros usuários além do root, como o banco funciona em uma estrutura pequena não usaremos indices

CREATE TABLE IF NOT EXISTS fornecedores(
   id_forn INT PRIMARY KEY AUTO_INCREMENT,
   nome_empresa VARCHAR (160),
   nome_fantasia VARCHAR (160),
   endereco VARCHAR (130),
   cep INT(20),
   cnpj VARCHAR(20),
   contato VARCHAR (20),
   email VARCHAR (60)
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS produtos(
   id_produto INT (11),
   id_forn INT (10),
   nome_produto VARCHAR (160),
   modelo VARCHAR (80),
   lote INT (20),
   preco DECIMAL (5, 2),
   quantidade INT (20),
   constraint produto_pk PRIMARY KEY AUTO_INCREMENT (id_produto),
   constraint fornecedores_produtos_fk FOREIGN KEY (id_forn)
   REFERENCES fornecedores (id_forn)
) ENGINE = MyISAM;

CREATE TABLE IF NOT EXISTS usuarios (
           id_usuario INT PRIMARY KEY AUTO_INCREMENT,
           login VARCHAR(60) UNIQUE,
           senha VARCHAR(60),
           papel VARCHAR(40)
) ENGINE = MyISAM;

INSERT INTO usuarios(login, senha, papel) VALUES ('root', '123mudar4', 'admin');
