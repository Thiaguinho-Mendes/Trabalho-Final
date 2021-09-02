<?php
require_once '../../conexao.php';

$idEscola = $_POST['id'];

$delete = "delete from Cardapio_Refeicao where id=$idEscola";
$query = mysqli_query($conexao, $delete);

