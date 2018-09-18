<?php 
require_once("cabecalho.php");
require_once("logica-usuario.php");

verificaUsuarioLogado();

$categoria = new Categoria();
$categoria->setId(1);

$produto = new LivroFisico("", 0, "", "false", $categoria);

$usado = "";

$categoriaDao = new CategoriaDao($conexao);
$categorias = $categoriaDao->listaCategorias(); 
?>
		<h1>Formulário de produto</h1>
		<div class="col-sm-6 col-sm-offset-3">
			<form action="adiciona-produto.php" method="POST">
				<?php include("produto-formulario-base.php"); ?>
				<input type="submit" name="Cadastrar" class="btn btn-success">
			</form>
		</div>
<?php include("rodape.php") ?>