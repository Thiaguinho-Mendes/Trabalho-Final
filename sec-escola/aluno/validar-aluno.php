<?php
require_once '../../funcoes-de-cabecalho.php';
require_once '../../conexao.php';
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

$acao = $_GET['acao'];

//Identifica a ação para adaptar os campos para a atualização ou cadastro de aluno
if ($acao == 'cadastrar') {
    $acaoHTML = "Cadastrar";
    
} else if ($acao == 'atualizar') {
    $acaoHTML = "Atualizar";
    $id = $_GET['id'];

    $select = "select * from Aluno where id=$id";
    $query = mysqli_query($conexao, $select);
    $table = mysqli_fetch_array($query);

    $nomeAluno = $table['nomeAluno'];
    $login = $table['login'];
    $senha = $table['senha'];
    $dataNascimento = $table['dataDeNascimento'];
    $anoEscolar_id = $table['anoEscolar_id'];
    $escola_id = $table['escola_id'];
}

$selectEscolas = "select Escola.id, Escola.nomeEscola from Escola";
$selectAnosEscolares =  "select AnoEscolar.id, AnoEscolar.nomeAnoEscolar from AnoEscolar";

$queryEscolas = mysqli_query($conexao, $selectEscolas);
$queryAnosEscolares = mysqli_query($conexao, $selectAnosEscolares);

cabecalhoSecEsc("../../estilo/style.css", "$acaoHTML Aluno", "index.php", "../escola/", "../estoque/", "../cardapio/", "../../login/logOut.php");
sectionTop();
?>
<h3><?php echo $acaoHTML?> Aluno</h3>
<hr>

<!--Formulário de cadastro/Atualização-->
    <form method="post" action="verificacao.php?acao=<?php
        if (!empty($id) and $acao == "atualizar") {
            echo $acao . "&id=$id";
        } else {
            echo $acao;
        }
    ?>">
    
        <label>Nome</label>
        <input type="text" class="form-control" required maxlength="64" name="nome"<?php
            if(!empty($nomeAluno)){
                echo " value='".$nomeAluno."'";
            }
        ?>>

        <label>Login</label>
        <input type="text" class="form-control" required maxlength="64" name="login"<?php
            if(!empty($login)){
                echo " value='".$login."'";
            }
        ?>>

        <label>Senha</label>
        <input type="password" class="form-control" required maxlength="64" name="senha"<?php
            if(!empty($senha)){
                echo " value='".$senha."'";
            }
        ?>>

        <label>Data de Nascimento</label>
        <input type="date" class="form-control" required  name="nascimento"<?php
            if(!empty($dataNascimento)){
                echo " value='".$dataNascimento."'";
            }
        ?>>
        
        <label  class="d-flex justify-content-center">Ano Escolar</label>
            <?php
            
//função que gera dinamicamente o Select com os anos escolares Existentes
                echo "<select name='anoEscolar' class='custom-select'>";
                while($tableAnosEscolares = mysqli_fetch_array($queryAnosEscolares)){
                    $idAnoEscolar = $tableAnosEscolares['id'];
                    $nomeAnoEscolar = $tableAnosEscolares['nomeAnoEscolar'];

                    if($id == $anoEscolar_id){
                        echo "<option value='$idAnoEscolar' selected>$nomeAnoEscolar</option>";
                    } else {
                        echo "<option value='$idAnoEscolar'>$nomeAnoEscolar</option>";
                    }
                }
                echo "</select>";
            ?>
        
        <label  class="d-flex justify-content-center">Escola</label>
            <?php
            
//função que gera dinamicamente o Select com as escolas existentes
                echo "<select name='escola' class='custom-select'>";
                    while($tableEscolas = mysqli_fetch_array($queryEscolas)){
                        $idEscola = $tableEscolas['id'];
                        $nomeEscola = $tableEscolas['nomeEscola'];

                        if($id == $escola_id){
                            echo "<option value='$idEscola' selected>$nomeEscola</option>";
                        } else {
                            echo "<option value='$idEscola'>$nomeEscola</option>";
                        }
                    }
                echo "</select>";
            ?>
        <input type="submit" value='Cadastrar' class="btn btn-dark mt-4">
</form>
<?php
sectionBaixo();
rodape();
