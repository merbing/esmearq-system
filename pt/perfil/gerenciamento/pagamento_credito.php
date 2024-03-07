<?php include("../../env/auth_check.php"); ?>
<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php
         include("views/include/head.php");
         include("../../banco/config.php");
         include("consultas/credito/check_id.php");
         include("consultas/geral/info.php");
         $id_parcela_pagamento = $_GET["pagamento_selecionado"];
         
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
                           <?php
                              $queryPagamentosCredito = "SELECT * FROM pagamentos_credito WHERE id_pagamento = $id_parcela_pagamento";
                              $resultPagamentosCredito = $conn->query($queryPagamentosCredito);
                              
                              if ($resultPagamentosCredito->num_rows > 0) {
                                  $row = $resultPagamentosCredito->fetch_assoc();
                                  $montante_formatado = number_format($row['montante_previsto'], 2, ',', '.');
                              
                              ?>
                           <h5>Número do Crédito: #<?php echo $id_submissao ?></h5>
                           <h5>Número da Parcela: #<?php echo $id_parcela_pagamento ?></h5>
                           <h5>Cliente: <?php echo $nome_cliente ?> (ID: <?php echo $id_cliente ?>)</h5>
                           <h5>Estado da Parcela: <?php echo $row["status"]; ?></h5>
                           <h5>Montante Previsto/Confirmado: <?php echo $montante_formatado; ?>kz</h5>
                           <h5>Prazo Previsto: <?php echo $row["data_prevista"]; ?></h5>
                           <h5>Última Atualiação do Pagamento: <?php echo $row["data_confirmacao"]; ?></h5>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <div class="card card-statistics">
                        <div class="card-header">
                           <h4 class="card-title">Pagamentos Parcela:</h4>
                           <div class="card-heading">
                              <?php
                                 $queryStatusPagamentosCredito = "SELECT * FROM pagamentos_credito WHERE id_pagamento = $id_parcela_pagamento  AND data_prevista <= CURDATE()";
                                 $resultStatusPagamentosCredito = $conn->query($queryStatusPagamentosCredito);
                                 
                                 if ($resultStatusPagamentosCredito->num_rows > 0) {
                                     $row = $resultStatusPagamentosCredito->fetch_assoc();
                                 
                                     if ($row["status"] == "Confirmado") {
                                         echo "Pagamento Confirmado";
                                     } else {
                                         ?>
                              <h4 class="card-title">Histórico de Pagamentos Parcela:</h4>
                           </div>
                        </div>
                        <div class="card-body">
                           <form action="processar/credito/atualizar_pagamento.php" method="post">
                              <input type="hidden" name="funcionario_id" value="<?php echo $user_id?>">
                              <input type="hidden" name="agencia_id" value="<?php echo $agencia_id?>">
                              <input type="hidden" name="data_pagamento" value="<?php echo date('y/m/d/h/m/s')?>">
                              <input type="hidden" name="id_submissao" value="<?php echo $id_submissao?>">
                              <input type="hidden" name="pagamento_id" value="<?php echo  $row['id_pagamento']; ?>">
                              <div class="form-group">
                                 <label class="control-label" for="status_pagamento">Status de Pagamento:</label>
                                 <div class="mb-2">
                                    <select class="form-control" name="status_pagamento" id="status_pagamento">
                                       <option disabled selected>Selecionar</option>
                                       <option value="Atrasado">Atrasado</option>
                                       <option value="Confirmado">Pago</option>
                                    </select>
                                 </div>
                              </div>
                              <button class="btn btn-primary" type="submit">Atualizar Pagamento</button>
                           </form>
                           <?php
                              }
                              } else {
                                 echo "Nenhuma transação encontrada ou a data atual não permite a execução desta ação. Por favor, verifique se a transação existe e se está dentro do período adequado para atualizações.";
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
                              <h4 class="card-title">Juros de Demora</h4>
                           </div>
                        </div>
                        <div class="card-body">
                           <?php
                              $queryJurosDemoraCredito = "SELECT * FROM pagamentos_credito WHERE id_pagamento = $id_parcela_pagamento AND data_prevista <= CURDATE()";
                              $resultJurosDemoraCredito = $conn->query($queryJurosDemoraCredito);
                              
                              if ($resultJurosDemoraCredito->num_rows > 0) {
                                  $row = $resultJurosDemoraCredito->fetch_assoc();
                              
                                  if ($row["status"] == "Confirmado") {
                                      echo "Pagamento Confirmado";
                                  } elseif ($row["status"] == "Atrasado") {
                                      ?>
                           <form action="processar/credito/jurso_demora.php" method="post">
                              <div class="form-group">
                                 <div class="mb-2">
                                 
                                    <input type="hidden" value="<?php echo $row['montante_previsto']?>" name="montante_previsto">
                                    <input type="hidden" name="funcionario_id" value="<?php echo $user_id?>">
                                    <input type="hidden" name="agencia_id" value="<?php echo $agencia_id?>">
                                    <input type="hidden" name="data_pagamento" value="<?php echo date('y/m/d/h/m/s')?>">
                                    <input type="hidden" name="id_submissao" value="<?php echo $id_submissao?>">
                                    <input type="hidden" value="<?php echo $row['id_pagamento']; ?>" name="pagamento_id" id="pagamento" required>
                                 </div>
                              </div>
                              <button class="btn btn-danger" type="submit">Adicionar</button>
                           </form>
                           <?php
                              }
                              } else {
                              echo "Nenhuma transação encontrada ou a data atual não permite a execução desta ação. Por favor, verifique se a transação existe e se está dentro do período adequado para atualizações.";
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