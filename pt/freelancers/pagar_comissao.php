<?php
session_start();
require_once("../../banco/config.php");
require_once("../config/auth.php");

     
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    try{
        $id = base64_decode($_GET["comissao_id"]);
        $freelancer_id = base64_decode($_GET["freelancer_id"]);
    
        $query = "UPDATE freelancers_comissoes  SET pago = 1  WHERE id=$id;";
        $result = $conn->query($query);
    
    
        if ($result === TRUE) {
         $sucess_message = "Alterado com sucesso!";
            header("Location: comissoes.php?freelancer_id=".base64_encode($freelancer_id)."&success_message=" . urlencode($sucess_message));
            exit();

        } else {
            $error_message = "Ocorreu um erro.";
            header("Location: comissoes.php?freelancer_id=".base64_encode($freelancer_id)."&error_message=" . urlencode($error_message));
            exit;
        }
    }catch(Exception $e)
    {
        $error_message = "Ocorreu um erro. Tente Novamente";
        header("Location: comissoes.php?freelancer_id=".base64_encode($freelancer_id)."&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

