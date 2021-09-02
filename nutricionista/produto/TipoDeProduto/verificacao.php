<?php
require_once '../../../conexao.php';

$acao = $_POST['acao'];

if($acao == 'cadastrar'){
    $nome = $_POST['nome'];
    
    $insert = "insert into TipoDeProduto value (default, '$nome')";
    mysqli_query($conexao, $insert);
}
else if($acao == 'getById'){
    $idTipoProduto = $_POST['id'];

    $select = "select TipoDeProduto.nomeTipoProduto, TipoDeProduto.id from TipoDeProduto where id = $idTipoProduto";
    $query = mysqli_query($conexao, $select);
    $fetch = mysqli_fetch_array($query);
    
    echo json_encode($fetch);
}
else if($acao == 'atualizar'){
    $idTipoProduto = $_POST['id'];
    $nome = $_POST['nome'];
    
    $insert = "update TipoDeProduto set nomeTipoProduto='$nome' where id= $idTipoProduto";
    $query = mysqli_query($conexao, $insert);  
} 
else if($acao == 'excluir'){
    $idTipoProduto = $_POST['id'];
    
    $delete = "delete from TipoDeProduto where id=$idTipoProduto";
    $query = mysqli_query($conexao, $delete);
    
    $deleteProduto = "delete from Produto where tipoDeProduto_id = $idTipoProduto";
    $queryDelProduto = mysqli_query($conexao, $deleteProduto);
}

