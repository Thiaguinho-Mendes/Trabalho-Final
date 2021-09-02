<!-- Modal Visualizar-->
<div class="modal fade" id="modalVisualizarNut" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modalNut" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Visualizar Nutricionista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <div>Nome: <span id="nomeNut"></span></div>
                <div>CPF: <span id="cpfNut"></span></div>
                <div>RG: <span id="rgNut"></span></div>
                <div>Endereço: <span id="enderecoNut"></span></div>
                <div>Número: <span id="numeroNut"></span></div>
                <div>E-Mail: <span id="emailNut"></span></div>
                <div>Data de Nascimento: <span id="nascimentoNut"></span></div>
                <div>Celular: <span id="celularNut"></span></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmação de Excluir usuário-->
<div class="modal fade" id="modalExcluirNut" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modalDelete" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Excluir Nutricionista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <div>Excluir o Nutricionista <span id="nomeExcluirNut" class="border-bottom"></span></div>
                <input type="hidden" id="idNut">
                <button class="btn btn-danger mt-2" id="excluirNutricionista">Excluir</button>
            </div>
        </div>
    </div>
</div>