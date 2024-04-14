<?php
// echo password_hash("1234",1);
require_once("../../banco/config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try{
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $senha = htmlspecialchars($_POST["pass"]);
        $confirm = htmlspecialchars($_POST["confirm"]);
        $nif = htmlspecialchars($_POST["nif"]);

        if(($name==null || $name=="") || ($email==null || $email=="") || 
        ($senha==null || $senha=="") || ($confirm==null || $confirm=="") || ($nif==null || $nif=="")){
            $error_message = "Preencha os campos obrigatórios";
            header("Location: registar.php?error_message=" . urlencode($error_message));
            exit;
        }

        if($senha != $confirm){
            $error_message = "As senhas devem ser iguais";
            header("Location: registar.php?error_message=" . urlencode($error_message));
            exit;
        }

        // Verificar email ja usado
         // verify email
        $query = "SELECT * FROM clientes WHERE email = '$email' ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error_message = "Este email já está em uso, faça Login";
            header("Location: registar.php?error_message=" . urlencode($error_message));
            exit;
        }

        $password = password_hash($senha,1);
        $query = "INSERT INTO clientes (nome,nif,email,senha,nacionalidade,estado_civil,endereco,telefone,data_de_nascimento) 
        values('$name','$nif','$email','$password','','','','','1970-01-01');";
        $result = $conn->query($query);
        $id = $conn->insert_id;
        
        if ($result === TRUE) {
            $sucess_message = "Dados Actualizados com sucesso!";
            // update session data
            $_SESSION["cliente_id"]   = $id;
            $_SESSION['nome_usuario'] = $name;
            $_SESSION['email_usuario'] = $email;
            
            header("Location: ../home/");
            // header("Location: ../../../conta.php?user_id=".base64_encode($user_id)."&success_message=". urlencode($sucess_message));
            // header("Location: ../../../dados_cliente?conta_do_cliente=$encrypted_user_id&success_message=" . urlencode($sucess_message));
            exit();
     
        } else {
            $encrypted_user_id = base64_encode($cliente_id);
            $error_message = "Não foi possível criar conta. Tente novamente";
            header("Location: registar.php?error_message=" . urlencode($error_message));
            exit;
        }


        // if ($result->num_rows > 0) {
        //     $row = $result->fetch_assoc();
        
        
        //     if (password_verify($senha, $row["senha"])) {
        //     session_start();
            
        //     $_SESSION["cliente_id"] = $row["id"];
        //     $_SESSION["nome_usuario"] = $row["nome"];
        //     $_SESSION["email_usuario"] = $row["email"];
        //     $_SESSION["telefone_usuario"] = $row["telefone"];

        //     // Redirecionando para a área do cliente
        //     header("Location: ../home/");
        //     exit();
        // } else {
        //     // Senha incorreta
        //     $error_message = "A senha passada está incorrecta";
        //     header("Location: login.php?&error_message=" . urlencode($error_message));
        //     exit;
        // }
    // } else {
    //     // Usuário não encontrado
    //     $error_message = "Nenhum usuário encontrado";
    //     header("Location: login.php?&error_message=" . urlencode($error_message));
    //     exit;
    // }
    }catch(Exception $e){
        echo $e->getMessage();
        exit;
        $error_message = "Registo Falhou. Tenta novamente.";
        header("Location: registar.php?&error_message=" . urlencode($error_message));
        exit;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/images/favicon.png" type="image/x-icon">
    <title>Esmearq - Área de Clientes</title>

    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-section">
                    <div class="materialContainer">
                        <div class="box">
                            <div class="login-title">
                                <h3 class="mb-2">Área de Clientes</h3>
                                <h2>Crie sua conta</h2>
                            </div>
                            <form action="" method="post">
                            <div class="input">
                                <label for="name">Nome Completo</label>
                                <input type="text" name="name" id="name" required>
                                <span class="spin"></span>
                            </div>
                            <div class="input">
                                <label for="nif">NIF</label>
                                <input type="text" name="nif" id="nif" required>
                                <span class="spin"></span>
                            </div>
                            <div class="input">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" required>
                                <span class="spin"></span>
                            </div>

                            <div class="input">
                                <label for="pass">Senha</label>
                                <input type="password" name="pass" id="pass" required>
                                <span class="spin"></span>
                            </div>
                            <div class="input">
                                <label for="confirm">Confirma sua senha</label>
                                <input type="password" name="confirm" id="confirm" required>
                                <span class="spin"></span>
                            </div>
                            <div class="w-100 ">
                                <?php if(isset($_GET['error_message'])): ?>
                                <span class=" text-danger text-center d-block"><?= $_GET['error_message']?></span>
                                <?php endif; ?>
                            </div>
                            <div class=" button logn">
                                <button  type="submit" style="background-color: blue; color: white;">
                                    <span>Criar Conta</span>
                                    <i class="fa fa-check"></i>
                                </button>
                            </div>
                            <div class="text-center">
                            Já tem uma conta? <a href="login.php" style="font-weight: bold;text-decoration:underline">Faça Login</a>
                            </div>
                            </form>
                           

                            

                            <!-- <p>Not a member? <a href="sign-up.html" class="theme-color">Sign up now</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- latest jquery-->
        <script src="assets/js/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap js-->
        <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

        <!-- Theme js-->
        <script src="assets/js/script.js"></script>
    </div>
</body>


</html>