<?php
require_once '../../conexao.php';
require_once '../../login/funcoesdelogin.php';
require_once '../../funcoes-de-cabecalho.php';

autenticar('../../index.php');

    cabecalhoAluno('../../estilo/style.css', 'Escola', '../escola/', '../cardapio/calendario.php','../../login/logOut.php');
    sectionTop();

//Seleção dos dados da escola selecionada no index
    $selectEscola = "select Escola.nomeEscola, "
                . "Escola.endereco, "
                . "Escola.cnpj, "
                . "Escola.email, "
                . "Escola.numero, "
                . "Escola.telefone from Escola where id=".$_SESSION['escola_id'];
    $query = mysqli_query($conexao, $selectEscola);
    
    echo "<h3>Escola</h3>"
    . "<hr>";

    if (mysqli_num_rows($query) == 1) {

        $table = mysqli_fetch_array($query);
        $nome = $table['nomeEscola'];
        $endereco = $table['endereco'];
        $cnpj = $table['cnpj'];
        $email = $table['email'];
        $numero = $table['numero'];
        $telefone = $table['telefone'];
        
        $selectSecEsc = "select SecEsc.nomeSecEsc, SecEsc.cargo from SecEsc where SecEsc.escola_id = ".$_SESSION['escola_id'];
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
                . "<div class=' mt-3 border-bottom subTitulos'>Secretários</div>";
                    if(!empty($diretor)){
                        echo "<div>Diretor: <span>$diretor</span></div>";
                    } else {
                        echo "<div>Diretor: <span>---</span></div>";
                    }

             echo "<div>Secretários: ";
                    if(!empty($secretarios)){
                        foreach ($secretarios as $secretario) {
                            echo "<span>".$secretario['nome']."</span>";
                        }
                    } else {
                        echo "<span>---</span>";
                    }
                echo "</div>"
            . "</div>";
         
    } else {
        echo "<h3 class='font-weight-normal'> Nenhuma Escola alocada a este Aluno</h3>";
    }
    
sectionBaixo();
rodape();
