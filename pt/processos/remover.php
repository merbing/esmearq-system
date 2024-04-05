<?php
session_start();
require_once("../../banco/config.php");
require_once("../config/auth.php");

     // verificar se  o utilizador tem permissao para ver essa pagina
     if(!in_array("Atualizar Processo",$permissoes) ){
        header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
     
     }
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $id = base64_decode($_GET["processo_id"]);
    
    $query = "DELETE FROM processos WHERE id=$id;";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $sucess_message = "Processo eliminado com sucesso!";
        header("Location: lista.php?success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $error_message = "Ocorreu um erro.";
        header("Location: lista.php?error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

