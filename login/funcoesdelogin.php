<?php 
    session_start();
    
//Função que define os parametros basicos de login.
    function logar($login, $nome, $id){
        $_SESSION["login"] = $login;
        $_SESSION["nome"] = $nome;
        $_SESSION["id"] = $id;
        iniciarSessao();
    }

//Inicio do tempo de uma session
    function iniciarSessao(){
        $_SESSION["time"] = time() + 3500;
    }

//Verificação que informa se o tempo expirou
    function tempoExpirado(){
        if($_SESSION["time"] < time()){
            return true;
        } else {
            iniciarSessao();
            return false;
        }
    }

//Verificação que inforna se está logado
    function estaLogado(){
        return isset($_SESSION["login"]);
    }

//Função que retorna o nome do usuário logado
    function username(){
        return $_SESSION["nome"];
    }
    
//Função que retorna o id do usuário logado
    function userid(){
        return $_SESSION["id"];
    }
    
//Função de deslogar
    function deslogar(){
        session_destroy();
    }

//Função que verifica se está logado ou se o tempo expirou
    function autenticar($location){
        if(!estaLogado() or tempoExpirado()){
            deslogar();
            header("Location: $location");
        } else {
            return true;
        }
    }

//Função que retorna o tipo de usuário que está logado
    function tipoLogin ($conexao, $string){
        $query = mysqli_query($conexao, $string);
        $array = mysqli_fetch_array($query);
        return $array;
    }
