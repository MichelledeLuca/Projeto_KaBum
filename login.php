<?php

require_once(__DIR__ . '/header/header.php');

?>


<head>
    <title>Login</title>   
</head>
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="login_verificar.php">
            <h3 class="h2 mb-3 fw-normal">Seja Bem Vindo(a)!</h3>
            
            <?php
                if (isset($_GET['error'])) {
                    echo "<p style='color:red;'>{$_GET['error']}</p>";
                }
            ?>

            <br><br>
            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="email" placeholder="nome@exemplo.com" required>
                <label for="email">E-mail</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                <label for="senha">Senha</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Lembrar me
                </label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
            <br><br>
        </form>
    </main>
    <script src="static/js/bootstrap.bundle.min.js"></script>
    <script src="static/js/color-modes.js"></script>
</body>
</html>
