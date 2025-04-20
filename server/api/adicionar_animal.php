<?php
require_once '../db/conexao.php';
$data = json_decode(file_get_contents("php://input"));

$nome = $data->nome ?? '';
$especie = $data->especie ?? '';
$raca = $data->raca ?? '';
$idade = $data->idade ?? '';
$descricao = $data->descricao ?? '';

$sql = "INSERT INTO animais (nome, especie, raca, idade, descricao) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $especie, $raca, $idade, $descricao]);

echo json_encode(['status' => 'animal_adicionado']);