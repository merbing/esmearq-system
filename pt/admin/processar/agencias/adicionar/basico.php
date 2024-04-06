<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $nome = $_POST["nome"];
    $endereco = $_POST["endereco"];
    $provincia = $_POST["provincia"];
    $telefone = $_POST["telefone"];

    $query = "INSERT INTO agencias (nome, endereco, provincia, telefone)
            VALUES ('$nome', '$endereco', '$provincia', '$telefone');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = $_SESSION['funcionario_id'];
        $sucess_message = "Agência cadastrada com sucesso!";
        try{
            // Registar a actividade (Log)
            $log = new Log("Cadastrando uma Agencia",('Agencia:'.$nome."-FUNCIONARIO:".$encrypted_user_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        header("Location: ../../../new_agency.php?success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../new_agency.php?error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

