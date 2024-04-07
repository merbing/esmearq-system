<?php
include("../../banco/config.php");
include_once("../config/auth.php");


if(isset($_GET['cliente_id']))
{
    $id = base64_decode($_GET['cliente_id']);

    try{
        $query = "DELETE FROM clientes WHERE id='$id';";
        $result = $conn->query($query);
    
    
        if ($result === TRUE) {
            $sucess_message = "Cliente Eliminado com sucesso!";
            header("Location: lista.php?success_message=" . urlencode($sucess_message));
            exit();

        } else {
            $error_message = "Ocorreu um erro. Tente novamente";
            header("Location: lista.php?error_message=" . urlencode($error_message));
            exit;
        }
    }catch(Exception $e){
        $error_message = "Ocorreu um erro. Tente novamente #".$e->getMessage();
        header("Location: lista.php?error_message=" . urlencode($error_message));
        exit;
    }
}else {
    $error_message = "Ocorreu um erro. Dados Nao informados";
    header("Location: lista.php?error_message=" . urlencode($error_message));
    exit;
}

?>