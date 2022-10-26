USE ecoage;

DROP TABLE IF EXISTS Usuario;

CREATE TABLE Usuario(
    id_usuario INT AUTO_INCREMENT,
    nome_completo VARCHAR(50) NOT NULL,
    data_nasc DATE NOT NULL,
    tel VARCHAR(15) NOT NULL, -- (16) 99603-2341
    apelido VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    
    PRIMARY KEY(id_usuario)
);