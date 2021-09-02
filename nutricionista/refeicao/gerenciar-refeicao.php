<?php
require_once '../../conexao.php';

$acao = $_POST['acao'];

if($acao == 'cadastrar'){
    $nome = $_POST['nome'];
    $insert = 'insert into Refeicao values(default, "'.$nome.'")';
    $query = mysqli_query($conexao, $insert);
} 
else if($acao == 'getById'){
    $idRefeicao = $_POST['id'];

    $select = "select Refeicao.nome, Refeicao.id from Refeicao where id = $idRefeicao";
    $query = mysqli_query($conexao, $select);
    $fetch = mysqli_fetch_array($query);
    
    echo json_encode($fetch);
}
else if($acao == 'atualizar'){
    $idRefeicao = $_POST['id'];
    $nome = $_POST['nome'];
    
    $insert = "update Refeicao set nome='$nome' where id= $idRefeicao";
    $query = mysqli_query($conexao, $insert);  
} 
else if($acao == 'excluir'){
    $idRefeicao = $_POST['id'];
    
    $delete = "delete from Refeicao where id=$idRefeicao";
    $query = mysqli_query($conexao, $delete);
    
    $deleteRefCardapio = "delete from Cardapio_Refeicao where refeicao_id = $idRefeicao";
    $queryRefDel = mysqli_query($conexao, $deleteRefCardapio);
}

