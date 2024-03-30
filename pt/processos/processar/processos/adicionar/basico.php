<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $client_id = $_POST["id_client"];
    $description = $_POST["descricao"];
    $service_id = $_POST["id_service"];
    $start_date = $_POST["data_inicio"];
    $end_date = $_POST["data_fim"];
    $employee_id = $_POST["id_funcionario"];
    $state_id = $_POST["id_state"];
    // $name = $_POST["name"];
    // $date = $date." ".$time;

    $query = "INSERT INTO processos (cliente_id,tipo_servico_id,estado_processo_id,funcionario_responsavel_id,
                descricao,data_inicio,data_fim_previsto,data_fim) 
            VALUES ('$client_id','$service_id','$state_id','$employee_id','$description','$start_date','$end_date','$end_date');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        // $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Processo Cadastrado com sucesso!";
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!";
        $funcionario_id = $_SESSION['funcionario_id'];
        try{
            // Registar a actividade (Log)
            $log = new Log("Cadastrando um processo",($client_id."-".$service_id."-".$state_id."-".$start_date."-".$end_date."-FUNCIONARIO:".$funcionario_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        header("Location: ../../../lista.php?success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

