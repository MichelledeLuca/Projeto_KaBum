<?php

function limpar_entrada($entrada) {
    $entrada = trim($entrada);
    $entrada = stripslashes($entrada);
    $entrada = htmlspecialchars($entrada);
    return $entrada;
}

function validarCPF($cpf) {
    if (strlen($cpf) != 11) {
        die("CPF inválido. Deve conter 11 dígitos.");
    }
}

function validarRG($rg) {
    if (strlen($rg) != 9) {
        die("RG inválido. Deve conter 9 dígitos.");
    }
}

function validarTelefone($telefone) {
    if (strlen($telefone) != 11) {
        die("Telefone inválido. Deve conter 11 dígitos.");
    }
}
?>
