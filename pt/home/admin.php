<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         include("../../banco/config.php");
         include_once("../config/auth.php");
         include("../views/include/head.php");
         include("consultas/admin.php");
         
         ?>
               <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <!-- Inclua o jQuery -->
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <!-- Inclua o ApexCharts -->
      <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
               <div class="container-fluid mb-0">
                  
                  <!-- begin row -->
                  <div class="row">
                     <div class="col-md-12 ">
                        <!-- begin page title -->
                        <div class="d-block d-sm-flex flex-nowrap align-items-center">
                           <div class="page-title ">
                              <h1>Dashboard</h1>
                           </div>
                        </div>
                        
                        <!-- end page title -->
                     </div>
                  </div>
                  <!-- end row -->
                  <div class="row">
                     <div class="col-12 mb-0">
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
                  <!-- end row -->
                  <div class="row mt-5">
                        
                     <div class="col-3">
                        <div class="card p-3">
                           <h3>Clientes</h3>
                           <h4 class="text-info"><?=$clients['count']??0?></h4>
                        </div>
                     </div>
                     <div class="col-3">
                        <div class="card p-3">
                           <h3>Processos</h3>
                           <h4 class="text-info"><?=$processos['count']??0?></h4>
                        </div>
                     </div>
                     <div class="col-3">
                        <div class="card p-3">
                           <h3>Consultorias</h3>
                           <h4 class="text-info"><?=$consultorias['count']??0?></h4>
                        </div>
                     </div>
                     <div class="col-3">
                        <div class="card p-3">
                           <h3>Funcionários</h3>
                           <h4 class="text-info"><?=$funcionarios['count']??0?></h4>
                        </div>
                     </div>

                  </div>

                  <div class="row">
                     <div class="col-4">
                        <div class="card card-statistics h-100 mb-0">
                           <div class="card-header d-flex justify-content-between">
                              <div class="card-heading">
                                 <h4 class="card-title">Paises Mais Requisitados</h4>
                              </div>
                              <div class="dropdown">
                                 <!-- <a class="btn btn-round btn-inverse-primary btn-xs" href="#">View all </a> -->
                              </div>
                           </div>
                           <div class="card-body">
                              <?php if($destinos_preferidos): ?>
                                 <?php foreach($destinos_preferidos as $destino): ?>
                                    <h5 class="text-success"><?=$destino['pais']?></h5>
                                 <?php endforeach; ?>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>

                     <div class="col-4">
                        <div class="card card-statistics h-100 mb-0">
                           <div class="card-header d-flex justify-content-between">
                              <div class="card-heading">
                                 <h4 class="card-title">Serviços Mais Solicitados</h4>
                              </div>
                              <div class="dropdown">
                                 <!-- <a class="btn btn-round btn-inverse-primary btn-xs" href="#">View all </a> -->
                              </div>
                           </div>
                           <div class="card-body">
                              <?php if($servicos_preferidos): ?>
                                 <?php foreach($servicos_preferidos as $servico): ?>
                                    <h5 class="text-success"><?=$servico['nome']?></h5>
                                 <?php endforeach; ?>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="card card-statistics h-100 mb-0">
                           <div class="card-header d-flex justify-content-between">
                              <div class="card-heading">
                                 <h4 class="card-title">Cientes Com mais Viajens</h4>
                              </div>
                              <div class="dropdown">
                                 <!-- <a class="btn btn-round btn-inverse-primary btn-xs" href="#">View all </a> -->
                              </div>
                           </div>
                           <div class="card-body">
                              <?php if($viajantes): ?>
                                 <?php foreach($viajantes as $viajante): ?>
                                    <h5 class="text-success"><?=$viajante['nome']?> <span class=" ml-3 btn-sm btn-info text-light"><?=$viajante['number']?></span></h5>
                                 <?php endforeach; ?>
                              <?php endif; ?>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     
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
      <script>
   var percentualConfirmado = <?php echo $percentualConfirmado; ?>;
   var percentualNaoConfirmado = <?php echo $percentualNaoConfirmado; ?>;
   
   var pieChart = new ApexCharts(document.querySelector("#somaEntregueChart"), {
       chart: {
           type: 'pie',
       },
       labels: ['Confirmado', 'Não Confirmado'],
       series: [percentualConfirmado, percentualNaoConfirmado],
       colors: ['#007BFF', '#FF0000'], // Classes de cores padrão do Bootstrap (primary e info)
       responsive: [{
           breakpoint: 480,
           options: {
               chart: {
                   width: 200
               }
           }
       }]
   });

   pieChart.render();
</script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>