<?php
    require_once '../../conexao.php';
    require_once '../../funcoes-de-cabecalho.php';
    require_once '../../login/funcoesdelogin.php';

    autenticar('../../index.php');
    
cabecalhoSecEsc('../../estilo/style.css', 'Estoque', '../aluno/', '../escola/', '.', '../cardapio/', '../../login/logOut.php');
sectionTop();

//Requisição dos dados do estoque ao Banco de Dados
    $selectEstoque = "select Estoque.estoque_id, Produto.id, Produto.nomeProduto, TipoDeProduto.nomeTipoProduto, Produto.marca, Produto.peso, TipoDePeso.nomeTipoPeso, Estoque.quantidade from Estoque " 
                    ."inner join Produto on Estoque.produto_id = Produto.id "
                    ."inner join TipoDePeso on Produto.tipoDePeso_id = TipoDePeso.id "
                    ."inner join TipoDeProduto on Produto.tipoDeProduto_id = TipoDeProduto.id "
                    ."where escola_id =".$_SESSION["idEscola"]." and status = 1";
    $queryEstoque = mysqli_query($conexao, $selectEstoque);
    
//Identificação que caso não exista itens no estoque exiba outra informação
    if(mysqli_num_rows($queryEstoque) == 0){
        
        echo "<h3>Estoque</h3>"
           . "<hr>"
           . "<div class='font-weight-normal my-3'>Nenhum produto alocado</div>";
        
    } else {
        
        echo "<table class='table'>"
            . "<thead class='thead-dark'>"
            . "<tr>"
                    . "<th scope='col'>Nome</th>"
                    . "<th scope='col'>Tipo</th>"
                    . "<th scope='col'>Marca</th>"
                    . "<th scope='col'>Peso</th>"
                    . "<th scope='col'>Quantidade</th>"
                    . "<th scope='col'></th>"
            . "</tr>"
            . "</thead>"
            . "<tbody>";
//Imprimir os dados dinamicamente em tabelas do estoque 
      while($table = mysqli_fetch_array($queryEstoque)){
          $idEstoque = $table['estoque_id'];
          $idProduto = $table['id'];
          $nomeProduto = $table['nomeProduto'];
          $nomeTipoProduto = $table['nomeTipoProduto'];
          $marca = $table['marca'];
          $peso = $table['peso'];
          $nomeTipoPeso = $table['nomeTipoPeso'];
          $quantidade = $table['quantidade'];

          echo "<tr>"
             . "<td>$nomeProduto</td>"
             . "<td>$nomeTipoProduto</td>"
             . "<td>$marca</td>"
             . "<td>$peso $nomeTipoPeso</td>"
             . "<td>$quantidade</td>"
             . "<td><button class='btn btn-light reduzir-produto' value='$idEstoque'><img src='../../estilo/icones/reduce.png' width='25px'/></button></td>"
             . "</tr>";
      }

      echo "</tbody>"
      . "</table>";  
    }
    
sectionBaixo();

?>
<script src="requisicao-ajax.js"></script>

<!--Modal reduzir produto-->
<div class="modal fade" id="modalReduzir" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitulo"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modalInfo">
          <form id="formReduzir" class="my-0" method="post">
                <label class='pt-2'>Quantidade</label>
                <input type="number" class="form-control" min="0" name="quant">
                <input type="hidden" id="idEstoque">
              <button type="submit" id="buttonReduzir" class="btn btn-dark mt-3">Reduzir</button>
          </form>
      </div>
    </div>
  </div>
</div>

<?php
rodape();
