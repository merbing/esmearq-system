<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../config/auth.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $client_id = $user_id;
    $name = $_POST["nome"];
    $email = $_POST["email"];
    $phone = $_POST["telefone"];
    $nif = $_POST["nif"];

    $query = "UPDATE freelancers SET nome = '$name',email='$email',telefone='$phone',nif='$nif'
    WHERE id = '$client_id';";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Dados Actualizados com sucesso!";
        // update session data
        $_SESSION['nome_usuario'] = $name;
        $_SESSION['email_usuario'] = $email;
        $_SESSION['telefone_usuario'] = $phone; 
        $_SESSION['nif_usuario'] = $nif;

        header("Location: ../../../conta.php?user_id=".base64_encode($user_id)."&success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../conta.php?user_id=".base64_encode($user_id)."&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

