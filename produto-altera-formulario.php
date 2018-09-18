<?php 
require_once("cabecalho.php");

$categoriaDao = new CategoriaDao($conexao);
$categorias = $categoriaDao->listaCategorias();

$produto_id = $_GET['id'];

$produtoDao = new ProdutoDao($conexao);
$produto = $produtoDao->buscaProduto($produto_id);

$usado = $produto->isUsado() ? "checked='checked'" : "";
?>
		<h1>Alteração de produto</h1>
		<div class="col-sm-6 col-sm-offset-3">
			<form action="altera-produto.php" method="POST">
				<div>
					<input type="hidden" name="id" value="<?=$produto->getId()?>">
				</div>
				<?php include("produto-formulario-base.php"); ?>
				<input type="submit" name="Alterar" class="btn btn-success">
			</form>
		</div>
<?php include("rodape.php") ?>