<?php
require_once(__DIR__ . '/classes/Conexao.php');
require_once(__DIR__ . '/classes/Funcoes.php');
require_once(__DIR__ . '/header/header.php');
require_once 'autenticacao.php';



$conexao = new Conexao();

$nome = $cpf = $rg = $telefone = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = limpar_entrada($_POST["nome"]);
    $cpf = limpar_entrada($_POST["cpf"]);
    $rg = limpar_entrada($_POST["rg"]);
    $telefone = limpar_entrada($_POST["telefone"]);

    validarCPF($cpf);
    validarRG($rg);
    validarTelefone($telefone);

    $sql = "INSERT INTO clientes (nome, cpf, rg, telefone) VALUES ('$nome', '$cpf', '$rg', '$telefone')";
    
    if ($conexao->conn->query($sql) === TRUE) {
        echo "Novo cliente cadastrado com sucesso.";
    } else {
        echo "Erro ao cadastrar o cliente: " . $conexao->conn->error;
    }
}

$conexao->fecharConexao();

?>


<head>
    <title>Cadastro de Cliente</title>
    
    <style>
        .form-container {
            margin-top: 50px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 py-4 bg-body-tertiary">
    <div class="container">
        <h1 class="h2 mb-0 text-center">Cadastro de Cliente</h1>
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <form action="salvar_cadastro.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                    <div class="mb-3">
                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf">
                    </div>
                    <div class="mb-3">
                        <label for="rg" class="form-label">RG</label>
                        <input type="text" class="form-control" id="rg" name="rg">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" onclick="return validarForm()">Salvar Cadastro</button>
                        <a href="index.php" class="btn btn-primary">Cancelar</a>
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
