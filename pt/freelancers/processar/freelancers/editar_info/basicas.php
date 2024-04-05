<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = htmlspecialchars($_POST["nome"]);
    $phonenumber = htmlspecialchars($_POST["telefone"]);
    $email = htmlspecialchars($_POST["email"]);
    $nif = htmlspecialchars($_POST["nif"]);
    $banco = htmlspecialchars($_POST["banco"]);
    $numero = htmlspecialchars($_POST["numero"]);
    $iban = htmlspecialchars($_POST["iban"]);
    $freelancer_id = htmlspecialchars($_POST['id_freelancer']);
    $query = "UPDATE freelancers SET nome='$name', nif='$nif', telefone='$phonenumber',
            email='$email', banco='$banco', numero_da_conta='$numero', iban='$iban'
             WHERE id=$freelancer_id";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($freelancer_id);
        
        $sucess_message = "Dados alterados com sucesso!";
        $funcionario_id = $_SESSION['funcionario_id'];
        try{
            // Registar a actividade (Log)
            $log = new Log("Editando um Freelancer",('Freelancer:'.$name."-NIF:".$nif."FUNCIONARIO:".$funcionario_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        header("Location: ../../../details.php?freelancer_id=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $encrypted_user_id = base64_encode($freelancer_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../details.php?freelancer_id=$encrypted_user_id&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

