<?php
session_start();
require_once("../../../../../banco/config.php");
include("../../../consultas/estados/buscar_cancelado.php");



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(!isset($_GET['agendamento_id']) || !$_GET['agendamento_id'])
    {
        $error_message = "Agendamento não encontrado";
        header("Location: ../../../lista.php?error_message=" . urlencode($error_message));
        exit;
    }
    $agendamento_id = base64_decode($_GET["agendamento_id"]);
   
    if($state==null)
    {   
        $error_message = "Estado 'cancelado' não disponível.";
        header("Location: ../../../detalhes.php?agendamento_id=".base64_encode($agendamento_id)."&error_message=" . urlencode($error_message));
        exit;
    }
    $state_id = $state['id'];
    $query = "UPDATE consultasagendamento SET id_estado='$state_id' WHERE id = '$agendamento_id';";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $sucess_message = "Agendamento Cancelado com sucesso!";
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
        header("Location: ../../../detalhes.php?agendamento_id=".base64_encode($agendamento_id)."&success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../detalhes.php?agendamento_id=".base64_encode($agendamento_id)."&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

