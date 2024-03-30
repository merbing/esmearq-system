<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    try{
         
    $cliente_id = $_POST["id_client"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $destino = $_POST["destino"];
    $viagem_id = $_POST['id_viagem'];
    $realizada = $_POST['realizada'];
    $query = "UPDATE viagens SET id_cliente='$cliente_id', data_viagem='$date', hora_viagem='$time', destino='$destino', 
            realizado='$realizada' WHERE id=$viagem_id";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        
        $sucess_message = "Dados alterados com sucesso!";
        $funcionario_id = $_SESSION['funcionario_id'];
        try{
            // Registar a actividade (Log)
            $log = new Log("Editando uma Viagem",('Viagem:'.$viagem_id."-CLIENTE:".$client_id."-DESTINO:".$destino."-FUNCIONARIO:".$funcionario_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        header("Location: ../../../editar_viagem.php?viagem_id=".base64_encode($viagem_id)."&success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../editar_viagem.php?viagem_id=".base64_encode($viagem_id)."&error_message=" . urlencode($error_message));
        exit;
    }
    }catch(Exception $e)
    {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um problema. Tente Novamente";
        header("Location: ../../../editar_viagem.php?viagem_id=".base64_encode($viagem_id)."&error_message=" . urlencode($error_message));
        exit;
    }

} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

