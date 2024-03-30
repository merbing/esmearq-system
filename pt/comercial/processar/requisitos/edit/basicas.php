<?php
session_start();
require_once("../../../../../banco/config.php");
require_once("../../../../utils/Log.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    $pais = $_POST["pais"];
    $taxa = $_POST["taxa"];
    $requisitos = $_POST["requisitos"];
    $requisito_id = $_POST['requisito_id'];
   try{
    $query = "UPDATE requisitos SET pais='$pais', taxa=$taxa, requisitos='$requisitos' WHERE id=$requisito_id;";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Requisito Alterado com sucesso!";
        // $_SESSION["success"] = "Papel Cadastrado com sucesso!"; 
        try{
            // Registar a actividade (Log)
            $log = new Log("Alterando um requisito",('Requsito:'.$requisito_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        header("Location: ../../../lista_requisitos.php?success_message=". urlencode($sucess_message));
        // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
        exit();
 
    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../editar_requisito.php?requisito_id=".base64_encode($requisito_id)."&error_message=" . urlencode($error_message));
        exit;
    }

   }catch(Exception $e)
   {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro. Tente Novamente";
        header("Location: ../../../editar_requisito.php?requisito_id=".base64_encode($requisito_id)."&error_message=" . urlencode($error_message));
        exit;
   }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

