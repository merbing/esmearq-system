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
                     <div class="col-12">
                        <div class="card card-statistics mail-contant">
                           <div class="card-body p-0">
                              <div class="row no-gutters">
                                 <div class="col-xxl-6 border-t border-xxl-t">
                                    <div class="mail-chat py-5 px-5">
                                       <?php
                                          if(isset($_GET['solicitacao_selecionada'])){
                                          $id_solicitacao_selecionada = $_GET["solicitacao_selecionada"];    
                                          
                                          // Consulta SQL para obter os detalhes da solicitação
                                          $sql = "SELECT se.*, f.nome_funcionario as remetente_nome
                                                  FROM solicitacoes_edicao se
                                                  INNER JOIN funcionarios f ON se.id_solicitante = f.id
                                                  WHERE se.id = $id_solicitacao_selecionada";
                                          $result = $conn->query($sql);
                                          
                                          if ($result->num_rows > 0) {
                                              $row = $result->fetch_assoc();
                                              $tipo_solicitacao = $row["tipo_solicitacao"];
                                              $motivo_solicitacao = $row["detalhes_solicitacao"];
                                              $remetente_nome = $row["remetente_nome"];
                                          
                                              ?>
                                       <div class="media align-items-center">
                                          <div class="bg-img mr-3">
                                          </div>
                                          <div>
                                             <h4 class="mb-0"><?php echo $remetente_nome; ?></h4>
                                             <p><?php echo date("d M Y", strtotime($row["data_solicitacao"])); ?></p>
                                          </div>
                                       </div>
                                       <div class="mt-4 d-flex justify-content-between">
                                          <div>
                                             <h3><?php echo $tipo_solicitacao; ?></h3>
                                          </div>
                                       </div>
                                       <div>
                                          <p class="my-4"><?php echo $motivo_solicitacao; ?></p>
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmarModal">
                                          Confirmar
                                          </button>
                                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#negarModal">
                                          Negar
                                          </button>
                                       </div>
                                       <!-- Modal de Confirmação -->
                                       <div class="modal fade" id="confirmarModal" tabindex="-1" role="dialog" aria-labelledby="confirmarModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                             <form action="processar/mudancas/aprovar.php" method="post">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title" id="confirmarModalLabel">Confirmar Solicitação</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <p>Tem certeza de que deseja confirmar esta solicitação?</p>
                                                      <input type="hidden" name="id_solicitacao" id="confirmarSolicitacaoId"value="<?php echo $id_solicitacao_selecionada; ?>">
                                                      <input type="hidden" name="funcionario_id" value="<?php echo $user_id; ?>">
                                                      <input type="hidden" name="agencia_id" value="<?php echo $agencia_id; ?>">
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                      <button type="submit" class="btn btn-primary" onclick="confirmarSolicitacao()">Confirmar</button>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                       <!-- Modal de Negação -->
                                       <div class="modal fade" id="negarModal" tabindex="-1" role="dialog" aria-labelledby="negarModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                             <form action="processar/mudancas/recusar.php" method="post">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title" id="negarModalLabel">Negar Solicitação</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <p>Tem certeza de que deseja negar esta solicitação?</p>
                                                      <input type="hidden" name="agencia_id" value="<?php echo $agencia_id; ?>">
                                                      <input type="hidden" name="funcionario_id" value="<?php echo $user_id; ?>">
                                                      <input name="id_solicitacao" type="hidden" id="negarSolicitacaoId" value="<?php echo $id_solicitacao_selecionada; ?>">
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                      <button type="submit" class="btn btn-danger" onclick="negarSolicitacao()">Negar</button>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                       <?php
                                          } else {
                                              echo "Solicitação não encontrada.";
                                          }}
                                          else {
                                              header('location: solicitacoes_pedidos');
                                              exit;
                                          }
                                          ?>
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