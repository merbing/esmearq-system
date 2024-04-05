<?php
session_start();
require_once("../../banco/config.php");
require_once("../config/auth.php");

     // verificar se  o utilizador tem permissao para ver essa pagina
     if(!in_array("Atualizar Clientes",$permissoes) ){
        header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
     
     }
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    try{
        $id = base64_decode($_GET["viagem_id"]);
    
        $query = "DELETE FROM viagens WHERE id=$id;";
        $result = $conn->query($query);
    
    
        if ($result === TRUE) {
         $sucess_message = "Viagem eliminada com sucesso!";
            header("Location: lista_viagens.php?success_message=" . urlencode($sucess_message));
            exit();

        } else {
            $error_message = "Ocorreu um erro.";
            header("Location: lista_viagens.php?error_message=" . urlencode($error_message));
            exit;
        }
    }catch(Exception $e)
    {
        $error_message = "Ocorreu um erro. Tente Novamente";
        header("Location: lista_viagens.php?error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

