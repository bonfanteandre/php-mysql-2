<?php 
include("cabecalho.php");
require_once("logica-usuario.php"); 
?>
<?php if (isset($_GET['login']) && $_GET['login'] == false) { ?>
	<p class="alert-danger">Usuário ou senha inválidos.</p>
<?php } ?> 
			<h1>Bem-vindo</h1>
			<?php if (usuarioEstaLogado()) { ?>
				<p class="text-success">Você está logado como <?=usuarioLogado()?></p>
				<a href="logout.php">Sair</a>
			<?php } else { ?>
			<h2>Login</h2>
			<div class="col-sm-offset-3 col-sm-6">
				<form action="login.php" method="POST">
				<div class="form-group">
					<label class="control-label">E-mail</label>
					<input class="form-control" type="email" name="email">
				</div>
				<div class="form-group">
					<label class="control-label">Senha</label>
					<input class="form-control" type="password" name="senha">
				</div>
				<button class="btn btn-primary pull-right" type="submit">Entrar</button>	
			</form>
			</div>
			<?php } ?>
<?php include("rodape.php") ?>