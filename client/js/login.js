// document.getElementById('loginForm').addEventListener('submit', async (e) => {
//     //e.preventDefault();
// console.log("AAA")
//     // const email = document.getElementById('email').value;
//     // const senha = document.getElementById('senha').value;

//     // const response = await fetch('/server/api/login_usuario.php', {
//     //     method: 'POST',
//     //     headers: { 'Content-Type': 'application/json' },
//     //     body: JSON.stringify({ email, senha }),
//     // });

//     // const result = await response.json();

//     // if (response.ok) {
//     //     alert('Login realizado com sucesso!');
//     //     console.log('Usuário autenticado:', result.usuario);
//     //     console.log('Redirecionando para:', '/client/html/index.html');
//     //     //window.location.href = '/client/html/index.html';
//     // } else {
//     //     console.error('Erro na resposta do servidor:', result);
//     //     alert(`Erro: ${result.message}`);
//     // }
// });

function login() {
    document.getElementById('loginForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const senha = document.getElementById('senha').value;
    
        const response = await fetch('/server/api/login_usuario.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, senha }),
        });
    
        const result = await response.json();
    
        if (response.ok) {
            alert('Login realizado com sucesso!');
            console.log('Usuário autenticado:', result.usuario);
            console.log('Redirecionando para:', '/client/html/index.html');
            window.location.href = '/client/html/index.html';
        } else {
            console.error('Erro na resposta do servidor:', result);
            alert(`Erro: ${result.message}`);
        }
    });
}