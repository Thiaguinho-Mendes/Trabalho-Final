<?php
require_once '../../conexao.php';
require_once '../../funcoes-de-cabecalho.php';
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

cabecalhoSecEdu('../../estilo/style.css', 'Cardápio', '../escola/', '../usuarios/cadastrar-usuarios.php', '../produto/', '../refeicao/', '.', '../../login/logOut.php');
sectionTop();
?>
<h3>Cardápio</h3>
<hr>
<a class="btn btn-dark mx-2 my-3 buttonLink" href="calendario.php?id=1">Ensino Infantil</a>
<a class="btn btn-dark mx-2 my-3 buttonLink" href="calendario.php?id=2">Ensino Fundamental</a>

<?php
sectionBaixo();
rodape();
