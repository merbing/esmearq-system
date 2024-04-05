
<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
         include("../views/include/head.php");
         include("../banco/config.php");
         include_once("../config/auth.php");
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
                                             <h4 class="card-title">Atualizar Estado do Processo</h4>
                                          </div>
                                       </div>
                                       <div class="card-body">
                                          <div class="tab">
                                             <form enctype="multipart/form-data" action="" method="post" class="form-horizontal">
                                                <div class="form-group">
                                                    <input type="hidden" name="id_produto" value="<?php echo $produto_selecionado?>">
                                                   <label for="nome_produto">Nome do Cliente</label>
                                                   <input type="text" value=""  class="form-control" id="nome_produto" name="nome_cliente" disabled placeholder="Nome do Cliente"  />
                                                </div>
                                                <div class="form-group">
                                                   <label for="servico_nome">Tipo de Serviço</label>
                                                   <input type="text" value="" class="form-control" id="servico_nome" name="servico_nome" placeholder="Serviço" disabled  />
                                                </div>
                                                <div class="form-group">
                                                   <label for="data_inicio">Data de Inicío</label>
                                                   <input  value="" type="date" class="form-control" id="data_inicio" name="data_inicio" disabled placeholder="Montante" />
                                                </div>
                                                </div>
                                                <div class="form-group">
                                                   <label for="data_termino">Data Prevista de Termino</label>
                                                   <input  value="" type="date" class="form-control" id="data_termino" name="data_termino" disabled placeholder="Montante" />
                                                </div>
                                                <div class="form-group">
                                                   <label for="status">Estado do Processo</label>
                                                   <select class="form-control" name="status" id="status"  required>
                                                      <option value="Selecionar" selected>
                                                      </option>
                                                      <option value="1">1</option>
                                                      <option value="0">1</option>
                                                   </select>
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

      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>