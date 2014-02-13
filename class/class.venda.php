<?php

class Venda {

    private $id;
    private $pessoa_id;
    private $total;
    private $forma_pagamento;
	private static $colunas;

    public function Venda() {
        $this->setId(null);
        $this->setPessoaId("");
        $this->setTotal("");
        $this->setFormaPagamento("");
    }

    public function getId() {
        return $this->id;
    }

    public function getPessoaId() {
		return $this->pessoa_id;
	}

	public function setPessoaId($pessoa_id) {
		$this->pessoa_id = $pessoa_id;
	}

	public function getTotal() {
		return $this->total;
	}

	public function setTotal($total) {
		$this->total = $total;
	}

	public function getFormaPagamento() {
		return $this->forma_pagamento;
	}

	public function setFormaPagamento($forma_pagamento) {
		$this->forma_pagamento = $forma_pagamento;
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
			"pessoa_id" => "Cliente",
			"total" => "Total",
			"forma_pagamento" => "Forma de Pagamento"
		);

		self::setColunas($colunas);
	}

	public function toVars() {
        $result['id'] = $this->getId();
        $result['pessoa_id'] = $this->getPessoaId();
        $result['total'] = $this->getTotal();
        $result['forma_pagamento'] = $this->getFormaPagamento();
        
        return $result;
    }

}

?>
