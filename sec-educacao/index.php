<?php
require_once("../funcoes-de-cabecalho.php");
require_once "../login/funcoesdelogin.php";

autenticar('../index');


cabecalhoSecEdu("../estilo/style.css", "Inicio", "escola/", "usuarios/cadastrar-usuarios.php", "produto/", "refeicao/", "cardapio/", "../login/logOut.php");


rodape();
