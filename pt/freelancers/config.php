<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
      session_start();

        
         include("../views/include/head.php");
         include("../../banco/config.php");
         include("consultas/freelancers/config/comissao.php");
         // include("consultas/clientes/dados.php");
         include_once("../config/auth.php");
 
        
      // var_dump($config);
      // exit;
         ?>
   </head>
   <body>
      <?php 
         if(isset($_SESSION['success']))
         {
            $message = $_SESSION['success'];
      ?>
         <script>
            alert("<?php echo $message?>");
         </script>
      <?php 
      $_SESSION['success'] = null;
         }
      ?>
      <!-- begin app -->
      <div class="app">
         <!-- begin app-wrap -->
         <!-- begin app-header -->
         <?php include("../views/include/header.php");?>
         <?php include("../views/include/menu.php");?>
         <!-- end app-header -->
         <!-- begin app-main -->
         <!-- begin app-container -->
         <div class="app-container">
            <!-- begin app-main -->
            <div class="app-main" id="main">
               <!-- begin container-fluid -->
               <div class="container-fluid">
                  <!-- begin row -->
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
                  <h3 class="card-title mb-5">Editar Configurações de Freelancers  </h3>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card card-statistics">
                           <div class="card-header">
                              <div class="card-heading">
                                 <h4 class="card-title">Editar Percentagem da comissão  </h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="processar/freelancers/config/comissao.php" method="post" class="form-horizontal">
                              
                                        
                                 <div class="row">
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="date">Percentagem de Comissão(%)</label>
                                    <div class="mb-2">
                                       <input type="number" class="form-control" value="<?=($config!=null && $config['percentagem_comissao']!=null)?$config['percentagem_comissao']:''?>" name="comissao" placeholder="Comissão" required />
                                    </div>
                                 </div>
                                  


                                 </div>
                              
                                 
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Guardar</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
               </div>
               <!-- end container-fluid -->
            </div>
            <!-- end app-main -->
         </div>
         <!-- end app-container -->
         <!-- begin footer -->
      </div>
      <!-- end app-container -->
      </div>
      <!-- end app-wrap -->
      </div>
      <!-- end app -->
      <!-- plugins -->
      <script>
         function handleNacionalidade() {
             var nacionalidadeSelect = document.getElementById('nacionalidade');
             var nacionalidadeInput = document.getElementById('nacionalidade_input');
             var outraNacionalidadeDiv = document.getElementById('outra_nacionalidade');
             
             if (nacionalidadeSelect.value === 'Outra') {
                 outraNacionalidadeDiv.style.display = 'block';
                 nacionalidadeInput.removeAttribute('disabled');
             } else {
                 outraNacionalidadeDiv.style.display = 'none';
                 nacionalidadeInput.setAttribute('disabled', 'disabled');
             }
         }
      </script>
      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>