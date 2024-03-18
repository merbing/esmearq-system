<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $processo_id = $_POST['processo_id'];
    $client_id = $_POST["id_client"];
    $description = $_POST["descricao"];
    $service_id = $_POST["id_service"];
    $start_date = $_POST["data_inicio"];
    $end_date = $_POST["data_fim"];
    $employee_id = $_POST["funcionario_id"];
    $state_id = $_POST["id_state"];
    

    $query = "UPDATE processos SET cliente_id='$client_id',tipo_servico_id='$service_id',estado_processo_id='$state_id',
    funcionario_responsavel_id='$employee_id',descricao='$description',data_inicio='$start_date',data_fim_previsto='$end_date',data_fim='$end_date'
    WHERE id = $processo_id;";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($client_id);
        $sucess_message = "Processo Actualizado com sucesso!";
        try{
            // Registar a actividade (Log)
            $log = new Log("Actualizando  um processo",($client_id."-".$service_id."-".$state_id."-".$start_date."-".$end_date),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
        header("Location: ../../../editar_processo.php?processo_id=".base64_encode($processo_id)."&success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../editar_processo.php?processo_id=".base64_encode($processo_id)."&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

