<?php

function gerarSenha() {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_+=<>?';
    $tamanhoSenha = 6;

    $senha = '';
    $caracteresLength = strlen($caracteres) - 1;

    for ($i = 0; $i < $tamanhoSenha; $i++) {
        $senha .= $caracteres[mt_rand(0, $caracteresLength)];
    }

    return $senha;
}

$senhaGerada = gerarSenha();

?>
