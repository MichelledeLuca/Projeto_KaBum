<?php
require_once(__DIR__ . '/classes/Cliente.php');
require_once(__DIR__ . '/classes/Conexao.php');
require_once 'autenticacao.php';


$conexao = new Conexao();
$mysqli = $conexao->getConexao();

$sql = "SELECT id, nome, data_nascimento, cpf, rg, telefone FROM clientes";
$resultado = $mysqli->query($sql);

$clientes = [];
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $cliente = new Cliente();
        $cliente->id = $row['id'];
        $cliente->nome = $row['nome'];
        $cliente->dataNascimento = $row['data_nascimento'];
        $cliente->cpf = $row['cpf'];
        $cliente->rg = $row['rg'];
        $cliente->telefone = $row['telefone'];
        $clientes[] = $cliente;
    }
}

$conexao->fecharConexao();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="icon" type="image/x-icon" href="/img/logo.png">
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/css/style.css" rel="stylesheet">
    <link href="static/css/sign-in.css" rel="stylesheet">
    <script src="static/js/color-modes.js"></script>
</head>
<body class="d-flex flex-column min-vh-100 py-4 bg-body-tertiary">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h2 mb-0">Lista de Clientes</h1>
            <a href="logout.php" class="btn btn-sm btn-secondary text-white">Sair</a>
        </div>
        <br/><br/><br/>

        <form action="cadastro_cliente.php" method="GET">
            <button type="submit" class="btn btn-sm btn-info" style="margin-right: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                </svg>
                Novo Cliente
            </button>
        </form>
        <br/>

        <div class="table-responsive">
            <table class="table table-striped text-center"> 
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Data Nascimento</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Telefone</th>
                        <th>Ações</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente->id; ?></td>
                            <td><?php echo $cliente->nome; ?></td>
                            <td><?php echo $cliente->dataNascimento; ?></td>
                            <td><?php echo $cliente->cpf; ?></td>
                            <td><?php echo $cliente->rg; ?></td>
                            <td><?php echo $cliente->telefone; ?></td>
                            <td>
                                <a href='editar_cliente.php?id=<?php echo $cliente->id; ?>' class='btn btn-sm btn-primary'>Editar</a>
                                <a href='excluir_cliente.php?id=<?php echo $cliente->id; ?>' class='btn btn-sm btn-danger' onclick='return confirmarExclusao();'>Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>
    <script src="static/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmarExclusao() {
            return confirm("Tem certeza que deseja excluir este cliente?");
        }
    </script>
</body>
</html>
