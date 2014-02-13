<?php

class ProdutoDAO {

    private static $conn = null;

    public function ProdutoDAO() {
        self::$conn = Ambiente::getConn();
    }

    public function insere($dados) {
        try {
            $stmt = self::$conn->prepare("INSERT INTO produtos 
                (id, nome, descricao, preco, unidade, estoque) 
                VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('issdsd', $dados['id'], $dados['nome'], $dados['descricao'], $dados['preco'], $dados['unidade'], $dados['estoque']);

            if ($stmt->execute()) {
				$msg = array("texto" => "Inserido com sucesso!",
					"tipo" => "sucesso");
			} else {
				$msg = array("texto" => "Erro ao inserir.",
					"tipo" => "erro");
			}

			$stmt->close();
		} catch (mysqli_sql_exception $ex) {
			$msg = array("texto" => "Erro: " . $ex->getMessage(),
				"tipo" => "erro");
		}

		Ambiente::setMsg($msg);
    }

    public function atualiza($dados) {
        try {
            $stmt = self::$conn->prepare("UPDATE produtos SET
                nome = ?, descricao = ?, preco = ?, unidade = ?, estoque = ?
                WHERE id = ?");
            $stmt->bind_param('ssdsdi', $dados['nome'], $dados['descricao'], $dados['preco'], $dados['unidade'], $dados['estoque'], $dados['id']);

            if ($stmt->execute()) {
				$msg = array("texto" => "Atualizado com sucesso!",
					"tipo" => "sucesso");
			} else {
				$msg = array("texto" => "Erro ao atualizar.",
					"tipo" => "erro");
			}

			$stmt->close();
		} catch (mysqli_sql_exception $ex) {
			$msg = array("texto" => "Erro: " . $ex->getMessage(),
				"tipo" => "erro");
		}

		Ambiente::setMsg($msg);
    }

    public function exclui($dados) {
        try {
            $stmt = self::$conn->prepare("DELETE FROM produtos WHERE id = ?");
            $stmt->bind_param('i', $dados['id']);

            if ($stmt->execute()) {
				$msg = array("texto" => "Excluído com sucesso!",
					"tipo" => "sucesso");
			} else {
				$msg = array("texto" => "Erro ao excluir.",
					"tipo" => "erro");
			}

			$stmt->close();
		} catch (mysqli_sql_exception $ex) {
			$msg = array("texto" => "Erro: " . $ex->getMessage(),
				"tipo" => "erro");
		}

		Ambiente::setMsg($msg);
    }

    public function lista($campo = NULL, $valor = NULL, $like = TRUE) {
        try {
            if ($campo == NULL || $valor == NULL) {
				$stmt = self::$conn->prepare("SELECT * FROM produtos ORDER BY nome ASC");
			} elseif ($like) {
				$stmt = self::$conn->prepare("SELECT * FROM produtos WHERE $campo LIKE '%$valor%'");
			} else {
				$stmt = self::$conn->prepare("SELECT * FROM produtos WHERE $campo = '$valor'");
			}
            
            if ($stmt->execute()) {
				$result = $stmt->get_result();
				$rows = $result->fetch_all(MYSQLI_ASSOC);
				$result->free();

				return $rows;
			} else {
				$stmt->close();
				$msg = array("texto" => "Erro ao listar.",
					"tipo" => "erro");
			}
		} catch (mysqli_sql_exception $ex) {
			$msg = array("texto" => "Erro: " . $ex->getMessage(),
				"tipo" => "erro");
		}

		Ambiente::setMsg($msg);
    }

}

?>
