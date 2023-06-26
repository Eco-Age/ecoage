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
    desc_tecidos VARCHAR(800) NOT NULL,
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

INSERT INTO Tecidos(id_tipo_tecidos, desc_tecidos, caminho_imagem, sustentavel)
VALUES 

(1, 
'O algodão orgânico é um tipo de tecido produzido a partir de plantas cultivadas 
sem o uso de produtos químicos sintéticos. Essa técnica segue padrões ecológicos e sustentáveis, 
contribuindo para a preservação do meio ambiente e a saúde dos trabalhadores envolvidos na cadeia 
produtiva. Além disso, utiliza menos água no processo de cultivo e produção, e é mais macio, 
durável e indicado para pessoas com pele sensível.', '../assets/imagens_tecido/tecido.png', 1),
       
(2, 
'A lã é um tecido natural produzido a partir do pelo de animais, como ovelhas, cabras e alpacas. 
É encontrado principalmente em regiões de clima frio. 
Para fabricá-la, temos a tosa dos animais, seguida de lavagem, cardagem e fiamento das 
fibras. Apesar de ser um tecido durável e confortável, a produção em larga escala pode ter impactos 
negativos no meio ambiente com o uso de produtos químicos e o abate 
em massa dos animais. Então, é importante escolher produtos de lã de fontes sustentáveis, que 
respeitam os direitos dos animais e adotam práticas ecológicas na produção.', '../assets/imagens_tecido/tecido.png', 1),

(3,
'O linho é um tecido natural feito a partir das fibras da planta do linho. É encontrado em 
roupas de cama, mesa e banho, além de roupas casuais e elegantes. Sua produção é feita a partir 
de plantações de linho, que são colhidas e passam por processos de separação das fibras, fiação 
e tecelagem. O linho é um tecido sustentável por ser biodegradável, renovável e por necessitar de 
pouca água e fertilizantes na produção. Além disso, é um tecido durável, resistente, respirável e 
absorvente, ideal para climas quentes e úmidos.', '../assets/imagens_tecido/tecido.png', 1),

(4, 
'O Tencel é um tecido produzido a partir de madeira de eucalipto, uma fonte renovável. 
A celulose é dissolvida em um solvente não tóxico e transformada em fibras. É encontrado em 
roupas, lençóis e toalhas. Sua fabricação usa menos água e energia do que a do algodão. 
As fibras são biodegradáveis e compostáveis, reduzindo o impacto ambiental. Além disso, o 
Tencel tem propriedades de absorção de umidade, é resistente a rugas e macio ao toque. É 
considerado um tecido sustentável por sua produção ambientalmente consciente e por ser renovável 
e biodegradável.', '../assets/imagens_tecido/tecido.png', 1),

(5,
'O tecido de bambu é feito a partir da fibra da planta do bambu, que cresce rapidamente e é 
facilmente renovável. É encontrado principalmente em regiões da Ásia, onde o bambu é cultivado. 
A fabricação do tecido começa com a extração da polpa da planta, que é transformada em fios e, 
em seguida, tecida em um tecido macio e respirável. O bambu é considerado um tecido sustentável 
devido à sua rápida taxa de crescimento e capacidade de regeneração natural. Além disso, o 
processo de fabricação do tecido de bambu é menos poluente do que o processo de fabricação de 
outros tipos de tecidos, como o algodão. O tecido de bambu é também biodegradável, o que significa
que não contribui para a poluição do meio ambiente quando descartado.', '../assets/imagens_tecido/tecido.png', 1),

(6, 
'A malha é um tecido produzido através da entrelaçamento de fios de trama e urdidura, 
formando um tecido flexível e elástico. É comumente usado na fabricação de roupas esportivas, 
moda casual e íntima. Pode ser feito de algodão, lã, poliéster, entre outros materiais. 
Sua fabricação ocorre através de um processo de tricotagem, que pode ser feito manualmente ou por 
máquinas. No entanto, o uso excessivo de poliéster e outros materiais sintéticos na fabricação de 
malhas pode não ser sustentável, pois estes materiais não são biodegradáveis e a produção em grande 
escala pode ter um grande impacto ambiental.', '../assets/imagens_tecido/tecido_bloqueado.png', 0),

(7, 
'A viscose é um tecido produzido a partir de celulose de madeira ou de outras plantas. 
É encontrado em roupas leves e frescas, como blusas, vestidos e lenços. Sua fabricação envolve a 
dissolução da celulose que é extrudado em fios que são transformados em tecido. 
Infelizmente, sua fabricação pode ser prejudicial ao meio ambiente
e aos trabalhadores, pois requer muita água e produtos químicos tóxicos. 
Além disso, a produção de viscose tem sido associada a desmatamento, trabalho escravo e poluição 
de rios.', '../assets/imagens_tecido/tecido_bloqueado.png', 0),

(8,
'A seda é um tecido fino e brilhante produzido a partir dos casulos de bichos-da-seda. 
É encontrado em várias peças de vestuário, desde roupas de cama até roupas de alta costura. 
A fabricação da seda envolve o cultivo dos bichos-da-seda, que depois são retirados 
dos casulos sem danificar as fibras. Essas fibras são trançadas juntas para formar um fio, 
que é tecido em um tecido macio e delicado. Infelizmente, a produção de seda pode ser prejudicial 
ao meio ambiente pelo fato da criação de bichos-da-seda requerer o 
uso de recursos naturais além de envolver processos químicos para a 
fabricação do tecido. Além disso, muitas vezes é difícil rastrear a cadeia de produção da seda, 
o que pode resultar em condições de trabalho desfavoráveis e exploração de trabalhadores. ', 
'../assets/imagens_tecido/tecido_bloqueado.png', 0),

(9, 
'O poliéster é um tecido sintético feito a partir do petróleo. Ele é encontrado em diversos 
tipos de roupas, principalmente em peças esportivas e de lazer. Sua fabricação envolve a 
transformação de matérias-primas químicas em fibras através de um processo chamado de polimerização. 
O poliéster é resistente e durável, além de possuir uma secagem rápida. No entanto, a sua produção 
é altamente poluente e contribui para o aumento da emissão de gases de efeito estufa, prejudicando 
o meio ambiente e a saúde humana. Além disso, quando descartado, o poliéster demora centenas de anos 
para se decompor na natureza, agravando ainda mais os problemas ambientais. Por esses motivos, 
o poliéster é considerado um tecido não sustentável.', '../assets/imagens_tecido/tecido_bloqueado.png', 0);

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
