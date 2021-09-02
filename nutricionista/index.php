<?php
    require_once '../conexao.php';
    require_once '../funcoes-de-cabecalho.php';
    require_once '../login/funcoesdelogin.php';
    
    autenticar('../index.php');
    
    cabecalhoNutricionista('../estilo/style.css', 'Inicio', 'escola/', 'relatorio/', 'produto/', 'refeicao/', 'cardapio/', '../login/logOut.php');
?>

<?php
    rodape();
