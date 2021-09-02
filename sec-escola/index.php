<?php 
require_once '../funcoes-de-cabecalho.php';
require_once '../login/funcoesdelogin.php';
require_once '../conexao.php';

autenticar('../index.php');

cabecalhoSecEsc('../estilo/style.css', 'Inicio', 'aluno/index.php', 'escola/', 'estoque/', 'cardapio/', '../login/logOut.php');
rodape();

//Função que define o id da escola no qual o Secretário é alocado para ser usado em outras páginas
    $select = "select escola_id from SecEsc where id=".userid();
    $query = mysqli_query($conexao, $select);
    $table = mysqli_fetch_array($query);
    $_SESSION['idEscola'] = $table['escola_id'];