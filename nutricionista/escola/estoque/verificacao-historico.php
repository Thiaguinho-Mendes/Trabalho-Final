<?php
require_once '../../../conexao.php';

$acao = $_POST['acao'];
$idEstoque = $_POST['id'];


if ($acao == "adicionado" or $acao == "retirado"){
    
    $select = "select Produto.nomeProduto, "
            . "Estoque.quantidade, "
            . "Estoque.quantAlterada, "
            . "Escola.nomeEscola, "
            . "Estoque.tipoUsuario, "
            . "Estoque.usuario_id, "
            . "Estoque.acao, "
            . "Estoque.status, "
            . "Estoque.data from Estoque "
            . "inner join Produto on Estoque.produto_id = Produto.id "
            . "inner join TipoDeProduto on Produto.tipoDeProduto_id = TipoDeProduto.id "
            . "inner join Escola on Estoque.escola_id = Escola.id "
            . "where Estoque.estoque_id = $idEstoque";
    $query = mysqli_query($conexao, $select);
    $table = mysqli_fetch_array($query);
    $tipoUsuario = $table['tipoUsuario'];
    $usuarioId = $table['usuario_id'];

    if ($tipoUsuario == "SecEsc") {
        $selectUser = "select nomeSecEsc from SecEsc where id = $usuarioId";
        $queryUser = mysqli_query($conexao, $selectUser);
        $tableUser = mysqli_fetch_array($queryUser);
        $nomeUser = $tableUser['nomeSecEsc'];

    } else if ($tipoUsuario == "SecEdu") {
        $selectUser = "select nome from SecEdu where id = $usuarioId";
        $queryUser = mysqli_query($conexao, $selectUser);
        $tableUser = mysqli_fetch_array($queryUser);
        $nomeUser = $tableUser['nome'];

    } else if ($tipoUsuario == "Nut") {
        $selectUser = "select nome from Nutricionista where id = $usuarioId";
        $queryUser = mysqli_query($conexao, $selectUser);
        $tableUser = mysqli_fetch_array($queryUser);
        $nomeUser = $tableUser['nome'];

    }
    
    array_push($table, $nomeUser);
    
    echo json_encode($table);
                
        
} else if ($acao == "transferido"){ 
//Pegando os dados do Estoque base
    $selectEstoqueBase = "select Produto.nomeProduto, "
            . "Estoque.quantidade, "
            . "Estoque.quantAlterada, "
            . "Escola.nomeEscola, "
            . "Estoque.estoqueTransf_id, "
            . "Estoque.tipoUsuario, "
            . "Estoque.usuario_id, "
            . "Estoque.acao, "
            . "Estoque.status, "
            . "Estoque.data from Estoque "
            . "inner join Produto on Estoque.produto_id = Produto.id "
            . "inner join TipoDeProduto on Produto.tipoDeProduto_id = TipoDeProduto.id "
            . "inner join Escola on Estoque.escola_id = Escola.id "
            . "where Estoque.estoque_id = $idEstoque";
    $queryEstoqueBase = mysqli_query($conexao, $selectEstoqueBase);
    $tableEstoques= mysqli_fetch_array($queryEstoqueBase);
    $tipoUsuario = $tableEstoques['tipoUsuario'];
    $usuarioId = $tableEstoques['usuario_id'];
    $idEstoqueAlvo = $tableEstoques['estoqueTransf_id'];

    if ($tipoUsuario == "SecEdu") {
        $selectUser = "select nome from SecEdu where id = $usuarioId";
        $queryUser = mysqli_query($conexao, $selectUser);
        $tableUser = mysqli_fetch_array($queryUser);
        $nomeUser = $tableUser['nome'];

    } else if ($tipoUsuario == "Nut") {
        $selectUser = "select nome from Nutricionista where id = $usuarioId";
        $queryUser = mysqli_query($conexao, $selectUser);
        $tableUser = mysqli_fetch_array($queryUser);
        $nomeUser = $tableUser['nome'];

    }
    
//Pegando os dados do estoque Alvo
    $selectEstoqueAlvo = "select Estoque.quantidade, "
        . "Estoque.quantAlterada, "
        . "Escola.nomeEscola, "
        . "Estoque.estoqueTransf_id, "
        . "Estoque.acao, "
        . "Estoque.status "
        . "from Estoque "
        . "inner join Escola on Estoque.escola_id = Escola.id "
        . "where Estoque.estoque_id = $idEstoqueAlvo";
    $queryEstoqueAlvo = mysqli_query($conexao, $selectEstoqueAlvo);
    $tableEstoqueAlvo = mysqli_fetch_array($queryEstoqueAlvo);
    
    array_push($tableEstoques, $nomeUser); 
    array_push($tableEstoques, $tableEstoqueAlvo);

    echo json_encode($tableEstoques);
    
}

