<?php

require_once("cabecalho.php");

//Pega os parametros que vieram via POST
$tipoProduto = $_POST['tipoProduto'];
$categoria = $_POST['categoria_id'];

$produtoFactory = new ProdutoFactory();
$produto = $produtoFactory->criarPor($tipoProduto, $_POST);
$produto->setId($_POST['id']);
$produto->atualizaBaseadoEm($_POST);
$produto->getCategoria()->setId($categoria);

if (array_key_exists('usado', $_POST)) {
	$produto->setUsado("true");
} else {
	$produto->setUsado("false");
}

$produtoDao = new ProdutoDao($conexao);

if ($produtoDao->alteraProduto($produto)) { ?>

	<p class="text-success">Produto <?=$produto->getNome()?> alterado com sucesso!</p>

<?php } else { 
	$msgErro = mysqli_error($conexao);
?>
	<p class="text-danger">O produto não foi adicionado. <?=$msgErro?> </p>
<?php }

//Teoricamente nao precisa fechar manualmente, pois o php fecha a conexao sozinho ao termina do processamento
mysqli_close($conexao);
?>
<?php include("rodape.php") ?>