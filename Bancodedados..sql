CREATE DATABASE GerenciadorSenhas;
USE GerenciadorSenhas;

CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha_entrada VARCHAR(255) NOT NULL,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Organizacao (
    id_organizacao INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    id_usuario_criador INT NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario_criador) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Subordinado (
    id_subordinado INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_organizacao INT NOT NULL,
    ativo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_organizacao) REFERENCES Organizacao(id_organizacao)
);

-- onde ficam senhas e pastas
CREATE TABLE Cofre (
    id_cofre INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    id_usuario INT NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

--  organização das senhas
CREATE TABLE Pasta (
    id_pasta INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    id_cofre INT NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cofre) REFERENCES Cofre(id_cofre)
);

-- gerenciadas dentro das pastas
CREATE TABLE Senha (
    id_senha INT AUTO_INCREMENT PRIMARY KEY,
    conta VARCHAR(100) NOT NULL,
    usuario_login VARCHAR(150),
    senha_criptografada VARCHAR(255) NOT NULL,
    observacao TEXT,
    id_pasta INT NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pasta) REFERENCES Pasta(id_pasta)
);

-- convidar subordinados
CREATE TABLE Convite (
    id_convite INT AUTO_INCREMENT PRIMARY KEY,
    email_convidado VARCHAR(150) NOT NULL,
    id_organizacao INT NOT NULL,
    status ENUM('PENDENTE', 'ACEITO', 'RECUSADO') DEFAULT 'PENDENTE',
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_organizacao) REFERENCES Organizacao(id_organizacao)
);

-- CONSULTA 1: Listar todas as organizações e o nome do usuário que as criou
SELECT 
    o.id_organizacao,
    o.nome AS organizacao,
    u.nome AS criador
FROM Organizacao o
JOIN Usuario u ON o.id_usuario_criador = u.id_usuario;

-- CONSULTA 2: Mostrar os subordinados e a organização em que trabalham
SELECT 
    s.id_subordinado,
    u.nome AS subordinado,
    o.nome AS organizacao
FROM Subordinado s
JOIN Usuario u ON s.id_usuario = u.id_usuario
JOIN Organizacao o ON s.id_organizacao = o.id_organizacao;

-- CONSULTA 3: Contar quantos subordinados cada organização possui
SELECT 
    o.nome AS organizacao,
    COUNT(s.id_subordinado) AS total_subordinados
FROM Organizacao o
LEFT JOIN Subordinado s ON o.id_organizacao = s.id_organizacao
GROUP BY o.nome;