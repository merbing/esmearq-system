<?php
session_start();
require_once("../../banco/config.php");

   // $id_code = 
   // verify if there is a check code
   if(isset($_GET['chkcd']) && isset($_GET['idm'])){
      $id_code = base64_decode($_GET['chkcd']);
      $idm = base64_decode($_GET['idm']);

      try{
         $query = "SELECT * FROM check_codes WHERE id = '$id_code'";
              $stmt = $conn->prepare($query);
              $stmt->execute();
              $result = $stmt->get_result();
          
              $code = null;
              if ($result->num_rows > 0) {
                  $code = $result->fetch_assoc();
              }
              else{
               $error_message = "Não foi possível enviar o código. Tente outra vez ";
               header("Location: forgot.php?error_message=".urlencode($error_message));
              exit();
              }
      }catch(Exception $e){
         $error_message = "Não foi possível enviar o código. Tente outra vez ";
          header("Location: forgot.php?error_message=".urlencode($error_message));
         exit();
      }
   }else{
      $error_message = "Não foi possível enviar o código. Tente outra vez ";
      header("Location: forgot.php?error_message=".urlencode($error_message));
      exit();
   }


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
                                <h2>Confirmar Código</h2>
                            </div>
                            <form action="processar/check.php" method="post">
                                 <input type="hidden" name="id_code" value="<?=$code['id']?>">
                                 <input type="hidden" name="idm" value="<?=$idm?>">
                            <div class="col-12">
                                <p class="text-dark">
                                Foi-lhe enviado um código de verificação ao seu e-mail <span class="text-secondary"><?=base64_decode($_GET['idm'])??''?></span>
                              </p>
                            </div>
                            <div class="input">
                                <label for="code">Digite o código</label>
                                <input type="text" name="code" id="code" placeholder="">
                                <span class="spin"></span>
                            </div>
                            

                            <div class="w-100 ">
                                <?php if(isset($_GET['error_message'])): ?>
                                <span class=" text-danger text-center d-block"><?= $_GET['error_message']?></span>
                                <?php endif; ?>
                            </div>
                            <div class=" button logn">
                                <button  type="submit" style="background-color: blue; color: white;">
                                    <span>Confirmar</span>
                                    <i class="fa fa-check"></i>
                                </button>
                            </div>
                            <div>
                                <a href="forgot.php">Não recebí um código</a>
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