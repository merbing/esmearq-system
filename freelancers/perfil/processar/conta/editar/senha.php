<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../config/auth.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST["user_id"];;
    $atual = $_POST["atual_password"];
    $new = $_POST["new_password"];
    $confirm = $_POST["confirm_password"];

    try{

        $query = "SELECT senha FROM freelancers  WHERE id = '$id' ";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $freelancer = null;
        if ($result->num_rows > 0) {
            $freelancer = $result->fetch_assoc();
        }else{
            $error_message = "Ocorreu um erro. Dados Não disponíveis";
            header("Location: ../../../senha.php?error_message=". urlencode($error_message));
        }
        

        if(password_verify($atual,$freelancer['senha'])){
            if($new == $confirm)
            {
                $senha = password_hash($new,1);
            $query = "UPDATE freelancers SET senha = '$senha'
            WHERE id = '$id';";
            $result = $conn->query($query);
            
            
            if ($result === TRUE) {
                // $encrypted_user_id = base64_encode($cliente_id);
                $sucess_message = "Senha Actualizada com sucesso!";
        
                header("Location: ../../../senha.php?user_id=".base64_encode($user_id)."&success_message=". urlencode($sucess_message));
                // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
                exit();
         
            } else {
                // $encrypted_user_id = base64_encode($cliente_id);
                $error_message = "Ocorreu um erro. Tente novamente";
                header("Location: ../../../senha.php?user_id=".base64_encode($user_id)."&error_message=" . urlencode($error_message));
                exit;
            }
            }else{
            $error_message = "Senha de confirmação deve ser igual a nova senha";
            header("Location: ../../../senha.php?error_message=". urlencode($error_message));

            }
        }else{
            $error_message = "Senha Errada";
            header("Location: ../../../senha.php?error_message=". urlencode($error_message));
        }

        
    }catch(Exception $e)
    {
        $error_message = "Ocorreu um erro. Dados Não disponíveis";
        header("Location: ../../../senha.php?error_message=". urlencode($error_message));
    }

    

    
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

