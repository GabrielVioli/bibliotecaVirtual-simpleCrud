create database if not exists exercicios;
use exercicios;
CREATE TABLE livros (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(250) NOT NULL,
    autor VARCHAR(250) NOT NULL,
    ano_publicacao INT,
    genero VARCHAR(100)
);

