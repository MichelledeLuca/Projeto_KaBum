<?php

class Util {
    public static function excluirCliente($idCliente, $conexao) {
        $sql = "DELETE FROM clientes WHERE id = $idCliente";
        if ($conexao->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>
