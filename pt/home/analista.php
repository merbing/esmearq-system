<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         include("../banco/config.php");
         include("../views/include/head.php");
         include("consultas/analista.php");
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
                        <!-- end page title -->
                     </div>
                  </div>
                  <!-- end row -->
                  <div class="row">
                     <div class="col-lg-6 col-xxl-4 m-b-30">
                        <div class="card card-statistics h-100 mb-0">
                           <div class="card-header d-flex justify-content-between">
                              <div class="card-heading">
                                 <h4 class="card-title">Créditos Recentes</h4>
                              </div>
                              <div class="dropdown">
                                 <a class="btn btn-round btn-inverse-primary btn-xs" href="#">Ver Todos </a>
                              </div>
                           </div>
                           <div class="card-body">
                              <?php
                                 if ($CreditosPerfilUsuarioresult) {
                                     // Loop para processar os resultados
                                     while ($row = $CreditosPerfilUsuarioresult->fetch_assoc()) {
                                         // Exibir os resultados conforme necessário
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
                                          <small> Criaedo Por <?php echo $user_name?></small>
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
                                 <h4 class="card-title">Solicitacões de Edições</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <ul class="activity">
                                 <?php
                                    if ($SolicitacoesPerfilresult) {
                                        while ($row = $SolicitacoesPerfilresult->fetch_assoc()) {
                                    ?>
                                 <?php 
                                    if($row["status"] == "Aprovado")
                                    {
                                    ?>
                                 <li class="activity-item success">
                                    <div class="activity-info">
                                       <h5 class="mb-0"> <?php echo $row['tipo_solicitacao']?> </h5>
                                       <span>
                                       Data:<?php echo $row['data_solicitacao']?>
                                       </span>
                                       <br>
                                       <span>
                                       <?php echo $row['detalhes_solicitacao']?>
                                       </span>
                                    </div>
                                 </li>
                                 <?php 
                                    }
                                    else {
                                    ?>
                                 <li class="activity-item danger">
                                    <div class="activity-info">
                                       <h5 class="mb-0"> <?php echo $row['tipo_solicitacao']?> </h5>
                                       <span>
                                       Data:<?php echo $row['data_solicitacao']?>
                                       </span>
                                       <br>
                                       <span>
                                       <?php echo $row['detalhes_solicitacao']?>
                                       </span>
                                    </div>
                                 </li>
                                 <?php 
                                    }
                                    ?>
                                 <?php
                                    }
                                    }
                                    ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-8 m-b-30">
                        <div class="card card-statistics h-100 mb-0">
                           <div class="card-header d-flex align-items-center justify-content-between">
                              <div class="card-heading">
                                 <h4 class="card-title">Créditos Pendentes</h4>
                              </div>
                           </div>
                           <div class="card-body scrollbar scroll_dark pt-0" style="max-height: 350px;">
                              <div class="datatable-wrapper table-responsive">
                                 <table id="datatable" class="table table-borderless table-striped">
                                    <thead>
                                    <tr>
                                          <th>ID Do Crédito</th>
                                          <th>Número de Conta</th>
                                          <th>Nome</th>
                                          <th>Montante</th>
                                          <th>Prazo</th>
                                          <th>Estado</th>
                                          <th>Credito</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       
                                       <?php
                                       
                                       $sql = "SELECT * FROM submissao_credito
                                       WHERE status = 'Pendente' ORDER BY id_submissao DESC";
                                                                        
                                                                        $result = $conn->query($sql);
                                                                        
                                                                        if ($result->num_rows > 0) {
                                          // Loop pelos resultados da consulta
                                          while ($row = $result->fetch_assoc()) {
                                                      // Formatar a renda mensal
                                                       if($row["valor_solicitado"]> 0)
                                                       {
                                                          $renda_formatada = number_format($row["valor_solicitado"], 0, ',', '.');
                                                       }
                                                       else{
                                                          $renda_formatada= 0;
                                                       }
                                          ?>
                                       <tr>
                                          <td><?php echo $row["id_submissao"]; ?></td>
                                          <td><?php echo $row["id_cliente"]; ?></td>
                                          <td><?php echo $row["data_submissao"]; ?></td>
                                          <td><?php echo $renda_formatada; ?></td>
                                          <td><?php echo $row["prazo"]; ?></td>
                                          <td><?php echo $row["status"]; ?></td>
                                          <td><a href="gerenciamento/?credito_selecionado=<?php echo $row["id_submissao"]; ?>" class="zmdi zmdi-assignment">Ver Crédito</a></td>
                                       </tr>
                                       <?php
                                          }}
                                          ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                          <th>ID Do Crédito</th>
                                          <th>Número de Conta</th>
                                          <th>Nome</th>
                                          <th>Montante</th>
                                          <th>Prazo</th>
                                          <th>Estado</th>
                                          <th>Credito</th>
                                       </tr>
                                    </tfoot>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
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