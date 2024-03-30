<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $name = htmlspecialchars($_POST["nome"]);
    $phonenumber = htmlspecialchars($_POST["telefone"]);
    $email = htmlspecialchars($_POST["email"]);
    $nif = htmlspecialchars($_POST["nif"]);
    $banco = htmlspecialchars($_POST["banco"]);
    $numero = htmlspecialchars($_POST["numero"]);
    $iban = htmlspecialchars($_POST["iban"]);
    
    $query = "INSERT INTO freelancers (nome, telefone, email,nif,banco,numero_da_conta,iban)
            VALUES ('$name','$phonenumber','$email','$nif','$banco','$numero','$iban');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = $_SESSION['funcionario_id'];
        $sucess_message = "Freelancer cadastrado com sucesso!";
        try{
            // Registar a actividade (Log)
            $log = new Log("Cadastrando um Freelancer",('Freelancer:'.$name."-FUNCIONARIO:".$encrypted_user_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        header("Location: ../../../lista.php?success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../lista.php?error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

