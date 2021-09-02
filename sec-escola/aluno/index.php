<?php 
require_once '../../funcoes-de-cabecalho.php';
require_once '../../conexao.php';
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

cabecalhoSecEsc('../../estilo/style.css', 'Alunos', '.', '../escola/', '../estoque/', '../cardapio/', '../../login/logOut.php');

sectionTop();

//Seleção de todos os Alunos cadastrados
$select = "select * from Aluno";
$query = mysqli_query($conexao, $select);

//Exibição dinamica de todas os Alunos
?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th colspan="4">Alunos</th>
        </tr>
    </thead>
    <tbody>
<?php
while($table = mysqli_fetch_array($query)){
        $idAluno = $table['id'];
        $nome = $table['nomeAluno'];
        
        echo "<tr>"
            . "<td>$nome</td>"
            . "<td><button class='btn btn-light m-2 visualizar-aluno' value='$idAluno'><img src='../../estilo/icones/eye.png' width='26px' /></button></td>"
            . "<td><a href='validar-aluno.php?acao=atualizar&id=$idAluno'class='btn btn-light m-2'><img src='../../estilo/icones/edit.png' width='26px' /></a></td>"
            . "<td><button class='btn btn-light m-2 excluir-aluno' value='$idAluno'><img src='../../estilo/icones/delete.png' width='26px' /></button></td>"
            . "</tr>";
    }
?>
    </tbody>
</table>

<a class="btn btn-dark m-2 cadastrar-aluno buttonLink" href="validar-aluno.php?acao=cadastrar">Cadastrar Aluno</a>
<script src="requisicao-ajax.js"></script>
<?php
sectionBaixo();
?>

<!-- Modal Visualizar aluno-->
<div class="modal fade" id="modalVisualizar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Visualizar Aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <div>Nome: <span id="nomeAluno"></span></div>
                <div>Escola: <span id="escolaAluno"></span></div>
                <div>Ano Escolar: <span id="anoEscolarAluno"></span></div>
                <div>Data de Nascimento: <span id="nascimentoAluno"></span></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmação de Excluir Aluno-->
<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Excluir Aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <div class="my-2">Excluir o Aluno <span id="nomeExcluir" class="border-bottom"></span></div>
                <input type="hidden" id="idAluno">
                <button class="btn btn-danger mt-2" id="excluir">Excluir</button>
            </div>
        </div>
    </div>
</div>

<?php
rodape();
