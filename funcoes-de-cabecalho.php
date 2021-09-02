<?php

//Página responsavel por trazer as funções que geram dinamicamente os cabeçalhos e rodapés das páginas em HMTL
//cada tipo de usuário terá sua propia função.

function cabecalhoSecEdu($estilo = null, $title = NULL, $linkEscola = NULL, $linkUsuarios = NULL, $linkProduto = NULL, $linkRefeicao = NULL, $linkCardapio = NULL, $linkLogOut = null){
    echo "<!DOCTYPE html>"
        . "<head>"
        . "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>"
        . "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>"
        . "<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>"
        . "<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>"
        . "<link rel='stylesheet' type='text/css' href='$estilo'/>"
        . "<meta charset='UTF-8'>"
        . "<title>$title</title>"
        . "</head>"
        . "<body>"
        . "<div class='container-fluid'>"
        . "<header>"
        .   "<div id='navbar'>"
        .          "<div>"
        .             "<a href='$linkEscola'>ESCOLA</a>"   
        .          "</div>"
        .          "<div>"
        .              "<a href='$linkUsuarios'>USUÁRIOS</a>"
        .          "</div>"
        .          "<div>"
        .             "<a href='$linkProduto'>PRODUTOS</a>"
        .          "</div>"
        .          "<div>"
        .             "<a href='$linkRefeicao'>REFEIÇÕES</a>"
        .          "</div>"
        .          "<div>"
        .             "<a href='$linkCardapio'>CARDÁPIO</a>"
        .          "</div>"
        .          "<div>"
        .             "<a href='$linkLogOut'><img src='https://image.flaticon.com/icons/svg/660/660350.svg' width=26px/></a>"
        .          "</div>"
        .   "</div>"
        . "</header>";
}

function cabecalhoSecEsc($estilo = null, $title = NULL,  $linkAluno = NULL, $linkEscola = NULL, $linkEstoque = NULL, $linkCardapio = NULL, $linkLogOut = null) {
    echo "<!DOCTYPE html>"
        . "<head>"
        . "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>"
        . "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>"
        . "<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>"
        . "<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>"
        . "<link rel='stylesheet' type='text/css' href='$estilo'/>"
        . "<meta charset='UTF-8'>"
        . "<title>$title</title>"
        . "</head>"
        . "<body>"
        . "<div class='container-fluid'>"
        . "<header>"
        .        "<div id='navbar'>"
        .            "<div>"
        .               "<a href='$linkAluno'>ALUNOS</a>"   
        .            "</div>"
        .            "<div>"
        .                "<a href='$linkEscola'>ESCOLA</a>"
        .            "</div>"
        .            "<div>"
        .               "<a href='$linkEstoque'>ESTOQUE</a>"
        .            "</div>"
        .            "<div>"
        .               "<a href='$linkCardapio'>CARDÁPIO</a>"
        .            "</div>"
        .            "<div>"
        .               "<a href='$linkLogOut'><img src='https://image.flaticon.com/icons/svg/660/660350.svg' width=26px/></a>"
        .            "</div>"
        .    "</div>"
        . "</header>";
    
}

function cabecalhoNutricionista($estilo = null, $title = NULL, $linkEscola = NULL, $linkRelatorio = NULL, $linkProduto = NULL, $linkRefeicao = NULL, $linkCardapio = NULL, $linkLogOut = null){
    echo "<!DOCTYPE html>"
        . "<head>"
        . "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>"
        . "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>"
        . "<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>"
        . "<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>"
        . "<link rel='stylesheet' type='text/css' href='$estilo'/>"
        . "<meta charset='UTF-8'>"
        . "<title>$title</title>"
        . "</head>"
        . "<body>"
        . "<div class='container-fluid'>"
        . "<header>"
        .   "<div id='navbar'>"
        .            "<div>"
        .               "<a href='$linkEscola'>ESCOLAS</a>"   
        .            "</div>"
        .            "<div>"
        .                "<a href='$linkRelatorio'>RELATÓRIO</a>"
        .            "</div>"
        .            "<div>"
        .               "<a href='$linkProduto'>PRODUTOS</a>"
        .            "</div>"
        .            "<div>"
        .               "<a href='$linkRefeicao'>REFEIÇÕES</a>"
        .            "</div>"
        .            "<div>"
        .               "<a href='$linkCardapio'>CARDÁPIO</a>"
        .            "</div>"
        .            "<div>"
        .               "<a href='$linkLogOut'><img src='https://image.flaticon.com/icons/svg/660/660350.svg' width=26px/></a>"
        .            "</div>"
        .   "</div>"
        . "</header>";
    
}

function cabecalhoAluno($estilo = null, $title = NULL, $linkEscola = NULL, $linkCardapio = NULL, $linkLogOut = null){
    echo "<!DOCTYPE html>"
        . "<head>"
        . "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>"
        . "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>"
        . "<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>"
        . "<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>"
        . "<link rel='stylesheet' type='text/css' href='$estilo'/>"
        . "<meta charset='UTF-8'>"
        . "<title>$title</title>"
        . "</head>"
        . "<body>"
        . "<div class='container-fluid'>"
        . "<header>"
        .   "<div id='navbar'>"
        .            "<div>"
        .                "<a href='$linkEscola'>Escola</a>"
        .            "</div>"
        .            "<div>"
        .               "<a href='$linkCardapio'>Cardápio</a>"
        .            "</div>"
        .            "<div>"
        .               "<a href='$linkLogOut'><img src='https://image.flaticon.com/icons/svg/660/660350.svg' width=26px/></a>"
        .            "</div>"
        .   "</div>"
        . "</header>";

}



//Funções responsaveis por criar o bloco dinamico no qual armazena as informações de cada página
function sectionTop() {
    echo "<section>"
    .        "<div id='Box'>";
}

function sectionBaixo() {
    echo "</div>"
    .    "</section>";
}

function rodape(){
    echo "</div></body>"
    . "</html>";
}
