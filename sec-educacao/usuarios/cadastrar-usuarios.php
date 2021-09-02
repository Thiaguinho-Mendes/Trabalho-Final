<?php
require_once '../../funcoes-de-cabecalho.php';
require_once '../../conexao.php';
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

cabecalhoSecEdu('../../estilo/style.css', 'Usuarios', '../escola/', 'cadastrar-usuarios.php', '../produto/', '../refeicao/', '../cardapio/', '../../login/logOut.php');
sectionTop();

//Seleção do nutricionista
$selectNut = 'select Nutricionista.id, Nutricionista.nome from Nutricionista';
$queryNut = mysqli_query($conexao, $selectNut);

//Seleção dos secretários que estão atribuidos a uma escola
$selectComEscola = 'select Escola.nomeEscola, SecEsc.nomeSecEsc, SecEsc.id from SecEsc '
        . 'inner join Escola on SecEsc.escola_id = Escola.id';
$queryComEscola = mysqli_query($conexao, $selectComEscola);

//Seleção dos secretários que nao estão atribuidos a nenhuma escola
$selectSemEscola = "select SecEsc.nomeSecEsc, SecEsc.id from SecEsc where SecEsc.escola_id is NULL";
$querySemEscola = mysqli_query($conexao, $selectSemEscola);
?>
<h3>Usuários</h3>
<div class="m-5">
    <!--Tabela do nutricionista-->
    <table class="table my-5">
        <thead>
            <tr>
                <th colspan="5">Nutricionista</th>
            </tr>
        </thead>

        <tbody>
            <?php
//Condição que identifica se ja existe um nutricionista cadastrado
                if(mysqli_num_rows($queryNut) == 1){
                    $table = mysqli_fetch_array($queryNut);
                    $idNut = $table['id'];
                    $nome = $table['nome'];

                    echo "<tr>"
                        . "<td>$nome</td>"
                        . "<td><button class='btn btn-light m-1 visualizar-nutricionista' value='$idNut'><img src='../../estilo/icones/eye.png' width='26px' /></button></td>"
                        . "<td><a class='btn btn-light m-1 atualizar-nutricionista' href='nutricionista/validar-nutricionista.php?acao=atualizar&id=$idNut'><img src='../../estilo/icones/edit.png' width='26px' /></a></td>"
                        . "<td><button class='btn btn-light m-1 deletar-nutricionista' value='$idNut'><img src='../../estilo/icones/delete.png' width='26px' /></button></td>"
                     . "</tr>";
                } else {
                 
//Se nenhum nutricionista existe, a opção de cadastro dele é exibida
                    echo "<tr>"
                    . "<td><a class='btn btn-dark m-2 buttonLink' href='nutricionista/validar-nutricionista.php?acao=cadastrar'>Cadastrar</a></td>"
                    . "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>
    
<div class="m-5">
    <!--Tabela dos secretários das escolas-->
<table class="table my-4">
    <thead>
        <tr>
            <th colspan="5">Secretários das Escolas</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
//Geração dinamica em tabela dos secretarios da escola que estão alocados a uma Escola
            while ($table = mysqli_fetch_array($queryComEscola)) {
                $secEscId = $table['id'];
                $secEscNome = $table['nomeSecEsc'];
                $escolaNome = $table['nomeEscola'];

                echo "<tr>"
                    . "<td>$secEscNome</td>"
                    . "<td>$escolaNome</td>"
                    . "<td><button class='btn btn-light visualizar-secEsc' value='$secEscId'><img src='../../estilo/icones/eye.png' width='28px'></button></td>"
                    . "<td><a href='secescola/validar-secesc?idSecEsc=$secEscId&acao=atualizar' class='btn btn-light atualizar-secEsc' value='$secEscId'><img src='../../estilo/icones/edit.png' width='28px'></a></td>"
                    . "<td><button class='btn btn-light excluir-secEsc' value='$secEscId'><img src='../../estilo/icones/delete.png' width='28px'></button></td>"
                . "</tr>";
            }
            
//Geração dinamica em tabela dos secretarios da escola que não estão alocados a uma Escola
            while ($table = mysqli_fetch_array($querySemEscola)) {
                $secEscId = $table['id'];
                $secEscNome = $table['nomeSecEsc'];

                echo "<tr>"
                    . "<td>$secEscNome</td>"
                    . "<td>---</td>"
                    . "<td><button class='btn btn-light visualizar-secEsc' value='$secEscId'><img src='../../estilo/icones/eye.png' width='28px'></button></td>"
                    . "<td><a href='secescola/validar-secesc?idSecEsc=$secEscId&acao=atualizar' class='btn btn-light atualizar-secEsc' value='$secEscId'><img src='../../estilo/icones/edit.png' width='28px'></a></td>"
                    . "<td><button class='btn btn-light excluir-secEsc' value='$secEscId'><img src='../../estilo/icones/delete.png' width='28px'></button></td>"
                . "</tr>";
            }
        ?>
    </tbody>
</table>
</div>

<a class="btn btn-dark buttonLink" href="secescola/validar-secesc.php?acao=cadastrar">Cadastrar Secretário da Escola</a>

<script src="secescola/requisicao-ajax.js"></script>
<script src="nutricionista/requisicao-ajax.js"></script>
<?php
sectionBaixo();

//Requisição dos modais relativos a cada usuário
require_once 'secescola/modaisSecEsc.php';
require_once 'nutricionista/modaisNut.php';
rodape();
