<?php
session_start();
require_once("../../../../banco/config.php");
require_once("../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    // $atividade =htmlspecialchars( $_POST["atividade"]);
    try{
        $atividade = htmlspecialchars(mysqli_real_escape_string($conn,$_POST["atividade"]));
    $inicio = $_POST["data_inicio"];
    $fim = $_POST["data_fim"];
    $id_funcionario = $_POST["id_funcionario"];
    $status = $_POST["status"];
    
    if(($_POST['id_funcionario']==null || $_POST['id_funcionario']=='') ){
        $error_message = "Ocorreu um erro. Preenha todos os campos";
        header("Location: ../../adicionar.php?&error_message=" . urlencode($error_message));
        exit;
    }
    
    $query = "INSERT INTO atividadesregistro (funcionario_id, atividade, estado, data_inicio, data_fim)
            VALUES ($id_funcionario, '$atividade', '$status', '$inicio', '$fim');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        $encrypted_user_id = base64_encode($cliente_id);
        $sucess_message = "Atividade cadastrada com sucesso!";
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        $funcionario_id = $_SESSION['funcionario_id'];
        try{
            // Registar a actividade (Log)
            $log = new Log("Adicionando uma atividade",('Actividade:'.$atividade."-INicio:".$inicio."-FIM:".$fim."-FUNCIONARIO:".$funcionario_id),$conn);
            $log->save();
        } catch(\Exception $e)
        {
            
        }
        header("Location: ../../adicionar.php?success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../adicionar.php?&error_message=" . urlencode($error_message));
        exit;
    }
    }catch(Exception $e)
    {
        $error_message = "Ocorreu um erro. Tente novamente mais tarde";
        header("Location: ../../adicionar.php?&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

