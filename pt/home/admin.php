<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         include("../../banco/config.php");
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
               <div class="container-fluid">
                  
                  <!-- begin row -->
                  <div class="row">
                     <div class="col-md-12 ">
                        <!-- begin page title -->
                        <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                              <h1>Dashboard</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       Inicío
                                    </li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        </div>
                        <!-- end page title -->
                     </div>
                  </div>
                  <!-- end row -->
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
                  <!-- end row -->
                  <div class="row">
                     <div class="col-lg-6 col-xxl-3 m-b-30">
                        <div class="card card-statistics h-100 mb-0">
                           <div class="card-header">
                              <h4 class="card-title">Estásticas de Crédito</h4>
                           </div>
                           <div class="card-body pt-0">
                              <div class="apexchart-wrapper">
                                <div id="somaEntregueChart"></div>
                              </div>
                              <div class="row text-center justify-content-center">
                                 <div class="col ml-3">
                                    <h4 class="mb-0"><?php echo number_format($somaMontanteConfirmados, 2, ',', '.') ?>kz</h4>
                                    <span> <i class="fa fa-square pr-1 text-primary"></i> Montante Pago </span>
                                 </div>
                                 <div class="col">
                                    <h4 class="mb-0"><?php echo number_format($somaMontanteAtrasadoPendente, 2, ',', '.') ?>kz</h4>
                                    <span> <i class="fa fa-square pr-1 text-info"></i> Montante Pendente</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-xxl-3 m-b-30">
                        <div class="card card-statistics h-100 mb-0 widget-income-list">
                           <div class="card-body d-flex align-itemes-center">
                              <div class="media align-items-center w-100">
                                 <div class="text-left">
                                    <h3 class="mb-0"><?php echo $totalRegistrosUsuarios;?> </h3>
                                    <span>Registros de Usuários</span>
                                 </div>
                                 <div class="img-icon bg-pink ml-auto">
                                    <i class="ti ti-user text-white"></i>
                                 </div>
                              </div>
                           </div>
                           <div class="card-body d-flex align-itemes-center">
                              <div class="media align-items-center w-100">
                                 <div class="text-left">
                                    <h3 class="mb-0"><?php echo $creditosAprovadosRow['totalAprovados'];?> </h3>
                                    <span>Créditos Aprovados</span>
                                 </div>
                                 <div class="img-icon bg-primary ml-auto">
                                    <i class="ti ti-tag text-white"></i>
                                 </div>
                              </div>
                           </div>
                           <div class="card-body d-flex align-itemes-center">
                              <div class="media align-items-center w-100">
                                 <div class="text-left">
                                    <h3 class="mb-0"><?php echo $totalEntregues?>  </h3>
                                    <span>Créditos Entregues</span>
                                 </div>
                                 <div class="img-icon bg-orange ml-auto">
                                    <i class="ti ti-wallet text-white"></i>
                                 </div>
                              </div>
                           </div>
                           <div class="card-body d-flex align-itemes-center">
                              <div class="media align-items-center w-100">
                                 <div class="text-left">
                                    <h3 class="mb-0"><?php echo $creditosReprovadosRow['totalReprovados'];?>  </h3>
                                    <span>Crédito Reprovados</span>
                                 </div>
                                 <div class="img-icon bg-info ml-auto">
                                    <i class="ti ti-slice text-white"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-4 m-b-30">
                        <div class="card card-statistics h-100 mb-0">
                           <div class="card-header">
                              <h4 class="card-title">Cadastro de Novos Clientes Por Agência</h4>
                           </div>
                           <div class="card-body">
                              <?php
                                 // Verificar se há resultados
                                 if ($AgenciasInscritosDiaResult->num_rows > 0) {
                                     // Inicializar a soma total fora do loop
                                     $totalGeralCadastros = 0;
                                 
                                     // Obter o total geral de cadastros
                                     while ($row = $AgenciasInscritosDiaResult->fetch_assoc()) {
                                         $totalGeralCadastros += $row['totalCadastros'];
                                     }
                                 
                                     // Reinicializar o ponteiro do resultado
                                     $AgenciasInscritosDiaResult->data_seek(0);
                                 
                                     // Loop para exibir os resultados
                                     while ($row = $AgenciasInscritosDiaResult->fetch_assoc()) {
                                         // Calcular a porcentagem em relação ao próprio total da agência
                                         $porcentagem = ($row['totalCadastros'] != 0) ? ($row['totalCadastros'] / $totalGeralCadastros) * 100 : 0;
                                 ?>
                              <div class="row jus align-itemes-center no-gutters m-b-10">
                                 <div class="col-sm-12">
                                    <div class="d-flex justify-content-between">
                                       <span><?php echo $row['nome_agencia'] ?></span>
                                       <h5 class="mt-1 mt-sm-0 pl-sm-3 mb-0"><?php echo $row['totalCadastros'] ?></h5>
                                    </div>
                                    <div class="progress my-2" style="height: 5px;">
                                       <div class="progress-bar" role="progressbar" style="width: <?php echo $porcentagem ?>%" aria-valuenow="<?php echo $porcentagem ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                 </div>
                              </div>
                              <?php
                                 }
                                 } else {
                                 echo "Nenhum cadastro encontrado.";
                                 }
                                 ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-xxl-4 m-b-30">
                        <div class="card card-statistics h-100 mb-0">
                           <div class="card-header d-flex justify-content-between">
                              <div class="card-heading">
                                 <h4 class="card-title">Créditos Pendentes</h4>
                              </div>
                              <div class="dropdown">
                                 <a class="btn btn-round btn-inverse-primary btn-xs" href="#">View all </a>
                              </div>
                           </div>
                           <div class="card-body">
                              <?php
                                 if ($CreditosPerfilUsuarioresult) {
                                     while ($row = $CreditosPerfilUsuarioresult->fetch_assoc()) {
                                 ?>
                              <div class="row active-task m-b-20">
                                 <div class="col-xs-1">
                                    <div class="bg-type bg-orange mb-1 mb-xs-0 mt-1">
                                       <span><?php echo $row['nome_cliente_abreviado']?></span>
                                    </div>
                                 </div>
                                 <div class="col-11">
                                    <small class="d-block mb-1">ID Solicitação: #<?php echo $row['id_submissao']?></small>
                                    <h5 class="mb-0"><a href="credito/"><?php echo $row['nome_credito']?></a></h5>
                                    <ul class="list-unstyled list-inline">
                                       <li class="list-inline-item">
                                          <small> Atualizado Por <?php echo $row["nome_funcionario"]?></small>
                                       </li>
                                       <li class="list-inline-item">|</li>
                                       <li class="list-inline-item">
                                          <small><?php echo $row['data_submissao']?></small>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <?php
                                 }
                                 }
                                 ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-xxl-4 m-b-30">
                        <div class="card card-statistics h-100 mb-0">
                           <div class="card-header d-flex justify-content-between">
                              <div class="card-heading">
                                 <h4 class="card-title">Nossos Créditos Aprovados</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <ul class="activity">
                                 <?php
                                    if ($CreditosAprovadosAgenciaresult) {
                                        while ($row = $CreditosAprovadosAgenciaresult->fetch_assoc()) {
                                    ?>
                                 <li class="activity-item success">
                                    <div class="activity-info">
                                       <h5 class="mb-0"><?php echo $row['nome_credito']?> </h5>
                                       <span>
                                       <?php echo $row['data_submissao']?>
                                       </span>
                                       <br>
                                       <span>
                                       <?php echo $row['nome_cliente']?>
                                       </span>
                                    </div>
                                 </li>
                                 <?php
                                    }
                                    }
                                    ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xxl-8 m-b-30">
                        <div class="card card-statistics h-100 mb-0">
                           <div class="card-header d-flex align-items-center justify-content-between">
                              <div class="card-heading">
                                 <h4 class="card-title">Pagamentos Pendentes</h4>
                              </div>
                              <div class="dropdown">
                                 <a class="btn btn-xs" href="#!">Export <i class="zmdi zmdi-download pl-1"></i> </a>
                              </div>
                           </div>
                           <div class="card-body scrollbar scroll_dark pt-0" style="max-height: 350px;">
                              <div class="datatable-wrapper table-responsive">
                                 <table id="datatable" class="table table-borderless table-striped">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Nome</th>
                                          <th>Montante</th>
                                          <th>Data Prevista</th>
                                          <th>Status</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                          if ($PagamentosPendentesResult) {
                                              while ($row = $PagamentosPendentesResult->fetch_assoc()) {
                                          ?>
                                       <tr>
                                          <td><?php echo $row['id_pagamento']?></td>
                                          <td><?php echo $row['nome_cliente']?></td>
                                          <td><?php echo number_format($row['montante_previsto'], 2, ',', '.') ?> kz</td>
                                          <td><?php echo $row["data_prevista"]?></td>
                                          <td><span class="badge badge-danger-inverse"><?php echo $row['status']?></span></td>
                                          <td> <a class="mr-3" href="credito/gerenciamento/pagamento_credito.php?credito_selecionado=<?php echo $row['id_submissao']?>&pagamento_selecionado=<?php echo $row['id_pagamento']?>"><i class="fe fe-edit"></i></a></td>
                                       </tr>
                                       <?php
                                          }
                                          }
                                          ?>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <th>#</th>
                                          <th>Nome</th>
                                          <th>Montante</th>
                                          <th>Data Prevista</th>
                                          <th>Status</th>
                                          <th>Ação</th>
                                       </tr>
                                    </tfoot>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
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