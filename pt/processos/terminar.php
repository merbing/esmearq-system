<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 

         if(!isset($_GET['processo_id']))
         {
            $error_message = "Processo não encontrado";
            header("Location: lista.php?error_message=". urlencode($error_message));
             // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
         include("../views/include/head.php");
         include("../../banco/config.php");
         include("consultas/processos/buscar.php");
         include("consultas/estados/dados.php");
         include("consultas/servicos/dados.php");
         include("../clientes/consultas/clientes/dados.php");
         include("../rh/consultas/funcionarios/dados.php");
         include_once("../config/auth.php");

        if(!$processo)
        {
          $error_message = "Processo não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }

        if(!in_array("Editar Estado de Processo",$permissoes) ){
         header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
      
      }
        
    $query = "SELECT * from processosestado WHERE nome_estado='terminado'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $estado = null;
    if ($result->num_rows > 0) {
            $estado = $result->fetch_assoc();
        }
    else{
        $estado = null;
        }

        if(!$estado)
        {
          $error_message = "Não é possível Terminar processo. Estado 'Terminado' Indisponível'";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
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
                                 <h4 class="card-title">Terminar Processo de <span class="text-info"><?=$processo['client_name']?> - </span><?=$processo['id']?></h4>
                              </div>
                           </div>
                           <div class="card-body">
                            <!-- <h5></h5> -->
                              <form action="processar/processos/editar/terminar.php" method="post" class="form-horizontal">
                                 <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                 <input type="hidden" name="agencia_id" value="<?php echo $agencia_id ?>">
                                 <input type="hidden" name="funcionario_id" value="<?=$id_funcionario?>">
                                 <input type="hidden" name="processo_id" value="<?=$processo['id']?>">
                                 <input type="hidden" name="cliente_email" value="<?=$processo['client_email']?>">
                                 <input type="hidden" name="state_id" value="<?=$estado['id']?>">
                                 <input type="hidden" class="form-control" name="password" value="<?php echo $senhaGerada ?>" />
                                 

                                 <div class="row">
                                 <div class="col-6 form-group">
                                    <h4>Tem a certeza que deseja terminar este processo? </h4>
                                    <div class="mb-2 d-flex align-items-center ">
                                        <label for="terminar" class="control-label">Sim <input type="checkbox" class="ml-2 mt-1" name="terminar" id="terminar" value="1"></label>
                                        
                                    </div>
                                 </div>  
                                          
                                 </div>


                                 
                                 
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-info" name="signup" value="Sign up">Terminar</button>
                                    <a href="lista.php" class="btn  btn-danger">Cancelar</a>
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