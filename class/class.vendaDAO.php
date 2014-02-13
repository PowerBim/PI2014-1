<?php

class VendaDAO {

    private static $conn = null;

    public function VendaDAO() {
        self::$conn = Ambiente::getConn();
    }

    public function insere($dados) {
        try {
            $stmt = self::$conn->prepare("INSERT INTO vendas 
                (id, pessoa_id, total, forma_pagamento) 
                VALUES (?, ?, ?, ?)");
            $stmt->bind_param('isss', $dados['id'], $dados['pessoa_id'], $dados['total'], $dados['forma_pagamento']);

            if ($stmt->execute()) {
                $_SESSION['msg'] = "Inserido com sucesso!";
            } else {
                $_SESSION['msg'] = "Erro ao inserir.";
            }

            $stmt->close();
        } catch (Exception $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function atualiza($dados) {
        try {
            $stmt = self::$conn->prepare("UPDATE vendas SET
                pessoa_id = ?, total = ?, forma_pagamento = ?
                WHERE id = ?");
            $stmt->bind_param('sssi', $dados['pessoa_id'], $dados['total'], $dados['forma_pagamento'], $dados['id']);

            if ($stmt->execute()) {
                $_SESSION['msg'] = "Atualizado com sucesso!";
            } else {
                $_SESSION['msg'] = "Erro ao atualizar.";
            }

            $stmt->close();
        } catch (Exception $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function exclui($dados) {
        try {
            $stmt = self::$conn->prepare("DELETE FROM vendas WHERE id = ?");
            $stmt->bind_param('i', $dados['id']);

            if ($stmt->execute()) {
                $_SESSION['msg'] = "Excluido com sucesso!";
            } else {
                $_SESSION['msg'] = "Erro ao excluir.";
            }

            $stmt->close();
        } catch (Exception $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function lista($campo = NULL, $valor = NULL) {
        try {
            if ($campo == NULL || $valor == NULL) {
                $stmt = self::$conn->prepare("SELECT * FROM vendas ORDER BY nome ASC");
            } else {
                $stmt = self::$conn->prepare("SELECT * FROM vendas WHERE $campo LIKE '%$valor%'");
            }
            
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_array(MYSQLI_ASSOC);

            $result->free();
            $stmt->close();

            return $row;
        } catch (Exception $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

}

?>
