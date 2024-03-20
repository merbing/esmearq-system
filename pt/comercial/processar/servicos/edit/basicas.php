<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $name = $_POST["name"];
    $duracao = $_POST["duracao"];
    $valor = $_POST["valor"];
    $service_id = $_POST['service_id'];
    $query = "UPDATE servicos SET nome='$name', custo=$duracao, prazo_dias='$valor' WHERE id=$service_id;";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Serviço Alterado com sucesso!";
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
        try{
            // Registar a actividade (Log)
            $log = new Log("Alterando um serviço",('Servico:'.$service_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        header("Location: ../../../lista_servicos.php?success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../editar_servico.php?error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

