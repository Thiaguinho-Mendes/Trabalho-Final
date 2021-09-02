<?php
require_once '../../conexao.php';
session_start();

//Cadastro da data para atribui-la no momento da redução do produto
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H-i-s');

$acao = $_POST['acao'];

//Reduzir na quantidade do produto
if($acao == 'reduzir'){
    $id = $_POST['id'];
    $quantidadeRed = $_POST['quantidade'];
    
    $select = "select quantidade, produto_id from Estoque where estoque_id = $id";
    $querySelect = mysqli_query($conexao, $select);
    $table = mysqli_fetch_array($querySelect);
    $idProduto = $table['produto_id'];
    $quantidade = $table['quantidade'];
    
    $quantidade -= $quantidadeRed;
    
    $update = "update Estoque set status = 0 where estoque_id = $id";
    $queryUpdate = mysqli_query($conexao, $update);
    
    
    $insert = "insert into Estoque values(default, ".$_SESSION['idEscola'].", $idProduto, NULL, $quantidade, $quantidadeRed, '$data', ".$_SESSION['id'].", 'SecEsc', 'Retirado', 1)";
    $queryInsert = mysqli_query($conexao, $insert);
    
} 

//Seleção dos dados do produto para exibir no modal de Redução
else if ($acao == 'getById'){
    $id = $_POST['id'];
    
    $select = "select Estoque.estoque_id, Estoque.quantidade, Produto.nomeProduto from Estoque inner join Produto
on Estoque.produto_id = Produto.id where estoque_id = $id";
    $query = mysqli_query($conexao, $select);
    $table = mysqli_fetch_array($query);
    
    echo json_encode($table);
}