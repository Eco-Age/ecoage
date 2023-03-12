USE ecoage;

DROP TABLE IF EXISTS Usuario;
DROP TABLE IF EXISTS Tecidos;
DROP TABLE IF EXISTS Tipo_Tecidos;
DROP TABLE IF EXISTS tokens;
DROP TABLE IF EXISTS avatars;


CREATE TABLE Usuario(
    id_usuario INT AUTO_INCREMENT,
    nome_completo VARCHAR(50) NOT NULL,
    data_nasc DATE NOT NULL,
    tel VARCHAR(16) NOT NULL, -- (016) 99603-2341
    apelido VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    id_avatar INT NOT NULL,
    
     PRIMARY KEY(id_usuario),
     FOREIGN KEY (id_avatar)
        REFERENCES avatars(id_avatar)
);

CREATE TABLE tokens (
  id_token INT AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  token VARCHAR(32) NOT NULL,
  data_expiracao DATETIME NOT NULL,

  PRIMARY KEY (id_token)
);


INSERT INTO Usuario (nome_completo, data_nasc, tel, apelido, email, senha, id_avatar) 
VALUES ('ecoage', '2022-02-02','123456789' , 'ecoage', 'live.ecoage@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1); -- senha: admin


CREATE TABLE Tipo_Tecidos (
    id_tipo_tecidos INT AUTO_INCREMENT,
    nome_tecidos VARCHAR(255) NOT NULL,

    PRIMARY KEY (id_tipo_tecidos)
);

CREATE TABLE Tecidos(
    id_tecidos INT AUTO_INCREMENT,
    id_tipo_tecidos INT NOT NULL,
    desc_tecidos VARCHAR(255) NOT NULL,

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

INSERT INTO Tecidos(id_tipo_tecidos, desc_tecidos)
VALUES (1, 'Os tecidos de algodão são de fibra natural macia e por isso são conhecidos pelo seu conforto térmico, durabilidade e capacidade de se adaptar para todos'),
       (2, 'A lã é derivada da pelagem da ovelha, da vicunha, da alpaca, da alpama ou da lhama que, depois de tosquiado, é processado industrialmente para usos têxteis, limpeza e coloração.');

-- Para adicionar o campo checkbox: 
ALTER TABLE Tecidos 
ADD sustentavel BOOLEAN NOT NULL DEFAULT false;

CREATE TABLE avatars (
    id_avatar INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    caminho VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_avatar)
);

INSERT INTO avatars (nome, caminho) 
VALUES  ('Avatar 1', '../avatars/avatar1.png'),
        ('Avatar 2', '../avatars/avatar2.png'),
        ('Avatar 3', '../avatars/avatar3.png'),
        ('Avatar 4', '../avatars/avatar4.png');
        

