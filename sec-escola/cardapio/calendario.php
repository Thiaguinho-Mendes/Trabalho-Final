<?php
require_once '../../conexao.php';
require_once '../../login/funcoesdelogin.php';
require_once '../../funcoes-de-cabecalho.php';

autenticar('../../index.php');

    $_SESSION['id_anoEscolar'] = $_GET['id'];

    cabecalhoSecEsc('../../estilo/style.css', 'Cardápio', '../aluno/', '../escola/', '../estoque/', 'index.php','../../login/logOut.php');

?>

<!--FullCalendar Links -->
<link href='../../FullCalendar/css/core/main.min.css' rel='stylesheet' />
<link href='../../FullCalendar/css/daygrid/main.min.css' rel='stylesheet' />
<script src='../../FullCalendar/js/core/main.min.js'></script>
<script src='../../FullCalendar/js/interaction/main.min.js'></script>
<script src='../../FullCalendar/js/daygrid/main.min.js'></script>
<script src='../../FullCalendar/js/core/locales/pt-br.js'></script>

<!--Página que possui os estilos do calendario-->
<link href="../../estilo/fullCalendarEstilo.css" rel="stylesheet" />

<!--Página que possui os codigos Js de criação do FullCalendar-->
<script src="calendario.js"></script>

        <div id='calendar'></div>
      
<!--Modal Visualizar uma Refeição do cardápio-->
<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Refeição do Cardapio</h5>
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
