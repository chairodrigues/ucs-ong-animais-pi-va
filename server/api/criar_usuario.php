<?php
require_once '../db/conexao.php';

$data = json_decode(file_get_contents("php://input"), true);

// Depuração: Verifique os dados recebidos
if (!$data) {
    echo json_encode(['status' => 'erro', 'message' => 'Nenhum dado recebido']);
    http_response_code(400); // Código de erro HTTP 400 (Bad Request)
    exit;
}

$nome = trim($data['nome'] ?? '');
$email = trim($data['email'] ?? '');
$senha = password_hash(trim($data['senha'] ?? ''), PASSWORD_DEFAULT);
$telefone = trim($data['telefone'] ?? '');
$tipo_usuario = $data['tipo_usuario'] ?? ''; // Captura o tipo de usuário

// Validação: Verifique se todos os campos obrigatórios estão preenchidos
if (!$nome || !$email || !$senha || !$tipo_usuario) {
    echo json_encode(['status' => 'erro', 'message' => 'Campos obrigatórios ausentes']);
    http_response_code(400); // Código de erro HTTP 400 (Bad Request)
    exit;
}

$sql = "INSERT INTO usuarios (nome, email, senha, telefone, tipo_usuario) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$nome, $email, $senha, $telefone, $tipo_usuario]);
    echo json_encode(['status' => 'usuario_cadastrado']);
} catch (Exception $e) {
    echo json_encode(['status' => 'erro', 'message' => $e->getMessage()]);
    http_response_code(500); // Código de erro HTTP 500 (Internal Server Error)
}