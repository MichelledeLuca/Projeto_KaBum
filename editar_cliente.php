<?php
require_once(__DIR__ . '/classes/ClienteDAO.php');
require_once(__DIR__ . '/classes/Funcoes.php');
require_once(__DIR__ . '/header/header.php');
require_once 'autenticacao.php';


$clienteDAO = new ClienteDAO();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_cliente = $_GET['id'];

    $cliente = $clienteDAO->buscarClientePorId($id_cliente);

    if (!$cliente) {
        echo "Cliente não encontrado.";
        exit;
    }
} else {
    echo "ID do cliente não especificado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $telefone = $_POST['telefone'];

    $resultado = $clienteDAO->atualizarCliente($id_cliente, $nome, $data_nascimento, $cpf, $rg, $telefone);

    if ($resultado) {
        echo "Cliente atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar cliente.";
    }
}
?>

<head>
    <title>Editar Cliente</title>
</head>

<body class="d-flex flex-column min-vh-100 py-4 bg-body-tertiary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="h2 mb-0 text-center">Editar Cliente</h1>
                <br/><br/>
                <form action="salvar_edicao.php" method="POST" onsubmit="return validarForm()">
                    <input type="hidden" name="id_cliente" value="<?php echo $cliente['id']; ?>">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $cliente['data_nascimento']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cliente['cpf']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="rg" class="form-label">RG</label>
                        <input type="text" class="form-control" id="rg" name="rg" value="<?php echo $cliente['rg']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $cliente['telefone']; ?>">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="index.php" class="btn btn-primary">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="static/js/bootstrap.bundle.min.js"></script>
    <script>
        function validarForm() {
            var cpf = document.getElementById('cpf').value;
            var rg = document.getElementById('rg').value;
            var telefone = document.getElementById('telefone').value;

            if (cpf.length !== 11) {
                alert('O CPF deve ter 11 dígitos.');
                return false;
            }

            if (rg.length !== 9) {
                alert('O RG deve ter 9 dígitos.');
                return false;
            }

            if (telefone.length !== 11) {
                alert('O telefone deve ter 11 dígitos.');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
