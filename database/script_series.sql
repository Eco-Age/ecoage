USE serie;

DROP TABLE IF EXISTS Series;
DROP TABLE IF EXISTS Categoria;


CREATE TABLE Categoria(
    id_categoria INT AUTO_INCREMENT,
    nome_categoria VARCHAR(30) NOT NULL,

    PRIMARY KEY (id_categoria)
);

CREATE TABLE Series(
    id_serie INT AUTO_INCREMENT,
    id_categoria INT NOT NULL,
    nome_serie VARCHAR(30) NOT NULL,
    qtd_temporadas INT NOT NULL,
    ano_lancamento INT NOT NULL,
    resumo VARCHAR(300) NOT NULL,
    assistida VARCHAR(300) NOT NULL,

    PRIMARY KEY (id_serie),
    FOREIGN KEY (id_categoria)
        REFERENCES Categoria (id_categoria)
);

CREATE TABLE Usuario(
    id_usuario INT AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nome VARCHAR(255) NOT NULL,

    PRIMARY KEY (id_usuario)
);

INSERT INTO Categoria(nome_categoria)
VALUES  ('Romance'),
        ('Ação'),
        ('Suspense'),
        ('Comédia'),
        ('Comédia Romântica'),
        ('Mistério');

INSERT INTO Series(id_categoria, nome_serie, qtd_temporadas, ano_lancamento, resumo, assistida)
VALUES (1,'Teen Wolf',2,2006,'Série de Lobos',1),
       (2,'Chicago Med',1067,2016,'Aventura pelo hospital',1),
       (3,'A matilha',780,2022,'Caso de desaparecimento',1);  

INSERT INTO Usuario(nome,email,senha) 
VALUES ('Ana','anaberocha@hotmail.com', 'Anab5atr9z'); 

ALTER TABLE Series
ADD data_cadastro DATE NOT NULL DEFAULT '2022-08-10';
