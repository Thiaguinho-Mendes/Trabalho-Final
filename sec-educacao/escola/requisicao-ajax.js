$(document).ready(function () {
//Função responsavel por disparar o modal com as informações da escola
    $('.visualizar-escola').on('click', function () {
        var idEscola = $(this).val();

        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                idEscola: idEscola,
                acao: 'visualizar'
            },
            dataType: 'json',
            success: function (data) {
                $('#nomeEscola').html(data.nomeEscola);
                $('#endereco').html(data.endereco);
                $('#numero').html(data.numero);
                $('#cnpj').html(data.cnpj);
                $('#email').html(data.email);
                $('#telefone').html(data.telefone);
                $('#infantil').html(data.alunosEnsInfantil);
                $('#fundamental').html(data.alunosEnsFundamental);
                $.each(data[9], function (index, secretario) {
                    if (secretario.cargo === "Diretor") {
                        $('#diretor').html(secretario.nome);
                    } else if (secretario.cargo === "Secretario") {
                        $('#secretarios').append('<div class="secretario">' + secretario.nome + '</div>');
                    }
                });
            }
        });

        $('#modalVisualizar').modal('show');
    });

//Função retira os dados colocados no modal apos ele ser fechado
    $('#modalVisualizar').on('hide.bs.modal', function () {
        $('span').empty();
        $('span').remove('.secretario');
    });

//Função informa um modal com a confirmação de exclusão de uma escola selecionada
    $('.excluir-escola').on('click', function () {
        var idEscola = $(this).val();

        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                idEscola: idEscola,
                acao: 'getDataEscola'
            },
            dataType: 'json',
            success: function (data) {
                $('#nomeExcluir').html(data.nomeEscola);
                $('#idEscola').val(data.id);
            }
        });
 
        $('#modalExcluir').modal('show');
    });
//Função que identifica se o botão de confirmação de exclusão foi apertado, excluindo em seguida os dados no banco
    $('#excluirEscola').on('click', function () {
        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                idEscola: $('#idEscola').val(),
                acao: 'excluir'
            },
            success: function () {
                location.reload();
            }
        });
    });
});

