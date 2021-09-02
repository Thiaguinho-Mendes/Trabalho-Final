-- Usuarios --
create table SecEdu (
    id int primary key auto_increment,
    nome varchar(64),
    login varchar(64),
    senha varchar(64)
);

create table Nutricionista (
    id int primary key auto_increment,
    nome varchar(64),
    login varchar(64),
    senha varchar(64),
    cpf varchar(11),
    rg varchar(11),
    endereco varchar(255),
    email varchar(255),
    dataDeNascimento date,
    numero varchar(8),
    celular varchar(15)
);

create table SecEsc (
    id int primary key auto_increment,
    nomeSecEsc varchar(64),
    login varchar(64),
    senha varchar(64),
    cpf varchar(11),
    rg varchar(11),
    endereco varchar(255),
    email varchar(255),
    dataDeNascimento date,
    numero varchar(8),
    celular varchar(15),
    cargo enum('Diretor', 'Secretario'),
    escola_id int references Escola(id)
);

create table Aluno (
    id int primary key auto_increment,
    nomeAluno varchar(64),
    login varchar(64),
    senha varchar(64),
    dataDeNascimento date,
    anoEscolar_id int references AnoEscolar(id),
    escola_id int references Escola(id)
);

-- Referente A escola e Estoque--

create table Escola (
    id int primary key auto_increment,
    nomeEscola varchar(100),
    endereco varchar(255),
    cnpj varchar(12),
    email varchar(255),
    numero varchar(8),
    telefone varchar(12),
    alunosEnsInfantil integer,
    alunosEnsFundamental integer
);

create table AnoEscolar (
    id int primary key auto_increment,
    nomeAnoEscolar varchar(64)
);

create table Estoque (
    estoque_id int primary key auto_increment,
    escola_id int references Escola(id),
    produto_id int references Produto(id),
    estoqueTransf_id int,
    quantidade int,
    quantAlterada int,
    data datetime,
    usuario_id int,
    tipoUsuario enum('SecEdu', 'SecEsc', 'Nut'),
    acao enum('Adicionado', 'Retirado', 'TransfRed', 'TransfAdd'),
    status boolean
);

create table Produto (
    id int primary key auto_increment,
    nomeProduto varchar(64),
    marca varchar(64),
    peso decimal,
    tipoDePeso_id int references TipoDePeso(id),
    tipoDeProduto_id int references TipoDeProduto(id)
);

create table TipoDePeso(
    id int primary key auto_increment,
    nomeTipoPeso varchar(64)
);

create table TipoDeProduto(
    id int primary key auto_increment,
    nomeTipoProduto varchar(64)
);

-- Referente ao Cardapio etc... ---

create table Cardapio_Refeicao (
    id int primary key auto_increment,
    data date,
    anoEscolar_id int references AnoEscolar(id),
    refeicao_id int references Refeicao(id)
);

create table Refeicao (
    id int primary key auto_increment,
    nome varchar(64)
);

-- Referente aos Relatorios e afins...--

create table Pedido (
    id int primary key auto_increment,
    data date,
    escola_id int references Escola(id),
    nutricionista_id int references Nutricionista(id)
);

create table Itens (
    pedido_id int references Pedido(id),
    produto_id int references Produto(id),
    quantidade int
);

-- Inserts e afins --

insert into SecEdu values(default, "Marcelo", "secEdu", "123");

insert into TipoDePeso values
(default, "g"),
(default, "kg"),
(default, "ml"),
(default, "L");

insert into AnoEscolar values
(default, "Ensino Infantil"),
(default, "Ensino Fundamental");

insert into Escola values
(default, 'EMEB Senador Francisco Benjamin Gallotti', 'Bairro Oficinas', '22365986459', 'gallotti@gmail.com', '42', '99659896', '400', '320'),
(default, 'EEB Doutor Otto Feuerschuette', 'Capivari de Baixo', '66532659862', 'otto@gmail.com', '669', '33652369', '200', '500'),
(default, 'Arino Bressan', 'Bairro Oficinas', '56523656941', 'arino@gmail.com', '95', '6656986', '300', '320');

insert into SecEsc values
(default, 'Anna Lucia', 'esc1', '123', '12536655325', '2236325', 'Rua Paulo Orlandi', 'anna@gmail.com', '1990-10-10', '52', '236565639', 'Diretor', 1),
(default, 'Marcia Lucia', 'esc1Sec', '123', '65986532654', '6598659', 'Rua Paulo Sergio', 'marcia@gmail.com', '1970-10-10', '63', '365964851', 'Secretario', 1),
(default, 'Paulo henrique', 'esc2', '123', '54845965299', '4566548', 'Avenida jarves', 'paulo@gmail.com', '1988-10-10', '49', '659865986', 'Diretor', 2);

insert into Aluno values
(default, 'Jose Almeida', 'aluno1', '123', '2007-10-11', 1, 1),
(default, 'Antonio Bras', 'aluno2', '123', '2007-03-11', 1, 1),
(default, 'Priscila Freitas', 'aluno3', '123', '2004-05-12', 2, 1),
(default, 'Carlos da Silva', 'aluno4', '123', '2004-04-03', 2, 2),
(default, 'Rogerio Skylab', 'aluno5', '123', '2007-12-09', 1, 2),
(default, 'Vinicius Dias', 'aluno6', '123', '2005-07-07', 2, 3);

insert into TipoDeProduto values
(default, 'Tempero'),
(default, 'Carne'),
(default, 'Fruta'),
(default, 'Cereal'),
(default, 'Massa'),
(default, 'Peixe');

insert into Produto values
(default, 'Pao', 'forma 10', 300, 1, 5),
(default, 'Cereal integral', 'Sucrilhos', 50, 1, 4),
(default, 'Macarrao Espaguetti', 'Filler', 900, 1, 5),
(default, 'Alcatra', 'Friboi', 2, 2, 2),
(default, 'Tilapia', 'Fine Fish', 1, 2, 6),
(default, 'Maca', 'Big Fruit', 3, 2, 3),
(default, 'Acucar', 'Uniao', 2, 2, 1);

select * from Produto;

Insert into Refeicao values
(default, 'Pao com Frango'),
(default, 'Pao com Presunto e Queijo'),
(default, 'Pao com Margarina'),
(default, 'Pao com Geleia'),
(default, 'Macarronada'),
(default, 'Peixe Empanado'),
(default, 'Bife a Milanesa'),
(default, 'Suco de Uva'),
(default, 'Suco de Caju'),
(default, 'Bolacha');

insert into Cardapio_Refeicao values
(default, '2019-11-01', 1, 1),
(default, '2019-11-01', 1, 9),
(default, '2019-11-04', 1, 5),
(default, '2019-11-04', 1, 2),
(default, '2019-11-05', 1, 6),
(default, '2019-11-06', 1, 3),
(default, '2019-11-07', 1, 7),
(default, '2019-11-08', 1, 10),
(default, '2019-11-11', 1, 1),
(default, '2019-11-12', 1, 4),
(default, '2019-11-13', 1, 6),
(default, '2019-11-14', 1, 3),
(default, '2019-11-15', 1, 10),
(default, '2019-11-18', 1, 9),
(default, '2019-11-18', 1, 3),
(default, '2019-11-19', 1, 6),
(default, '2019-11-19', 1, 8),
(default, '2019-11-20', 1, 4),
(default, '2019-11-21', 1, 5),
(default, '2019-11-22', 1, 7),
(default, '2019-11-22', 1, 8),
(default, '2019-11-25', 1, 2),
(default, '2019-11-26', 1, 1),
(default, '2019-11-27', 1, 4),
(default, '2019-11-27', 1, 9),
(default, '2019-11-28', 1, 3),
(default, '2019-11-29', 1, 10),
(default, '2019-11-01', 2, 1),
(default, '2019-11-01', 2, 9),
(default, '2019-11-04', 2, 5),
(default, '2019-11-04', 2, 2),
(default, '2019-11-05', 2, 6),
(default, '2019-11-06', 2, 3),
(default, '2019-11-07', 2, 7),
(default, '2019-11-08', 2, 10),
(default, '2019-11-11', 2, 1),
(default, '2019-11-12', 2, 4),
(default, '2019-11-13', 2, 6),
(default, '2019-11-14', 2, 3),
(default, '2019-11-15', 2, 10),
(default, '2019-11-18', 2, 9);

insert into Estoque values
(default, 1, 3, NULL, 30, 30, '2019-11-04 12:47:18', 1, 'SecEdu', 'Adicionado', 0),
(default, 1, 3, NULL, 40, 10, '2019-11-04 12:48:18', 1, 'SecEdu', 'Adicionado', 0),
(default, 1, 3, NULL, 35, 5, '2019-11-04 12:49:18', 1, 'SecEsc', 'Retirado', 1),
(default, 1, 5, NULL, 50, 50, '2019-11-04 12:50:18', 1, 'Nut', 'Adicionado', 0),
(default, 1, 5, 6, 10, 40, '2019-11-04 12:51:18', 1, 'Nut', 'TransfRed', 1),
(default, 2, 3, 5, 40, 40, '2019-11-04 12:52:18', 1, 'Nut', 'TransfAdd', 1);
