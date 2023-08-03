USE ecoage;

DROP TABLE IF EXISTS Curtidas;
DROP TABLE IF EXISTS Patente;
DROP TABLE IF EXISTS Ranking;
DROP TABLE IF EXISTS Usuario;
DROP TABLE IF EXISTS Tecidos;
DROP TABLE IF EXISTS Tipo_Tecidos;
DROP TABLE IF EXISTS tokens;
DROP TABLE IF EXISTS avatars;
DROP TABLE IF EXISTS Noticias;
DROP TABLE IF EXISTS Codigos;



CREATE TABLE avatars (
    id_avatar INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    caminho VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_avatar)
);

INSERT INTO avatars (nome, caminho) 
VALUES  ('Avatar 1', '../assets/avatars/avatar1.png'),
        ('Avatar 2', '../assets/avatars/avatar2.png'),
        ('Avatar 3', '../assets/avatars/avatar3.png'),
        ('Avatar 4', '../assets/avatars/avatar4.png');

CREATE TABLE Usuario(
    id_usuario INT AUTO_INCREMENT,
    nome_completo VARCHAR(50) NOT NULL,
    data_nasc DATE NOT NULL,
    tel VARCHAR(16), -- (016) 99603-2341
    apelido VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    verifica INT(1) NOT NULL,
    id_avatar INT NOT NULL,
    
     PRIMARY KEY(id_usuario),
     FOREIGN KEY (id_avatar)
        REFERENCES avatars(id_avatar) 
);

ALTER TABLE Usuario 
ADD tipo_usuario INT(1) NOT NULL DEFAULT 0;

INSERT INTO Usuario (nome_completo, data_nasc, tel, apelido, email, senha, verifica, id_avatar, tipo_usuario) 
VALUES ('ecoage', '2022-02-02','123456789' , 'ecoage', 'live.ecoage@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1); -- senha: admin

CREATE TABLE Patente (
     id_patente INT NOT NULL AUTO_INCREMENT,
     patente VARCHAR(100),

     PRIMARY KEY (id_patente)
);

CREATE TABLE Ranking (
    id_ranking INT NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_patente INT NOT NULL,
    carreteis INT,
    tempo VARCHAR(100),
    PRIMARY KEY (id_ranking),
    FOREIGN KEY (id_usuario) REFERENCES Usuario (id_usuario),
    FOREIGN KEY (id_patente) REFERENCES Patente (id_patente)
);

INSERT INTO Patente (patente)
VALUES ('Poliéster'),
       ('Seda'),
       ('Viscose'),
       ('Malha Sintética'),
       ('Bambu'),
       ('Tencel'),
       ('Linho'),
       ('Lã'),
       ('Algodão Orgânico');

CREATE TABLE Codigos(
    id_codigo INT AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    codigo INT(6) NOT NULL,
    data_expiracao DATETIME NOT NULL,

    PRIMARY KEY (id_codigo)
);

CREATE TABLE tokens (
  id_token INT AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  token VARCHAR(32) NOT NULL,
  data_expiracao DATETIME NOT NULL,

  PRIMARY KEY (id_token)
);

CREATE TABLE Tipo_Tecidos (
    id_tipo_tecidos INT AUTO_INCREMENT,
    nome_tecidos VARCHAR(255) NOT NULL,

    PRIMARY KEY (id_tipo_tecidos)
);

CREATE TABLE Tecidos(
    id_tecidos INT AUTO_INCREMENT,
    id_tipo_tecidos INT NOT NULL,
    composicao VARCHAR(800) NOT NULL,
    producao VARCHAR(800) NOT NULL,
    meioambiente VARCHAR(800) NOT NULL,
    caminho_imagem VARCHAR(255) NOT NULL,

    PRIMARY KEY (id_tecidos),
    FOREIGN KEY (id_tipo_tecidos)
        REFERENCES Tipo_Tecidos(id_tipo_tecidos)
);


INSERT INTO Tipo_Tecidos(nome_tecidos)
VALUES  
        ('Algodão Orgânico'),
        ('Lã'),
        ('Linho'),
        ('Tencel'),
        ('Bambu'),
        ('Malha Sintética'),
        ('Viscose'),
        ('Seda'),
        ('Poliéster');

-- Para adicionar o campo checkbox: 
ALTER TABLE Tecidos 
ADD sustentavel BOOLEAN NOT NULL DEFAULT false;

INSERT INTO Tecidos(id_tipo_tecidos, composicao, producao, meioambiente, caminho_imagem, sustentavel)
VALUES 

(1, 
' Não utiliza agrotóxicos e pesticidas.',
' Utilização de corantes naturais, a água é reaproveitada e há uma rotação de culturas.' ,
' Ajuda o meio ambiente, no qual se mostrou 46% menos instigante ao aquecimento global.',
 '../assets/imagens_tecido/tecido.png', 1),
       
(2, 
'Lã de ovelhas e inseticidas sintéticos.',
' Temos a tosa dos animais, em seguida ocorre a lavagem, cardagem e fiamento das fibras. ',
' Impactos negativos no meio ambiente com o uso de produtos químicos e o abate 
em massa dos animais, no qual são amarrados e se machucam, ocorre uma contaminação do solo, água e fauna, além da emissão de gás metano, detergentes e graxa.',
 '../assets/imagens_tecido/tecido.png', 1),

(3,
'Fibras da planta do linho.', 
' Sua produção é feita a partir de plantações de linho, que são colhidas e passam por processos de separação das fibras, fiação 
e tecelagem. ',
' Ajudam o meio ambiente por ser biodegradável, renovável e por necessitar de 
pouca água e fertilizantes na produção.', '../assets/imagens_tecido/tecido.png', 1),

(4, 
'Madeira de eucalipto, a partir de celulose de origem vegetal.', 
'No processo de produção é utilizado o N-metyl morfholine oxide, um solvente biodegradável que é considerado ecologicamente viável
por não ser tóxico e por meio de injetores de fiação, a celulose é coagulada e então a fibra é lavada, secada e posteriormente cortada. ',
'As fibras são biodegradáveis e compostáveis, reduzindo o impacto ambiental.', '../assets/imagens_tecido/tecido.png', 1),

(5,
'Fibra da planta do bambu.', 
'A produção do tecido começa com a extração da polpa da planta, que é transformada em fios e, 
em seguida, tecida em um tecido macio e respirável.', 
'Não há impactos ambientais, pois o processo de fabricação do tecido de bambu é menos poluente e também é biodegradável.','../assets/imagens_tecido/tecido.png', 1),

(6, 
'Entrelaçamento de fios de trama e urdidura, pode ser feito de algodão, lã, poliéster, entre outros materiais',
'Sua fabricação ocorre através de um processo de tricotagem, que pode ser feito manualmente ou por 
máquinas. ',
'O uso excessivo de  materiais sintéticos na fabricação de malhas pode não ser sustentável, causando um grande impacto ambiental.', '../assets/imagens_tecido/tecido_bloqueado.png', 0),

(7, 
'Celulose de madeira ou de outras plantas.', 
'Sua fabricação envolve a dissolução da celulose que é extrudado em fios que são transformados em tecido.', 
'Sua fabricação pode ser prejudicial ao meio ambiente e aos trabalhadores, pois requer muita água e produtos químicos tóxicos. 
Além disso, a produção tem sido associada a desmatamento, trabalho escravo e poluição 
de rios.', '../assets/imagens_tecido/tecido_bloqueado.png', 0),

(8,
'Bichos-da-seda.',
'Os bichos-da-seda são “domesticados” e criados em fazendas. Quando esses animais entram na fase de pupa, após finalizarem seus casulos, eles são colocados em água fervente, o que os mata e possibilita a extração da seda.',
'Impactos negativos no meio ambiente devido a  quantidade de água e energia utilizada em sua fabricação',
'../assets/imagens_tecido/tecido_bloqueado.png', 0),


(9, 
'Petróleo ou do gás natural.',
'Sua fabricação envolve a transformação de matérias-primas químicas em fibras através de um processo chamado de polimerização.', 
'Sua produção é altamente poluente e contribui para o aumento da emissão de gases de efeito estufa, prejudicando 
o meio ambiente e a saúde humana.', '../assets/imagens_tecido/tecido_bloqueado.png', 0);

CREATE TABLE Noticias(
    id_noticia INT AUTO_INCREMENT,
    titulo_noticia VARCHAR(800) NOT NULL,
    data_noticia DATE NOT NULL,
    url_noticia VARCHAR(800) NOT NULL,
    descricao_noticia VARCHAR(300) NOT NULL,
    curtidas INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id_noticia)
);

INSERT INTO Noticias (titulo_noticia, data_noticia, url_noticia , descricao_noticia) 
VALUES 
('Tecidos sustentáveis são apostas da indústria têxtil para reduzir poluição', '2022-10-24',
'https://oglobo.globo.com/economia/esg/noticia/2022/10/tecidos-sustentaveis-sao-apostas-da-industria-textil-para-reduzir-poluicao.ghtml' , 
'Produto é alternativa para gerar menos impacto ambiental na produção e no descarte de produtos têxteis.'),

('Um efeito borboleta: a indústria da moda e meio-ambiente', '2022-02-02',
'https://wp.ufpel.edu.br/empauta/um-efeito-borboleta-a-industria-da-moda-e-meio-ambiente/',
'Quando se fala no impacto ambiental da indústria da moda se fala muito mais que apenas na extração de matérias-primas, mas também no consumo de...'),

('Qual é o impacto que nossas roupas causam ao meio ambiente?','2022-02-02',
'https://noticias.r7.com/tecnologia-e-ciencia/qual-e-o-impacto-que-nossas-roupas-causam-ao-meio-ambiente-01122021',
'O consumo excessivo e rápido de peças de roupa, que surge do padrão de produção do fast-fashion (moda rápida), é cada vez mais nocivo para o...'),

('Fast Fashion: como a moda pode ameaçar o meio ambiente?', '2022-12-20',
'https://exame.com/negocios/fast-fashion-moda-ameacar-meio-ambiente/',
'Produção em larga escala de roupas baratas e incentivo ao consumismo geram peças descartáveis; 
modelo também tem denúncias de violação de direitos dos trabalhadores.'),

('Novidades sustentáveis no mundo têxtil: o que vem por aí', '2022-06-7',
'https://fcem.com.br/noticias/novidades-sustentaveis-no-mundo-textil-o-que-vem-por-ai/',
'O mundo têxtil é um dos grandes poluidores do planeta, nada de novo nisso. Novidade são as tecnologias que estão sendo desenvolvidas...'),

('Moda sustentável e tecnologia: A transformação já está acontecendo', '2022-01-04',
'https://harpersbazaar.uol.com.br/bazaar-green/moda-sustentavel-e-tecnologia-a-transformacao-ja-esta-acontecendo/',
'Tecnologia pode ser chave para transformação sustentável da indústria da moda.'),

('O que a moda sustentável pode aprender com o mundo em 2021', '21-08-30',
'https://ffw.uol.com.br/noticias/sustentabilidade/o-que-a-moda-sustentavel-pode-aprender-com-o-mundo-em-2021/',
'Sustentabilidade: Uma mensagem sobre o presente.'),

('Upcycling e Recycling: O que são os termos da moda sustentável', '2023-01-27',
'https://harpersbazaar.uol.com.br/bazaar-green/upcycling-e-recycling-o-que-sao-os-termos-da-moda-sustentavel/',
'Conheça qual a diferença entre os dois conceitos e como eles podem ser aplicados.'),

('Chiara Gadaleta, especialista em sustentabilidade aponta destaques da moda sustentável no mundo', '2020-07-11',
'https://harpersbazaar.uol.com.br/bazaar-green/chiara-gadaleta-especialista-em-sustentabilidade-aponta-destaques-da-moda-sustentavel-no-mundo/',
'Boas notícias na moda do novo mundo.'),

('Sesc São Paulo realiza feiras e conversas sobre moda sustentável', '2023-03-14',
'https://orbi.band.uol.com.br/programacao/sesc-sao-paulo-realiza-feiras-e-conversas-sobre-moda-sustentavel-4599',
'O Sesc São Paulo realizará, a partir do dia 25 de março, diversas ações relacionadas à Moda Sustentável, como feiras de trabalhos autorais e autônomos e conversas sobre a cadeia produtiva da moda alternativa.'),

('Conheça o primeiro museu interativo do mundo para inovação e moda sustentável', '19-06-06',
'https://ffw.uol.com.br/noticias/sustentabilidade/conheca-o-primeiro-museu-interativo-do-mundo-para-inovacao-e-moda-sustentavel/',
'Museu interativo inovador promove moda sustentável e conscientização ambiental em todo o mundo.');

CREATE TABLE Curtidas(
    id_curtida INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_noticia INT, 
    id_usuario INT,
    FOREIGN KEY (id_noticia) REFERENCES Noticias(id_noticia),
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);
