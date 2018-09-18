<?php

//Faz as inclusoes dos arquivos
require_once("cabecalho.php");
require_once("logica-usuario.php");

//Pega o id do produto passado por get
$id = $_POST['id'];

$produtoDao = new ProdutoDao($conexao);

//Chama a funcao para remover o produto
$produtoDao->removeProduto($id);

$_SESSION["success"] = "Produto removido com sucesso.";

//A resposta deste arquivo nao tem um corpo (como um html), somente um header e nele eh mudada a localizacao (uri), sendo assim o codigo nao http de resposta nao eh 200 e sim 302
header("Location: produto-lista.php");

//Funcao que diz para o php nao executar mais nada abaixo disso, sempre utilizar depois de fazer um location
die();