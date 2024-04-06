
<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
      //   include("../banco/config.php");
        include("../views/include/head.php");
        include("../../banco/config.php");
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
               <div class="mb-2">
                     <a href="agencies_list.php" class="btn btn-sm btn-dark">Volta a Lista</a>
                  </div>
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
                                             <h4 class="card-title">Adicionar Nova Agência</h4>
                                          </div>
                                       </div>
                                       <div class="card-body">
                                          <div class="tab">
                                             <form action="processar/agencias/adicionar/basico.php" method="post" class="form-horizontal">
                                                <div class="form-group">
                                                   <label for="nome_agencia">Nome da Agência</label>
                                                   <input type="text" class="form-control" id="nome_agencia" name="nome" placeholder="Nome da Agência" required />
                                                </div>
                                                <div class="form-group">
                                                   <label for="endereco">Endereço</label>
                                                   <input type="endereco" class="form-control" id="endereco" name="endereco" placeholder="Endereço" required />
                                                </div>
                                                <div class="form-group">
                                                   <label for="provincia">Província</label>
                                                   <input type="provincia" class="form-control" id="provincia" name="provincia" placeholder="Província" required />
                                                </div>
                                                <div class="form-group">
                                                   <label for="telefone">Telefone</label>
                                                   <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required />
                                                </div>
                                                <button type="submit" class="btn btn-primary">Adicionar</button>
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