<?php

//Página que possui a conexão com o banco, todas as páginas que precisam se comunicar com o banco
//incluem essa página nelas.

    $conexao = mysqli_connect("localhost", "root", "", "gereesc");