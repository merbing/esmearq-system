<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    try{
        $nome = htmlspecialchars($_POST["nome"]);
    $numero = htmlspecialchars($_POST["numero"]);
    $banco = htmlspecialchars($_POST["banco"]);
    $iban = htmlspecialchars($_POST["iban"]);
    $saldo = htmlspecialchars($_POST["saldo"]);
    $tipo = htmlspecialchars($_POST["tipo"]);

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
    }catch(Exception $e){
        $error_message = "Ocorreu um erro. Tente novamente mais tarde";
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

