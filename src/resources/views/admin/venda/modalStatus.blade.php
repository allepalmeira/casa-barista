{{-- INICIO - MODAL CANCELAR/REABRIR VENDA (usado na listagem e na comanda)  --}}
<div class="modal fade" id="modal-status-venda" tabindex="-1"
    aria-labelledby="modal-status-venda-titulo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="form-status-venda" method="POST">
                @csrf
                @method('PATCH')

                <div class="modal-header">
                    <h5 class="modal-title" id="modal-status-venda-titulo">Alterar status da venda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-0" id="modal-status-venda-txt">

                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Voltar
                    </button>

                    <button type="submit" class="btn btn-danger" id="btn-status-venda">
                        Confirmar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
{{-- FIM - MODAL CANCELAR/REABRIR VENDA  --}}


{{-- Cancelar e Reabrir Venda --}}
<script>
    const modalStatusVenda = document.getElementById('modal-status-venda');
    const formStatusVenda = document.getElementById('form-status-venda');
    const tituloStatusVenda = document.getElementById('modal-status-venda-titulo');
    const txtStatusVenda = document.getElementById('modal-status-venda-txt');
    const btnStatusVenda = document.getElementById('btn-status-venda');


    modalStatusVenda.addEventListener('show.bs.modal', function(event) {

        const botao = event.relatedTarget;

        const url = botao.getAttribute('data-url');
        const codigo = botao.getAttribute('data-codigo');
        const status = botao.getAttribute('data-status');

        formStatusVenda.action = url;

        if (status !== 'CANCELADA') {

            tituloStatusVenda.textContent = 'Cancelar venda';
            txtStatusVenda.textContent = 'Tem certeza de que deseja cancelar a venda #' + codigo + '?';
            btnStatusVenda.textContent = 'Cancelar venda';

            btnStatusVenda.className = 'btn btn-danger'

        } else {

            tituloStatusVenda.textContent = 'Reabrir venda';
            txtStatusVenda.textContent = 'A venda #' + codigo + ' voltará para EM ANDAMENTO. Confirmar?';
            btnStatusVenda.textContent = 'Reabrir';

            btnStatusVenda.className = 'btn btn-success'

        }

    });
</script>
