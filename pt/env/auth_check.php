<?php
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: ../../login");
    exit();
}

    $funcionario_id =$user_id = $_SESSION["funcionario_id"];
    $user_name = $_SESSION["nome_usuario"];
    $user_email = $_SESSION["email_usuario"];
    $user_phone = $_SESSION["telefone_usuario"];
    $cargo_id = $_SESSION["cargo_id"];
    $agencia_id = $_SESSION["agencia_id"];
    
?>
