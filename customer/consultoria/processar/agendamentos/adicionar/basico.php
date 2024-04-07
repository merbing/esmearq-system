<?php
session_start();
require_once("../../../../../banco/config.php");
include("../../../consultas/estados/buscar_espera.php");
// require_once("../../../../utils/Log.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if($state==null)
    {   
        $error_message = "Estado 'em espera' não disponível.";
        header("Location: ../../../agendar.php?error_message=" . urlencode($error_message));
        exit;
    }

    // var_dump($_POST);
    // exit;
    try{
        $client_id = $_SESSION["cliente_id"];
    $country = htmlspecialchars($_POST["pais"]);
    $service_id = htmlspecialchars($_POST["id_service"]);
    $date = htmlspecialchars( $_POST["data"]);
    $time = htmlspecialchars($_POST["hora"]);
    $state_id = $_POST["id_state"];
    // $name = $_POST["name"];
    $date = $date." ".$time;

    $query = "INSERT INTO consultasagendamento (pais_destino,data_consulta,id_estado,id_cliente,servico_desejado) 
            VALUES ('$country','$date','".$state['id']."','$client_id','$service_id');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Agendamento Cadastrado realizado com sucesso!";
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
        // $funcionario_id = $_SESSION['funcionario_id'];
        // try{
        //     // Registar a actividade (Log)
        //     $log = new Log("Cadastrando um agendamento",('Client:'.$client_id."-SERVICE:".$service_id."-DATA:".$date."-FUNCIONARIO:".$funcionario_id),$conn);
        //     $log->save();
        // } catch(\Exception $e)
        // {
            
        // }
        header("Location: ../../../agendar.php?success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../agendar.php?error_message=" . urlencode($error_message));
        exit;
    }
    }catch(Exception $e){
        $error_message = "Ocorreu um erro. Tente novamente";
        header("Location: ../../../agendar.php?error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

