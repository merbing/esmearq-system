<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
   try{
    $tipo = htmlspecialchars($_POST["tipo"]);

    $query = "INSERT INTO bancostipocontas (tipo_conta) VALUES ('$tipo');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = $_SESSION['funcionario_id'];
        $sucess_message = "Tipo cadastrado com sucesso!";
        try{
            // Registar a actividade (Log)
            $log = new Log("Cadastrando um tipo de Conta",('Tipo:'.$tipo."-FUNCIONARIO:".$encrypted_user_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        header("Location: ../../../bankaccount_types.php?success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../bankaccount_types.php?error_message=" . urlencode($error_message));
        exit;
    }
   }catch(Exception $e){
        $error_message = "Ocorreu um erro. Tente novamente mais tarde";
        header("Location: ../../../bankaccount_types.php?error_message=" . urlencode($error_message));
        exit;
   }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

