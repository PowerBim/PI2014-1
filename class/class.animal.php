<?php

class Animal {

    private $id;
    private $pessoa_id;
    private $tipo;
    private $nome;
	private static $colunas;

    public function Animal($dono) {
        $this->setId(null);
        $this->setNome("");
        $this->setPessoaId($dono);
        $this->setTipo("");
    }

	public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
	
	public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
	
	public function getPessoa_id() {
		return $this->pessoa_id;
	}

	public function setPessoa_id($pessoa_id) {
		$this->pessoa_id = $pessoa_id;
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
			"dono" => "Dono",
			"tipo" => "Tipo",
			"nome" => "Nome"
		);

		self::setColunas($colunas);
	}
	
    public function toVars() {
        $result['id'] = $this->getId();
        $result['nome'] = $this->getNome();
        $result['pessoa_id'] = $this->getPessoa_id();
        $result['tipo'] = $this->getTipo();
        
        return $result;
    }

}

?>
