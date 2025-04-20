<?php
require_once '../db/conexao.php';

$sql = "SELECT * FROM animais";
$stmt = $pdo->query($sql);
$animais = $stmt->fetchAll();

echo json_encode($animais);