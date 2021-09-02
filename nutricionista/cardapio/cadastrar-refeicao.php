<?php
require_once '../../conexao.php';
session_start();

//Pega os dados mandados pelo ajax e os coloca em um array
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Tratamento da string data para se adaptar ao padrão date do MYSQL
$data = str_replace('/', '-', $dados['start']);
$data_convertida = date('Y-m-d', strtotime($data));

//string e função de insert ao banco de dados
$insert = "insert into Cardapio_Refeicao values(default, '".$data_convertida."', '".$_SESSION['id_anoEscolar']."', '".$dados['refeicoes']."')";
$query = mysqli_query($conexao, $insert);

//função que identifica se o insert ao banco funcionou ou não
if ($query) {
    $retorna = ['sit' => true];
} else {
    $retorna = ['sit' => false,  'msg' => '<div class="alert alert-danger" role="alert">
        Erro: Refeição não cadastrada!
    </div>'];
}

header('Content-Type: applicaton/json');
//Função que prepara $retorna para ser trabalhada na página calendario.js
//Esta variavel informa se o insert ao banco de dados foi valido ou não
echo json_encode($retorna);

