<?php
require_once '../../conexao.php';
session_start();

//string e função seleciona as refeições de um ano escolar no banco de dados
$select = 'select refeicao.nome, cardapio_refeicao.data from cardapio_refeicao inner join refeicao
on cardapio_refeicao.refeicao_id = refeicao.id where cardapio_refeicao.anoEscolar_id = '.$_SESSION['id_anoEscolar'];
$query = mysqli_query($conexao, $select);

$refeicoes = [];

while($tbl = mysqli_fetch_array($query)){
    $refeicao = $tbl['nome'];
    $data = $tbl['data'];
    
    $refeicoes[] = [
        'title' => $refeicao,
        'start' => $data,
    ];
}

//função que transforma o array $refeições em um dado JSON para poder ser trabalhado no calendario.js
echo json_encode($refeicoes);