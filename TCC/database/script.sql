USE ecoage;

DROP TABLE IF EXISTS Usuario;
DROP TABLE IF EXISTS Tecidos;
DROP TABLE IF EXISTS Tipo_Tecidos;
DROP TABLE IF EXISTS tokens;
DROP TABLE IF EXISTS avatars;
DROP TABLE IF EXISTS Noticias;


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
durável e indicado para pessoas com pele sensível.', '../assets/tecido.png', 1),
       
(2, 
'A lã é um tecido natural produzido a partir do pelo de animais, como ovelhas, cabras e alpacas. 
É encontrado principalmente em regiões de clima frio. 
Para fabricá-la, temos a tosa dos animais, seguida de lavagem, cardagem e fiamento das 
fibras. Apesar de ser um tecido durável e confortável, a produção em larga escala pode ter impactos 
negativos no meio ambiente com o uso de produtos químicos e o abate 
em massa dos animais. Então, é importante escolher produtos de lã de fontes sustentáveis, que 
respeitam os direitos dos animais e adotam práticas ecológicas na produção.', '../assets/tecido.png', 1),

(3,
'O linho é um tecido natural feito a partir das fibras da planta do linho. É encontrado em 
roupas de cama, mesa e banho, além de roupas casuais e elegantes. Sua produção é feita a partir 
de plantações de linho, que são colhidas e passam por processos de separação das fibras, fiação 
e tecelagem. O linho é um tecido sustentável por ser biodegradável, renovável e por necessitar de 
pouca água e fertilizantes na produção. Além disso, é um tecido durável, resistente, respirável e 
absorvente, ideal para climas quentes e úmidos.', '../assets/tecido.png', 1),

(4, 
'O Tencel é um tecido produzido a partir de madeira de eucalipto, uma fonte renovável. 
A celulose é dissolvida em um solvente não tóxico e transformada em fibras. É encontrado em 
roupas, lençóis e toalhas. Sua fabricação usa menos água e energia do que a do algodão. 
As fibras são biodegradáveis e compostáveis, reduzindo o impacto ambiental. Além disso, o 
Tencel tem propriedades de absorção de umidade, é resistente a rugas e macio ao toque. É 
considerado um tecido sustentável por sua produção ambientalmente consciente e por ser renovável 
e biodegradável.', '../assets/tecido.png', 1),

(5,
'O tecido de bambu é feito a partir da fibra da planta do bambu, que cresce rapidamente e é 
facilmente renovável. É encontrado principalmente em regiões da Ásia, onde o bambu é cultivado. 
A fabricação do tecido começa com a extração da polpa da planta, que é transformada em fios e, 
em seguida, tecida em um tecido macio e respirável. O bambu é considerado um tecido sustentável 
devido à sua rápida taxa de crescimento e capacidade de regeneração natural. Além disso, o 
processo de fabricação do tecido de bambu é menos poluente do que o processo de fabricação de 
outros tipos de tecidos, como o algodão. O tecido de bambu é também biodegradável, o que significa
que não contribui para a poluição do meio ambiente quando descartado.', '../assets/tecido.png', 1),

(6, 
'A malha é um tecido produzido através da entrelaçamento de fios de trama e urdidura, 
formando um tecido flexível e elástico. É comumente usado na fabricação de roupas esportivas, 
moda casual e íntima. Pode ser feito de algodão, lã, poliéster, entre outros materiais. 
Sua fabricação ocorre através de um processo de tricotagem, que pode ser feito manualmente ou por 
máquinas. No entanto, o uso excessivo de poliéster e outros materiais sintéticos na fabricação de 
malhas pode não ser sustentável, pois estes materiais não são biodegradáveis e a produção em grande 
escala pode ter um grande impacto ambiental.', '../assets/tecido_bloqueado.png', 0),

(7, 
'A viscose é um tecido produzido a partir de celulose de madeira ou de outras plantas. 
É encontrado em roupas leves e frescas, como blusas, vestidos e lenços. Sua fabricação envolve a 
dissolução da celulose que é extrudado em fios que são transformados em tecido. 
Infelizmente, sua fabricação pode ser prejudicial ao meio ambiente
e aos trabalhadores, pois requer muita água e produtos químicos tóxicos. 
Além disso, a produção de viscose tem sido associada a desmatamento, trabalho escravo e poluição 
de rios.', '../assets/tecido_bloqueado.png', 0),

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
'../assets/tecido_bloqueado.png', 0),

(9, 
'O poliéster é um tecido sintético feito a partir do petróleo. Ele é encontrado em diversos 
tipos de roupas, principalmente em peças esportivas e de lazer. Sua fabricação envolve a 
transformação de matérias-primas químicas em fibras através de um processo chamado de polimerização. 
O poliéster é resistente e durável, além de possuir uma secagem rápida. No entanto, a sua produção 
é altamente poluente e contribui para o aumento da emissão de gases de efeito estufa, prejudicando 
o meio ambiente e a saúde humana. Além disso, quando descartado, o poliéster demora centenas de anos 
para se decompor na natureza, agravando ainda mais os problemas ambientais. Por esses motivos, 
o poliéster é considerado um tecido não sustentável.', '../assets/tecido_bloqueado.png', 0);

Create table Noticias(
    id_noticia INT AUTO_INCREMENT,
    titulo_noticia VARCHAR(800) NOT NULL,
    data_noticia DATE NOT NULL,
    url_noticia VARCHAR(800) NOT NULL,
    descricao_noticia VARCHAR(800) NOT NULL,

       PRIMARY KEY (id_noticia)
);

INSERT INTO Noticias (titulo_noticia, data_noticia, url_noticia , descricao_noticia) 
VALUES ('Qual o impacto da moda no meio ambiente?', '2022-02-02',
'https://santaceciliaresiduos.com.br/moda-meio-ambiente/#:~:text=Nosso%20lixo%20t%C3%AAxtil%2C%20consequ%C3%AAncia%20da,de%20desperd%C3%ADcio%20de%20%C3%A1gua%20globalmente. ' , 
'Nosso lixo têxtil, consequência da lógica da moda descartável, leva cerca de 200 anos para se desintegrar.
E as consequência dessa indústria de fast fashion vai além do descarte. 
De acordo com relatório da ONU responsável por 20% do total de desperdício de água globalmente.'),

('Um efeito borboleta: a indústria da moda e meio-ambiente','2022-02-02','https://wp.ufpel.edu.br/empauta/um-efeito-borboleta-a-industria-da-moda-e-meio-ambiente/',
'Quando se fala no impacto ambiental da indústria da moda se fala muito mais que apenas na extração de matérias-primas, mas também no consumo de ...'),

('Qual é o impacto que nossas roupas causam ao meio ambiente?','2022-02-02','https://noticias.r7.com/tecnologia-e-ciencia/qual-e-o-impacto-que-nossas-roupas-causam-ao-meio-ambiente-01122021',
'O consumo excessivo e rápido de peças de roupa, que surge do padrão de produção do fast-fashion (moda rápida), é cada vez mais nocivo para o ...');