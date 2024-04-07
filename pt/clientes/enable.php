<?php
include("../../banco/config.php");
include_once("../config/auth.php");


if(isset($_GET['cliente_id']))
{
    $id = base64_decode($_GET['cliente_id']);

    try{
        $query = "UPDATE clientes SET ativo=1 WHERE id='$id';";
        $result = $conn->query($query);
    
    
        if ($result === TRUE) {
            $sucess_message = "Utilizador activado com sucesso!";
            header("Location: dados_cliente.php?cliente_id=".base64_encode($id)."&success_message=" . urlencode($sucess_message));
            exit();

        } else {
            $error_message = "Ocorreu um erro. Tente novamente";
            header("Location: dados_cliente.php?cliente_id=".base64_encode($id)."&error_message=" . urlencode($error_message));
            exit;
        }
    }catch(Exception $e){
        $error_message = "Ocorreu um erro. Tente novamente";
        header("Location: dados_cliente.php?cliente_id=".base64_encode($id)."&error_message=" . urlencode($error_message));
        exit;
    }
}else {
    $error_message = "Ocorreu um erro. Dados Nao informados";
    header("Location: dados_cliente.php?cliente_id=".base64_encode($id)."&error_message=" . urlencode($error_message));
    exit;
}

?>