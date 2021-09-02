<?php
require_once '../../conexao.php';

if (!empty($_POST['acao'])) {
    $acao = $_POST['acao'];

//Requisição dos dados da Escola/Secretarios por meio do Id da escola
    if ($acao == "visualizar") {
        $idEscola = $_POST['idEscola'];

        $selectEscola = "select * from Escola where id=$idEscola";
        $selectSecEsc = "select SecEsc.id, SecEsc.nomeSecEsc, SecEsc.cargo from SecEsc where SecEsc.escola_id = $idEscola";

        $queryEscola = mysqli_query($conexao, $selectEscola);
        $querySecEsc = mysqli_query($conexao, $selectSecEsc);

        $tableEscola = mysqli_fetch_array($queryEscola);

        $secretarios = [];

        while ($tableSecEsc = mysqli_fetch_array($querySecEsc)) {
            $nomeSecEsc = $tableSecEsc['nomeSecEsc'];
            $cargo = $tableSecEsc['cargo'];

            if ($cargo == "Diretor") {
                $secretarios[] = [
                    "nome" => $nomeSecEsc,
                    "cargo" => "Diretor"
                ];
            } else if ($cargo == "Secretario") {
                $secretarios[] = [
                    "nome" => $nomeSecEsc,
                    "cargo" => "Secretario"
                ];
            }
        }

        array_push($tableEscola, $secretarios);

        echo json_encode($tableEscola);
    }
}

