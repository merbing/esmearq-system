<?php
session_start();
require_once("../../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
   try{
    $name =htmlspecialchars( $_POST["name"]);
    $query = "INSERT INTO consultasestado (nome) VALUES ('$name');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Estado Cadastrado realizado com sucesso!";
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
        header("Location: ../../../adicionar_estado.php?success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../adicionar_estado.php?error_message=" . urlencode($error_message));
        exit;
    }
   }catch(Exception $e){
    $error_message = "Ocorreu um erro. Tenta novamente mais tarde";
    header("Location: ../../../adicionar_estado.php?error_message=" . urlencode($error_message));
    exit;
   }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

