<?php

class AnimalDAO {

    private static $conn = null;

    public function AnimalDAO() {
        self::$conn = Ambiente::getConn();
    }

    public function insere($dados) {
        try {
            $stmt = self::$conn->prepare("INSERT INTO animais 
                (id, pessoa_id, tipo, nome) 
                VALUES (?, ?, ?, ?)");
            $stmt->bind_param('isss', $dados['id'], $dados['pessoa_id'], $dados['tipo'], $dados['nome']);

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
            $stmt = self::$conn->prepare("UPDATE animais SET
                tipo = ?, nome = ?, pessoa_id = ?
                WHERE id = ?");
            $stmt->bind_param('sssi', $dados['tipo'], $dados['nome'], $dados['pessoa_id'], $dados['id']);

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
            $stmt = self::$conn->prepare("DELETE FROM animais WHERE id = ?");
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
				$stmt = self::$conn->prepare("SELECT a.id, p.nome AS dono, a.tipo, a.nome FROM animais a INNER JOIN pessoas p ON a.pessoa_id = p.id ORDER BY a.nome ASC");
			} elseif ($like) {
				$stmt = self::$conn->prepare("SELECT * FROM animais WHERE $campo LIKE '%$valor%'");
			} else {
				$stmt = self::$conn->prepare("SELECT * FROM animais WHERE $campo = '$valor'");
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
