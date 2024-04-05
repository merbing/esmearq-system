<?php
session_start();
require_once("../../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $service_id = $_POST["id_service"];
    $client = $_POST["id_cliente"];
    try{
        $query = "INSERT INTO servicos_solicitados (id_cliente,id_servico) VALUES ('$client','$service_id');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Cadastrado realizado com sucesso!";
        $_SESSION["success"] = "Permissão Atribuída com sucesso!"; 
        header("Location: ../../../cliente_servicos.php?cliente_id=".base64_encode($client));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../cliente_servicos.php?cliente_id=".base64_encode($client)); exit;
    }
    }catch(Exception $e)
    {
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../cliente_servicos.php?cliente_id=".base64_encode($client)); exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

