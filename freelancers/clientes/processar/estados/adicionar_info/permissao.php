<?php
session_start();
require_once("../../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $papel_id = $_POST["papel_id"];
    $permissao_id = $_POST["permissao_id"];
    $query = "INSERT INTO permissoesporcargo (cargo_id,permissao_id) VALUES ('$papel_id','$permissao_id');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Cadastrado realizado com sucesso!";
        $_SESSION["success"] = "Permissão Atribuída com sucesso!"; 
        header("Location: ../../../lista_papel_permissoes.php?papel_id=".base64_encode($papel_id));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../cliente_files?conta_do_cliente=$encrypted_user_id&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

