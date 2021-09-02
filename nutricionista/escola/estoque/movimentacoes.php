<?php
require_once "../../../funcoes-de-cabecalho.php";
require_once "../../../conexao.php";
require_once '../../../login/funcoesdelogin.php';

autenticar('../../../index.php');

cabecalhoNutricionista('../../../estilo/style.css', 'Movimentações', '../', '../../relatorio',  '../../produto/', '../../refeicao/', '../../cardapio/', '../../../login/logOut.php');
sectionTop();

$selectEstoque = "select Produto.nomeProduto, Estoque.estoque_id, Estoque.quantidade, Estoque.quantAlterada, Estoque.acao from Estoque "
        . "inner join Escola on Estoque.escola_id = Escola.id "
        . "inner join Produto on Estoque.produto_id = Produto.id "
        . "where escola_id = ".$_SESSION["idEscola"]." "
        . "order by Estoque.data desc";
$queryEstoque = mysqli_query($conexao, $selectEstoque);

    echo "<table class='table my-0'>"
        . "<thead class='thead-dark'>"
        . "<tr>"
        . "<th>Produto</th>"
        . "<th>Quantia Atual</th>"
        . "<th>Quantia Alterada</th>"
        . "<th>Ação</th>"
        . "</tr>"
        . "</thead>"
            . "<tbody>";
                while($table = mysqli_fetch_array($queryEstoque)){
                    $nomeProduto = $table['nomeProduto'];
                    $quantidade = $table['quantidade'];
                    $quantMov = $table['quantAlterada'];
                    $acao = $table['acao'];
                    $estoqueId = $table['estoque_id'];

                        if($acao == 'Adicionado'){
                            echo "<tr class='tableRowHistorico addRed adicionado' value='$estoqueId'>"
                               . "<td>$nomeProduto</td>"
                               . "<td>$quantidade</td>"
                               . "<td>+$quantMov</td>"
                               . "<td>$acao</td>";
                        } 
                        else if($acao == 'Retirado'){
                            echo "<tr class='tableRowHistorico addRed retirado' value='$estoqueId'>"
                               . "<td>$nomeProduto</td>"
                               . "<td>$quantidade</td>"
                               . "<td>-$quantMov</td>"
                               . "<td>$acao</td>";
                        }
                        else if($acao == 'TransfAdd'){
                            echo "<tr class='tableRowHistorico transferido' value='$estoqueId'>"
                               . "<td>$nomeProduto</td>"
                               . "<td>$quantidade</td>"
                               . "<td>+$quantMov</td>"
                               . "<td>Transportado</td>";
                        }
                        else if($acao == 'TransfRed'){
                            echo "<tr class='tableRowHistorico transferido' value='$estoqueId'>"
                               . "<td>$nomeProduto</td>"
                               . "<td>$quantidade</td>"
                               . "<td>-$quantMov</td>"
                               . "<td>Transportado</td>";
                        }
                    echo "</tr>";
                }
    echo "</tbody>"
. "</table>"
. "</div>";
?>
<script src="requisicao-ajax.js"></script>
<?php
sectionBaixo();
?>

<!--Modal Adicionar/Reduzir--> 
<div class="modal fade" id="modalAddRed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg estoqueHistorico" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                
                <div>Especificações</div>
                <table class="table">
                    <thead>
                        <tr class="table-active">
                            <th>Produto</th>
                            <th>Usuário</th>
                            <th>Cargo</th>
                            <th>Ação</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="produto"></td>
                            <td id="usuario"></td>
                            <td id="tipoUsuario"></td>
                            <td id="acao"></td>
                            <td id="data"></td>
                        </tr>
                    </tbody>
                </table>
                
                <div>Quantidades</div>
                <table class="table" id="tableQuant">
                    <tr class="table-active">
                        <th>Escola</th>
                        <th>Quantia Atual</th>
                        <th>Quantia Alterada</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td id="escola"></td>
                        <td id="quantAtual"></td>
                        <td id="quantMov"></td>
                        <td id="status"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Modal Transferir--> 
<div class="modal fade" id="modalTransf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg estoqueHistorico" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                
                <div>Especificações</div>
                <table class="table">
                    <thead>
                        <tr class="table-active">
                            <th>Produto</th>
                            <th>Usuário</th>
                            <th>Cargo</th>
                            <th>Ação</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="produtoTransf"></td>
                            <td id="usuarioTransf"></td>
                            <td id="tipoUsuarioTransf"></td>
                            <td id="acaoTransf"></td>
                            <td id="dataTransf"></td>
                        </tr>
                    </tbody>
                </table>
                
                <div>Quantidades</div>
                <table class="table" id="tableQuant">
                    <tr class="table-active">
                        <th colspan="2">Escola</th>
                        <th>Quantia Atual</th>
                        <th>Quantia Alterada</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <th>Escola Base</th>
                        <td id="escolaBase"></td>
                        <td id="quantAtualBase"></td>
                        <td id="quantMovBase" rowspan="2"></td>
                        <td id="statusBase"></td>
                    </tr>
                    <tr>
                        <th>Escola Alvo</th>
                        <td id="escolaAlvo"></td>
                        <td id="quantAlvo"></td>
                        <td id="statusAlvo"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
rodape();