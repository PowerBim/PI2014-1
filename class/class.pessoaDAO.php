<?php

class PessoaDAO {

	private static $conn = null;

	public function PessoaDAO() {
		self::$conn = Ambiente::getConn();
	}

	public function insere($dados) {
		try {
			$stmt = self::$conn->prepare("INSERT INTO pessoas 
                (id, tipo, cpf_cnpj, rg_ie, nome, endereco, telefone, contato) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param('isssssss', $dados['id'], $dados['tipo'], $dados['cpf_cnpj'], $dados['rg_ie'], $dados['nome'], $dados['endereco'], $dados['telefone'], $dados['contato']);

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
			$stmt = self::$conn->prepare("UPDATE pessoas SET tipo = ?, 
				cpf_cnpj = ?, rg_ie = ?, nome = ?, endereco = ?, 
				telefone = ?, contato = ? 
				WHERE id = ?");
			$stmt->bind_param('issssssi', $dados['tipo'], $dados['cpf_cnpj'], $dados['rg_ie'], $dados['nome'], $dados['endereco'], $dados['telefone'], $dados['contato'], $dados['id']);

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
			$stmt = self::$conn->prepare("DELETE FROM pessoas WHERE id = ?");
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
				$stmt = self::$conn->prepare("SELECT * FROM pessoas ORDER BY nome ASC");
			} elseif ($like) {
				$stmt = self::$conn->prepare("SELECT * FROM pessoas WHERE $campo LIKE '%$valor%'");
			} else {
				$stmt = self::$conn->prepare("SELECT * FROM pessoas WHERE $campo = '$valor'");
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