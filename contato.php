<?php require_once("cabecalho.php"); ?>
<div class="col-sm-6 col-sm-offset-3">
	<form action="envia-contato.php" method="POST">
		<div class="form-group">
			<label class="control-label">E-mail:</label>
			<input type="email" name="email" class="form-control">
		</div>
		<div class="form-group">
			<label class="control-label">Nome:</label>
			<input type="text" name="text" class="form-control">
		</div>
		<div class="form-group">
			<label class="control-label">Mensagem</label>
			<textarea name="mensagem" class="form-control"></textarea>
		</div>
		<button type="submit" class="btn btn-primary">Enviar</button>
	</form>
</div>
<?php require_once("rodape.php"); ?>