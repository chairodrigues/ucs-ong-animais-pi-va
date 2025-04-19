<?php
require_once '../db/conexao.php';
$data = json_decode(file_get_contents("php://input"));

$nome = $data->nome ?? '';
$email = $data->email ?? '';
$senha = $data->senha ?? '';
$telefone = $data->telefone ?? '';
$tipo = $data->tipo_usuario ?? '';

if (!$nome || !$email || !$senha) {
    http_response_code(400);
    echo json_encode(['erro' => 'Dados incompletos']);
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
$sql = "INSERT INTO usuarios (nome, email, senha, telefone, tipo_usuario) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $email, $senhaHash, $telefone, $tipo]);

echo json_encode(["status" => "ok"]);