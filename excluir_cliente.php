<?php
require_once(__DIR__ . '/classes/Conexao.php');
require_once(__DIR__ . '/classes/Util.php');

if(isset($_GET['id'])) {
    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    $idCliente = $_GET['id'];
    
    if (Util::excluirCliente($idCliente, $conn)) {
        echo "Cliente excluído com sucesso";
    } else {
        echo "Erro ao excluir cliente";
    }

    // Fecha a conexão com o banco de dados
    $conexao->fecharConexao();

    header("Location: index.php");
    exit();
} else {
    echo "ID do cliente não fornecido";
}
?>
