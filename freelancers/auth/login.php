<?php
// echo password_hash("1234",1);
require_once("../../banco/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   try{
    $email = htmlspecialchars(mysqli_real_escape_string($conn,$_POST["email"]));
    $senha = htmlspecialchars(mysqli_real_escape_string($conn,$_POST["pass"]));

    $verificar_usuario = "SELECT * FROM freelancers WHERE email = '$email' AND ativo=1";
    $result = $conn->query($verificar_usuario);
   
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        
        if (password_verify($senha, $row["senha"])) {
            session_start();
            
            $_SESSION["freelancer_id"] = $row["id"];
            $_SESSION["nome_usuario"] = $row["nome"];
            $_SESSION["email_usuario"] = $row["email"];
            $_SESSION["telefone_usuario"] = $row["telefone"];

            // Redirecionando para a área do cliente
            header("Location: ../home/");
            exit();
        } else {
            // Senha incorreta
            $error_message = "A senha passada está incorrecta";
            header("Location: login.php?&error_message=" . urlencode($error_message));
            exit;
        }
    } else {
        // Usuário não encontrado
        $error_message = "Nenhum usuário encontrado";
        header("Location: login.php?&error_message=" . urlencode($error_message));
        exit;
    }
   }catch(Exception $e){
    $error_message = "Autenticação não concluída. Tente novamente";
    header("Location: login.php?&error_message=" . urlencode($error_message));
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
    <title>Esmearq - Área de Freelancer</title>

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
                                <h3 class="mb-2">Área de Freelancers</h3>
                                <h2>Login</h2>
                            </div>
                            <form action="" method="post">
                            <div class="input">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email">
                                <span class="spin"></span>
                            </div>

                            <div class="input">
                                <label for="pass">Password</label>
                                <input type="password" name="pass" id="pass">
                                <span class="spin"></span>
                            </div>
                            <a href="forgot.php" class="pass-forgot mb-3">Esqueceu sua senha?</a>
                            <div class="w-100 ">
                                <?php if(isset($_GET['error_message'])): ?>
                                <span class=" text-danger text-center d-block"><?= $_GET['error_message']?></span>
                                <?php endif; ?>
                            </div>
                            <div class=" button logn">
                                <button  type="submit" style="background-color: blue; color: white;">
                                    <span>Entrar</span>
                                    <i class="fa fa-check"></i>
                                </button>
                            </div>
                            <div class="text-center">
                                Não tem uma conta? <a href="registar.php" style="font-weight: bold;text-decoration:underline">Crie uma conta</a>
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