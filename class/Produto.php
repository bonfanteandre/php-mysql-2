<?php 

abstract class _Produto {

	private $id;
	private $nome;
	private $preco;
	private $descricao;
	private $usado;
	private $categoria;

	function __construct($nome, $preco, $descricao, $usado, Categoria $categoria) {
		$this->nome = $nome;
		$this->preco = $preco;
		$this->descricao = $descricao;
		$this->usado = $usado;
		$this->categoria = $categoria;
	}

	public function getId () {
		return $this->id;
	}

	public function setId ($id) {
		$this->id = $id;
	}

	public function getNome () {
		return $this->nome;
	}

	public function getPreco () {
		return $this->preco;
	}

	public function getDescricao () {
		return $this->descricao;
	}

	public function isUsado () {
		return $this->usado;
	}

	public function setUsado ($usado) {
		$this->usado = $usado;
	}

	public function getCategoria () {
		return $this->categoria;
	}

	public function precoComDesconto($percentual = 0.1) {

		if ($percentual > 0 && $percentual <= 0.5) {
			return $this->preco - ($this->preco * $percentual);
		}

		return $this->preco;
	}

	public function calculaImposto() {
		return $this->preco * 0.195;
	}

	public function temIsbn() {
		return $this instanceof Livro;
	}

	public function temWaterMark() {
		return $this instanceof Ebook;
	}

	public function temTaxaImpressao() {
		return $this instanceof LivroFisico;
	}

	abstract function atualizaBaseadoEm($params);

	function __toString() {
		return $this->nome . ": R$" . $this->preco;
	}

	function __destruct() {
		//funcao executada ao descartar objeto da memoria
	}
}