<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST["name"];
    $nif = $_POST["nif"];
    $birthdate = $_POST["birthdate"];
    $nationality = $_POST["nationality"];
    if(isset($_POST["foreingh_nationality"])){
        $foreingh_nationality = $_POST["foreingh_nationality"];    
    }
    $address = $_POST["address"];
    $phonenumber = $_POST["phonenumber"];
    $email = $_POST["email"];
    $state = $_POST["state"];
    $cliente_id = $_POST['id'];
    if($nationality == "Outra")
    {
        $nationality = $foreingh_nationality;
    }
    $query = "UPDATE clientes SET nome='$name', nif='$nif', data_de_nascimento='$birthdate', nacionalidade='$nationality', 
            estado_civil='$state', endereco='$address', telefone='$phonenumber',email='$email' WHERE id=$cliente_id";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        
        $sucess_message = "Dados alterados com sucesso!";
        $funcionario_id = $_SESSION['funcionario_id'];
        try{
            // Registar a actividade (Log)
            $log = new Log("Editando um Cliente",('Client:'.$name."-NIF:".$nif."-NASCIMENTO:".$birthdate."-FUNCIONARIO:".$funcionario_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        header("Location: ../../../dados_cliente.php?cliente_id=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../cliente_files.php?conta_do_cliente=$encrypted_user_id&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

