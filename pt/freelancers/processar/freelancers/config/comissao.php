<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $comissao = $_POST["comissao"];
    
    // VERIFICAR SE JÁ TEM UM REGISTRO NA TABELA DE CONFIGURAÇÃO
    $query = "SELECT * FROM freelancers_config  WHERE id = 1 limit 1 ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $config = null;
    if ($result->num_rows > 0) {
        $config = $result->fetch_assoc();
    }

    if($config == null){
        // Cria um novo registro
        $query = "INSERT INTO freelancers_config (id,percentagem_comissao) values (1,'$comissao')";
        $result = $conn->query($query);

        if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);

        $sucess_message = "Comissão alterada com sucesso!";
        $funcionario_id = $_SESSION['funcionario_id'];
        try{
            // Registar a actividade (Log)
            $log = new Log("Alteranco a percentagem de comissão dos freelancers",("-FUNCIONARIO:".$funcionario_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
    
        }
        header("Location: ../../../config.php?success_message=" . urlencode($sucess_message));
        exit();

        } else {
            $encrypted_user_id = base64_encode($cliente_id);
            $error_message = "Ocorreu um erro.";
            header("Location: ../../../config.php?error_message=" . urlencode($error_message));
            exit;
        }
    }else{
        //actualiza o registro existente
        
        $query = "UPDATE freelancers_config SET percentagem_comissao='$comissao' WHERE id=1";
        $result = $conn->query($query);

        if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);

        $sucess_message = "Comissão alterada com sucesso!";
        $funcionario_id = $_SESSION['funcionario_id'];
        try{
            // Registar a actividade (Log)
            $log = new Log("Alteranco a percentagem de comissão dos freelancers",("-FUNCIONARIO:".$funcionario_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
    
        }
        header("Location: ../../../config.php?success_message=" . urlencode($sucess_message));
        exit();

        } else {
            $encrypted_user_id = base64_encode($cliente_id);
            $error_message = "Ocorreu um erro.";
            header("Location: ../../../config.php?error_message=" . urlencode($error_message));
            exit;
        }
    }



} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../../../login.php");
    exit();
}

$conn->close();
?>

