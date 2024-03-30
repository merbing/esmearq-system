<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 

         if(!isset($_GET['requisito_id']))
         {
          $error_message = "Requisito não encontrado";
          header("Location: lista_requisitos.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
         include("../views/include/head.php");
         include("../../banco/config.php");
         include("consultas/requisitos/buscar.php");
         include("consultas/contas/dados.php");
         include("consultas/servicos/dados.php");
         include("../clientes/consultas/clientes/dados.php");
         include_once("../../config/auth.php");

         if(!$requisito)
         {
            $error_message = "Requisito não encontrado";
            header("Location: lista_requisitos.php?error_message=". urlencode($error_message));
            // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
      //   // verificar se  o utilizador tem permissao para ver essa pagina
      //   if(!in_array("Ver Factura",$permissoes) ){
      //    header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
      
      // }
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
                           <?php
                            // Verifica se há uma mensagem de erro
                            if (isset($_GET['warning_message'])) {
                            ?>
                         <div class="mt-1 alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Aviso:</strong> <?php echo urldecode($_GET['warning_message']); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ti ti-close"></i>
                            </button>
                         </div>
                         <?php } ?> 
                            
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-md-12">
                         <div class="card card-statistics">
                            <div class="card-header">
                               <div class="card-heading">
                                  <h4 class="card-title">Editar Requisitos para  <span class="text-info"><?=$requisito['pais']?></span></h4>
                               </div>
                            </div>
                            <div class="card-body">
                               <form action="processar/requisitos/edit/basicas.php" method="post" class="form-horizontal">
                                 <input type="hidden" name="requisito_id" value="<?=$requisito['id']?>">
                               <div class="row">
                                 <div class="col-5 form-group">
                                    <label class="control-label" for="pais">País*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" value="<?=$requisito['pais']?>" id="pais" name="pais" placeholder="País de destino" required />
                                    </div>
                                 </div>
                                 <div class="col-5 form-group">
                                    <label class="control-label" for="taxa">Taxa de pagamento(AKZ)*</label>
                                    <div class="mb-2">
                                       <input type="number" class="form-control" value="<?=$requisito['taxa']?>" id="taxa" name="taxa" placeholder="Taxa de Pagamento" required />
                                    </div>
                                 </div>
                                 <div class="col-6 form-group">
                                    <label class="control-label" for="Valor">Requisitos*</label>
                                    <div class="mb-2">
                                       <textarea name="requisitos" class="form-control" id="" cols="30" rows="10" placeholder="Preencha os requisitos separados por virgula "><?=$requisito['requisitos']?></textarea>
                                    </div>
                                 </div>
                                 
                                 </div>
                                 <!-- <div class="form-group">
                                    <div class="form-check">
                                       <input required class="form-check-input" type="checkbox" checked id="uagree" name="uagree">
                                       <label class="form-check-label" for="uagree">Eu Confirmo estas informações*</label>
                                    </div>
                                 </div> -->
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
       <script src="../assets/js/jquery-3.3.1.min.js"></script>
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
          
 
          $(document).ready(function(){
 
             $("#id_servico").on("change",function(){
                var option_price = $('option:selected', this).attr('data-price');
                console.log(option_price);
 
                $("#price").val(option_price);
             });
 
          });
       </script>
       <script src="../assets/js/vendors.js"></script>
       <!-- custom app -->
       <script src="../assets/js/app.js"></script>
    </body>
 </html>