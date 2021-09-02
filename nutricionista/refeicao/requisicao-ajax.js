$(document).ready(function () {
//Função responsavel pelo cadastro de Refeicões
    $('#button-cadastro').click(function (event) {
        event.preventDefault();

        $('#modalCadUp').html('Cadastrar Refeição');
        $('#buttonSubmit').val('Cadastrar');
        $('#divModal').modal('show');
    });

//Função responsavel pela atualização de Refeições
    $('.button-atualizar').on("click", function () {
        var buttonId = $(this).val();

        $.ajax({
            url: 'gerenciar-refeicao.php',
            method: 'post',
            data: {
                id: buttonId,
                acao: 'getById'
            },
            dataType: 'json',
            success: function (data) {
                $('#nome').val(data.nome);
                $('#idRefeicaoUp').val(data.id);
            }
        });

        $('#modalCadUp').html('Atualizar Refeição');
        $('#buttonSubmit').val('Atualizar');
        $('#divModal').modal('show');
    });

//Função que limpa todos os campos dos inputs toda vez que o modal de cadastro/atualização é fechado
    $('#divModal').on('hide.bs.modal', function () {
        $('#formulario input').val("");
        $('#buttonSubmit').val("");
    });
    
//Condição que indica se os dados devem ser atualizados ou cadastrados.
    $('#buttonSubmit').on('click', function () {
        if ($(this).val() === "Cadastrar") {
            $('#formulario').submit(function () {

                $.ajax({
                    method: 'post',
                    url: 'gerenciar-refeicao.php',
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
            $('#formulario').on("submit", function (event) {
                event.preventDefault();

                $.ajax({
                    method: 'post',
                    url: 'gerenciar-refeicao.php',
                    data: {
                        id: $('#idRefeicaoUp').val(),
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
//função que lida com a exclusão de uma refeição
    $('.button-excluir').on('click', function () {
        var buttonId = $(this).val();

        $.ajax({
            url: 'gerenciar-refeicao.php',
            method: 'post',
            data: {
                id: buttonId,
                acao: 'getById'
            },
            dataType: 'json',
            success: function (data) {
                $('#nomeRefDel').html(data.nome);
                $('#idExcluir').val(data.id);
            }
        });
        $('#delRef').modal('show');
    });
    $('#buttonConfirmar').on('click', function () {
        $.ajax({
            url: 'gerenciar-refeicao.php',
            method: 'post',
            data: {
                id: $('#idExcluir').val(),
                acao: 'excluir'
            },
            success: function () {
                location.reload();
            }
        });
    });
});