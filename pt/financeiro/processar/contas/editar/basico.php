<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    try{
            $id = $_POST['id_conta'];
    $nome = htmlspecialchars($_POST["nome"]);
    $numero = htmlspecialchars($_POST["numero"]);
    $banco = htmlspecialchars($_POST["banco"]);
    $iban = htmlspecialchars($_POST["iban"]);
    $saldo = htmlspecialchars($_POST["saldo"]);
    $tipo = htmlspecialchars($_POST["tipo"]);

    $query = "UPDATE bancariasinformacoes SET nome_conta='$nome', banco='$banco', IBAN='$iban', numero_conta='$numero',
     saldo='$saldo', tipo_conta_id='$tipo' WHERE id = '$id';";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $funcionario_id = $_SESSION['funcionario_id'];
        $sucess_message = "Conta Alterada com sucesso!";
        try{
            // Registar a actividade (Log)
            $log = new Log("Alterando uma Conta",('Conta:'.$nome."-NUMERO:".$numero."-FUNCIONARIO:".$funcionario_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        header("Location: ../../../edit_account.php?account_id=".base64_encode($id)."&success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../edit_account.php?account_id=".base64_encode($id)."&error_message=" . urlencode($error_message));
        exit;
    }
    }catch(Exception $e){
        $error_message = "Ocorreu um erro. Tente novamente mais tarde";
        header("Location: ../../../edit_account.php?account_id=".base64_encode($id)."&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

