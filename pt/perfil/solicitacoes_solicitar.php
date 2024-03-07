<?php 
   include("../env/auth_check.php");
   ?>
<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
         include("../views/include/head.php");
         include("../banco/config.php");
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
                           <div class="card-body">
                              <div class="row tabs-contant">
                                 <div class="col-xxl-6">
                                    <div class="card card-statistics">
                                       <div class="card-header">
                                          <div class="card-heading">
                                             <h4 class="card-title">Nova Solicitação</h4>
                                          </div>
                                       </div>
                                       <div class="card-body">
                                          <div class="tab">
                                             <form action="processar/mudancas/solicitar.php" method="post" class="form-horizontal">
                                                <div class="form-group">
                                                   <label for="tipo">Tipo de Mudança</label>
                                                   <input type="hidden" name="agencai_id" value="<?php echo $agencia_id ?>">
                                                   <input type="hidden" name="funcionario_id" value="<?php echo $user_id?>">
                                                   <select name="tipo" class="form-control" id="tipo">
                                                      <option value="Conta Cliente">Conta de Cliente</option>
                                                      <option value="Estado de Pagamento">Estado de Pagamento</option>
                                                   </select>
                                                </div>
                                                <div class="form-group">
                                                   <label for="id_item">ID do Item</label>
                                                   <input type="number" class="form-control" id="id_item" placeholder="ID do Item" required name="id_item" />
                                                </div>
                                                <div class="form-group">
                                                   <label for="motivo">Motivo da Solicitação</label>
                                                   <textarea rows="5" class="form-control" id="motivo" placeholder="Motivo da Solicitação" required name="motivo"> </textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Atualizar</button>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
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
        var url = window.location.href;
        var mensagemEncoded = url.split('?mensagem=')[1];
        var mensagemDecoded = decodeURIComponent(mensagemEncoded.replace(/\+/g, ' '));

        alert(mensagemDecoded);
    </script>

      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>