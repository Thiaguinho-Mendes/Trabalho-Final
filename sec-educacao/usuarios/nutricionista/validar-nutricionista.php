<?php
require_once '../../../funcoes-de-cabecalho.php';
require_once '../../../conexao.php';
require_once '../../../login/funcoesdelogin.php';

autenticar('../../../index.php');

$acao = $_GET['acao'];

//Identifica a ação para mudar adaptar os campos para a atualização ou cadastro
if ($acao == 'cadastrar') {
    $acaoHTML = "Cadastrar";
    
} else if ($acao == 'atualizar') {
    $acaoHTML = "Atualizar";
    $id = $_GET['id'];

    $select = "select * from Nutricionista where id=$id";
    $query = mysqli_query($conexao, $select);
    $table = mysqli_fetch_array($query);

    $nomeNut = $table['nome'];
    $cpf = $table['cpf'];
    $rg = $table['rg'];
    $endereco = $table['endereco'];
    $email = $table['email'];
    $dataNascimento = $table['dataDeNascimento'];
    $numero = $table['numero'];
    $celular = $table['celular'];
    $login = $table['login'];
    $senha = $table['senha'];
}

cabecalhoSecEdu("../../../estilo/style.css", "$acaoHTML Nutricionista", "../../escola/", "../cadastrar-usuarios.php", "../../produto/", "../../refeicao/", "../../cardapio/", "../../../login/logOut.php");
    
sectionTop()
?>
<h3><?php echo $acaoHTML; ?> Nutricionista</h3>

<form method="post" action="verificacao.php?acao=<?php
    if (!empty($id) and $acao == "atualizar") {
      echo $acao . "&id=$id";
  } else {
      echo $acao;
  }
?>">
    <label>Nome</label>
    <input type="text" class="form-control" required maxlength="64" name="nome"<?php
        if(!empty($nomeNut)){
            echo " value='".$nomeNut."'";
        }
    ?>>
    <label>CPF</label>
    <input type="text" class="form-control" required maxlength="11" name="cpf"<?php
        if(!empty($cpf)){
            echo " value='".$cpf."'";
        }
    ?>>
    <label>RG</label>
    <input type="text" class="form-control" required maxlength="11" name="rg"<?php
        if(!empty($rg)){
            echo " value='".$rg."'";
        }
    ?>>
    <label>Endereco</label>
    <input type="text" class="form-control" required maxlength="255" name="endereco"<?php
        if(!empty($endereco)){
            echo " value='".$endereco."'";
        }
    ?>>
    <label>E-Mail</label>
    <input type="email" class="form-control" required maxlength="255" name="email"<?php
        if(!empty($email)){
            echo " value='".$email."'";
        }
    ?>>
    <label>Data de Nascimento</label>
    <input type="date" class="form-control" required  name="nascimento"<?php
        if(!empty($dataNascimento)){
            echo " value='".$dataNascimento."'";
        }
    ?>>
    <label>Número</label>
    <input type="text" class="form-control" required maxlength="8" name="numero"<?php
        if(!empty($numero)){
            echo " value='".$numero."'";
        }
    ?>>
    <label>Celular</label>
    <input type="text" class="form-control" required maxlength="15" name="celular"<?php
        if(!empty($celular)){
            echo " value='".$celular."'";
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
    <input type="submit" class="btn btn-dark m-2" value="<?php echo $acaoHTML; ?>">
</form>

<?php
sectionBaixo();
rodape();