<?php

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
                                <h3 class="mb-2">Área de Clientes</h3>
                                <h2>Esqueceu sua Senha?</h2>
                            </div>
                            <form action="processar/forgot.php" method="post">
                            <div class="col-12">
                                <p class="text-dark">
                                    Enviaremos um código de verificação ao seu e-mail se corresponder a uma conta da Esmearq
                              </p>
                            </div>
                            <div class="input">
                                <label for="email">Digite seu email</label>
                                <input type="email" name="email" id="email" placeholder="">
                                <span class="spin"></span>
                            </div>
                            

                            <div class="w-100 ">
                                <?php if(isset($_GET['error_message'])): ?>
                                <span class=" text-danger text-center d-block"><?= $_GET['error_message']?></span>
                                <?php endif; ?>
                            </div>
                            <div class=" button logn">
                                <button  type="submit" style="background-color: blue; color: white;">
                                    <span>Continuar</span>
                                    <i class="fa fa-check"></i>
                                </button>
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