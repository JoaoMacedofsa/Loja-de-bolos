CREATE DATABASE empresa;

CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
);

CREATE DATABASE bolos;

CREATE TABLE bolo(
    id_bolo INT AUTO_INCREMENT PRIMARY KEY,
    nome_bolo VARCHAR(200) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    imagem_url VARCHAR(200) NOT NULL,
)
