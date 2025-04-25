CREATE DATABASE IF NOT EXISTS petmatch;
USE petmatch;

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    tipo_usuario ENUM('doador', 'adotante') NOT NULL
);

-- Tabela de animais
CREATE TABLE IF NOT EXISTS animais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especie VARCHAR(50),
    raca VARCHAR(100),
    idade INT,
    descricao TEXT
);

-- Tabela de mensagens
CREATE TABLE IF NOT EXISTS mensagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    remetente_id INT,
    destinatario_id INT,
    mensagem TEXT,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (remetente_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (destinatario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);