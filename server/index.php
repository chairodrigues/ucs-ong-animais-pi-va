<div read_file="" for=""></div> Result:

<?php
$host = 'localhost';
$dbname = 'petmatch';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

function criarUsuario($nome, $email, $senha, $telefone, $tipo_usuario) {
    global $pdo;
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nome, email, senha, telefone, tipo_usuario) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$nome, $email, $senhaHash, $telefone, $tipo_usuario]);
}

function listarAnimais() {
    global $pdo;
    $sql = "SELECT * FROM animais";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function adicionarAnimal($nome, $especie, $porte, $idade, $saude, $descricao, $fotos, $id_usuario) {
    global $pdo;
    $sql = "INSERT INTO animais (nome, especie, porte, idade, saude, descricao, fotos, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$nome, $especie, $porte, $idade, $saude, $descricao, $fotos, $id_usuario]);
}

function enviarMensagem($id_remetente, $id_destinatario, $conteudo) {
    global $pdo;
    $sql = "INSERT INTO mensagens (id_remetente, id_destinatario, conteudo) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id_remetente, $id_destinatario, $conteudo]);
}

function registrarAdocao($id_animal, $id_adotante) {
    global $pdo;
    $sql = "INSERT INTO adocoes (id_animal, id_adotante, status) VALUES (?, ?, 'pendente')";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id_animal, $id_adotante]);
}
?>