<?php 
require_once '../../funcoes-de-cabecalho.php';
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

$_SESSION['id_anoEscolar'] = null;

cabecalhoNutricionista('../../estilo/style.css', 'Cardápio', '../escola/', '../relatorio/', '../produto/', '../refeicao/', '.', '../../login/logOut.php');
sectionTop();
?>
<h3>Cardápio</h3>
<hr>
<a href="calendario.php?id=1" class="btn btn-dark mx-2 my-3 buttonLink">Ensino Infantil</a>
<a href="calendario.php?id=2" class="btn btn-dark mx-2 my-3 buttonLink">Ensino Fundamental</a>
<?php
sectionBaixo();
rodape();
