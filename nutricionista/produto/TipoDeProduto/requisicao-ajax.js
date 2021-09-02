$(document).ready(function () {
    $('#button-cadastro').click(function (event) {
        event.preventDefault();

        $('#tituloModal').html('Cadastrar Tipo de Produto');
        $('#buttonSubmit').val('Cadastrar');
        $('#modalTipoProduto').modal('show');
    });

    $('.button-atualizar').on("click", function () {
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
                $('#nome').val(data.nomeTipoProduto);
                $('#idTipoProdutoUp').val(data.id);
            }
        });

        $('#tituloModal').html('Atualizar Tipo de Produto');
        $('#buttonSubmit').val('Atualizar');
        $('#modalTipoProduto').modal('show');
    });

//Função que limpa todos os campos dos inputs toda vez que o modal de cadastro/atualização é fechado
    $('#modalTipoProduto').on('hide.bs.modal', function () {
        $('#formulario input').val("");
        $('#buttonSubmit').val("");
    });

//função que indentifica se o formulário é de Cadastro ou Atualização com base no Button clicado
    $('#buttonSubmit').on('click', function () {
        if ($(this).val() === "Cadastrar") {
//Função que lida com a submissão dos dados colocados no formulario de cadastro
            $('#formulario').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    method: 'post',
                    url: 'verificacao.php',
                    data: {
                        nome: $('input[name=nome]').val(),
                        acao: 'cadastrar'
                    },
                    success: function () {
                        location.reload();
                    }
                });
            });
        } else if ($(this).val() === "Atualizar") {
//Função que lida com a submissão dos dados colocados no formulario de Atualização
            $('#formulario').on("submit", function (event) {
                event.preventDefault();

                $.ajax({
                    method: 'post',
                    url: 'verificacao.php',
                    data: {
                        id: $('#idTipoProdutoUp').val(),
                        nome: $('input[name=nome]').val(),
                        acao: 'atualizar'
                    },
                    success: function () {
                        location.reload();
                    }
                });
            });
        }
    });

    $('.button-deletar').on('click', function () {
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
                $('#nomeTipoDeProdutoDel').html(data.nomeTipoProduto);
                $('#idTipoProdutoDel').val(data.id);
            }
        });
        $('#delTipoProduto').modal('show');
    });
    $('#buttonConfirmar').on('click', function () {
        $.ajax({
            url: 'verificacao.php',
            method: 'post',
            data: {
                id: $('#idTipoProdutoDel').val(),
                acao: 'excluir'
            },
            success: function () {
                location.reload();
            }
        });
    });
});
