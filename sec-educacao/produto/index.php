<?php
require_once '../../funcoes-de-cabecalho.php';
require_once '../../conexao.php';
require_once '../../login/funcoesdelogin.php';

autenticar('../../index.php');

cabecalhoSecEdu('../../estilo/style.css', 'Usuarios', '../escola/', '../usuarios/cadastrar-usuarios.php', '../produto/', '../refeicao/', '../cardapio/', '../../login/logOut.php');

$select = "select Produto.nomeProduto, Produto.marca, Produto.peso, TipoDeProduto.nomeTipoProduto, TipoDePeso.nomeTipoPeso from Produto "
        . "inner join TipoDeProduto on Produto.tipoDeProduto_id = TipoDeProduto.id "
        . "inner join TipoDePeso on Produto.tipoDePeso_id = TipoDePeso.id";
$query = mysqli_query($conexao, $select);
sectionTop();
?>
<table class="table">
    <thead class="thead-dark">
        <th scope="col">Nome</th>
        <th scope="col">Tipo</th>
        <th scope="col">Marca</th>
        <th scope="col">Peso</th>
    </thead>
<tbody>
<?php
while($table = mysqli_fetch_array($query)){
    $nomeProduto = $table['nomeProduto'];
    $marcaProduto = $table['marca'];
    $pesoProduto = $table['peso'];
    $tipoPeso = $table['nomeTipoPeso'];
    $tipoProduto = $table['nomeTipoProduto'];
    
    echo "<tr>"
        . "<td>$nomeProduto</td>"
        . "<td>$tipoProduto</td>"
        . "<td>$marcaProduto</td>"
        . "<td>$pesoProduto $tipoPeso</td>"
        . "</tr>";
}
?>
</tbody>
</table>
<?php 
sectionBaixo();
rodape();
