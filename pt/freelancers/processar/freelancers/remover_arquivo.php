<?php
session_start();
require_once("../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $file_id = $_GET["file_id"];
   $id = base64_decode($file_id);
   $cliente_id = base64_decode($_GET["cliente_id"]);
   


    $query = "DELETE FROM clientes_documentos  WHERE id=$id";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Documento removido com sucesso!";
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        header("Location: ../../dados_cliente.php?cliente_id=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../dados_cliente.php?cliente_id=$encrypted_user_id&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

