<?php

require_once("class/Categoria.php");
require_once("class/Produto.php");

function listarProdutos($conexao) {

	$produtos = array();
	
	$query = "SELECT p.*, c.nome as c_nome, c.id as c_id FROM produtos p 
			INNER JOIN categorias c ON c.id = p.categoria_id";
	
	$resultado = mysqli_query($conexao, $query);
	
	while ($produto_array = mysqli_fetch_assoc($resultado)) {
		
		$categoria = new Categoria();
		$categoria->setId($produto_array['c_id']);
		$categoria->setNome($produto_array['c_nome']);

		$nome = $produto_array['nome'];
		$preco = $produto_array['preco'];
		$descricao = $produto_array['descricao'];
		$usado = $produto_array['usado'];

		$produto = new Produto($nome, $preco, $descricao, $usado, $categoria);
		$produto->setId($produto_array['id']);

		array_push($produtos, $produto);
	}

	return $produtos;		
}

function insereProduto($conexao, Produto $produto) {

	$nome = mysqli_real_escape_string($conexao, $produto->getNome());
	$descricao = mysqli_real_escape_string($conexao, $produto->getDescricao());
	$preco = $produto->getPreco();

	//Monta a query interpolando as variaveis
	$query = "INSERT INTO produtos (nome, preco, descricao, categoria_id, usado) VALUES ('{$produto->getNome()}', '{$produto->getPreco()}', '{$produto->getDescricao()}', {$produto->getCategoria()->getId()}, {$produto->isUsado()})";

	//Tenta executar a query e retorna
	return mysqli_query($conexao, $query);
}

function removeProduto($conexao, $id) {

	$query = "DELETE FROM produtos WHERE id = {$id}";

	return mysqli_query($conexao, $query);

}

function buscaProduto($conexao, $id) {

	$query = "SELECT p.*, c.nome as c_nome, c.id as c_id 
			  FROM produtos p 
			  INNER JOIN categorias c ON c.id = p.categoria_id
			  WHERE p.id = {$id}";

	$resultado = mysqli_query($conexao, $query);

	$produto_array = mysqli_fetch_assoc($resultado);

	$categoria = new Categoria();
	$categoria->setId($produto_array['c_id']);
	$categoria->setNome($produto_array['c_nome']);

	$nome = $produto_array['nome'];
	$preco = $produto_array['preco'];
	$descricao = $produto_array['descricao'];
	$usado = $produto_array['usado'];

	$produto = new Produto($nome, $preco, $descricao, $usado, $categoria);
	$produto->setId($produto_array['id']);

	return $produto;
}

function alteraProduto($conexao, Produto $produto) {

	$query = "UPDATE produtos SET nome = '{$produto->getNome()}', preco = '{$produto->getPreco()}', descricao = '{$produto->getDescricao()}', categoria_id = {$produto->getCategoria()->getId()}, usado = {$produto->isUsado()} WHERE id = {$produto->getId()}";

	return mysqli_query($conexao, $query);
}