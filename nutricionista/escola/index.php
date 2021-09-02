<?php
require_once "../../funcoes-de-cabecalho.php";
require_once "../../conexao.php";
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

$_SESSION["idEscola"] = NULL;


cabecalhoNutricionista('../../estilo/style.css', 'Escola', '.', '../relatorio/', '../produto/', '../refeicao/', '../cardapio/', '../../login/logOut.php');

sectionTop();

//Seleção de todas as escolas cadastradas
$select = "select Escola.id, Escola.nomeEscola from Escola";
$query = mysqli_query($conexao, $select);
?>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col" colspan="2"></th>
        </tr>
    </thead>
    <tbody>

        <?php
//Exibição dinamica de todas as escolas
        while ($table = mysqli_fetch_array($query)) {
            $idEscola = $table['id'];
            $nome = $table['nomeEscola'];
            ?>

            <tr>
                <td><?php echo $nome; ?></td>
                <td><button class="btn btn-light m-2 visualizar-escola" value="<?php echo $idEscola; ?>"><img src='https://image.flaticon.com/icons/svg/65/65000.svg' width=26px/></button></td>
                <td><a href="estoque/estoque.php?id=<?php echo $idEscola; ?>" ><button class="btn btn-light m-2"><img src='../../estilo/icones/box.png' width=26px/></button></a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<script src="requisicao-ajax.js"></script>

<?php
sectionBaixo();
?>
<!-- Modal Visualizar Escola-->
<div class="modal fade" id="modalVisualizar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Visualizar Escola</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <div>Nome: <span id="nomeEscola"></span></div>
                <div>Endereço: <span id="endereco"></span></div>
                <div>Número: <span id="numero"></span></div>
                <div>CNPJ: <span id="cnpj"></span></div>
                <div>E-Mail: <span id="email"></span></div>
                <div>Telefone: <span id="telefone"></span></div>
                <div class='border-bottom mt-3 subTituloModal'>Numero de Alunos</div>
                <div>Ensino Infantil: <span id="infantil"></span></div>
                <div>Ensino Fundamental: <span id="fundamental"></span></div>
                <div class='border-bottom mt-3 subTituloModal'>Diretor</div>
                <div><span id="diretor"></span></div>
                <div class='border-bottom mt-3 subTituloModal'>Secretários</div>
                <div><span id="secretarios"></span></div>
            </div>
        </div>
    </div>
</div>
<?php
rodape();
