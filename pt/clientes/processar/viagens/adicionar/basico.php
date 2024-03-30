<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    try{
        $cliente_id = $_POST["id_client"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $destino = $_POST["destino"];
    //    var_dump($cliente_id);
    //    exit;
        $query = "INSERT INTO viagens (id_cliente, data_viagem, hora_viagem, realizado,destino)
                VALUES ($cliente_id, '$date', '$time', 0, '$destino');";
        $result = $conn->query($query);
        
        
        if ($result === TRUE) {
            $encrypted_user_id = $_SESSION['funcionario_id'];
            $sucess_message = "Viagem cadastrada com sucesso!";
            try{
                // Registar a actividade (Log)
                $log = new Log("Cadastrando uma Viagem",'Client:'.$name , $conn);
                $log->save();
            } catch(\Exception $e)
            {
                
            }
            // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
            // header("Location: ../../../adicionar.php");
            header("Location: ../../../lista_viagens.php?success_message=" . urlencode($sucess_message));
            exit();
    
        } else {
            $encrypted_user_id = base64_encode($cliente_id);
            $error_message = "Ocorreu um erro.";
            header("Location: ../../../lista_viagens.php?error_message=" . urlencode($error_message));
            exit;
        }
    }catch(Exception $e)
    {
        $encrypted_user_id = base64_encode($cliente_id);
            $error_message = "Ocorreu um erro. Detalhes: ".$e->getMessage();
            header("Location: ../../../lista_viagens.php?error_message=" . urlencode($error_message));
            exit;
    }
   
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

