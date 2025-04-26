<?php
require_once '../db/conexao.php';

session_start();

$data = json_decode(file_get_contents("php://input"));

$email = trim($data->email ?? '');
$senha = trim($data->senha ?? '');

// Validação: Verifique se os campos obrigatórios foram preenchidos
if (!$email || !$senha) {
    echo json_encode(['status' => 'erro', 'message' => 'E-mail e senha são obrigatórios']);
    http_response_code(400); // Código de erro HTTP 400 (Bad Request)
    exit;
}

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($senha, $usuario['senha'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    echo json_encode(['status' => 'login_sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'message' => 'E-mail ou senha inválidos']);
    http_response_code(401); // Código de erro HTTP 401 (Unauthorized)
}