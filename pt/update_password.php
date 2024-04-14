<?php

if(!isset($_GET['idm']))
{
   $error_message = "Não foi possível enviar o código. Tente outra vez ";
   header("Location: forgot.php?error_message=".urlencode($error_message));
  exit();
}
$mail = base64_decode($_GET['idm']);

?>

<!DOCTYPE html>
<html lang="pt">
   <head>
      <title>ESMEARQ - Operações Internas</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- app favicon -->
      <link rel="shortcut icon" href="assets/img/logoa.png">
      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
      <!-- plugin stylesheets -->
      <link rel="stylesheet" type="text/css" href="assets/css/vendors.css" />
      <!-- app style -->
      <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
   </head>
   <body class="bg-white">
      <!-- begin app -->
      <div class="app">
         <!-- begin app-wrap -->
         <div class="app-wrap">
            <!-- begin pre-loader -->
            <div class="loader">
               <div class="h-100 d-flex justify-content-center">
                  <div class="align-self-center">
                     <img src="assets/img/loader/loader.svg" alt="loader">
                  </div>
               </div>
            </div>
            <!-- end pre-loader -->
            <!--start login contant-->
            <div class="app-contant">
               <div class="bg-white">
                  <div class="container-fluid p-0">
                     <div class="row no-gutters">
                        <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                           <div class="d-flex align-items-center h-100-vh">
                              <div class="login p-50">
                                 <h1 class="mb-2">ESMEARQ</h1>
                                 <h3>Criar uma nova senha</h3>
                                 <div class="row">
                                    <div class="col-12 mb-2">
                                       <?php
                                          // Verifica se há uma mensagem de erro
                                          if (isset($_GET['error_message'])) {
                                          ?>
                                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Erro:</strong> <?php echo urldecode($_GET['error_message']); ?>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <i class="ti ti-close"></i>
                                          </button>
                                       </div>
                                       <?php
                                          }
                                          
                                          // Verifica se há uma mensagem de sucesso
                                          if (isset($_GET['success_message'])) {
                                          ?>
                                       <div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>Sucesso:</strong> <?php echo urldecode($_GET['success_message']); ?>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <i class="ti ti-close"></i>
                                          </button>
                                       </div>
                                       <?php
                                          }
                                          ?>
                                    </div>
                                 </div>
                                 <form action="processar/login_usuarios/update_password.php" method="post" class="mt-3 mt-sm-5">
                                    <input type="hidden" name="email" value="<?=$mail?>">
                                    <div class="row">
                                       <div class="col-12">
                                          <div class="form-group">
                                             <label class="control-label">Nova Senha*</label>
                                             <input type="password" name="new" class="form-control" placeholder="Digite sua senha" required />
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="form-group">
                                             <label class="control-label">Confirmar Senha*</label>
                                             <input type="password" name="confirm" class="form-control" placeholder="Repita a sua senha" required />
                                          </div>
                                       </div>
                                       <!-- <div class="col-12">
                                          <p class="text-dark">
                                            Enviaremos um código de verificação a este e-mail se corresponder a uma conta da Esmearq
                                          </p>
                                       </div> -->
                                       <div class="col-12 mt-3">
                                          <button type="submit" class="btn btn-primary text-uppercase">Guardar</button>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
                           <div class="row align-isstems-center h-100">
                              <div class="col-7 mx-auto ">
                                 <img class="img-fluid" src="assets/img/bg/login.svg" alt="">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--end login contant-->
         </div>
         <!-- end app-wrap -->
      </div>
      <!-- end app -->
      <!-- plugins -->
      <script src="assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="assets/js/app.js"></script>
   </body>
</html>