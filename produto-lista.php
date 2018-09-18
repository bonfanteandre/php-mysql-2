<?php 

require_once("cabecalho.php");
require_once("logica-usuario.php");

verificaUsuarioLogado();
?>

<?php
	if (isset($_SESSION["success"])) :
?>
	<p class="alert-success"><?=$_SESSION["success"]?></p>
<?php endif ?>

	<table class="table table-striped table-bordered">
<?php

	$produtoDao = new ProdutoDao($conexao);
	$produtos = $produtoDao->listarProdutos();

	foreach ($produtos as $produto) :
?>
		<tr>
			<td><?=$produto->getNome() ?></td>
			<td><?=$produto->getPreco() ?></td>
			<td><?=$produto->precoComDesconto(0.5)?></td>
			<td><?=$produto->calculaImposto()?></td>
			<td><?=substr($produto->getDescricao(), 0, 40)?></td>
			<td><?=$produto->getCategoria()->getNome() ?></td>
			<td><?php if ($produto->temIsbn()) { echo $produto->getIsbn(); }?></td>
			<td>
				<a href="produto-altera-formulario.php?id=<?=$produto->getId()?>" class="btn btn-primary">
				Alterar</a>
			</td>
			<td>
				<form action="remove-produto.php" method="POST">
					<input type="hidden" name="id" value="<?=$produto->getId()?>">
					<button class="btn btn-danger" type="submit">Remover</button>
				</form>
			</td>
		</tr>
<?php endforeach ?>
	</table>
<?php include("rodape.php") ?>