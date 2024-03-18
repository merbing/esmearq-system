<?php
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: ../../login.php");
    exit();
}

    $funcionario_id =$user_id = $_SESSION["funcionario_id"];
    $user_name = $_SESSION["nome_usuario"];
    $user_email = $_SESSION["email_usuario"];
    $user_phone = $_SESSION["telefone_usuario"];
    $papel_usuario_id = $_SESSION["papel_usuario_id"];
    $papel_usuario = $_SESSION["papel_usuario"];
    $agencia_id = $_SESSION["agencia_id"];
    
?>
