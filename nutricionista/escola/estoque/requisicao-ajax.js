$(document).ready(function () {
//função responsavel por adaptar e disparar o modal para Adicionar um produto
    $('#buttonAdicionar').on('click', function () {
        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                acao: 'exibirDados'
            },
            success: function (data) {
                if (data === "false") {
                    $("#addProduto").hide();
                    $("#msgProdutoEmpty").html("Nenhum produto disponível");
                } else {
                    if ($('#selectProduto>option').length === 0) {
                        $.each(JSON.parse(data), function (index, value) {
                            $('#selectProduto').append('<option value=' + value.id + '>' + value.nome + '</option>');
                        });
                    }
                }
            }
        });
        
        $('#modalAdicionar').modal('show');
    });
    $('#addProduto').submit(function () {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                id: $('select[name=produto]').val(),
                quantidade: $('input[name=quantidade]').val(),
                acao: 'cadastrar'
            },
            success: function () {
                location.reload();
            }
        });
    });

//função responsavel por adaptar e disparar o modal para Alocar um produto
    $('.alocar-produto').on('click', function () {
        var idEstoque = $(this).val();
        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                id: idEstoque,
                acao: 'getById'
            },
            success: function (data) {
                var produto = JSON.parse(data);
                $('input[name=produtoNome]').val(produto.nomeProduto);
                $('#idEstoque').val(produto.estoque_id);
            }
        });
        
        $('#modalTitulo').html('Alocar Produto');
        $('#buttonSubmit').val('Adicionar');
        $('#modalProduto').modal('show');
    });
    
//função responsavel por adaptar e disparar o modal para Reduzir um produto
    $('.reduzir-produto').on('click', function () {
        var idEstoque = $(this).val();
        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                id: idEstoque,
                acao: 'getById'
            },
            success: function (data) {
                var produto = JSON.parse(data);
                $('input[name=produtoNome]').val(produto.nomeProduto);
                $('input[name=quantidadeAlocada]').attr({'max': produto.quantidade});
                $('#idEstoque').val(produto.estoque_id);
            }
        });

        $('#modalTitulo').html('Reduzir Produto');
        $('#buttonSubmit').val('Reduzir');
        $('#modalProduto').modal('show');
    });
    
//função que indentifica se o formulário é de Alocar ou Reduzir com base no Button clicado
    $('#buttonSubmit').on('click', function () {
        if ($(this).val() === "Adicionar") {
            $('#alocarProduto').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    method: 'post',
                    url: 'verificacao.php',
                    data: {
                        id: $('#idEstoque').val(),
                        quantidade: $('input[name=quantidadeAlocada]').val(),
                        acao: 'alocar'
                    },
                    success: function () {
                        location.reload();
                    }
                });
            });
        } else if ($(this).val() === "Reduzir") {
            $('#alocarProduto').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    method: 'post',
                    url: 'verificacao.php',
                    data: {
                        id: $('#idEstoque').val(),
                        quantidade: $('input[name=quantidadeAlocada]').val(),
                        acao: 'reduzir'
                    },
                    success: function () {
                        location.reload();
                    }
                });
            });
        }
    });
    
//função responsavel por adaptar e disparar o modal para Reduzir um produto
    $('.transferir-produto').on('click', function () {
        var idEstoque = $(this).val();
        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                id: idEstoque,
                acao: 'getDataTransferir'
            },
            dataType: 'json',
            success: function (data) {
                if ($('#escolaAlvo>option').length === 0) {
                    $.each(data, function (index, value) {
                        if (index !== (data.length - 1)) {
                            $('#escolaAlvo').append('<option value=' + value.idEscola + '>' + value.nomeEscola + '</option>');
                        }
                    });
                }
                var itens = data[data.length-1];
                $('#produtoTransferir').html(itens.nomeProduto);
                $('#escola').html(itens.escola);
                $('input[name=quantidadeTransferida]').attr({
                    'max' : itens.quantidade
                });
                $('#idEstoqueTransferir').val(itens.estoque_id);
            }
        });
        
        $('#modalTransferir').modal('show');
    });
    $('#transferirProduto').submit(function () {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                id: $('#idEstoqueTransferir').val(),
                escolaAlvo: $('select[name=escolaAlvo]').val(),
                quantidade: $('input[name=quantidadeTransferida]').val(),
                acao: 'transferir'
            },
            success: function () {
                location.reload();
            }
        });
    });
    
//Função que limpa todos os campos dos inputs toda vez que o modal de cadastro/atualização é fechado
    $('.modal').on('hide.bs.modal', function () {
        $('form select').empty();
        $('form input').val("");
        $('#buttonSubmit').val("");
        $('.modalInfo td').empty("");
    });
    
//Função que dispara e prepara o modal de exibição do historico de movimentação de Adicionar/Reduzir
    $('.addRed').on('click', function () {
        var idEstoque = $(this).attr('value');
        var estoqueAcao = $(this).attr('class').split(' ').pop();
        $.ajax({
            method: 'post',
            url: 'verificacao-historico.php',
            data:{
                id: idEstoque,
                acao: estoqueAcao
            },
            dataType: 'json',
            success: function(data){
                $('#produto').html(data.nomeProduto);
                $('#escola').html(data.nomeEscola);
                $('#tipoUsuario').html(data.tipoUsuario);
                $('#usuario').html(data[9]);
                $('#acao').html(data.acao);
                $('#data').html(data.data);
                
                if(data.tipoUsuario === "Nut"){
                    $('#tipoUsuario').html("Nutricionista");
                } else if (data.tipoUsuario === "SecEdu"){
                    $('#tipoUsuario').html("Secretário da Educação");
                } else if (data.tipoUsuario === "SecEsc"){
                    $('#tipoUsuario').html("Secretário da Escola");
                }
                
                $('#quantAtual').html(data.quantidade);
                if (data.acao === "Adicionado") {
                    $('#quantMov').html('+' + data.quantAlterada);
                } else if (data.acao === "Retirado") {
                    $('#quantMov').html('-' + data.quantAlterada);
                }                
                if (data.status === "0") {
                    $('#status').html("Desativado");
                } else {
                    $('#status').html("Ativo");
                }
            }
        });
        
        $('#modalAddRed').modal('show');
    });
    
//Função que dispara e prepara o modal de exibição do historico de movimentação de Transferencia
    $('.transferido').on('click', function () {
        var idEstoque = $(this).attr('value');
        var estoqueAcao = $(this).attr('class').split(' ').pop();
        $.ajax({
            method: 'post',
            url: 'verificacao-historico.php',
            data:{
                id: idEstoque,
                acao: estoqueAcao
            },
            dataType: 'json',
            success: function(data){
                //Definindo os dados da escola base
                $('#produtoTransf').html(data.nomeProduto);
                $('#escolaBase').html(data.nomeEscola);
                
                if(data.tipoUsuario === "Nut"){
                    $('#tipoUsuarioTransf').html("Nutricionista");
                } else if (data.tipoUsuario === "SecEdu"){
                    $('#tipoUsuarioTransf').html("Secretário da Educação");
                } else if (data.tipoUsuario === "SecEsc"){
                    $('#tipoUsuarioTransf').html("Secretário da Escola");
                }
                
                $('#usuarioTransf').html(data[10]);
                $('#acaoTransf').html("Transferido");
                $('#dataTransf').html(data.data);
                
                $('#quantAtualBase').html(data.quantidade);
                $('#quantMovBase').html(+ data.quantAlterada);
                
                if (data.status === "0") {
                    $('#statusBase').html("Desativado");
                } else {
                    $('#statusBase').html("Ativo");
                }
                
                //Definindo os dados da escola alvo
                $('#escolaAlvo').html(data[11].nomeEscola);
                $('#quantAlvo').html(data[11].quantidade);
                
                if (data[11].status === "0"){
                    $('#statusAlvo').html("Desativado");                
                } else {
                    $('#statusAlvo').html("Ativo");
                }
                
            }
        });
        
        $('#modalTransf').modal('show');
    });
});