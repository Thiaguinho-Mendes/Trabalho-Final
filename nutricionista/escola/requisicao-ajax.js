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
                        $('#secretarios').append('<div class="secretario ml-1">' + secretario.nome + '</div>');
                    }
                });
            }
        });

        $('#modalVisualizar').modal('show');
    });

//Função retira os dados colocados no modal apos ele ser fechado
    $('.modal').on('hide.bs.modal', function () {
        $('.secretario').remove();
    });
});