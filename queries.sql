CREATE DATABASE '7thorsystems' --*** 
-- ***trocar pelo nome do banco, não serão criados outros usuários além do root, como o banco funciona em uma estrutura pequena não usaremos indices

CREATE TABLE IF NOT EXISTS fornecedores(
    id_forn INT (11),
    nome_empresa VARCHAR (80),
    nome_fantasia VARCHAR (80),
    endereco VARCHAR (50),
    cep INT(20),
    cnpj INT(20),
    contato INT (20),
    email VARCHAR (30),
    constraint fornecedores_pk PRIMARY KEY AUTO_INCREMENT(id_forn)
);

CREATE TABLE IF NOT EXISTS produtos(
    id_produto INT (11),
    id_forn INT (10),
    nome_produto VARCHAR (80),
    modelo VARCHAR (50),
    lote INT (20),
    preco FLOAT (5, 2),
    quantidade INT (20),
    constraint produto_pk PRIMARY KEY AUTO_INCREMENT (id_produto),
    constraint fornecedores_produtos_fk FOREIGN KEY (id_forn)
    REFERENCES fornecedores (id_forn)
);

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT (11),
    login VARCHAR(20) NULL,
    senha VARCHAR(20) NULL,
    constraint id_usuario_pk PRIMARY KEY AUTO_INCREMENT(id_user)
)

INSERT INTO usuarios (login, senha) VALUES ('root','123mudar4');
