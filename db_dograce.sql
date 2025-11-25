CREATE DATABASE dograce;

USE dograce;

CREATE TABLE adocoes (
    nome_id varchar(255) PRIMARY KEY,
    cachorro_id int,
    usuario_id int,
    data_adocao timestamp,
    status varchar(50),
    observacoes text,
    numero_id varchar(11)
);

CREATE TABLE cachorros_adocao (
    id int AUTO_INCREMENT PRIMARY KEY,
    nome varchar(50),
    raca varchar(50),
    idade int,
    tamanho enum('pequeno', 'medio', 'grande'),
    descricao text,
    personalidade text,
    imagem varchar(255),
    disponivel tinyint(1),
    data_cadastro timestamp
);

CREATE TABLE categorias (
    id int AUTO_INCREMENT PRIMARY KEY,
    nome varchar(50),
    descricao text
);

CREATE TABLE corridas (
    id int PRIMARY KEY,
    nome varchar(100),
    data_corrida date,
    localizacao varchar(255),
    descricao text,
    categoria enum('iniciante', 'intermediario', 'avancado', 'profissional'),
    status enum('agendada', 'em_andamento', 'finalizada'),
    data_criacao timestamp
);

CREATE TABLE inscricoes_corrida (
    id int AUTO_INCREMENT PRIMARY KEY,
    nome_dono varchar(255),
    equipe varchar(255),
    email varchar(150),
    nome_cachorro varchar(255),
    raca varchar(50),
    idade int,
    categoria varchar(50),
    experiencia text,
    comportamento varchar(255),
    data_inscricao datetime
);

CREATE TABLE produtos (
    id int AUTO_INCREMENT PRIMARY KEY,
    nome varchar(100),
    descricao text,
    preco decimal(10,2),
    categoria_id int,
    tipo enum('carro', 'roupa'),
    cor_principal varchar(20),
    imagem varchar(255),
    estoque int,
    ativo tinyint(1),
    data_cadastro timestamp
);

CREATE TABLE usuarios (
    id int AUTO_INCREMENT PRIMARY KEY,
    nome varchar(100),
    email varchar(100),
    telefone varchar(100),
    endereco text,
    data_cadastro timestamp,
    tipo enum('cliente', 'admin'),
    password varchar(255)
);

ALTER TABLE adocoes DROP PRIMARY KEY;
ALTER TABLE adocoes CHANGE nome_id nome VARCHAR(255);
