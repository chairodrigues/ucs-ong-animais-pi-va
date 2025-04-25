function alertar(){
    alert(' ')
}

document.getElementById('enviar').addEventListener('click', async () => {
    const nome = document.getElementById('nome').value;
    const email = document.getElementById('email').value;
    const telefone = document.getElementById('telefone').value;
    const mensagem = document.getElementById('mensagem').value;

    const response = await fetch('/server/api/enviar_contato.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nome, email, telefone, mensagem })
    });

    const result = await response.json();
    if (response.ok) {
        alert('Mensagem enviada com sucesso!');
    } else {
        alert(`Erro: ${result.error}`);
    }
});