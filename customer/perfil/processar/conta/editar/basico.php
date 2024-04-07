<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../config/auth.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   try{
    $client_id = $user_id;
    $name = htmlspecialchars($_POST["nome"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["telefone"]);
    $address = htmlspecialchars($_POST["endereco"]);

    // verify email
    $query = "SELECT * FROM clientes WHERE email = '$email' AND id != '$client_id'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error_message = "Ocorreu um erro. Este email já está em uso";
        header("Location: ../../../conta.php?user_id=".base64_encode($user_id)."&error_message=" . urlencode($error_message));
        exit;
    }

    $query = "UPDATE clientes SET nome = '$name',email='$email',telefone='$phone',endereco='$address'
    WHERE id = '$client_id';";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Dados Actualizados com sucesso!";
        // update session data
        $_SESSION['nome_usuario'] = $name;
        $_SESSION['email_usuario'] = $email;
        $_SESSION['telefone_usuario'] = $phone; 
        $_SESSION['endereco_usuario'] = $address;

        header("Location: ../../../conta.php?user_id=".base64_encode($user_id)."&success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../conta.php?user_id=".base64_encode($user_id)."&error_message=" . urlencode($error_message));
        exit;
    }
   }catch(Exception $e){
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro. Tente novamente mais tarde";
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

