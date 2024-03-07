<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
         include("../views/include/head.php");
         include("../../banco/config.php");
         include("../consultas/credito/check_id.php");
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
                     <div class="col-md-12 m-b-30">
                        <!-- begin page title -->
                        <div class="d-block d-sm-flex flex-nowrap align-items-center">
                           <div class="page-title mb-2 mb-sm-0">
                              <h1>Crédito</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="index.html"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       Gerenciamento
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Gerenciamento de Crédito</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        <!-- end page title -->
                     </div>
                  </div>
                  <!-- end row -->
                  <!--start icon contant-->
                  <div class="row">
                     <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card card-statistics">
                           <div class="card-header">
                              <div class="card-heading">
                                 <h4 class="card-title">Gerenciamento de Crédito</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <!-- Informações da Visão Geral -->
                              <h5>Número do Crédito: #123456</h5>
                              <h5>Montante do Crédito Solicitado: R$10,000.00</h5>
                              <h5>Data de Solicitação: 2024-01-20</h5>
                              <h5>Status Atual: Aprovado</h5>
                              <h5>Detalhes do Cliente: John Doe (ID: 123456789)</h5>
                              <h5>Termos do Crédito: Montante Aprovado: R$8,000.00, Taxa de Juros: 5%, Prazo de Pagamento: 12 meses</h5>

                              <!-- Histórico de Pagamentos Recentes -->
                              <h5>Histórico de Pagamentos Recentes:</h5>
                              <ul>
                                 <li>Data: 2024-02-15, Montante Pago: R$800.00, Status: Pago</li>
                                 <li>Data: 2024-03-15, Montante Pago: R$800.00, Status: Pago</li>
                                 <!-- Adicione mais itens conforme necessário -->
                              </ul>

                              <!-- Indicadores de Desempenho (Simulados) -->
                              <h5>Indicadores de Desempenho:</h5>
                              <div class="progress">
                                 <div class="progress-bar bg-success" style="width: 70%" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>

                              <!-- Ações Rápidas -->
                              <div class="mt-3">
                                 <a href="pagina_aprovacao_reprovacao.html" class="btn btn-primary">Aprovação/Reprovação</a>
                                 <a href="pagina_historico_pagamentos.html" class="btn btn-success">Histórico de Pagamentos</a>
                                 <a href="pagina_detalhes_cliente.html" class="btn btn-info">Detalhes do Cliente</a>
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
      <?php include ("../assets/js/alerts/adicionar_cliente/info.php");?>
      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>
