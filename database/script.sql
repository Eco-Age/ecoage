USE ecoage;

DROP TABLE IF EXISTS Usuario;
DROP TABLE IF EXISTS Tecidos;
DROP TABLE IF EXISTS Tipo_Tecidos;

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



CREATE TABLE Tipo_Tecidos (
    id_tipo_tecidos INT AUTO_INCREMENT,
    nome_tecidos VARCHAR(255) NOT NULL,

    PRIMARY KEY (id_tipo_tecidos)
);

CREATE TABLE Tecidos(
    id_tecidos INT AUTO_INCREMENT,
    id_tipo_tecidos INT NOT NULL,
    desc_tecidos VARCHAR(255) NOT NULL,
    sustentavel BOOLEAN NOT NULL,

    PRIMARY KEY (id_tecidos),
    FOREIGN KEY (id_tipo_tecidos)
        REFERENCES Tipo_Tecidos(id_tipo_tecidos)
);

INSERT INTO Tipo_Tecidos(nome_tecidos)
VALUES  ('Algodão'),
        ('Lã'),
        ('Malha'),
        ('Viscose'),
        ('Seda'),
        ('Linho'),
        ('Poliester');

INSERT INTO Tecidos(id_tipo_tecidos, desc_tecidos , sustentavel)
VALUES (1, 'Os tecidos de algodão são de fibra natural macia e por isso são conhecidos pelo seu conforto térmico, durabilidade e capacidade de se adaptar para todos',0),
       (2, 'A lã é derivada da pelagem da ovelha, da vicunha, da alpaca, da alpama ou da lhama que, depois de tosquiado, é processado industrialmente para usos têxteis, limpeza e coloração.',0);
