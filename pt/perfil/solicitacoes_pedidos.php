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
                                 <div class="col-md-8  col-xxl-4 border-md-t">
                                    <div class="mail-content  border-right border-n h-100">
                                       <?php
                                          // Verificar o cargo do usuário e definir a condição da agência
                                          if ($cargo_id == 0) {
                                              // Se o cargo for 0, não mostrar nada
                                              $condicao_agencia = "AND 1 = 0";
                                          } elseif ($cargo_id == 1) {
                                              // Se o cargo for 1, verificar a agência do remetente
                                              $condicao_agencia = "AND f.agencia_id = $agencia_id";
                                          } else {
                                              // Se o cargo for 2 ou 3, mostrar todas as solicitações pendentes
                                              $condicao_agencia = "";
                                          }
                                          
                                          // Consulta SQL para recuperar solicitações pendentes
                                          $sql = "SELECT se.*, f.nome_funcionario as remetente_nome, f.agencia_id
                                          FROM solicitacoes_edicao se
                                          INNER JOIN funcionarios f ON se.id_solicitante = f.id
                                          WHERE se.status = 'Pendente' $condicao_agencia
                                          ORDER BY se.data_solicitacao DESC
                                          ";
                                          
                                          $resultado = $conn->query($sql);
                                          
                                          if ($resultado->num_rows > 0) {
                                              // Exibir as solicitações em um loop
                                              while ($row = $resultado->fetch_assoc()) {
                                                  $remetente_nome = $row["remetente_nome"];
                                                  $solicitacao_id = $row["id"];
                                                  $data_solicitacao = date("h:i A", strtotime($row["data_solicitacao"]));
                                                  $detalhes_solicitacao = $row["detalhes_solicitacao"];
                                          ?>
                                       <div class="mail-msg scrollbar scroll_dark">
                                          <div class="mail-msg-item">
                                             <a href="solicitacoes_detalhes?solicitacao_selecionada=<?php echo $solicitacao_id; ?>">
                                                <div class="media align-items-center">
                                                   <div class="mr-3">
                                                      <div class="bg-img">
                                                      </div>
                                                   </div>
                                                   <div class="w-100">
                                                      <div class="mail-msg-item-titel justify-content-between">
                                                         <p><?php echo $remetente_nome; ?></p>
                                                         <p class="d-none d-xl-block"><?php echo $data_solicitacao; ?></p>
                                                      </div>
                                                      <h5 class="mb-0 my-2"><?php echo $row["tipo_solicitacao"]; ?></h5>
                                                      <p><?php echo $detalhes_solicitacao; ?></p>
                                                      <p class="d-xl-none"><?php echo $data_solicitacao; ?></p>
                                                   </div>
                                                </div>
                                             </a>
                                          </div>
                                       </div>
                                       <?php
                                          }
                                          } else {
                                          // Mensagem caso não haja solicitações pendentes
                                          echo "Nenhuma solicitação pendente.";
                                          }
                                          
                                          // Fechar a conexão com o banco de dados
                                          $conn->close();
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