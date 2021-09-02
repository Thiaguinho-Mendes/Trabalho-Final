$(document).ready(function () {

//Identifica se o usuário aperta o button de visualizar
    $('.visualizar-nutricionista').on('click', function () {
        var idNutricionista = $(this).val();

//Requisição dos dados do Nutricionista 
        $.ajax({
            method: 'post',
            url: 'nutricionista/verificacao.php',
            data: {
                idNutricionista: idNutricionista,
                acao: 'getById'
            },
            dataType: 'json',
            success: function (data) {
                $('#nomeNut').html(data.nome);
                $('#cpfNut').html(data.cpf);
                $('#rgNut').html(data.rg);
                $('#enderecoNut').html(data.endereco);
                $('#numeroNut').html(data.numero);
                $('#emailNut').html(data.email);
                $('#nascimentoNut').html(data.dataDeNascimento);
                $('#celularNut').html(data.celular);
            }
        });

//Invocação do modal de visualização do Nutricionista
        $('#modalVisualizarNut').modal('show');
    });

//Identifica se o usuário aperta o button de excluir
    $('.deletar-nutricionista').on('click', function () {
        var idNutricionista = $(this).val();
        $.ajax({
            method: 'post',
            url: 'nutricionista/verificacao.php',
            data: {
                idNutricionista: idNutricionista,
                acao: 'getDataNut'
            },
            dataType: 'json',
            success: function (data) {
//Atribuição do nome do usuário a ser excluido no modal de confimação  de exclusão
                $('#nomeExcluirNut').html(data.nome);
                $('#idNut').val(data.id);
            }
        });
//Exibição do modal de confirmação de exclusão
        $('#modalExcluirNut').modal('show');
    });
    
    $('#excluirNutricionista').on('click', function () {
        var idNutricionista = $('#idNut').val();
        $.ajax({
            method: 'post',
            url: 'nutricionista/verificacao.php',
            data: {
                idNutricionista: idNutricionista,
                acao: 'excluir'
            },
            success: function () {
                location.reload();
            }
        });
    });

});
