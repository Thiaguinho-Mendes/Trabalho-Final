$(document).ready(function () {
//Função que lida com o cadastro de um produto
    $('#button-cadastro').click(function () {
//Requisição dos tipos de produtos e pesos existentes para colocalos como Options de um Select
        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                acao: 'getValues'
            },
            dataType: 'json',
            success: function (data) {
                $.each(data, function (index, value) {
                    $.each(value.tipoPeso, function (index, tipoPeso) {
                        $('#tipoDePeso').append('<option value=' + tipoPeso.id + '>' + tipoPeso.nomeTipoPeso + '</option>');
                    });
                    $.each(value.tipoProduto, function (index, tipoProduto) {
                        $('#tipoDeProduto').append('<option value=' + tipoProduto.id + '>' + tipoProduto.nomeTipoProduto + '</option>');
                    });
                });
            }
        });

//Preparação do modal para Cadastro de um produto
        $('#tituloModal').html('Cadastrar Produto');
        $('#buttonSubmit').val('Cadastrar');
        $('#modalProduto').modal('show');
    });

//função que indentifica se o formulário é de Cadastro ou Atualização com base no Button clicado
    $('#buttonSubmit').on('click', function(){
        if($(this).val() === "Cadastrar"){
//Função que lida com a submissão dos dados colocados no formulario de cadastro
            $('#formulario').submit(function () {
                event.preventDefault();
                $.ajax({
                    method: 'post',
                    url: 'verificacao.php',
                    data: {
                        nome: $('input[name=nome]').val(),
                        marca: $('input[name=marca]').val(),
                        peso: $('input[name=peso]').val(),
                        tipoDePeso: $('select[name=tipoDePeso]').val(),
                        tipoDeProduto: $('select[name=tipoDeProduto]').val(),
                        acao: 'cadastrar'
                    },
                    success: function () {
                       location.reload();
                    }
                });

            });
        } else if ($(this).val() === "Atualizar"){
//Função que indica quando um formulário é confirmado
            $('#formulario').on("submit", function (event) {
                event.preventDefault();
                $.ajax({
                    method: 'post',
                    url: 'verificacao.php',
                    data: {
                        id: $('#idProdutoUp').val(),
                        nome: $('input[name=nome]').val(),
                        marca: $('input[name=marca]').val(),
                        peso: $('input[name=peso]').val(),
                        tipoDePeso: $('select[name=tipoDePeso]').val(),
                        tipoDeProduto: $('select[name=tipoDeProduto]').val(),
                        acao: 'atualizar'
                    },
                    success: function () {
                        location.reload();
                    }
                });
            });
        }
    });

//Função que limpa todos os campos dos inputs toda vez que o modal de cadastro/atualização é fechado
    $('#modalProduto').on('hide.bs.modal', function () {
        $('#formulario input').val("");
        $('#tipoDePeso').empty();
        $('#tipoDeProduto').empty();
        $('#buttonSubmit').val("");
    });

//Função que trabalha com alterar os dados de um produto
    $('.button-alterar').on("click", function () {
        var buttonId = $(this).val();
//Requisição ao banco dos dados já existentes do produto selecionado
        $.ajax({
            url: 'verificacao.php',
            method: 'post',
            data: {
                id: buttonId,
                acao: 'getById'
            },
            dataType: 'json',
            success: function (data) {
//Definição nos inputs com os dados que existiam anteriormente em cada produto
                $('#nome').val(data.nomeProduto);
                $('#marca').val(data.marca);
                $('#peso').val(data.peso);
                $('#idProdutoUp').val(data.id);

//Funções que percorrem os os tipos de produtos e pesos existentes para coloca-los como Options nos Selects
                $.each(JSON.parse(data[6].tipoPeso), function (index, value) {
                    if (value.nomeTipoPeso === data.nomeTipoPeso) {
                        $('#tipoDePeso').append('<option value=' + value.id + ' selected>' + value.nomeTipoPeso + '</option>');
                    } else {
                        $('#tipoDePeso').append('<option value=' + value.id + '>' + value.nomeTipoPeso + '</option>');
                    }
                });

                $.each(JSON.parse(data[6].tipoProduto), function (index, value) {
                    if (value.nomeTipoProduto === data.nomeTipoProduto) {
                        $('#tipoDeProduto').append('<option value=' + value.id + ' selected>' + value.nomeTipoProduto + '</option>');
                    } else {
                        $('#tipoDeProduto').append('<option value=' + value.id + '>' + value.nomeTipoProduto + '</option>');
                    }
                });
            }
        });

//Alteração nos dados do modal para indicar que é a atualização do produto
        $('#tituloModal').html('Atualizar Produto');
        $('#buttonSubmit').val('Atualizar');
        $('#modalProduto').modal('show');
    });

//Função que trabalha com a visualização dos dados de um produto selecionado
    $('.button-visualizar').on("click", function () {
        var buttonId = $(this).val();
        $.ajax({
            url: 'verificacao.php',
            method: 'post',
            data: {
                id: buttonId,
                acao: 'getById'
            },
            dataType: 'json',
            success: function (data) {
                $('#nomeProduto').html(data.nomeProduto);
                $('#tipoProduto').html(data.nomeTipoProduto);
                $('#marcaProduto').html(data.marca);
                $('#pesoProduto').html(data.peso + " " + data.nomeTipoPeso);
            }
        });
        $('#modalVisualizar').modal('show');
    });

//Função que trabalha com a exclusão de um produto
    $('.button-deletar').on('click', function () {
        var buttonId = $(this).val();

//Requisição dos dados do produto para exibi-los no modal
        $.ajax({
            url: 'verificacao.php',
            method: 'post',
            data: {
                id: buttonId,
                acao: 'getById'
            },
            dataType: 'json',
            success: function (data) {
                $('#nomeProdutoDel').html(data.nomeProduto);
                $('#idProdutoDel').val(data.id);
            }
        });

//Modal que aparece pedindo a confirmação da exclusão
        $('#delProduto').modal('show');
    });

//Função que identifica a confirmação da exclusão de um produto
    $('#buttonConfirmar').on('click', function () {
        $.ajax({
            url: 'verificacao.php',
            method: 'post',
            data: {
                id: $('#idProdutoDel').val(),
                acao: 'excluir'
            },
            success: function () {
                location.reload();
            }
        });
    });
});
