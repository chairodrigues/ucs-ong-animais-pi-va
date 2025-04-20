<?php
require_once '../db/conexao.php';
$data = json_decode(file_get_contents("php://input"));

$remetente = $data->remetente_id ?? 0;
$destinatario = $data->destinatario_id ?? 0;
$mensagem = $data->mensagem ?? '';

$sql = "INSERT INTO mensagens (remetente_id, destinatario_id, mensagem) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$remetente, $destinatario, $mensagem]);

echo json_encode(['status' => 'mensagem_enviada']);