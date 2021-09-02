<?php
require_once '../../../funcoes-de-cabecalho.php';
require_once '../../../conexao.php';
require_once '../../../login/funcoesdelogin.php';

autenticar('../../../index.php');

cabecalhoNutricionista('../../../estilo/style.css', 'Tipo de Produto', '../../escola/', '../../relatorio/', '../', '../../refeicao/', '../../cardapio/', '../../../login/logOut.php');
sectionTop();

$select = "select * from TipoDeProduto";
$query = mysqli_query($conexao, $select);
?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col" width=60%>Nome</th>
            <th scope="col" colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($table = mysqli_fetch_array($query)) {
                $idTipoProduto = $table['id'];
                $nome = $table['nomeTipoProduto'];

                echo "<tr>"
                . "<td class='py-4'>$nome</td>"
                . "<td><button class='btn btn-light button-atualizar' value='$idTipoProduto' ><img src='https://image.flaticon.com/icons/svg/1001/1001371.svg' width=26px/></button></td>"
                . "<td><button class='btn btn-light button-deletar' value='$idTipoProduto' ><img src='https://image.flaticon.com/icons/svg/32/32178.svg' width=26px/></button></td>"
                . "</tr>";
            }
        ?>
    </tbody>
</table>   

<script src="requisicao-ajax.js"></script>
<button class='btn btn-dark m-2' id='button-cadastro'>Cadastrar Tipo de Produto</button>


<?php
sectionBaixo();
?>

<!-- Modal -->
<div class="modal fade" id="modalTipoProduto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <form class="form-group my-0" id="formulario" method="post">
                    <label>Nome</label>
                    <input type="text" id="nome" required class="form-control my-2" name="nome">
                    <input type="hidden" id="idTipoProdutoUp">
                    <input type="submit" id="buttonSubmit" class="btn btn-dark mt-2">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delTipoProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Excluir Tipo de Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <div class="my-2">Excluir o tipo de produto: <span id="nomeTipoDeProdutoDel" class="border-bottom"></span></div>
                <input type="hidden" id="idTipoProdutoDel">
                <button class="btn btn-danger my-2" id="buttonConfirmar">Excluir</button>
            </div>
        </div>
    </div>
</div>  

<?php
rodape();
