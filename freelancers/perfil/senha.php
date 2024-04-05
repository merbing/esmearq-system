<?php 
      session_start();

        include("../../banco/config.php");
        include_once("../config/auth.php");
       
        if(!$user_id)
        {
            $error_message = "Ocorreu um erro. Não tem permissão para ver isto";
            header("Location: ../home/index.php?error_message=". urlencode($error_message));
        }
        try{

            $query = "SELECT senha FROM freelancers  WHERE id = '$user_id' ";
    
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $freelancer = null;
            if ($result->num_rows > 0) {
                $freelancer = $result->fetch_assoc();
            }else{
                $error_message = "Ocorreu um erro. Dados Não disponíveis";
                header("Location: ../home/index.php?error_message=". urlencode($error_message));
            }
            
        }catch(Exception $e)
        {
            $error_message = "Ocorreu um erro. Dados Não disponíveis";
            header("Location: ../home/index.php?error_message=". urlencode($error_message));
        }
        
    ?>
<!DOCTYPE html>
<html lang="pt">
   <?php 
      include("../views/include/head.php");
      ?>
   <body class="main-body app sidebar-mini Light-mode">
      <!-- Loader -->
      <div id="global-loader" class="light-loader">
         <img src="../assets/img/loaders/loader.svg" class="loader-img" alt="Loader">
      </div>
      <!-- /Loader -->
      <!-- Page -->
      <div class="page">
         <!-- main-sidebar opened -->
         <?php require_once("../views/include/menu.php")?>
         <!-- main-sidebar -->
         <!-- main-content -->
         <div class="main-content app-content">
            <!-- main-header -->
            <?php require_once("../views/include/header.php")?>
            <!-- /main-header -->
            <!-- mobile-header -->
            <?php require_once("../views/include/mobile_header.php")?>
            <!-- mobile-header -->
            <!-- container -->
            <div class="container-fluid">
               <!-- breadcrumb -->
               <div class="breadcrumb-header justify-content-between">
                  <div class="my-auto">
                     <div class="d-flex">
                        <h4 class="content-title mb-0 my-auto">Minha Conta</h4>
                        <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Alterar Senha</span>
                     </div>
                  </div>
                  <!-- <?php include("../views/include/cta_btn.php")?> -->
               </div>
               <!-- breadcrumb -->
               <!-- row -->
               <div class="row row-sm">
                  <!-- Col -->
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-body">
                        <div>
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
                           <?php
                              if (isset($_GET['status'])) {
                                  if ($_GET['status'] === 'erro' && isset($_GET['mensagem'])) {
                                      $mensagem_erro = urldecode($_GET['mensagem']);
                                      echo '<div class="alert alert-danger">' . $mensagem_erro . '</div>';
                                  } elseif ($_GET['status'] === 'sucesso') {
                                      $mensagem_sucesso = "Senha atualizada com sucesso";
                                      echo '<div class="alert alert-success">' . $mensagem_sucesso . '</div>';
                                  }
                              }
                              ?>
                           <form method="POST" action="processar/conta/editar/senha.php" class="form-horizontal">
                              <div class="mb-4 main-content-label">Alterar Senha</div>
                              <input type="hidden" value="<?php echo $user_id?>" name="user_id">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label class="form-label">Senha Atual</label>
                                    </div>
                                    <div class="col-md-9">
                                       <input name="atual_password" type="password"  class="form-control" placeholder="Sua Senha Atual" required>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label class="form-label">Nova Senha</label>
                                    </div>
                                    <div class="col-md-9">
                                       <input name="new_password" type="password" class="form-control" placeholder="Nova Senha" required>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <label class="form-label">Reconfirmar Senha</label>
                                    </div>
                                    <div class="col-md-9">
                                       <input name="confirm_password" type="password" class="form-control" placeholder="Reconfirmar Senha" required>
                                    </div>
                                 </div>
                              </div>
                              <div class="card-footer">
                                 <button type="submit" class="btn btn-primary waves-effect waves-light">Atualizar</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!-- /Col -->
               </div>
               <!-- row closed -->
            </div>
            <!-- Container closed -->
         </div>
         <!-- main-content closed -->
         <!-- Right-sidebar-->
         <?php require_once("../views/include/menu_notificacoes.php")?>
         <!-- Right-sidebar-closed -->
      </div>
      <!--End Page -->
      <?php require_once("../views/include/links_scrpt.php")?>
   </body>
</html>