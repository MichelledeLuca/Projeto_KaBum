<?php
// Conexão com o banco de dados
$host = 'localhost';
$usuario_bd = 'root';
$senha_bd = '1234mi';
$nome_bd = 'projeto';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram enviados
    if (isset($_POST['id_cliente'], $_POST['nome'], $_POST['data_nascimento'], $_POST['cpf'], $_POST['rg'], $_POST['telefone'])) {
        // Obtém os dados do formulário
        $id_cliente = $_POST['id_cliente'];
        $nome = $_POST['nome'];
        $data_nascimento = $_POST['data_nascimento'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $telefone = $_POST['telefone'];

        // Cria a conexão
        $conn = new mysqli($host, $usuario_bd, $senha_bd, $nome_bd);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        // Atualiza os dados do cliente no banco de dados
        $sql = "UPDATE clientes SET nome='$nome', data_nascimento='$data_nascimento', cpf='$cpf', rg='$rg', telefone='$telefone' WHERE id=$id_cliente";

        if ($conn->query($sql) === TRUE) {
            // Redireciona de volta para index.php após a edição ser concluída
            header("Location: index.php");
            exit();
        } else {
            echo "Erro ao atualizar o cliente: " . $conn->error;
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        echo "Todos os campos são obrigatórios.";
    }
} else {
    // Se o formulário não foi submetido via POST, redirecione para index.php
    header("Location: index.php");
    exit();
}
?>
