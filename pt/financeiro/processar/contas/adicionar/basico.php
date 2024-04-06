<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $nome = $_POST["nome"];
    $numero = $_POST["numero"];
    $banco = $_POST["banco"];
    $iban = $_POST["iban"];
    $saldo = $_POST["saldo"];
    $tipo = $_POST["tipo"];

    $query = "INSERT INTO bancariasinformacoes (nome_conta, banco, IBAN, numero_conta, saldo, tipo_conta_id)
            VALUES ('$nome', '$banco', '$iban', '$numero', '$saldo', '$tipo');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = $_SESSION['funcionario_id'];
        $sucess_message = "Conta cadastrada com sucesso!";
        try{
            // Registar a actividade (Log)
            $log = new Log("Cadastrando uma Conta",('Conta:'.$nome."-NUMERO:".$numero."-FUNCIONARIO:".$encrypted_user_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        header("Location: ../../../new_account.php?success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../new_account.php?error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

