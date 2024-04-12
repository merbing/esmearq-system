<?php
session_start();
require_once("../../banco/config.php");
require_once("../config/auth.php");

     // verificar se  o utilizador tem permissao para ver essa pagina
     if(!in_array("Ver Atividade",$permissoes) ){
        header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
     
     }
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    if(!isset($_GET['atividade_id']) || !isset($_GET['moment'])){
        $error_message = "Ocorreu um erro. Tente novamente";
        header("Location: minhas_atividades.php?error_message=" . urlencode($error_message));
        exit;
    }

    $id = base64_decode($_GET["atividade_id"]);
    $momento = ($_GET["moment"]);
    
    try{
        $query = "UPDATE atividadesregistro SET state = '$momento' WHERE id=$id;";
        $result = $conn->query($query);
    
    
        if ($result === TRUE) {

            try{
                $query = "INSERT INTO momentos (id_atividade,momento) values('$id','$momento');";
                $result = $conn->query($query);
            }catch(Exception $e){

            }

            $sucess_message = "Atividade alterada com sucesso!";
            header("Location: minhas_atividades.php?success_message=" . urlencode($sucess_message));
            exit();

        } else {

            $error_message = "Ocorreu um erro.";
            header("Location: minhas_atividades.php?error_message=" . urlencode($error_message));
            exit;
        }

    }catch(Exception $e){
        $error_message = "Ocorreu um erro.Tente novamente";
        header("Location: minhas_atividades.php?error_message=" . urlencode($error_message));
        exit;
    }

} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

