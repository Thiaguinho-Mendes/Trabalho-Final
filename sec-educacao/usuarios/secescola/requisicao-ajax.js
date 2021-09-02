$(document).ready(function () {

//Requisição dos dados do Secretário selecionado, atribuição destes dados e disparo do modal.
    $('.visualizar-secEsc').on('click', function () {
        var secEscId = $(this).val();

        $.ajax({
            method: 'post',
            url: 'secescola/verificacao.php',
            data: {
                idSecEsc: secEscId,
                acao: 'getById'
            },
            dataType: 'json',
            success: function (data) {
                $('#nomeSecEsc').html(data.nomeSecEsc);
                
                if(data.nomeEscola === undefined){
                    $('#escolaSecEsc').html("---");
                } else {
                    $('#escolaSecEsc').html(data.nomeEscola);
                }
                
                if (data.cargo === 'Diretor') {
                    $('#cargoSecEsc').html('Diretor');
                } else if (data.cargo === 'Secretario') {
                    $('#cargoSecEsc').html('Secretário');
                }
                
                $('#cpfSecEsc').html(data.cpf);
                $('#rgSecEsc').html(data.rg);
                $('#enderecoSecEsc').html(data.endereco);
                $('#numeroSecEsc').html(data.numero);
                $('#emailSecEsc').html(data.email);
                $('#nascimentoSecEsc').html(data.dataDeNascimento);
                $('#celularSecEsc').html(data.celular);
            }
        });

        $('#modalVisualizarSecEsc').modal('show');
    });

//Função retira os dados colocados no modal apos ele ser fechado
    $('.modal').on('hide.bs.modal', function () {
        $('span').empty();
    });

//Requisição dos dados do Secretário selecionado, atribuição destes dados e disparo do modal referente a exclusão deste usuário.
    $('.excluir-secEsc').on('click', function () {
        var idSecEsc = $(this).val();

        $.ajax({
            method: 'post',
            url: 'secescola/verificacao.php',
            data: {
                idSecEsc: idSecEsc,
                acao: 'getDataSecEsc'
            },
            dataType: 'json',
            success: function (data) {
                $('#nomeExcluirSecEsc').html(data.nomeSecEsc);
                $('#idSecEsc').val(data.id);
            }
        });

        $('#modalExcluirSecEsc').modal('show');
    });
    
//Submissão da exclusão de um Secretário caso a confirmação seja clicada
    $('#excluirSecEsc').on('click', function () {
        var idSecEsc = $('#idSecEsc').val();
        $.ajax({
            method: 'post',
            url: 'secescola/verificacao.php',
            data: {
                idSecEsc: idSecEsc,
                acao: 'excluir'
            },
            success: function () {
                location.reload();
            }
        });
    });

});