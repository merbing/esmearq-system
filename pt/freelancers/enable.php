<?php
include("../../banco/config.php");
include_once("../config/auth.php");


if(isset($_GET['freelancer_id']))
{
    $id = base64_decode($_GET['freelancer_id']);

    try{
        $query = "UPDATE freelancers SET ativo=1 WHERE id='$id';";
        $result = $conn->query($query);
    
    
        if ($result === TRUE) {
            $sucess_message = "Utilizador activado com sucesso!";
            header("Location: details.php?freelancer_id=".base64_encode($id)."&success_message=" . urlencode($sucess_message));
            exit();

        } else {
            $error_message = "Ocorreu um erro. Tente novamente";
            header("Location: details.php?freelancer_id=".base64_encode($id)."&error_message=" . urlencode($error_message));
            exit;
        }
    }catch(Exception $e){
        $error_message = "Ocorreu um erro. Tente novamente";
        header("Location: details.php?freelancer_id=".base64_encode($id)."&error_message=" . urlencode($error_message));
        exit;
    }
}else {
    $error_message = "Ocorreu um erro. Dados Nao informados";
    header("Location: details.php?freelancer_id=".base64_encode($id)."&error_message=" . urlencode($error_message));
    exit;
}

?>