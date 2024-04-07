<?php
include("../../banco/config.php");
include_once("../config/auth.php");


if(isset($_GET['id']) && isset($_GET['papel_id']))
{
    $permissao_id = base64_decode($_GET['id']);
    $papel_id = base64_decode($_GET['papel_id']);

    try{
        $query = "DELETE FROM permissoesporcargo WHERE id='$permissao_id';";
        $result = $conn->query($query);
    
    
        if ($result === TRUE) {
            $sucess_message = "Permissao eliminada com sucesso!";
            header("Location: lista_papel_permissoes.php?papel_id=".base64_encode($papel_id)."&success_message=" . urlencode($sucess_message));
            exit();

        } else {
            $error_message = "Ocorreu um erro. Tente novamente";
            header("Location: lista_papel_permissoes.php?papel_id=".base64_encode($papel_id)."&error_message=" . urlencode($error_message));
            exit;
        }
        }catch(Exception $e){
            $error_message = "Ocorreu um erro. Tente novamente";
            header("Location: lista_papel_permissoes.php?papel_id=".base64_encode($papel_id)."&error_message=" . urlencode($error_message));
            exit;
        }
}else {
    $error_message = "Ocorreu um erro. Dados Nao informados";
    header("Location: lista_papeis.php?papel_id=".base64_encode($papel_id)."&error_message=" . urlencode($error_message));
    exit;
}

?>