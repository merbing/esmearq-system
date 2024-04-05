<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 

         if(!isset($_GET['service_id']))
         {
            $error_message = "Serviço não encontrado";
            header("Location: lista_servicos.php?error_message=". urlencode($error_message));
             // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
         include("../views/include/head.php");
         include("../../banco/config.php");
         include("consultas/servicos/buscar.php");
         include_once("../config/auth.php");

        if(!$service)
        {
          $error_message = "Serviço não encontrado";
          header("Location: lista_servicos.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }
        if(!in_array("Ver Serviços",$permissoes) ){
         header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
      
      }
    ?>
   </head>
   <body>
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
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card card-statistics">
                           <div class="card-header">
                              <div class="card-heading">
                                 <h4 class="card-title">Editar Serviço <span class="text-info"><?=$service['nome']?></span></h4>
                              </div>
                           </div>
                           <div class="card-body">
                           <form action="processar/servicos/edit/basicas.php" method="post" class="form-horizontal">
                                 <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                 <input type="hidden" name="agencia_id" value="<?php echo $agencia_id ?>">
                                 <input type="hidden" class="form-control" name="password" value="<?php echo $senhaGerada ?>" />
                                 <input type="hidden" name="service_id" value="<?=$service['id']?>" >
                                 <div class="row">
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="novo_servico">Nome do Serviço*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" value="<?=$service['nome']??''?>" id="novo_servico" name="name" placeholder="Nome do Serviço" required />
                                    </div>
                                 </div>
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="tempo">Tempo de Execução (em dias)*</label>
                                    <div class="mb-2">
                                       <input type="number" class="form-control" value="<?=$service['prazo_dias']??'1'?>" id="tempo" name="duracao" placeholder="Tempo Execução" required />
                                    </div>
                                 </div>
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="Valor">Valor*</label>
                                    <div class="mb-2">
                                       <input type="number" class="form-control" name="valor" value="<?=$service['custo']??'0'?>" placeholder="Valor do Serviço" 
                                       required />
                                    </div>
                                 </div>
                                 
                                 </div>
                                 <div class="form-group">
                                    <div class="form-check">
                                       <input required class="form-check-input" type="checkbox" checked id="uagree" name="uagree">
                                       <label class="form-check-label" for="uagree">Eu Confirmo estas informações*</label>
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
         function filterOptions() {
             var input, filter, select, options, option, i, txtValue;
             input = document.getElementById("searchInput");
             filter = input.value.toUpperCase();
             select = document.getElementById("id_cliente");
             options = select.getElementsByTagName("option");
             for (i = 0; i < options.length; i++) {
                 option = options[i];
                 txtValue = option.textContent || option.innerText;
                 if (txtValue.toUpperCase().indexOf(filter) > -1) {
                     option.style.display = "";
                 } else {
                     option.style.display = "none";
                 }
             }
         }
         
         document.addEventListener("DOMContentLoaded", function() {
             document.getElementById("searchInput").addEventListener("input", filterOptions);
         });
         
      </script>
      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>