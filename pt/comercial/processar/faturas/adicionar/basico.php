<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $client_id = $_POST["id_client"];
    $conta_id = $_POST["id_conta"];
    $service_id = $_POST["id_service"];
    $nome_empresa = $_POST["nome_empresa"];
    $email_empresa = $_POST["email_empresa"];
    $telefone_empresa = $_POST["telefone_empresa"];
    $endereco_empresa = $_POST["endereco_empresa"];
    $desconto = $_POST["desconto"];
    $valor = $_POST["valor"];
    $id_pago = $_POST["id_pago"];

    $query = "INSERT INTO faturas (cliente_id,servico_id,bancaria_info_id,nome_empresa,email,telefone,endereco,desconto,pago,valor)
            VALUES ('$client_id','$service_id','$conta_id','$nome_empresa','$email_empresa','$telefone_empresa','$endereco_empresa','$desconto','$id_pago','$valor');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        // $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Fatura Registada com sucesso!";
        
        try{
            // Registar a actividade (Log)
            $log = new Log("Cadastrando uma fatura",('Client:'.$client_id."-Servico:".$service_id."-Conta:".$conta_id."-Empresa:".$nome_empresa."-Pago:".$pago_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        header("Location: ../../../lista_faturas.php?success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../adicionar_faturas.php?error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

