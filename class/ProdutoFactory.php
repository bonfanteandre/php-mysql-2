<?php 

class ProdutoFactory {

	private $classes = array("LivroFisico", "Ebook");

	public function criarPor($tipoProduto, $params) {

		$nome = $params['nome'];
		$descricao = $params['descricao'];
		$preco = $params['preco'];
		$usado = $params['usado'];
		$categoria = new Categoria(); 

		if (in_array($tipoProduto, $this->classes)) {
			return new $tipoProduto($nome, $preco, $descricao, $usado, $categoria);
		}

		return new LivroFisico($nome, $preco, $descricao, $usado, $categoria);
	}

}