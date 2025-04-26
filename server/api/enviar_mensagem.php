<?php
require_once '../db/conexao.php';

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');

$data = json_decode(file_get_contents("php://input"));

$remetente = $data->remetente_id ?? 0;
$destinatario = $data->destinatario_id ?? 0;

$sql = "INSERT INTO mensagens (remetente_id, destinatario_id, mensagem) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$remetente, $destinatario, $mensagem]);

echo json_encode(['status' => 'mensagem_enviada']);