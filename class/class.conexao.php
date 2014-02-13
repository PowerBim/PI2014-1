<?php
class Conexao {

    private $banco;
    private $host;
    private $usuario;
    private $senha;

    public function getBanco() {
        return $this->banco;
    }

    public function setBanco($banco) {
        $this->banco = $banco;
    }

    public function getHost() {
        return $this->host;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function conectaBd() {
        return new mysqli($this->host, $this->usuario, $this->senha, $this->banco);
    }

    private function getTabela($tabela, $campo, $valor) {
        $conn = Ambiente::getConn();
        return $conn->query("SELECT * FROM $tabela WHERE $campo LIKE '%$valor%'");
    }

    public function getPessoasByNome($valor) {
        $tabela = 'pessoas';
        $campo = 'nome';
        return $this->getTabela($tabela, $campo, $valor);
    }

    public function getPessoasByDocumento($valor) {
        $tabela = 'pessoas';
        $campo = 'cpf_cnpj';
        return $this->getTabela($tabela, $campo, $valor);
    }

}

?>
