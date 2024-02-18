<?php
// Função para verificar se o usuário está logado
function verificarAutenticacao() {
    session_start();

    if (!isset($_SESSION['usuario_logado']) || !$_SESSION['usuario_logado']) {
        header("Location: login.php");
        exit();
    }
}
?>
