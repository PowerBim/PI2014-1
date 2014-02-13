<?php

class Produto {

    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $unidade;
    private $estoque;
	private static $colunas;

    public function Produto() {
        $this->setId(null);
        $this->setNome("");
        $this->setDescricao("");
        $this->setPreco(0);
        $this->setUnidade("");
        $this->setEstoque("");
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

	public function getDescricao() {
		return $this->descricao;
	}

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

	public function getPreco() {
		return $this->preco;
	}

	public function setPreco($preco) {
		$this->preco = $preco;
	}

	public function getUnidade() {
		return $this->unidade;
	}

	public function setUnidade($unidade) {
		$this->unidade = $unidade;
	}

	public function getEstoque() {
		return $this->estoque;
	}

	public function setEstoque($estoque) {
		$this->estoque = $estoque;
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
			"nome" => "Nome",
			"descricao" => "Descrição",
			"preco" => "Preço",
			"unidade" => "Unidade",
			"estoque" => "Estoque"
		);

		self::setColunas($colunas);
	}
	
    public function toVars() {
        $result['id'] = $this->getId();
        $result['nome'] = $this->getNome();
        $result['descricao'] = $this->getDescricao();
        $result['preco'] = $this->getPreco();
        $result['unidade'] = $this->getUnidade();
        $result['estoque'] = $this->getEstoque();
        
        return $result;
    }

}

?>
