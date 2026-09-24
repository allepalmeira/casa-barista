{{-- PESQUISA ENQUANTO DIGITA - atualiza a tabela e o rodapé sem recarregar a página --}}
{{-- Usado nos forms de pesquisa que têm o atributo data-pesquisa --}}
<script>
    document.querySelectorAll('form[data-pesquisa]').forEach(function(form) {

        const campoBusca = form.querySelector('input[name="busca"]');
        const card = form.closest('.card');

        let espera;
        let ultimoPedido = 0;

        campoBusca.addEventListener('input', function() {

            // Espera parar de digitar por 400ms antes de pesquisar
            clearTimeout(espera);

            espera = setTimeout(async function() {

                const pedido = ++ultimoPedido;

                // Monta a URL com a busca e o filtro atuais (sempre volta para a página 1)
                const url = form.action + '?' + new URLSearchParams(new FormData(form)).toString();

                try {

                    const resposta = await fetch(url);
                    const html = new DOMParser().parseFromString(await resposta.text(), 'text/html');

                    // Se o usuário digitou de novo enquanto esperava, ignora esta resposta
                    if (pedido !== ultimoPedido) {
                        return;
                    }

                    const novoCard = html.querySelector('form[data-pesquisa]').closest('.card');

                    // Troca só as linhas da tabela e o rodapé (total + paginação)
                    card.querySelector('tbody').innerHTML = novoCard.querySelector('tbody').innerHTML;
                    card.querySelector('.card-footer').innerHTML = novoCard.querySelector('.card-footer').innerHTML;

                    // Atualiza a URL do navegador (recarregar mantém a pesquisa)
                    history.replaceState(null, '', url);

                } catch (erro) {

                    // Se algo der errado, faz a pesquisa do jeito normal
                    form.submit();

                }

            }, 400);

        });

    });
</script>
