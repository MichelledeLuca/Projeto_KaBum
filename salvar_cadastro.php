<?php
// Conexão com o banco de dados
$host = 'localhost';
$usuario_bd = 'root';
$senha_bd = '1234mi';
$nome_bd = 'projeto';

// Verifica se todos os campos foram enviados pelo formulário
if (isset($_POST['nome']) && isset($_POST['data_nascimento']) && isset($_POST['cpf']) && isset($_POST['rg']) && isset($_POST['telefone'])) {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $telefone = $_POST['telefone'];

    // Cria a conexão com o banco de dados
    $conn = new mysqli($host, $usuario_bd, $senha_bd, $nome_bd);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Prepara a consulta SQL para inserir um novo cliente
    $sql = "INSERT INTO clientes (nome, data_nascimento, cpf, rg, telefone) VALUES ('$nome', '$data_nascimento', '$cpf', '$rg', '$telefone')";

    // Executa a consulta
    if ($conn->query($sql) === TRUE) {
        // Redireciona para a página index após o cadastro bem-sucedido
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao cadastrar o cliente: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    echo "Todos os campos são obrigatórios.";
}
?>
