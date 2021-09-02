<?php
require_once '../../conexao.php';
require_once '../../login/funcoesdelogin.php';
require_once '../../funcoes-de-cabecalho.php';

autenticar('../../index.php');

cabecalhoSecEsc('../../estilo/style.css', 'Cardápio', '../aluno/', '../escola/', '../estoque/', '.','../../login/logOut.php');
sectionTop();
?>

<h3>Cardápio</h3>
<hr>
<!--Links que definem se o cardápio é do ensino infantil ou Fundamental com base no id-->
<a class="btn btn-dark mx-2 my-3 buttonLink" href="calendario.php?id=1">Ensino Infantil</a>
<a class="btn btn-dark mx-2 my-3 buttonLink" href="calendario.php?id=2">Ensino Fundamental</a>

<?php
sectionBaixo();
rodape();
