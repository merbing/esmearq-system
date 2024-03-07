<?php include("../../env/auth_check.php"); ?>
<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php
         include("views/include/head.php");
         include("../../banco/config.php");
         include("consultas/credito/check_id.php");
         include("consultas/geral/info.php");
         ?>
   </head>
   <body>
      <div class="app">
      <?php include("../views/include/header.php"); ?>
      <?php include("../views/include/menu.php"); ?>
      <div class="app-container">
         <div class="app-main" id="main">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-12 m-b-30">
                     <div class="d-block d-sm-flex flex-nowrap align-items-center">
                        <div class="page-title mb-2 mb-sm-0">
                           <h1>Gerenciamento de Crédito</h1>
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
                                 <li class="breadcrumb-item active text-primary" aria-current="page">Histórico de Crédito</li>
                              </ol>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <div class="card card-statistics">
                        <div class="card-header">
                           <div class="card-heading">
                              <h4 class="card-title">Detalhes do Crédito</h4>
                           </div>
                        </div>
                        <div class="card-body">
                           <!-- Informações sobre o crédito -->
                           <h5>Número do Crédito: #<?php echo $id_submissao ?></h5>
                           <h5>Cliente: <?php echo $nome_cliente ?> (ID: <?php echo $id_cliente ?>)</h5>
                           <h5>Status Atual: <?php echo $statussb; ?></h5>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <div class="card card-statistics">
                        <div class="card-header">
                           <div class="card-heading">
                              <h4 class="card-title">Histórico de Pagamentos Recentes</h4>
                           </div>
                        </div>
                        <div class="card-body">
                           <?php
                              if ($resultPagamentosCredito->num_rows > 0) {
                                  ?>
                           <table id="datatable" class="display compact table table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th>Parcela</th>
                                    <th>Data Prevista</th>
                                    <th>Status Atual</th>
                                    <th>Montante</th>
                                    <th>Ação</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    // Reinicie o resultado para percorrê-lo novamente
                                    $resultPagamentosCredito->data_seek(0);
                                    while ($row = $resultPagamentosCredito->fetch_assoc()) {
                                    ?>
                                 <tr>
                                    <td><?php echo $row["parcela"]; ?></td>
                                    <td><?php echo $row["data_prevista"]; ?></td>
                                    <td><?php echo $row["status"]; ?></td>
                                    <td><?php echo  number_format($row['montante_previsto'], 2, ',', '.') ?>kz</td>
                                    <td><a href="pagamento_credito.php?credito_selecionado=<?php echo $id_submissao; ?>&pagamento_selecionado=<?php echo $row["id_pagamento"]; ?>" class="zmdi zmdi-assignment">Ver Crédito</a></td>
                                 </tr>
                                 <?php
                                    }
                                    ?>
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <th>Parcela</th>
                                    <th>Data Prevista</th>
                                    <th>Status Atual</th>
                                    <th>Montante</th>
                                    <th>Ação</th>
                                 </tr>
                              </tfoot>
                           </table>
                           <?php
                              } else {
                                  echo "Nenhum pagamento registrado.";
                              }
                              ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <div class="card card-statistics">
                        <div class="card-header">
                           <div class="card-heading">
                              <h4 class="card-title">Dívidas Pendentes</h4>
                           </div>
                        </div>
                        <div class="card-body">
                           <!-- Informações sobre atrasos de pagamento -->
                           <?php
                              if ($resultAtrasosPagamento->num_rows > 0) {
                                 ?>
                                 <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                          <th>ID do Atraso</th>
                                          <th>Data Prevista</th>
                                          <th>Status Atual</th>
                                          <th>Montante</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                  while ($row = $resultAtrasosPagamento->fetch_assoc()) {
                                    ?>
                                 <tr>
                                    <td><?php echo $row["id_atraso"]; ?></td>
                                    <td><?php echo $row["data_atraso"]; ?></td>
                                    <td><?php echo $row["status"]; ?></td>
                                    <td><?php echo  number_format($row['montante_juros'], 2, ',', '.'); ?>kz</td>
                                    <td><a href="atraso_credito.php?atraso_selecionado=<?php echo $row["id_atraso"]; ?>&credito_selecionado=<?php echo $id_submissao; ?>&pagamento_selecionado=<?php echo $row["id_pagamento"]; ?>" class="zmdi zmdi-assignment">Ver Crédito</a></td>
                                 </tr>
                                 <?php
                                    }
                                    ?>
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <th>Parcela</th>
                                    <th>Data Prevista</th>
                                    <th>Status Atual</th>
                                    <th>Montante</th>
                                    <th>Ação</th>
                                 </tr>
                              </tfoot>
                           </table>
                           <?php
                              } else {
                                  echo "Nenhum pagamento registrado.";
                              }
                              ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php include("../assets/js/alerts/adicionar_cliente/info.php"); ?>
      <script src="../assets/js/vendors.js"></script>
      <script src="../assets/js/app.js"></script>
   </body>
</html>