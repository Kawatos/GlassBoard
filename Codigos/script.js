document.getElementById('criarPaginaBtn').addEventListener('click', function() {
    const titulo = document.getElementById('inomedapagina').value;
    const conteudo = $('#summernote').summernote('code');
    const autor = document.getElementById('inomedoautor').value;

    console.log('Titulo:', titulo);
    console.log('Conteudo:', conteudo);
    console.log('Autor:', autor);

    fetch('criar_pagina.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            title: titulo,
            content: conteudo,
            author: autor
        })
    })
    .then(response => {
        console.log('Resposta:', response);
        return response.json();
    })
    .then(data => {
        console.log('Data:', data);
        if (data.success) {
            alert('Página criada com sucesso!');
            window.location.href = data.url;
        } else {
            alert('Erro ao criar a página.');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
    });
});
