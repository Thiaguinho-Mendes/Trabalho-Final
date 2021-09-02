<?php
require_once '../../conexao.php';
require_once '../../funcoes-de-cabecalho.php';
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

$_SESSION['id_anoEscolar'] = $_GET['id'];

    cabecalhoNutricionista('../../estilo/style.css', 'Cardápio', '../escola/', '../relatorio/', '../produto/', '../refeicao/', 'index.php','../../login/logOut.php');
    
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
        
        <!-- Modal De cadastro...-->
        <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Refeição</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
        <!--Formulario-->
                        <form id="adicionarRefeicao" class="m-0 mt-3" method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Refeição</label>
                                <div class="col-sm-10">
                                    <?php 
//metodo que pega os dados da classe Refeição e os exibe em um select HTML
                            $select = "select * from Refeicao";
                            $query = mysqli_query($conexao, $select);
                            echo "<select name='refeicoes' class='custom-select'>";
                            while ($tbl = mysqli_fetch_array($query)) {
                                $idEscola = $tbl['id'];
                                $refeicao = $tbl['nome'];

                                echo "<option value='" . $idEscola . "'>" . $refeicao . "</option>";
                            }
                            echo "</select>";
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Data</label>
                        <div class="col-sm-10">
                            <input type="text" name="start" class="form-control" id="start" readonly=“true”>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm">
                            <button type="submit" class="btn btn-dark" name="cadastrar" id="cadastrar">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal Delete-->
<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <input type="hidden" id="idRefExcluir">
                <button class='btn btn-danger mt-2' id="buttonExcluir">Excluir</button>
            </div>
        </div>
    </div>
</div>

<?php
rodape();
