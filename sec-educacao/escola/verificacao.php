<?php
require_once '../../conexao.php';

//Verificação que identifica se a requisição veio por pelo POST ou por GET
if(!empty($_GET['acao'])){
    $acao = $_GET['acao'];
    
//Condição que indica se o tipo de ação é cadastrar ou Atualizar, é nescessario pois apenas estas funções tem dados
//a serem pegos por POST
    if($acao == 'cadastrar' or $acao == 'atualizar'){

    $nome = $_POST["nomeEscola"];
    $endereco = $_POST["endereco"];
    $cnpj = $_POST["cnpj"];
    $email = $_POST["email"];
    $numero = $_POST["numero"];
    $telefone = $_POST["telefone"];
    $alunosEnsInfantil = $_POST["alunosEnsInfantil"];
    $alunosEnsFundamental = $_POST["alunosEnsFundamental"];

//Condição para caso foi selecionado o cadastro de uma escola
    if($acao == 'cadastrar'){

        $insert = "insert into Escola values(default, '$nome', '$endereco', '$cnpj', '$email', '$numero', '$telefone', $alunosEnsInfantil, $alunosEnsFundamental)";
        $query = mysqli_query($conexao, $insert);

        if($query){
            header("Location: index.php");
        } else {
            header("Location: verificar-escola.php");
        }
    }
    
//Condição selecionada caso foi selecionado a atualização de uma escola
    else if($acao == 'atualizar'){
       $idEscola = $_GET['id'];
       
       $update = "update Escola set nomeEscola='$nome', "
               . "endereco='$endereco', "
               . "cnpj='$cnpj', "
               . "email='$email', "
               . "numero='$numero', "
               . "telefone='$telefone', "
               . "alunosEnsInfantil=$alunosEnsInfantil, "
               . "alunosEnsFundamental=$alunosEnsFundamental where id=$idEscola";
       $query = mysqli_query($conexao, $update);
       
       if($query){
           header("Location: index.php");
       } else {
           header("Location: verificar-escola.php");
           }
      }
    }
}
else if(!empty($_POST['acao'])){
    $acao = $_POST['acao'];
    
//Requisição dos dados da Escola/Secretarios por meio do Id da escola
    if($acao == "visualizar"){
        $idEscola = $_POST['idEscola'];
        
        $selectEscola = "select * from Escola where id=$idEscola";
        $selectSecEsc = "select SecEsc.id, SecEsc.nomeSecEsc, SecEsc.cargo from SecEsc where SecEsc.escola_id = $idEscola";

        $queryEscola = mysqli_query($conexao, $selectEscola);
        $querySecEsc = mysqli_query($conexao, $selectSecEsc);
        
        $tableEscola = mysqli_fetch_array($queryEscola);
        
        $secretarios = [];
        
        while($tableSecEsc = mysqli_fetch_array($querySecEsc)){
            $nomeSecEsc = $tableSecEsc['nomeSecEsc'];
            $cargo = $tableSecEsc['cargo'];
            
            if($cargo == "Diretor"){
                $secretarios[] = [
                    "nome" => $nomeSecEsc,
                    "cargo" => "Diretor"
                ];
            } else if ($cargo == "Secretario"){
                $secretarios[] = [
                    "nome" => $nomeSecEsc,
                    "cargo" => "Secretario"
                ];
            }
        }
        
        array_push($tableEscola, $secretarios);

        echo json_encode($tableEscola);
    } 
    else if ($acao == "getDataEscola"){
        $idEscola = $_POST['idEscola'];
        
        $select = "select Escola.id, Escola.nomeEscola from Escola where Escola.id = $idEscola";
        $query = mysqli_query($conexao, $select);
        $table = mysqli_fetch_array($query);
        
        echo json_encode($table);
    }
    else if ($acao == "excluir"){
        $idEscola = $_POST['idEscola'];
        
        $delete = "delete from Escola where id = $idEscola";
        mysqli_query($conexao, $delete);
        
        $setNullSecEsc = "update SecEsc set escola_id = NULL where escola_id = $idEscola";
        $querySetNullSecEsc = mysqli_query($conexao, $setNullSecEsc);
    }
} 