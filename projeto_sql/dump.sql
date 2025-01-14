
DROP DATABASE IF EXISTS aluguerVeiculos;
CREATE DATABASE aluguerVeiculos;
USE aluguerVeiculos;

CREATE TABLE tipo_de_cliente ( 
    id INT AUTO_INCREMENT,
    descricao VARCHAR(100) NOT NULL,
    desconto DOUBLE,
    PRIMARY KEY (id)
);

CREATE TABLE tipo_de_funcionario (
    id INT AUTO_INCREMENT,
    descricao VARCHAR(100) NOT NULL,
    salario_base DOUBLE,
    PRIMARY KEY (id)
);

CREATE TABLE cliente (
    nif INT,
    nome VARCHAR(100) NOT NULL,
    morada VARCHAR(200),
    nr_carta INT,
    id_tipo INT,
    data_nascimento DATE,
    email VARCHAR(100),
    telefone VARCHAR(15),
    PRIMARY KEY (nif), 
    FOREIGN KEY (id_tipo) REFERENCES tipo_de_cliente(id)
);

CREATE TABLE marca (
    id INT AUTO_INCREMENT,
    descricao VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE modelo (
    id INT AUTO_INCREMENT,
    descricao VARCHAR(100) NOT NULL,
    ano_fabricacao YEAR,
    marca_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (marca_id) REFERENCES marca(id)
);

CREATE TABLE tipo_de_veiculo (
    id INT AUTO_INCREMENT,
    descricao VARCHAR(100) NOT NULL,
    transmissao VARCHAR(100),
    capacidade_passageiros INT,
    PRIMARY KEY (id)
);

CREATE TABLE combustivel (
    id INT AUTO_INCREMENT,
    descricao VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE tipo_seguro (
    id INT AUTO_INCREMENT,
    descricao VARCHAR(100) NOT NULL,
    cobertura VARCHAR(100),
    valor_mensal DOUBLE,
    PRIMARY KEY (id)
);

CREATE TABLE estado_veiculo (
    id INT AUTO_INCREMENT,
    estado VARCHAR(100),
    PRIMARY KEY (id)
);

CREATE TABLE veiculo (
    matricula VARCHAR(8),
    cor VARCHAR(10),
    preco_dia INT,
    kms INT,
    tipo_veiculo_id INT,
    combustivel_id INT,
    modelo_id INT,
    seguro_id INT,
    estado INT,
    PRIMARY KEY (matricula),
    FOREIGN KEY (tipo_veiculo_id) REFERENCES tipo_de_veiculo(id),
    FOREIGN KEY (combustivel_id) REFERENCES combustivel(id), 
    FOREIGN KEY (modelo_id) REFERENCES modelo(id),
    FOREIGN KEY (seguro_id) REFERENCES tipo_seguro(id), 
    FOREIGN KEY (estado) REFERENCES estado_veiculo(id)
);

CREATE TABLE funcionario (
    nif INT,
    nome VARCHAR(100),
    morada VARCHAR(100),
    cartao_cidadao INT,
    email VARCHAR(100),
    telefone VARCHAR(9),
    data_admissao DATE,
    id_tipo INT,
    PRIMARY KEY (nif),
    FOREIGN KEY (id_tipo) REFERENCES tipo_de_funcionario(id)
);

CREATE TABLE reserva (
    matricula_veiculo VARCHAR(10),
    id INT AUTO_INCREMENT,
    nr_dias INT,
    data_inicio DATE,
    data_fim DATE,
    nif_cliente INT,
    preco_total DOUBLE,
    PRIMARY KEY (id),
    FOREIGN KEY (nif_cliente) REFERENCES cliente(nif),
    FOREIGN KEY (matricula_veiculo) REFERENCES veiculo(matricula)
);

CREATE TABLE aluguer (
    id INT AUTO_INCREMENT,
    datahora DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_reserva INT,
    quant_dias INT,
    estado_deposito VARCHAR(4),
    id_funcionario INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_reserva) REFERENCES reserva(id),
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(nif)
);

CREATE TABLE fatura (
    id INT AUTO_INCREMENT,
    id_aluguer INT,
    total_a_pagar DOUBLE,
    data_emissao DATE DEFAULT CURRENT_TIMESTAMP,
    nif INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_aluguer) REFERENCES aluguer(id)
);


CREATE TABLE cancelamento (
    id INT AUTO_INCREMENT,
    datahora DATETIME DEFAULT CURRENT_TIMESTAMP,
    descricao TEXT,
    id_reserva INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_reserva) REFERENCES reserva(id)
);

CREATE TABLE devolucoes (
    id INT AUTO_INCREMENT,
    descricao TEXT,
    morada_devolucao VARCHAR(100),
    datahora DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_aluguer INT,
    id_funcionario INT,
    estado_deposito VARCHAR(4),
    PRIMARY KEY (id),
    FOREIGN KEY (id_aluguer) REFERENCES aluguer(id),
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(nif)
);

CREATE TABLE levantamento (
    id INT AUTO_INCREMENT,
    datahora DATETIME DEFAULT CURRENT_TIMESTAMP,
    foto TEXT,
    morada_levantamento VARCHAR(100),
    id_aluguer INT,
    id_funcionario INT,
    estado_deposito VARCHAR(4),
    PRIMARY KEY (id),
    FOREIGN KEY (id_aluguer) REFERENCES aluguer(id),
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(nif)
);

CREATE TABLE manutencao (
    id INT AUTO_INCREMENT,
    datahora DATETIME DEFAULT CURRENT_TIMESTAMP,
    matricula_veiculo VARCHAR(10),
    descricao TEXT,
    custo DOUBLE,
    id_funcionario INT,
    PRIMARY KEY (id),
    FOREIGN KEY (matricula_veiculo) REFERENCES veiculo(matricula),
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(nif)
);

CREATE TABLE pagamento (
    id INT AUTO_INCREMENT,
    datahora DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_fatura INT,
    valor DOUBLE,
    metodo VARCHAR(50),
    PRIMARY KEY (id),
    FOREIGN KEY (id_fatura) REFERENCES fatura(id)
);


DELIMITER $$
CREATE TRIGGER after_reserva_insert
AFTER INSERT ON reserva
FOR EACH ROW
BEGIN
    UPDATE veiculo
    SET estado = 4
    WHERE matricula = NEW.matricula_veiculo;
END$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER auto_fatura
AFTER INSERT ON aluguer
FOR EACH ROW
BEGIN
    DECLARE montante_fatura DOUBLE;
    DECLARE contribuinte INT;
    DECLARE desconto DOUBLE;
    
    SET montante_fatura = (SELECT preco_total FROM reserva WHERE id = NEW.id_reserva);
    SET contribuinte = (SELECT nif_cliente FROM reserva WHERE id = NEW.id_reserva);
    SET desconto = (SELECT tipo_de_cliente.desconto 
                    FROM cliente 
                    JOIN tipo_de_cliente ON cliente.id_tipo = tipo_de_cliente.id
                    WHERE cliente.nif = contribuinte);

    SET montante_fatura = montante_fatura - (montante_fatura * desconto);

    INSERT INTO fatura (id_aluguer, total_a_pagar, nif)
    VALUES (NEW.id, montante_fatura, contribuinte);
END$$
DELIMITER ;





DELIMITER $$
CREATE TRIGGER after_cancelamento_insert
AFTER INSERT ON cancelamento
FOR EACH ROW
BEGIN
    DECLARE v_matricula VARCHAR(8);
    
    SET v_matricula = (SELECT matricula_veiculo 
                        FROM reserva
                        WHERE id = NEW.id_reserva);
    
    UPDATE veiculo
    SET estado = 1
    WHERE matricula = v_matricula;
END$$
DELIMITER ;





DELIMITER $$
CREATE TRIGGER after_devolucao_insert
AFTER INSERT ON devolucoes
FOR EACH ROW
BEGIN
    DECLARE v_matricula VARCHAR(8);
    
     SET v_matricula = (SELECT matricula_veiculo 
                        FROM reserva
                        WHERE id = (SELECT id_reserva 
                                    FROM aluguer 
                                    WHERE id = NEW.id_aluguer));
    
    UPDATE veiculo
    SET estado = 1
    WHERE matricula = v_matricula;
END$$
DELIMITER ;





DELIMITER $$
CREATE TRIGGER after_levantamento_insert
AFTER INSERT ON levantamento
FOR EACH ROW
BEGIN
    DECLARE v_matricula VARCHAR(8);
    
     SET v_matricula = (SELECT matricula_veiculo
                        FROM reserva
                        WHERE id = (SELECT id_reserva 
                                    FROM aluguer 
                                    WHERE id = NEW.id_aluguer));
    
    UPDATE veiculo
    SET estado = 2
    WHERE matricula = v_matricula;
END$$
DELIMITER ;





DELIMITER $$
CREATE TRIGGER after_manutencao_insert
AFTER INSERT ON manutencao
FOR EACH ROW
BEGIN
    UPDATE veiculo
    SET estado = 3
    WHERE matricula = NEW.matricula_veiculo;
END$$
DELIMITER ;



INSERT INTO tipo_de_cliente (descricao, desconto) VALUES 
    ('Individual', 0.05),
    ('Empresarial', 0.10);





INSERT INTO tipo_de_funcionario (descricao, salario_base) VALUES 
    ('Atendente', 1500.00),
    ('Gerente', 3000.00),
    ('Mecanico', 1800.00);






INSERT INTO cliente (nif, nome, morada, nr_carta, id_tipo, data_nascimento, email, telefone) VALUES 
    (123456789, 'João Silva', 'Rua A, 123', 12345, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Individual'),
        '1980-01-01', 'joao.silva@email.com', '123456789'),
    (987654321, 'Maria Santos', 'Avenida B, 456', 67890, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Empresarial'), 
        '1975-05-15', 'maria.santos@email.com', '987654321'),
    (112233445, 'Ana Oliveira', 'Rua G, 789', 54321, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Individual'),
        '1990-03-22', 'ana.oliveira@email.com', '123123123'),
    (998877664, 'Carlos Nunes', 'Rua H, 101', 98765, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Empresarial'), 
        '1985-09-15', 'carlos.nunes@email.com', '987987987'),
    (556677889, 'Isabel Almeida', 'Rua I, 202', 11223, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Individual'),
        '1995-11-30', 'isabel.almeida@email.com', '456456456'),
    (332211446, 'Miguel Costa', 'Rua J, 303', 33445, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Empresarial'), 
        '1978-07-12', 'miguel.costa@email.com', '789789789'),
    (667788990, 'Sara Martins', 'Rua K, 404', 55667, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Individual'),
        '1992-04-18', 'sara.martins@email.com', '555666777'),
    (445566779, 'Pedro Ferreira', 'Avenida L, 505', 77889, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Empresarial'), 
        '1981-02-25', 'pedro.ferreira@email.com', '999888777'),
    (334455668, 'Rita Lopes', 'Travessa M, 606', 99001, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Individual'),
        '1987-08-20', 'rita.lopes@email.com', '222333444'),
    (223344557, 'Tiago Rodrigues', 'Praça N, 707', 22334, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Empresarial'), 
        '1979-10-05', 'tiago.rodrigues@email.com', '111222333'),
    (998877666, 'Vera Sousa', 'Alameda O, 808', 44556, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Individual'),
        '1994-12-14', 'vera.sousa@email.com', '333444555'),
    (778899002, 'Ricardo Mendes', 'Estrada P, 909', 66778, 
        (SELECT id FROM tipo_de_cliente WHERE descricao LIKE 'Empresarial'), 
        '1982-06-09', 'ricardo.mendes@email.com', '444555666');





INSERT INTO marca (descricao) VALUES 
    ('Toyota'),
    ('BMW'),
    ('Mercedes-Benz'),
    ('Ford'),
    ('Honda'),
    ('Audi'),
    ('Volkswagen'),
    ('Nissan'),
    ('Chevrolet'),
    ('Hyundai'),
    ('Kia'),
    ('Peugeot'),
    ('Renault'),
    ('Fiat');







INSERT INTO modelo (descricao, ano_fabricacao, marca_id) VALUES 
    ('Civic', 2021, (SELECT id FROM marca WHERE descricao LIKE 'Honda')),
    ('A4', 2022, (SELECT id FROM marca WHERE descricao LIKE 'Audi')),
    ('Golf', 2020, (SELECT id FROM marca WHERE descricao LIKE 'Volkswagen')),
    ('Altima', 2019, (SELECT id FROM marca WHERE descricao LIKE 'Nissan')),
    ('Camaro', 2021, (SELECT id FROM marca WHERE descricao LIKE 'Chevrolet')),
    ('Elantra', 2022, (SELECT id FROM marca WHERE descricao LIKE 'Hyundai')),
    ('Sportage', 2021, (SELECT id FROM marca WHERE descricao LIKE 'Kia')),
    ('208', 2020, (SELECT id FROM marca WHERE descricao LIKE 'Peugeot')),
    ('Clio', 2022, (SELECT id FROM marca WHERE descricao LIKE 'Renault')),
    ('Punto', 2019, (SELECT id FROM marca WHERE descricao LIKE 'Fiat')),
    ('C-Class', 2023, (SELECT id FROM marca WHERE descricao LIKE 'Mercedes-Benz')),
    ('Corolla', 2020, (SELECT id FROM marca WHERE descricao LIKE 'Toyota')),
    ('Mustang', 2019, (SELECT id FROM marca WHERE descricao LIKE 'Ford'));
    



INSERT INTO tipo_de_veiculo (descricao, transmissao, capacidade_passageiros) VALUES 
    ('Ligeiro', 'Automática', 5),
    ('Carrinha', 'Automática', 2),
    ('Pesado', 'Manual', 25),
    ('SUV', 'Manual', 7);





INSERT INTO combustivel (descricao) VALUES 
    ('Gasolina'),
    ('GPL'),
    ('Elétrico'),
    ('Diesel');





INSERT INTO tipo_seguro (descricao, cobertura, valor_mensal) VALUES 
    ('Completo', 'Acidentes + roubo', 200.00),
    ('Básico', 'Acidentes', 100.00);





INSERT INTO estado_veiculo(estado) VALUES
    ("Disponivel"), 
    ("Alugado"), 
    ("Em Manutenção"), 
    ("Reservado");









INSERT INTO veiculo (matricula, cor, preco_dia, kms, tipo_veiculo_id, combustivel_id, modelo_id, seguro_id, estado) VALUES 
    ('FF-11-22', 'Preto', 110, 27000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Ligeiro'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Gasolina'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Corolla'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Completo'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('UU-67-89', 'Preto', 135, 24000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'SUV'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Diesel'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Corolla'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Completo'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('VV-78-90', 'Preto', 125, 23000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Carrinha'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'GPL'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Mustang'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Básico'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('WW-89-01', 'Preto', 140, 20000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Ligeiro'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Gasolina'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Camaro'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Completo'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('AA-55-33', 'Preto', 100, 15000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Ligeiro'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Gasolina'),        
        (SELECT id FROM modelo WHERE descricao LIKE 'Corolla'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Completo'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('GG-22-33', 'Branco', 95, 34000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Carrinha'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Diesel'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Mustang'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Básico'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('HH-33-44', 'Azul Claro', 130, 22000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Pesado'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Elétrico'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Camaro'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Completo'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('II-44-55', 'Vermelho', 140, 15000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'SUV'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'GPL'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Elantra'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Básico'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('JJ-55-66', 'Cinza', 85, 29000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Ligeiro'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Gasolina'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Mustang'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Completo'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('KK-66-77', 'Amarelo', 120, 32000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Carrinha'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Diesel'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Camaro'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Básico'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('LL-77-88', 'Verde', 100, 21000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Pesado'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Elétrico'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Elantra'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Completo'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('MM-88-99', 'Laranja', 125, 33000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'SUV'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'GPL'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Corolla'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Básico'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('NN-99-00', 'Roxo', 95, 25000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Ligeiro'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Gasolina'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Camaro'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Básico'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('OO-00-11', 'Bege', 105, 28000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Carrinha'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Diesel'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Elantra'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Completo'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('PP-12-34', 'Cinza', 115, 26000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Ligeiro'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Gasolina'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Golf'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Completo'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('QQ-23-45', 'Azul', 140, 22000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Carrinha'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Diesel'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Altima'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Básico'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('RR-34-56', 'Branco', 120, 31000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Pesado'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Gasolina'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Camaro'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Completo'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('SS-45-67', 'Preto', 100, 30000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'SUV'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'GPL'),
        (SELECT id FROM modelo WHERE descricao LIKE 'Elantra'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Básico'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    ),
    ('TT-56-78', 'Verde', 130, 25000,
        (SELECT id FROM tipo_de_veiculo WHERE descricao LIKE 'Ligeiro'), 
        (SELECT id FROM combustivel WHERE descricao LIKE 'Gasolina'),
        (SELECT id FROM modelo WHERE descricao LIKE 'C-Class'), 
        (SELECT id FROM tipo_seguro WHERE descricao LIKE 'Completo'), 
        (SELECT id FROM estado_veiculo WHERE estado LIKE 'Disponivel')
    );



INSERT INTO funcionario (nif, nome, morada, cartao_cidadao, email, telefone, data_admissao, id_tipo) VALUES 
    (555444888, 'Carlos Pereira', 'Rua C, 789', 123456789, 'carlos.pereira@email.com', '966444888', '2023-01-01',
        (SELECT id FROM tipo_de_funcionario WHERE descricao LIKE 'Atendente')
    ),
    (111222333, 'Ana Costa', 'Rua D, 123', 987654321, 'ana.costa@email.com', '912345678', '2022-05-10',
        (SELECT id FROM tipo_de_funcionario WHERE descricao LIKE 'Gerente')
    ),
    (222333444, 'João Martins', 'Avenida E, 456', 876543210, 'joao.martins@email.com', '923456789', '2021-08-15',
        (SELECT id FROM tipo_de_funcionario WHERE descricao LIKE 'Mecanico')
    ),
    (333444555, 'Maria Fernandes', 'Rua F, 789', 765432109, 'maria.fernandes@email.com', '934567890', '2020-11-20',
        (SELECT id FROM tipo_de_funcionario WHERE descricao LIKE 'Atendente')
    ),
    (444555666, 'Pedro Lima', 'Rua G, 101', 654321098, 'pedro.lima@email.com', '945678901', '2019-03-25',
        (SELECT id FROM tipo_de_funcionario WHERE descricao LIKE 'Gerente')
    ),
    (555666777, 'Rita Almeida', 'Avenida H, 202', 543210987, 'rita.almeida@email.com', '956789012', '2023-07-05',
        (SELECT id FROM tipo_de_funcionario WHERE descricao LIKE 'Mecanico')
    ),
    (666777888, 'Tiago Lopes', 'Rua I, 303', 432109876, 'tiago.lopes@email.com', '967890123', '2021-01-18',
        (SELECT id FROM tipo_de_funcionario WHERE descricao LIKE 'Atendente')
    ),
    (777888999, 'Vera Silva', 'Rua J, 404', 321098765, 'vera.silva@email.com', '978901234', '2020-06-29',
        (SELECT id FROM tipo_de_funcionario WHERE descricao LIKE 'Gerente')
    ),
    (888999000, 'Ricardo Santos', 'Rua K, 505', 210987654, 'ricardo.santos@email.com', '989012345', '2018-12-12',
        (SELECT id FROM tipo_de_funcionario WHERE descricao LIKE 'Mecanico')
    ),
    (999000111, 'Isabel Rocha', 'Avenida L, 606', 109876543, 'isabel.rocha@email.com', '990123456', '2022-09-17',
        (SELECT id FROM tipo_de_funcionario WHERE descricao LIKE 'Atendente')
    ),
    (000111222, 'Miguel Carvalho', 'Rua M, 707', 987654320, 'miguel.carvalho@email.com', '901234567', '2017-04-23',
        (SELECT id FROM tipo_de_funcionario WHERE descricao LIKE 'Gerente')
    );




INSERT INTO reserva (matricula_veiculo, nr_dias, data_inicio, data_fim, nif_cliente, preco_total) VALUES 
    ('FF-11-22', 5, '2024-08-01', '2024-08-06', (SELECT nif FROM cliente WHERE nome = 'Ana Oliveira'), NULL),
    ('UU-67-89', 7, '2024-08-10', '2024-08-17', (SELECT nif FROM cliente WHERE nome = 'Miguel Costa'), NULL),
    ('VV-78-90', 3, '2024-08-15', '2024-08-18', (SELECT nif FROM cliente WHERE nome = 'Carlos Nunes'), NULL),
    ('WW-89-01', 10, '2024-08-20', '2024-08-30', (SELECT nif FROM cliente WHERE nome = 'Sara Martins'), NULL),
    ('AA-55-33', 4, '2024-08-25', '2024-08-29', (SELECT nif FROM cliente WHERE nome = 'Isabel Almeida'), NULL),
    ('GG-22-33', 6, '2024-08-05', '2024-08-11', (SELECT nif FROM cliente WHERE nome = 'Pedro Ferreira'), NULL),
    ('HH-33-44', 8, '2024-08-12', '2024-08-20', (SELECT nif FROM cliente WHERE nome = 'Tiago Rodrigues'), NULL),
    ('II-44-55', 2, '2024-08-07', '2024-08-09', (SELECT nif FROM cliente WHERE nome = 'Ricardo Mendes'), NULL),
    ('JJ-55-66', 1, '2024-08-14', '2024-08-15', (SELECT nif FROM cliente WHERE nome = 'Rita Lopes'), NULL);
    
    UPDATE reserva
		SET preco_total = (SELECT nr_dias * preco_dia FROM veiculo WHERE veiculo.matricula = reserva.matricula_veiculo)
		WHERE preco_total IS NULL;





INSERT INTO aluguer (datahora, id_reserva, quant_dias, estado_deposito, id_funcionario) 
VALUES   
    (CURRENT_DATE, 
        (SELECT id FROM reserva WHERE matricula_veiculo = 'FF-11-22' AND nif_cliente = 112233445), 
        5, 
        '70%', 
        (SELECT nif FROM funcionario WHERE nome = 'Vera Silva')
    ),
    (CURRENT_DATE, 
        (SELECT id FROM reserva WHERE matricula_veiculo = 'UU-67-89' AND nif_cliente = 332211446), 
        7, 
        '80%', 
        (SELECT nif FROM funcionario WHERE nome = 'Carlos Pereira')
    ),
    (CURRENT_DATE, 
        (SELECT id FROM reserva WHERE matricula_veiculo = 'VV-78-90' AND nif_cliente = 998877664), 
        3, 
        '50%', 
        (SELECT nif FROM funcionario WHERE nome = 'Ricardo Santos')
    ),
    (CURRENT_DATE, 
        (SELECT id FROM reserva WHERE matricula_veiculo = 'WW-89-01' AND nif_cliente = 667788990), 
        10, 
        '70%', 
        (SELECT nif FROM funcionario WHERE nome = 'Maria Fernandes')
    ),
    (CURRENT_DATE, 
        (SELECT id FROM reserva WHERE matricula_veiculo = 'AA-55-33' AND nif_cliente = 556677889), 
        4, 
        '65%', 
        (SELECT nif FROM funcionario WHERE nome = 'João Martins')
    ),
    (CURRENT_DATE, 
        (SELECT id FROM reserva WHERE matricula_veiculo = 'GG-22-33' AND nif_cliente = 445566779), 
        6, 
        '75%', 
        (SELECT nif FROM funcionario WHERE nome = 'Ana Costa')
    ),
    (CURRENT_DATE, 
        (SELECT id FROM reserva WHERE matricula_veiculo = 'HH-33-44' AND nif_cliente = 223344557), 
        8, 
        '60%', 
        (SELECT nif FROM funcionario WHERE nome = 'Ricardo Santos')
    ),
    (CURRENT_DATE, 
        (SELECT id FROM reserva WHERE matricula_veiculo = 'II-44-55' AND nif_cliente = 778899002), 
        2, 
        '55%', 
        (SELECT nif FROM funcionario WHERE nome = 'Tiago Lopes')
    ),
    (CURRENT_DATE, 
        (SELECT id FROM reserva WHERE matricula_veiculo = 'JJ-55-66' AND nif_cliente = 334455668), 
        1, 
        '50%', 
        (SELECT nif FROM funcionario WHERE nome = 'Pedro Lima')
    );





INSERT INTO cancelamento (datahora, descricao, id_reserva) VALUES 
    (CURRENT_DATE, 'Cancelamento por motivo pessoal', 
        (SELECT id FROM reserva WHERE nif_cliente = (SELECT nif FROM cliente WHERE nif LIKE 112233445) AND matricula_veiculo LIKE 'FF-11-22')
    );




INSERT INTO levantamento (foto, morada_levantamento, id_aluguer, id_funcionario, estado_deposito) VALUES 
    ('foto_veiculo.jpg', 'Rua F, 303', 
        (SELECT aluguer.id FROM aluguer, funcionario, reserva
            WHERE aluguer.id_funcionario = funcionario.nif
            AND aluguer.datahora LIKE "2024-08-06 00:00:00"
            AND aluguer.id_reserva = reserva.id
            AND reserva.nif_cliente = (SELECT nif FROM cliente WHERE nome = 'Ana Oliveira')
            AND reserva.matricula_veiculo = "FF-11-22"),
        (SELECT nif FROM funcionario WHERE nome LIKE 'Vera Silva'),
        "60%"
    ),
    ('foto_veiculo.jpg', 'Rua F, 303', 
        (SELECT aluguer.id FROM aluguer, funcionario, reserva
            WHERE aluguer.id_funcionario = funcionario.nif
            AND aluguer.datahora LIKE "2024-08-06 00:00:00"
            AND aluguer.id_reserva = reserva.id
            AND reserva.nif_cliente = (SELECT nif FROM cliente WHERE nome = 'Miguel Costa')
            AND reserva.matricula_veiculo = "UU-67-89"),
        (SELECT nif FROM funcionario WHERE nome LIKE 'Carlos Pereira'),
        "60%"
    ),
    ('foto_veiculo.jpg', 'Rua F, 303', 
        (SELECT aluguer.id FROM aluguer, funcionario, reserva
            WHERE aluguer.id_funcionario = funcionario.nif
            AND aluguer.datahora LIKE "2024-08-06 00:00:00"
            AND aluguer.id_reserva = reserva.id
            AND reserva.nif_cliente = (SELECT nif FROM cliente WHERE nome = 'Carlos Nunes')
            AND reserva.matricula_veiculo = "VV-78-90"),
        (SELECT nif FROM funcionario WHERE nome LIKE 'Ricardo Santos'),
        "60%"
    );




INSERT INTO devolucoes (descricao, morada_devolucao, id_aluguer, id_funcionario, estado_deposito) 
VALUES 
    (
        'Devolução sem danos', 
        'Rua E, 202', 
        (
            SELECT aluguer.id
            FROM aluguer, reserva, funcionario
            WHERE aluguer.id_reserva = reserva.id
            AND aluguer.id_funcionario = funcionario.nif
            AND aluguer.id_funcionario = (SELECT nif FROM funcionario WHERE nome = 'Vera Silva')
            AND reserva.nif_cliente = (SELECT nif FROM cliente WHERE nome = 'Ana Oliveira')
            AND aluguer.datahora LIKE "2024-08-06 00:00:00"
        ), 
        (SELECT nif FROM funcionario WHERE nome LIKE 'Vera Silva'),
        '60%'
    ),
    (
        'Devolução sem danos', 
        'Rua E, 202', 
        (
            SELECT aluguer.id
            FROM aluguer, reserva, funcionario
            WHERE aluguer.id_reserva = reserva.id
            AND aluguer.id_funcionario = funcionario.nif
            AND aluguer.id_funcionario = (SELECT nif FROM funcionario WHERE nome = 'Carlos Pereira')
            AND reserva.nif_cliente = (SELECT nif FROM cliente WHERE nome = 'Miguel Costa')
            AND aluguer.datahora LIKE "2024-08-06 00:00:00"
        ), 
        (SELECT nif FROM funcionario WHERE nome LIKE 'Carlos Pereira'),
        '60%'
    );

INSERT INTO manutencao (matricula_veiculo, descricao, custo, id_funcionario) VALUES 
    ('AA-55-33', 'Troca de óleo', 150.00,
        (SELECT nif FROM funcionario WHERE nome LIKE 'Carlos Pereira')
    ); 





INSERT INTO pagamento (id_fatura, valor, metodo) VALUES 
    (
        (SELECT fatura.id FROM fatura
        WHERE id_aluguer = 1), 
        (SELECT fatura.total_a_pagar FROM fatura
        WHERE id_aluguer = 1), 
        'Cartão de Crédito'
    );




    -- Acrescentei uma view aqui para trabalharmos...
CREATE VIEW vw_aluguer_detalhes AS
SELECT 
    aluguer.id, 
    aluguer.datahora, 
    aluguer.id_funcionario, 
    funcionario.nome AS nomefuncionario, 
    cliente.nome AS nomecliente 
FROM aluguer
JOIN funcionario ON aluguer.id_funcionario = funcionario.nif
JOIN reserva ON aluguer.id_reserva = reserva.id
JOIN cliente ON reserva.nif_cliente = cliente.nif;


CREATE VIEW veiculos_disponiveis AS 
SELECT 
    veiculo.matricula AS matricula, 
    modelo.descricao AS modelo, 
    marca.descricao AS marca, 
    veiculo.cor AS cor, 
    veiculo.kms AS kms
FROM veiculo, modelo, marca
WHERE veiculo.modelo_id = modelo.id
AND modelo.marca_id = marca.id
AND veiculo.estado = 1;



SELECT morada 
FROM funcionario
WHERE nome like 'Miguel Carvalho';

SELECT funcionario.nome, tipo_de_funcionario.salario_base
FROM funcionario, tipo_de_funcionario
WHERE funcionario.id_tipo = tipo_de_funcionario.id 
AND funcionario.nome = 'João Martins' AND tipo_de_funcionario.descricao = 'mecanico';

SELECT matricula_veiculo, COUNT(*) as numero_de_reservas 
FROM reserva
GROUP BY matricula_veiculo;


SELECT matricula_veiculo, COUNT(*) as numero_de_reservas 
FROM reserva, veiculo
WHERE reserva.matricula_veiculo = veiculo.matricula
AND veiculo.cor LIKE "Preto"
GROUP BY matricula_veiculo;


SELECT veiculo.matricula
FROM veiculo
WHERE veiculo.matricula NOT IN (
    SELECT matricula_veiculo
    FROM reserva
)
GROUP BY veiculo.matricula;

SELECT cliente.nome, cliente.nif, SUM(reserva.preco_total) AS total_pago
FROM cliente, reserva, aluguer 
WHERE cliente.nif = reserva.nif_cliente AND 
reserva.id = aluguer.id_reserva
GROUP BY cliente.nome
HAVING SUM(reserva.preco_total) = (
    SELECT MAX(total_pago)
    FROM (
        SELECT cliente.nome, SUM(reserva.preco_total) AS total_pago
        FROM cliente, reserva, aluguer 
        WHERE cliente.nif = reserva.nif_cliente AND 
		  reserva.id = aluguer.id_reserva
        GROUP BY cliente.nome
    ) AS temp
);

SELECT MAX(total_a_pagar) as valor_maximo , MIN(total_a_pagar) as valor_minimo
FROM fatura;

SELECT veiculo.matricula as veiculo_id, COUNT(reserva.id) as numero_de_reservas 
FROM veiculo 
LEFT JOIN reserva ON veiculo.matricula = reserva.matricula_veiculo 
GROUP BY veiculo.matricula
UNION
SELECT matricula as veiculo_id, 0 as numero_de_reservas 
FROM veiculo
WHERE matricula NOT IN (SELECT matricula_veiculo FROM reserva);

SELECT nif_cliente, if(COUNT(*) >= 3, COUNT(*) , "Nao tem 3") as quantidade_de_cancelamentos 
FROM reserva, cancelamento
WHERE cancelamento.id_reserva = reserva.id
GROUP BY nif_cliente;

SELECT reserva.nif_cliente, SUM(reserva.preco_total) as total_gasto 
FROM reserva, veiculo
WHERE reserva.matricula_veiculo = veiculo.matricula 
AND veiculo.kms > 500
GROUP BY reserva.nif_cliente;




