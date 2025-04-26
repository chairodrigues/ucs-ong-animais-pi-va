<?php
require_once '../db/conexao.php';

try {
    // Recebe os dados enviados pelo formulário
    $data = json_decode(file_get_contents("php://input"));

    if (!$data) {
        throw new Exception('Nenhum dado foi enviado ou o formato está incorreto.');
    }

    $nome = trim($data->nome ?? '');
    $email = trim($data->email ?? '');
    $telefone = trim($data->telefone ?? '');
    $mensagem = trim($data->mensagem ?? '');

    // Validação básica
    if (empty($nome)) {
        throw new Exception('O campo "nome" é obrigatório.');
    }
    if (empty($email)) {
        throw new Exception('O campo "email" é obrigatório.');
    }
    if (empty($mensagem)) {
        throw new Exception('O campo "mensagem" é obrigatório.');
    }

    // Insere os dados no banco de dados
    $sql = "INSERT INTO contatos (nome, email, telefone, mensagem) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $telefone, $mensagem]);

    // Retorna uma resposta de sucesso
    http_response_code(200);
    echo json_encode(['status' => 'mensagem_enviada']);
} catch (Exception $e) {
    // Retorna uma mensagem de erro detalhada
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
} catch (PDOException $e) {
    // Retorna uma mensagem de erro específica do banco de dados
    http_response_code(500);
    echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
    exit;
}