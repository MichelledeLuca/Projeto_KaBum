<?php
require_once 'autenticacao.php';
require_once(__DIR__ . '/classes/Conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexao = new Conexao();
    $conn = $conexao->getConexao();

    $email = trim($_POST['email']); 
    $senha = trim($_POST['senha']); 

    // Prepara a consulta SQL
    $query = "SELECT senha FROM usuarios WHERE login = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Associa os parâmetros
        $stmt->bind_param("s", $email);
        // Executa a consulta
        if ($stmt->execute()) {
            // Obtém o resultado
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $senha_bd = $row['senha'];

                // Verifica a senha
                if ($senha == $senha_bd) {
                    $_SESSION['usuario_logado'] = true;
                    header('Location: index.php');
                    exit();
                } else {
                    header('Location: login.php?error=Senha%20incorreta');
                    exit();
                }
            } else {
                header('Location: login.php?error=Usuário%20não%20encontrado');
                exit();
            }
        } else {
            echo "Erro ao executar a consulta: " . $stmt->error;
        }
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    $conn->close();
} else {
    header('Location: login.php');
    exit();
}
?>
