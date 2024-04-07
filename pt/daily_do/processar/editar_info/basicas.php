<?php
session_start();
require_once("../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    try{
        $id = $_POST["id_atividade"];
    $atividade =htmlspecialchars( $_POST["atividade"]);
    $inicio = htmlspecialchars($_POST["data_inicio"]);
    $fim = htmlspecialchars($_POST["data_fim"]);
    $id_funcionario = $_POST["id_funcionario"];
    $status = $_POST["status"];
    
    $query = "UPDATE atividadesregistro SET funcionario_id=$id_funcionario, atividade='$atividade', estado='$status',
         data_inicio='$inicio', data_fim='$fim' WHERE id=$id;";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_atividade_id = base64_encode($id);
        $sucess_message = "Atividade actualizada com sucesso!";
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        header("Location: ../../editar.php?atividade_id=$encrypted_atividade_id&success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $encrypted_atividade_id = base64_encode($id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../editar.php?atividade_id=$encrypted_atividade_id&error_message=" . urlencode($error_message));
        exit;
    }
    }catch(Exception $e){
        $encrypted_atividade_id = base64_encode($id);
        $error_message = "Ocorreu um erro. Tenta novamente mais tarde";
        header("Location: ../../editar.php?atividade_id=$encrypted_atividade_id&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

