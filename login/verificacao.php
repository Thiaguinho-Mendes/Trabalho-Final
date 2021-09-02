<?php

    require_once "../conexao.php";
    require_once "funcoesdelogin.php";

    $login = $_POST["login"];
    $senha = $_POST["senha"];

//Vefiricação dos dados 
    if(empty($login) or empty($senha)){
        header("Location: ../index.php");
    } else {
        if(strlen($login) <= 64 and strlen($senha) <= 64){
//Pagina do Secretário da Educação
    $loginInfo = tipoLogin($conexao, "select * from SecEdu where login='$login' and senha='$senha'");
    if($loginInfo != null){
        logar($loginInfo['login'], $loginInfo['nome'], $loginInfo['id']);
        header("Location: ../sec-educacao");
    } 
    
//Página do Nutricionista
    $loginInfo = tipoLogin($conexao, "select * from Nutricionista where login='$login' and senha='$senha'");
    if($loginInfo != null){
         logar($loginInfo['login'], $loginInfo['nome'], $loginInfo['id']);
         header("Location: ../nutricionista");
    } 
    
//Página do Secretário da Escola   
    $loginInfo = tipoLogin($conexao, "select * from SecEsc where login='$login' and senha='$senha'");
    if($loginInfo != null){
         logar($loginInfo['login'], $loginInfo['nome'], $loginInfo['id']);
         header("Location: ../sec-escola");
    } 
    
//Página do Aluno    
    $loginInfo = tipoLogin($conexao, "select * from Aluno where login='$login' and senha='$senha'");
    if($loginInfo != null){
         logar($loginInfo['login'], $loginInfo['nome'], $loginInfo['id']);
         header("Location: ../aluno");
    } 
    
    if(empty($_SESSION['login'])){
        header("Location: ../index.php");
    }
    
    } else {
        header("Location: ../index.php");
        }
    }
        