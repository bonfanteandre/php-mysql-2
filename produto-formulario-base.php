<div class="form-group">
	<label class="control-label">Nome:</label>
	<input type="text" name="nome" class="form-control" placeholder="Insira o nome do produto..." value="<?=$produto->getNome()?>">
</div>
<div class="form-group">
	<label class="control-label">Preço:</label>
	<input type="number" name="preco" class="form-control" value="<?=$produto->getPreco()?>"><br>
</div>
<div class="form-group">
	<label class="control-label">Descrição</label>
	<textarea class="form-control" name="descricao">
		<?=$produto->getDescricao()?>
	</textarea>
</div>
<div>
	<input type="checkbox" name="usado" value="true" <?=$usado?>>&nbsp;Usado
</div>
<div class="form-group">
	<select class="form-control" name="categoria_id">
		<?php foreach($categorias as $c): 
			$selected = $c->getId() === $produto->getCategoria()->getId() ? "selected='selected'" : "";
		?>
			<option value="<?=$c->getId()?>" <?=$selected?> >
				<?=$c->getNome()?>
			</option>
	<?php endforeach ?> 
	</select>
</div>
<div class="form-group">
	<select class="form-control" name="tipoProduto">
		<?php 

		$tipos = array("Livro Fisico", "Ebook");

		foreach($tipos as $t): 
			
			$tipoSemEspaco = str_replace(' ', '', $t);			
			$selected = get_class($produto) == $t ? "selected='selected'" : "";
		?>	
			<option value="<?=$tipoSemEspaco?>" <?=$selected?> >
				<?=$t?>
			</option>
	<?php endforeach ?> 
	</select>
</div>
<div class="form-group">
	<label class="control-label">ISBN:</label>
	<input type="text" name="isbn" class="form-control" placeholder="Insira o ISBN..." 
	value="<?php if ($produto->temIsbn()) { echo $produto->getIsbn(); }?>">
</div>
<div class="form-group">
	<label class="control-label">Taxa impressao:</label>
	<input type="text" name="taxa_impressao" class="form-control" placeholder="Insira a taxa de impressão..." 
	value="<?php if ($produto->temTaxaImpressao()) { echo $produto->getTaxaImpressao(); }?>">
</div>
<div class="form-group">
	<label class="control-label">Water Mark:</label>
	<input type="text" name="water_mark" class="form-control" placeholder="Insira o water mark..." 
	value="<?php if ($produto->temWaterMark()) { echo $produto->getWaterMark(); }?>">
</div>