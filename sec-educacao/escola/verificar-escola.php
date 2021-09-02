<?php
require_once "../../funcoes-de-cabecalho.php";
require_once "../../conexao.php";
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

$acao = $_GET['acao'];

//Identificar se o formulario deve ser de cadastro ou Atualização
if($acao == "cadastrar"){
    $acaoHTML = "Cadastrar";
} else if ($acao == "atualizar"){
    $acaoHTML = "Atualizar";
    $idEscola = $_GET['id'];
    
//Seleção dos dados da escola para colocar nos formulários.
    $select = "select * from Escola where id = $idEscola";
    $query = mysqli_query($conexao, $select);
    $table = mysqli_fetch_array($query);
    
    $id = $table['id'];
    $nomeEscola = $table['nomeEscola'];
    $endereco = $table['endereco'];
    $cnpj = $table['cnpj'];
    $email = $table['email'];
    $numero = $table['numero'];
    $telefone = $table['telefone'];
    $alunosEnsInfantil = $table['alunosEnsInfantil'];
    $alunosEnsFundamental = $table['alunosEnsFundamental'];
}

cabecalhoSecEdu("../../estilo/style.css", " $acaoHTML Escola", "../escola/", "../usuarios/cadastrar-usuarios.php", "../produto/", "../refeicao/", "../cardapio/", "../../login/logOut.php");
    
sectionTop();
?>
<h3><?php echo $acaoHTML ?> Escola</h3>

<form method="post" action="verificacao.php?acao=<?php
    if (!empty($id) and $acao == "atualizar") {
        echo $acao . "&id=$id";
    } else {
        echo $acao;
    }
?>">
    
    <label>Nome</label>
    <input type="text" class="form-control" required maxlength="100" name="nomeEscola" <?php
        if(!empty($nomeEscola)){
            echo "value='".$nomeEscola."'";
        }
    ?>>
    
    <label>Endereco</label>
    <input type="text" class="form-control" required maxlength="255" name="endereco" <?php
        if(!empty($endereco)){
            echo "value='".$endereco."'";
        }
    ?>>
    
    <label>Numero</label>
    <input type="text" class="form-control" required maxlength="8" name="numero" <?php
        if(!empty($numero)){
            echo "value='".$numero."'";
        }
    ?>>
    
    <label>CNPJ</label>
    <input type="text" class="form-control" required maxlength="12" name="cnpj" <?php
        if(!empty($cnpj)){
            echo "value='".$cnpj."'";
        }
    ?>>
    
    <label>E-mail</label>
    <input type="email" class="form-control" required maxlength="255" name="email" <?php
        if(!empty($email)){
            echo "value='".$email."'";
        }
    ?>>
    
    <label>Telefone</label>
    <input type="text" class="form-control" required maxlength="12" name="telefone" <?php
        if(!empty($telefone)){
            echo "value='".$telefone."'";
        }
    ?>>
    
    <div class="mt-3">Numero de Alunos:</div>
    <label>Ensino Infantil</label>
    <input type="number" class="form-control" maxlength="4" name="alunosEnsInfantil" <?php
        if(!empty($alunosEnsInfantil)){
            echo "value='".$alunosEnsInfantil."'";
        }
    ?>>
    
    <label>Ensino Fundamental</label>
    <input type="number" class="form-control" maxlength="4" name="alunosEnsFundamental" <?php
        if(!empty($alunosEnsFundamental)){
            echo "value='".$alunosEnsFundamental."'";
        }
    ?>>
    <input type="submit" class="btn btn-dark mt-4" value="<?php echo $acaoHTML ?>">
</form>
<?php 
sectionBaixo();
rodape();
