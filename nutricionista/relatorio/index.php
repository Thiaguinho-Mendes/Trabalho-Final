<?php
require_once '../../conexao.php';
require_once '../../funcoes-de-cabecalho.php';
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

cabecalhoNutricionista('../../estilo/style.css', 'Relatório', '../escola/', '.', '../produto/', '../refeicao/', '../cardapio/','../../login/logOut.php');
sectionTop();
?>
<BR>
    EM DESENVOLVIMENTO
<BR>
<BR>
<a href="../index.php" class="btn btn-dark m-2">Voltar</a>
<?php
sectionBaixo();
rodape();
