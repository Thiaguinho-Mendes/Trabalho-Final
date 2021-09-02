//criação do calendario por meio de uma instancia
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'pt-br',
                    plugins: ['interaction', 'dayGrid'],
                    eventLimit: true,
//Método que pega os dados do banco e os exibe no calendário
                    eventSources: [{
//a pagina que pega os dados e o retorna em JSON
                        url: 'listar_refeicoes.php',
                        color: '#2C3E50',
                        textColor: 'white',
//função que evita problemas de cache
                        extraParams: function() {
                            return {
                                cachebuster: new Date().valueOf()
                            };
                        }
                    }],
//função que exibe um formulário de cadastro em um modal caso clique em algum dia no calendário
                    selectable: true,
                    select: function (info) {
                        var data = info.start.toLocaleString();
                        data = data.slice(0, 10);
                        $('#cadastrar #start').val(data);
                        $('#cadastrar').modal('show');
                    },
                    eventClick: function (info) {
                        $('#ref').html(info.event.title);
                        $('#idRefExcluir').val(info.event.id);
                        
                        $('#excluir').modal('show');
                    }
                });

                calendar.render();
               
//Função que pega os dados do formulário de cadastro e os submete ao banco de dados
                $(document).ready(function () {
                    $('#adicionarRefeicao').on("submit", function (event) {
                        event.preventDefault();
//função ajax que manda os dados a pagina de verificação
                        $.ajax({
                            method: "post",
                            url: "cadastrar-refeicao.php",
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
//função que retorna o reload da página caso dê sucesso ou mensagem de Erro caso dê erro.
                            success: function(retorna){
                                if(retorna['sit']){
                                    location.reload();
                                }else {
                                    $('#msg-cadastro').html(retorna['msg']);
                                }
                            }
                        });
                    });
//Função responsavel pela confirmação da exclusão de uma refeição
                    $('#buttonExcluir').on('click', function () {
                        $.ajax({
                            method: 'post',
                            url: 'excluir-refeicao.php',
                            data: {
                                id: $('#idRefExcluir').val()
                            },
                            success: function () {
                                location.reload();
                            }
                        });
                    });
                });
            });
