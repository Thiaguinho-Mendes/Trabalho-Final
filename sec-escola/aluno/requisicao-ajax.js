$(document).ready(function() {
    
//Requisita os dados do aluno, atribui ao modal e o dispara ao clicar no botão de visualizar aluno
    $('.visualizar-aluno').on('click', function () {
        var idAluno = $(this).val();

        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                idAluno: idAluno,
                acao: 'getById'
            },
            dataType: 'json',
            success: function (data) {
                $('#nomeAluno').html(data.nomeAluno);
                
                if(data.nomeEscola === undefined){
                    $('#escolaAluno').html("---");
                } else {
                    $('#escolaAluno').html(data.nomeEscola);
                }
                
                $('#anoEscolarAluno').html(data.nomeAnoEscolar);
                $('#nascimentoAluno').html(data.dataDeNascimento);
            }
        });

        $('#modalVisualizar').modal('show');
    });
    
    
//Requisita os dados do aluno, atribui ao modal e o dispara ao clicar no botão de Excluir aluno
    $('.excluir-aluno').on('click', function () {
        var idAluno = $(this).val();

        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                idAluno: idAluno,
                acao: 'getDataAluno'
            },
            dataType: 'json',
            success: function (data) {
                $('#nomeExcluir').html(data.nomeAluno);
                $('#idAluno').val(data.id);
            }
        });

        $('#modalExcluir').modal('show');
    });
//Identifica se o usuário confirma a exclusão de um aluno e submete a ação ao banco de dados
    $('#excluir').on('click', function () {
        var idAluno = $('#idAluno').val();
        $.ajax({
            method: 'post',
            url: 'verificacao.php',
            data: {
                idAluno: idAluno,
                acao: 'excluir'
            },
            success: function () {
                location.reload();
            }
        });
    });
});
