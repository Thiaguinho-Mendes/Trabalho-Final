<?php
require_once '../../conexao.php';
require_once '../../funcoes-de-cabecalho.php';
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

    $_SESSION['id_anoEscolar'] = $_GET['id'];

    cabecalhoSecEdu('../../estilo/style.css', 'Cardápio', '../escola/', '../usuarios/cadastrar-usuarios.php', '../produto/', '../refeicao/', 'index.php','../../login/logOut.php');
    
?>
<!--FullCalendar Links -->
<link href='../../FullCalendar/css/core/main.min.css' rel='stylesheet' />
<link href='../../FullCalendar/css/daygrid/main.min.css' rel='stylesheet' />
<script src='../../FullCalendar/js/core/main.min.js'></script>
<script src='../../FullCalendar/js/interaction/main.min.js'></script>
<script src='../../FullCalendar/js/daygrid/main.min.js'></script>
<script src='../../FullCalendar/js/core/locales/pt-br.js'></script>

<!--bootstrap links-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!--Página que possui os estilos do calendario-->
<link href="../../estilo/fullCalendarEstilo.css" rel="stylesheet" />

<!--Página que possui os codigos Js de criação do FullCalendar-->
<script src="calendario.js"></script>

        <div id='calendar'></div>
        
<!--Modal Visualizar-->
<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modalCardapio" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Refeição do Cardapio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modalInfo">
                <div class="my-2">Refeição: <span id='ref' class="border-bottom"></span></div>
            </div>
        </div>
    </div>
</div>        
<?php
rodape();