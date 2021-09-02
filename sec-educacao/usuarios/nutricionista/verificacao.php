<?php
require_once "../../../conexao.php";

//Condição que identifica se a ação veio pelo Ajax (POST) ou de outro modo (GET).
if(!empty($_GET['acao'])){
    $acao = $_GET['acao'];
    
    if ($acao == 'cadastrar' or $acao == 'atualizar') {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $endereco = $_POST['endereco'];
        $email = $_POST['email'];
        $nascimento = $_POST['nascimento'];
        $numero = $_POST['numero'];
        $celular = $_POST['celular'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];

//Requisição e submissão dos dados caso a função seja Cadastrar
        if ($acao == 'cadastrar') {
            $insert = "insert into Nutricionista values (default, "
                    . "'$nome', "
                    . "'$login', "
                    . "'$senha', "
                    . "'$cpf', "
                    . "'$rg', "
                    . "'$endereco', "
                    . "'$email', "
                    . "'$nascimento', "
                    . "'$numero', "
                    . "'$celular')";

            $query = mysqli_query($conexao, $insert);

            if ($query) {
                header("Location: ../cadastrar-usuarios.php");
            } else {
                header("Location: validar-nutricionista.php");
            }

//Requisição e submissão dos dados caso a função seja Atualizar
        } else if ($acao == 'atualizar') {
            $id = $_GET['id'];
            
            $update = "update Nutricionista set nome='$nome',"
                    . " login='$login',"
                    . " senha='$senha',"
                    . " cpf='$cpf',"
                    . " rg='$rg',"
                    . " endereco='$endereco',"
                    . " email='$email',"
                    . " dataDeNascimento='$nascimento',"
                    . " numero='$numero',"
                    . " celular='$celular' where id=$id";

            $query = mysqli_query($conexao, $update);

            if ($query) {
                header('Location: ../cadastrar-usuarios.php');
            } else {
                header('Location: validar-nutricionista.php');
            }
        }
    }
    
} else if (!empty([$_POST['acao']])){
    $acao = $_POST['acao'];
    
    
    if ($acao == 'getById') {
        $id = $_POST['idNutricionista'];

        $select = "select * from Nutricionista where id = $id";
        $query = mysqli_query($conexao, $select);
        $table = mysqli_fetch_array($query);

        echo json_encode($table);
    } 
    else if ($acao == 'getDataNut') {
        $id = $_POST['idNutricionista'];

        $select = "select Nutricionista.nome, Nutricionista.id from Nutricionista where id=$id";
        $query = mysqli_query($conexao, $select);
        $table = mysqli_fetch_array($query);

        echo json_encode($table);
    }
    else if ($acao == 'excluir') {
        $id = $_POST['idNutricionista'];
        
        $delete = "delete from Nutricionista where id=$id";
        $query = mysqli_query($conexao, $delete);
    }
}