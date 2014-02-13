<?php

class Pessoa {

	private $id;
	private $nome;
	private $endereco;
	private $telefone;
	private $cpf_cnpj;
	private $rg_ie;
	private $tipo;
	private $contato;
	private static $colunas;

	public function Pessoa() {
		$this->setId(null);
		$this->setNome("");
		$this->setEndereco("");
		$this->setTelefone("");
		$this->setTipo(0);
		$this->setCpf_cnpj("");
		$this->setRg_ie("");
		$this->setContato("");
		self::setColunasPadrao();
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getCpf_cnpj() {
		return $this->cpf_cnpj;
	}

	public function setCpf_cnpj($cpf_cnpj) {
		$this->cpf_cnpj = $cpf_cnpj;
	}

	public function getRg_ie() {
		return $this->rg_ie;
	}

	public function setRg_ie($rg_ie) {
		$this->rg_ie = $rg_ie;
	}

	public function getContato() {
		return $this->contato;
	}

	public function setContato($contato) {
		$this->contato = $contato;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getEndereco() {
		return $this->endereco;
	}

	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}

	public function getTelefone() {
		return $this->telefone;
	}

	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}

	public function getTipo() {
		return $this->tipo;
	}

	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	public static function getColunas() {
		return self::$colunas;
	}

	public static function setColunas($colunas) {
		self::$colunas = $colunas;
	}

	public static function setColunasPadrao() {
		$colunas = array(
			"id" => "ID",
			"tipo" => "tipo",
			"cpf_cnpj" => "CPF/CNPJ",
			"rg_ie" => "RG/IE",
			"nome" => "Nome",
			"endereco" => "Endereço",
			"telefone" => "Telefone",
			"contato" => "Contato"
		);

		self::setColunas($colunas);
	}

	public function toVars() {
		$result['id'] = $this->getId();
		$result['nome'] = $this->getNome();
		$result['endereco'] = $this->getEndereco();
		$result['telefone'] = $this->getTelefone();
		$result['cpf_cnpj'] = $this->getCpf_cnpj();
		$result['rg_ie'] = $this->getRg_ie();
		$result['tipo'] = $this->getTipo();
		$result['contato'] = $this->getContato();

		return $result;
	}

}

?>
