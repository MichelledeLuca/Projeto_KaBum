<?php
require_once(__DIR__ . '/Conexao.php');

class ClienteDAO {
    private $conexao;

    public function __construct() {
        $this->conexao = new Conexao();
    }

    public function buscarClientePorId($id) {
        $conn = $this->conexao->getConexao();
        $sql = "SELECT id, nome, data_nascimento, cpf, rg, telefone FROM clientes WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }


}
?>
