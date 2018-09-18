<?php 

class ProdutoDao {

	private $conexao;

	function __construct($conexao) {
		$this->conexao = $conexao;
	}

	function listarProdutos() {

		$produtos = array();
		
		$query = "SELECT p.*, c.nome as c_nome, c.id as c_id FROM produtos p 
				INNER JOIN categorias c ON c.id = p.categoria_id";
		
		$resultado = mysqli_query($this->conexao, $query);
		
		while ($produto_array = mysqli_fetch_assoc($resultado)) {

			$produto_id = $produto_array['id'];
			$tipoProduto = $produto_array['tipo_produto'];
			$categoria_id = $produto_array['c_id'];
			$categoria_nome = $produto_array['c_nome'];

			$produtoFactory = new ProdutoFactory();
			$produto = $produtoFactory->criarPor($tipoProduto, $produto_array);
			$produto->atualizaBaseadoEm($produto_array);
			$produto->setId($produto_id);
			$produto->getCategoria()->setId($categoria_id);
			$produto->getCategoria()->setNome($categoria_nome);

			array_push($produtos, $produto);
		}

		return $produtos;		
	}

	function insereProduto(Produto $produto) {

		$nome = mysqli_real_escape_string($this->conexao, $produto->getNome());
		$descricao = mysqli_real_escape_string($this->conexao, $produto->getDescricao());
		$preco = $produto->getPreco();
		$tipo_produto = get_class($produto);

		$isbn = "";
		if ($produto->temIsbn()) {
			$isbn = $produto->getIsbn();
		}

		$waterMark = "";
    	if($produto->temWaterMark()) {
        	$waterMark = $produto->getWaterMark();
    	}

    	$taxaImpressao = "";
    	if($produto->temTaxaImpressao()) {
        	$taxaImpressao = $produto->getTaxaImpressao();
    	}

		//Monta a query interpolando as variaveis
		$query = "INSERT INTO produtos (nome, preco, descricao, categoria_id, usado, tipo_produto, isbn, water_mark, taxa_impressao) VALUES ('{$produto->getNome()}', '{$produto->getPreco()}', '{$produto->getDescricao()}', {$produto->getCategoria()->getId()}, {$produto->isUsado()}, '{$tipo_produto}', '{$isbn}', '{$waterMark}', '{$taxaImpressao}')";

		//Tenta executar a query e retorna
		return mysqli_query($this->conexao, $query);
	}

	function removeProduto($id) {

		$query = "DELETE FROM produtos WHERE id = {$id}";

		return mysqli_query($this->conexao, $query);

	}

	function buscaProduto($id) {

		$query = "SELECT p.*, c.nome as c_nome, c.id as c_id 
				  FROM produtos p 
				  INNER JOIN categorias c ON c.id = p.categoria_id
				  WHERE p.id = {$id}";

		$resultado = mysqli_query($this->conexao, $query);

		$produto_array = mysqli_fetch_assoc($resultado);

		$produto_id = $produto_array['id'];
		$tipoProduto = $produto_array['tipo_produto'];
		$categoria_id = $produto_array['c_id'];
		$categoria_nome = $produto_array['c_nome'];

		$produtoFactory = new ProdutoFactory();
		$produto = $produtoFactory->criarPor($tipoProduto, $produto_array);
		$produto->atualizaBaseadoEm($produto_array);
		$produto->setId($produto_id);
		$produto->getCategoria()->setId($categoria_id);
		$produto->getCategoria()->setNome($categoria_nome);

		return $produto;
	}

	function alteraProduto(Produto $produto) {

		$tipo_produto = get_class($produto);

		echo $tipo_produto;

		$isbn = "";
		if ($produto->temIsbn()) {
			$isbn = $produto->getIsbn();
		}

		$waterMark = "";
    	if($produto->temWaterMark()) {
        	$waterMark = $produto->getWaterMark();
    	}

    	$taxaImpressao = "";
    	if($produto->temTaxaImpressao()) {
        	$taxaImpressao = $produto->getTaxaImpressao();
    	}	

		$query = "UPDATE produtos SET nome = '{$produto->getNome()}', preco = '{$produto->getPreco()}', descricao = '{$produto->getDescricao()}', categoria_id = {$produto->getCategoria()->getId()}, usado = {$produto->isUsado()}, tipo_produto = '{$tipo_produto}', isbn = '{$isbn}', water_mark = '{$waterMark}', taxa_impressao = '{$taxaImpressao}' WHERE id = {$produto->getId()}";

		return mysqli_query($this->conexao, $query);
	}	
}