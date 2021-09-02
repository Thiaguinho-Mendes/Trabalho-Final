<?php
require_once '../../conexao.php';
require_once '../../login/funcoesdelogin.php';
require_once '../../funcoes-de-cabecalho.php';

autenticar('../../index.php');

cabecalhoSecEsc('../../estilo/style.css', 'Escola', '../aluno/', '.', '../estoque/', '../cardapio/', '../../login/logOut.php');
sectionTop();


//Seleção dos dados da escola selecionada no index
$query = mysqli_query($conexao, "select * from escola where id=" . $_SESSION['idEscola']);

    echo "<h3>Escola</h3>"
    . "<hr>";
//Identificação para caso exista uma escola cadastrada
    if (mysqli_num_rows($query) == 1) {

//Requisição e geração dos dados na escola e secretários nela atribuidos
        $table = mysqli_fetch_array($query);
        $nome = $table['nomeEscola'];
        $endereco = $table['endereco'];
        $cnpj = $table['cnpj'];
        $email = $table['email'];
        $numero = $table['numero'];
        $telefone = $table['telefone'];
        $alunosEnsInfantil = $table['alunosEnsInfantil'];
        $alunosEnsFundamental = $table['alunosEnsFundamental'];
        
        $selectSecEsc = "select SecEsc.nomeSecEsc, SecEsc.cargo from SecEsc where SecEsc.escola_id = ".$_SESSION['idEscola'];
        $querySecEsc = mysqli_query($conexao, $selectSecEsc);
        
        $secretarios = [];
        
        if($querySecEsc){
            while($tableSecEsc = mysqli_fetch_array($querySecEsc)){
                $nomeSecEsc = $tableSecEsc['nomeSecEsc'];
                $cargo = $tableSecEsc['cargo'];

                if($cargo == "Diretor"){
                    $diretor = $nomeSecEsc;
                } else {
                    $secretarios[] = [
                        "nome" => $nomeSecEsc
                    ];
                }
            }  
        }
        
        
         echo "<div id='escola' class='m-4'>"
                . "<div>Nome: <span>$nome</span></div>"
                . "<div>Endereço: <span>$endereco</span></div>"
                . "<div>Número: <span>$numero</span></div>"
                . "<div>CNPJ: <span>$cnpj</span></div>"
                . "<div>E-Mail: <span>$email</span></div>"
                . "<div>Telefone: <span>$telefone</span></div>"
                . "<div class=' mt-3 border-bottom subTitulos'>Numero de Alunos</div>"
                . "<div>Ensino Infantil: <span>$alunosEnsInfantil</span></div>"
                . "<div>Ensino Fundamental: <span>$alunosEnsFundamental</span></div>"
                 . "<div class=' mt-3 border-bottom subTitulos'>Diretor</div>";
                    if(!empty($diretor)){
                        echo "<div><span>$diretor</span></div>";
                    } else {
                        echo "<div><span>---</span></div>";
                    }

             echo "<div class=' mt-3 border-bottom subTitulos'>Secretários</div>";
                    if(!empty($secretarios)){
                        foreach ($secretarios as $secretario) {
                            echo "<div>".$secretario['nome']."</div>";
                        }
                    } else {
                        echo "<span>---</span>";
                    }
                echo "</div>"
            . "</div>";
         
    } else {
        echo "<h3 class='font-weight-normal'> Nenhuma Escola alocada a este secretário</h3>";
    }
    
sectionBaixo();
rodape();
