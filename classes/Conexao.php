<?php

class Conexao {
    private $host = 'localhost';
    private $usuario = 'root';
    private $senha = '1234mi';
    private $nomeBanco = 'projeto';
    private $conexao;

    public function __construct() {
        $this->conexao = new mysqli($this->host, $this->usuario, $this->senha, $this->nomeBanco);
        if ($this->conexao->connect_error) {
            die("Erro de conexão: " . $this->conexao->connect_error);
        }
    }

    public function getConexao() {
        return $this->conexao;
    }

    public function fecharConexao() {
        $this->conexao->close();
    }
}
