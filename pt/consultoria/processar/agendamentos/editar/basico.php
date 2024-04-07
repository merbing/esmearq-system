<?php
session_start();
require_once("../../../../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    try{
        $client_id = htmlspecialchars($_POST["id_client"]);
    $country = htmlspecialchars($_POST["pais"]);
    $service_id = htmlspecialchars($_POST["id_service"]);
    $date = htmlspecialchars($_POST["date"]);
    $time = htmlspecialchars($_POST["time"]);
    $state_id = $_POST["id_state"];
    $agendamento_id = $_POST["agendamento_id"];

    // $name = $_POST["name"];
    $date = $date." ".$time;

    $query = "UPDATE consultasagendamento SET pais_destino = '$country',data_consulta='$date',id_estado='$state_id',
    id_cliente='$client_id',servico_desejado='$service_id' WHERE id = '$agendamento_id';";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Agendamento Actualizado com sucesso!";
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
        header("Location: ../../../editar_agendamento.php?agendamento_id=".base64_encode($agendamento_id)."&success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../editar_agendamento.php?agendamento_id=".base64_encode($agendamento_id)."&error_message=" . urlencode($error_message));
        exit;
    }
    }catch(Exception $e)
    {
        $error_message = "Ocorreu um erro. Tente novamente mais tarde";
        header("Location: ../../../editar_agendamento.php?agendamento_id=".base64_encode($agendamento_id)."&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

