<?php

require_once '../../../conexao.php';
session_start();
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d h-i-s');

$idEscola = $_SESSION['idEscola'];
$acao = $_POST['acao'];


if ($acao == 'exibirDados') {
//Requisição de todos os produtos cadastrados no estoque da escola selecionada
    $selectEstoque = "select produto_id from Estoque where Estoque.escola_id = " . $idEscola;
    $queryEstoque = mysqli_query($conexao, $selectEstoque);
    $produtosEstoque = [];

//Atribuição de tais produtos a um array
    while ($tableEstoque = mysqli_fetch_array($queryEstoque)) {
        $produtoEstoque_id = $tableEstoque['produto_id'];

        $produtosEstoque[] = $produtoEstoque_id;
    }

//Requisição de todos os produtos cadastrados
    $selectProduto = "select id, nomeProduto from Produto";
    $queryProduto = mysqli_query($conexao, $selectProduto);
    $produtos = [];

//Atribuição de tais produtos a um array
    while ($tableProduto = mysqli_fetch_array($queryProduto)) {
        $produto_id = $tableProduto['id'];
        $nomeProduto = $tableProduto['nomeProduto'];

        $produtos[] = [
            'id' => $produto_id,
            'nome' => $nomeProduto
        ];
    }


    $produtosVerificados = [];
//Estrutura que indentifica quais produtos já existe no estoque da escola, para que nao sejam exibidos
//novamente para serem cadastrados, para evitar repetição de produtos.
    if (empty($produtosEstoque)) {
        foreach ($produtos as $produto) {
            $produtosVerificados[] = $produto;
        }
    } else {
        foreach ($produtos as $produto) {
            for ($i = 0; $i < count($produtosEstoque); $i++) {
                if ($produtosEstoque[$i] == $produto['id']) {
                    break;
                } else if ($i == count($produtosEstoque) - 1) {
                    $produtosVerificados[] = $produto;
                }
            }
        }
    }

    if(count($produtosVerificados) == 0){
       echo "false";
    } else {
        echo json_encode($produtosVerificados);
    }
    
} 
//Submissão ao banco de dados do cadastro do produto selecionado
else if ($acao == 'cadastrar') {
    $idProduto = $_POST['id'];
    $quantidade = $_POST['quantidade'];
    
    $insert = "insert into Estoque values (default, '$idEscola', '$idProduto', NULL, $quantidade, $quantidade, '$data', ".$_SESSION['id'].", 'SecEdu', 'Adicionado', 1)";
    $query = mysqli_query($conexao, $insert);
    
} 
else if ($acao == 'getById') {
    $idEstoque = $_POST['id'];

    $select = "select Produto.nomeProduto, Estoque.quantidade, Estoque.estoque_id from Estoque inner join Produto on "
            . "Estoque.produto_id = Produto.id where Estoque.estoque_id = " . $idEstoque;
    $query = mysqli_query($conexao, $select);
    $table = mysqli_fetch_array($query);

    echo json_encode($table);
    
} 
//Submissão ao banco de dados da alocação em quantidade do produto selecionado 
else if ($acao == 'alocar') {
    $id = $_POST['id'];
    $quantidadeRed = $_POST['quantidade'];

    $select = "select quantidade, produto_id from Estoque where estoque_id = $id";
    $querySelect = mysqli_query($conexao, $select);
    $table = mysqli_fetch_array($querySelect);
    $idProduto = $table['produto_id'];
    $quantidade = $table['quantidade'];

    $quantidade += $quantidadeRed;

    $update = "update Estoque set status = 0 where estoque_id = $id";
    $queryUpdate = mysqli_query($conexao, $update);

    $insert = "insert into Estoque values(default, $idEscola, $idProduto, NULL, $quantidade, $quantidadeRed, '$data', ".$_SESSION['id'].", 'SecEdu', 'Adicionado', 1)";
    $queryInsert = mysqli_query($conexao, $insert);
    
} 
//Submissão ao banco de dados da Redução em quantidade do produto selecionado 
else if($acao == 'reduzir'){
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

    $insert = "insert into Estoque values(default, $idEscola, $idProduto, NULL, $quantidade, $quantidadeRed, '$data', ".$_SESSION['id'].", 'SecEdu', 'Retirado', 1)";
    $queryInsert = mysqli_query($conexao, $insert);  
    
}
//Requisição ao bando de dados das informações para exibir no modal de transferencia de produtos
else if ($acao == 'getDataTransferir') {
    $id = $_POST['id'];

    $selectEstoque = "select Produto.nomeProduto, Estoque.estoque_id, Estoque.quantidade, Escola.nomeEscola from Estoque inner join Produto "
            . "on Estoque.produto_id = Produto.id inner join Escola "
            . "on Estoque.escola_id = Escola.id where estoque_id = $id";
    $queryEstoque = mysqli_query($conexao, $selectEstoque);
    $tableEstoque = mysqli_fetch_array($queryEstoque);

    $selectEscolas = "select id, nomeEscola from Escola where id <> $idEscola";
    $queryEscolas = mysqli_query($conexao, $selectEscolas);

    

    $dados = [];

    while ($tableEscolas = mysqli_fetch_array($queryEscolas)) {
        $idEscola = $tableEscolas['id'];
        $nomeEscola = $tableEscolas['nomeEscola'];
        
        $dados[] = [
            "idEscola" => $idEscola,
            "nomeEscola" => $nomeEscola
        ];
    }

    $dados[] = [
        "estoque_id" => $tableEstoque['estoque_id'],
        "nomeProduto" => $tableEstoque['nomeProduto'],
        "quantidade" => $tableEstoque['quantidade'],
        "escola" => $tableEstoque['nomeEscola']
    ];

    echo json_encode($dados);
} 
//submissão ao banco de dados das informações de trasnferencia de produto no banco de dados.
else if ($acao == 'transferir') {
    $idEstoque = $_POST['id'];
    $quantidade = $_POST['quantidade'];
    $idEscolaAlvo = $_POST['escolaAlvo'];

//Requisição dos dados do estoque da escola base
    $selectEstoque = "select quantidade, produto_id from Estoque where estoque_id = $idEstoque";
    $queryEstoque = mysqli_query($conexao, $selectEstoque);
    $tableEstoque = mysqli_fetch_array($queryEstoque);
    $quantidadeEstoque = $tableEstoque['quantidade'];
    $idProduto = $tableEstoque['produto_id'];

//Subtração do valor do estoque para atualizar o valor retirado do estoque da escola base
    $quantidadeEstoque -= $quantidade;

//Atualização do status do estoque da escola base
    $updateEstoque = "update Estoque set status = 0 where Estoque.estoque_id=$idEstoque";
    mysqli_query($conexao, $updateEstoque);

//Requisição dos dados do estoque da escola alvo.
    $selectEstoqueAlvo = "select Estoque.estoque_id, Estoque.quantidade from Estoque where Estoque.escola_id = $idEscolaAlvo and Estoque.produto_id = $idProduto and Estoque.status = 1";
    $queryEstoqueAlvo = mysqli_query($conexao, $selectEstoqueAlvo);
    
//Condição que identifica se o produto ja existe em um estoque.
    if (mysqli_num_rows($queryEstoqueAlvo) != 0) {
        $tableEstoqueAlvo = mysqli_fetch_array($queryEstoqueAlvo);
        $idEstoqueAlvo = $tableEstoqueAlvo['estoque_id'];
        $quantidadeEstoqueAlvo = $tableEstoqueAlvo['quantidade'];
        
//Atualização do novo estoque da escola base.
    $insertNewEstBase = "insert into Estoque values(default, $idEscola, $idProduto, $idEstoqueAlvo, $quantidadeEstoque, $quantidade, '$data', ".$_SESSION['id'].", 'SecEdu', 'TransfRed', 1)";
    $queryInsertNewEstBase = mysqli_query($conexao, $insertNewEstBase);

//Seleção do id do novo estoque da escola base cadastrado (para coloca-lo no novo estoque da escola alvo)
    $selectIdNewEstBase = "select Estoque.estoque_id from Estoque where Estoque.escola_id = $idEscola and Estoque.produto_id = $idProduto";
    $queryIdNewEstBase = mysqli_query($conexao, $selectIdNewEstBase);
    $tableIdNewEstBase = mysqli_fetch_array($queryIdNewEstBase);
    $idNewEstBase = $tableIdNewEstBase['estoque_id'];
    
//Incrementação da quantidade transferida para o estoque da escola alvo
        $quantidadeEstoqueAlvo += $quantidade;

//Atualização do status do estoque velho
        $updateEscAlvo = "update Estoque set status = 0 where Estoque.estoque_id = " . $idEstoqueAlvo;
        mysqli_query($conexao, $updateEscAlvo);

//Criação do novo estoque da escola alvo
        $insertNewEstoque = "insert into Estoque values(default, $idEscolaAlvo, $idProduto, $idNewEstBase, $quantidadeEstoqueAlvo, $quantidade, '$data', ".$_SESSION['id'].", 'SecEdu', 'TransfAdd', 1)";
        mysqli_query($conexao, $insertNewEstoque);
        
    } else {
        $insertNewEstBase = "insert into Estoque values(default, $idEscola, $idProduto, NULL, $quantidadeEstoque, $quantidade, '$data', ".$_SESSION['id'].", 'SecEdu', 'TransfRed', 1)";
        $queryInsertNewEstBase = mysqli_query($conexao, $insertNewEstBase);
        
        
        $selectIdEstBase = "select Estoque.estoque_id from Estoque where Estoque.escola_id = $idEscola and Estoque.produto_id = $idProduto and status = 1";
        $querySelectIdEstBase = mysqli_query($conexao, $selectIdEstBase);
        $tableIdEstBase = mysqli_fetch_array($querySelectIdEstBase);
        $idNewEstBase = $tableIdEstBase['estoque_id'];
        
        $insertNewEstAlvo = "insert into Estoque values (default, $idEscolaAlvo, $idProduto, $idNewEstBase, $quantidade, $quantidade, '$data', ".$_SESSION['id'].", 'SecEdu', 'TransfAdd', 1)";
        mysqli_query($conexao, $insertNewEstAlvo);
        
//Seleção do id do novo estoque da escola Alvo cadastrado (para coloca-lo no novo estoque da escola base)
        $selectIdNewEstAlvo = "select Estoque.estoque_id from Estoque where Estoque.escola_id = $idEscolaAlvo and Estoque.produto_id = $idProduto";
        $queryIdNewEstAlvo = mysqli_query($conexao, $selectIdNewEstAlvo);
        $tableIdNewEstAlvo = mysqli_fetch_array($queryIdNewEstAlvo);
        $idNewEstAlvo = $tableIdNewEstAlvo['estoque_id'];
        
        $updateNewEstBase = "update Estoque set estoqueTransf_id = $idNewEstAlvo where Estoque.estoque_id = $idNewEstBase";
        $queryUpdateNewEstBase = mysqli_query($conexao, $updateNewEstBase);
    }
}