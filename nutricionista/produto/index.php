<?php
require_once '../../conexao.php';
require_once '../../funcoes-de-cabecalho.php';
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

cabecalhoNutricionista('../../estilo/style.css', 'Produtos', '../escola/', '../relatorio/', '.', '../refeicao/', '../cardapio/', '../../login/logOut.php');

sectionTop();

$select = "select * from Produto";
$query = mysqli_query($conexao, $select);
$row = 1;
?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col"></th>
            <th scope="col" width=60%>Nome</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

        <?php
        while ($table = mysqli_fetch_array($query)) {
            $idProduto = $table['id'];
            $nome = $table['nomeProduto'];
            ?>
            <tr>
                <th scope="row" class="py-4"><?php echo $row; ?></th>
                <td><?php echo $nome; ?></td>
                <td><button class="btn btn-light button-visualizar" value="<?php echo $idProduto; ?>" ><img src='https://image.flaticon.com/icons/svg/65/65000.svg' width=26px/></button></td>
                <td><button class="btn btn-light button-alterar" value="<?php echo $idProduto; ?>" ><img src='https://image.flaticon.com/icons/svg/1001/1001371.svg' width=26px/></button></td>
                <td><button class="btn btn-light button-deletar" value="<?php echo $idProduto; ?>" ><img src='https://image.flaticon.com/icons/svg/32/32178.svg' width=26px/></button></td>
            </tr>
            
            <?php
            $row += 1;
        }
        ?>
    </tbody>
</table>

<button class="btn btn-dark m-2" id="button-cadastro">Cadastrar Produto</button>
<a href="TipoDeProduto/index.php" class="btn btn-dark m-2 buttonLink">Tipo de Produto</a>

<script src="requisicao-ajax.js"></script>
<?php
sectionBaixo();
?>

<!-- Modal Cadastro de Produto-->
<div class="modal fade" id="modalProduto" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <input type="hidden" id="idProdutoUp">
                    <label class="pt-2">Nome</label>
                    <input type="text" id="nome" required class="form-control" name="nome">
                    <label class="pt-2">Marca</label>
                    <input type="text" id="marca" required class="form-control" name="marca">
                    <label class="pt-2">Peso</label>
                    <input type="number" id="peso" required class="form-control" name="peso">
                    <label class="d-block pt-2">Tipo de Peso</label>
                    <select name="tipoDePeso" class="custom-select px-2" id="tipoDePeso"></select>
                    <label class="d-block pt-2">Tipo de Produto</label>
                    <select name="tipoDeProduto" class="custom-select px-2" id="tipoDeProduto"></select>
                    <input type="submit" id="buttonSubmit" class="btn btn-dark mt-3">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Visualizar Produto -->
<div class="modal fade" id="modalVisualizar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Visualizar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <div>Nome: <span id="nomeProduto"></span></div>
                <div>Tipo: <span id="tipoProduto"></span></div>
                <div>Marca: <span id="marcaProduto"></span></div>
                <div>Peso: <span id="pesoProduto"></span> <span id="tipoDePeso"></span></div>
            </div>
        </div>
    </div>
</div>

<!--Modal Excluir produto-->
<div class="modal fade" id="delProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Excluir Tipo de Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <div class="my-2">Excluir produto: <span id="nomeProdutoDel" class="border-bottom"></span></div>
                <input type="hidden" id="idProdutoDel">
                <button class="btn btn-danger mt-2" id="buttonConfirmar">Confirmar</button>
            </div>
        </div>
    </div>
</div>   
<?php
rodape();
