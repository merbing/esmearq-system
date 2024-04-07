<?php
session_start();
require_once("../../../../../banco/config.php");
// require_once("../../../../utils/Log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // exit;
    try{
        $name = htmlspecialchars($_POST["name"]);
    $nif = htmlspecialchars($_POST["nif"]);
    $birthdate = htmlspecialchars($_POST["birthdate"]);
    $nationality = htmlspecialchars($_POST["nationality"]);
    if(isset($_POST["foreingh_nationality"])){
        $foreingh_nationality = $_POST["foreingh_nationality"];    
    }
    $address = htmlspecialchars($_POST["address"]);
    $phonenumber = htmlspecialchars($_POST["phonenumber"]);
    $email = htmlspecialchars($_POST["email"]);
    $state = htmlspecialchars($_POST["state"]);
    if($nationality == "Outra")
    {
        $nationality = $foreingh_nationality;
    }
    $id_freelancer = $_POST['id_freelancer'];
    $senha = password_hash("1234",1);

    // verify email
    $query = "SELECT * FROM clientes WHERE email = '$email'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error_message = "Ocorreu um erro. Este email já está em uso";
        header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        exit;
    }


    $query = "INSERT INTO clientes (nome, nif, data_de_nascimento, nacionalidade, estado_civil, endereco, telefone,email,id_freelancer,senha)
            VALUES ('$name', '$nif', '$birthdate', '$nationality', '$state', '$address','$phonenumber','$email',$id_freelancer,'$senha');";
    $result = $conn->query($query);
    
    
    if ($result === TRUE) {
        // $encrypted_user_id = $_SESSION['funcionario_id'];
        $sucess_message = "Cliente cadastrado com sucesso!";
        // try{
        //     // Registar a actividade (Log)
        //     $log = new Log("Cadastrando um Cliente de Freelancer",('Client:'.$name."-NIF:".$nif."-NASCIMENTO:".$birthdate."-FUNCIONARIO:".$encrypted_user_id),$conn);
        //     $log->save();
        // } catch(\Exception $e)
        // {
            
        // }
        // $_SESSION["success"] = "Utilizador Cadastrado com sucesso!"; 
        // header("Location: ../../../adicionar.php");
        header("Location: ../../../lista.php?freelancer_id=".base64_encode($id_freelancer)."&success_message=" . urlencode($sucess_message));
        exit();

    } else {
        $encrypted_user_id = base64_encode($cliente_id);
        $error_message = "Ocorreu um erro.";
        header("Location: ../../../adicionar.php?freelancer_id=".base64_encode($id_freelancer)."&error_message=" . urlencode($error_message));
        exit;
    }
    }catch(Exception $e){
        $error_message = "Ocorreu um erro. Tente novamente mais tarde";
        header("Location: ../../../adicionar.php?freelancer_id=".base64_encode($id_freelancer)."&error_message=" . urlencode($error_message));
        exit;
    }
} else {
    // Página de login se o formulário não for submetido via POST
    header("Location: ../../login.php");
    exit();
}

$conn->close();
?>

