<?php
require_once "../../../funcoes-de-cabecalho.php";
require_once "../../../conexao.php";
require_once '../../../login/funcoesdelogin.php';

autenticar('../../../index.php');

date_default_timezone_set('America/Sao_Paulo');

cabecalhoSecEdu('../../../estilo/style.css', 'Estoque', '../../escola/', '../../usuarios/cadastrar-usuarios.php', '../../produto/', '../../refeicao/', '../../cardapio/', '../../../login/logOut.php');

sectionTop();

//Session que pega o id da escola selecionada na página anterior.
if ($_SESSION["idEscola"] == NULL) {
    $_SESSION["idEscola"] = $_GET['id'];
}

//Requisição dos dados do estoque ao Banco de Dados
$selectEstoque = "select Estoque.estoque_id, Produto.id, Produto.nomeProduto, TipoDeProduto.nomeTipoProduto, Produto.marca, Produto.peso, TipoDePeso.nomeTipoPeso, Estoque.quantidade from Estoque "
        . "inner join Produto on Estoque.produto_id = Produto.id "
        . "inner join TipoDePeso on Produto.tipoDePeso_id = TipoDePeso.id "
        . "inner join TipoDeProduto on Produto.tipoDeProduto_id = TipoDeProduto.id "
        . "where escola_id =" . $_SESSION["idEscola"] . " and status = 1 order by Estoque.data desc";
$queryEstoque = mysqli_query($conexao, $selectEstoque);

if(mysqli_num_rows($queryEstoque) >= 1){
    echo "<table class='table'>"
     . "<thead class='thead-dark'>"
     . "<tr>"
     . "<th>Nome</th>"
     . "<th>Tipo</th>"
     . "<th>Marca</th>"
     . "<th>Peso</th>"
     . "<th>Quantidade</th>"
     . "<th colspan='3'></th>"
     . "</tr>"
     . "</thead>"
     . "<tbody>";
    //Imprimir os dados dinamicamente em tabelas do estoque 
    while ($table = mysqli_fetch_array($queryEstoque)) {
        $idEstoque = $table['estoque_id'];
        $idProduto = $table['id'];
        $nomeProduto = $table['nomeProduto'];
        $nomeTipoProduto = $table['nomeTipoProduto'];
        $marca = $table['marca'];
        $peso = $table['peso'];
        $nomeTipoPeso = $table['nomeTipoPeso'];
        $quantidade = $table['quantidade'];

        echo "<tr>"
        . "<td>$nomeProduto</td>"
        . "<td >$nomeTipoProduto</td>"
        . "<td>$marca</td>"
        . "<td>$peso $nomeTipoPeso</td>"
        . "<td>$quantidade</td>"
        . "<td><button class='btn btn-light alocar-produto' value='$idEstoque'><img src='../../../estilo/icones/add.png' width='25px'/></button></td>"
        . "<td><button class='btn btn-light reduzir-produto' value='$idEstoque'><img src='../../../estilo/icones/reduce.png' width='25px'/></button></td>"
        . "<td><button class='btn btn-light transferir-produto' value='$idEstoque'><img src='../../../estilo/icones/transfer.png' width='25px'/></button></td>"
        . "</tr>";
    }

    echo "</tbody>"
     . "</table>";
} else {
    echo "<h3>Estoque</h3>"
    . "<hr>"
    . "<div class='my-2'>Nenhum produto alocado ao Estoque</div>";
}
?>
<button class="btn btn-dark m-3" id="buttonAdicionar">Alocar Produto</button>
<?php
    if(mysqli_num_rows($queryEstoque) >= 1){
        echo "<a class='btn btn-dark m-2 buttonLink' href='movimentacoes.php' id='buttonHistorico'>Historico</a>";
    }
?>
<script src="requisicao-ajax.js"></script>
<?php
sectionBaixo();
?>

<!--Modal Adicionar--> 
<div class="modal fade" id="modalAdicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <form method="post" class="my-0" id="addProduto">
                    <label class='d-block pt-2'>Produto</label>
                    <select name="produto" class="custom-select px-3" id="selectProduto"></select>
                    <label class='d-block pt-2'>Quantidade</label>
                    <input type="number" required name="quantidade" class="form-control">
                    <button type="submit" class="btn btn-dark mt-3">Adicionar</button>
                </form>
                <div id="msgProdutoEmpty"></div>
            </div>
        </div>
    </div>
</div>

<!--Modal de alocar/subtrair de produtos--> 
<div class="modal fade" id="modalProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <form method="post" class="my-0" id="alocarProduto">
                        <label class='pt-2'>Produto</label>
                        <input type="text" name="produtoNome" class="form-control" readonly=“true”>
                        <label class='pt-2'>Quantidade</label>
                        <input type="number" required name="quantidadeAlocada" min="0" class="form-control">
                        <input type="hidden" id="idEstoque">
                    <button class="btn btn-dark mt-3" id="buttonSubmit">Alocar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTransferir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transferir Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <div class="m-2">Produto: <span id="produtoTransferir"></span></div>
                <div class="m-2">Escola: <span id="escola"></span></div>
                <hr class="my-0">
                <form method="post" class="my-0" id="transferirProduto">
                        <label class="pt-2">Escola Alvo:</label>
                        <select name="escolaAlvo" class="custom-select px-3" id="escolaAlvo"></select>
                        <label class="pt-2">Quantidade</label>
                        <input type="number" required name="quantidadeTransferida" min="0" class="form-control">
                        <input type="hidden" id="idEstoqueTransferir">
                    <button type="submit" class="btn btn-dark mt-3" id="buttonTransferir">Transferir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
rodape();

