document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    const telefone = document.getElementById('telefone').value;
    const tipo_usuario = document.getElementById('tipo_usuario').value;

    // Verifique se o tipo de usuário foi selecionado
    if (!tipo_usuario) {
        alert('Por favor, selecione o tipo de usuário.');
        return;
    }

    console.log('Dados do formulário:', { nome, email, senha, telefone, tipo_usuario });

    const response = await fetch('/server/api/criar_usuario.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nome, email, senha, telefone, tipo_usuario }),
    });

    const result = await response.json();
    if (result.status === 'usuario_cadastrado') {
        alert('Usuário registrado com sucesso!');
        window.location.href = 'login.html';
    } else {
        alert('Erro ao registrar usuário: ' + result.message);
    }
});