<?php
session_start();
require_once("../../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $pais = $_POST["pais"];
    $taxa = $_POST["taxa"];
    $requisitos = $_POST["requisitos"];
    $query = "INSERT INTO requisitos (pais,taxa,requisitos) VALUES ('$pais',$taxa,'$requisitos');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Requisito Cadastrado com sucesso!";
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
        header("Location: ../../../lista_requisitos.php?success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../adicionar_requisitos.php?error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>
