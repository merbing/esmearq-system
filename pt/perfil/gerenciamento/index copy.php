<?php include("../../env/auth_check.php");?>
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
                              <h5>Número do Crédito: #<?php echo $id_submissao ?></h5>
                              <h5>Montante do Crédito Solicitado: <?php echo $valor_solicitado_formatado ?>kz</h5>
                              <h5>Data de Solicitação: <?php echo $data_submissao ?></h5>
                              <h5>Status Atual: <?php
                                 $queryCredito = "SELECT * FROM submissao_credito WHERE id_submissao = $credito_id";
                                 $resultCredito = $conn->query($queryCredito);
                                                                     if ($resultCredito->num_rows > 0) {
                                                                        $row = $resultCredito->fetch_assoc();
                                                                        $statussb = $row['status'];
                                  echo $statussb;}?></h5>
                              <h5>Detalhes do Cliente: <?php echo $nome_cliente ?> (ID: <?php echo $id_cliente ?>)</h5>
                              <!-- Informações sobre entrega de crédito -->
                              <h5>Termos do Crédito:</h5>
                              <?php
                                 if ($resultEntregaCredito->num_rows > 0) {
                                     while ($row = $resultEntregaCredito->fetch_assoc()) {
                                         echo "Montante Entregue: AKZ " . $valor_solicitado_formatado . ", Taxa de Juros: " . $taxaJuro . "%, Período de Pagamento: " . $prazo_credito . " meses";
                                     }
                                 }else{
                                    if ($statussb == "Aprovado Por Diretor" && $nivel_aprovacao = "Aprovação Final") {
                                       if ($cargo_id == 2 || $cargo_id == 3) {

                                          ?>
                                          
                              <form action="processar/credito/creditar.php" method="post">
                                 <input type="hidden" name="iva" value="<?php echo $creditoIVA ?>">
                                 <input type="hidden" name="taxa_juros" value="<?php echo $taxaJuro ?>">
                                 <input type="hidden" name="id_historico" value="<?php echo $id_historico ?>">
                                 <input type="hidden" name="id_submissao" value="<?php echo $id_submissao ?>">
                                 <input type="hidden" name="funcionario_id" value="<?php echo $funcionario_id ?>">
                                 <input type="hidden" name="data_credito" value="<?php echo date('y/m/d') ?>">
                                 <input type="hidden" name="status" value="Entregue">
                                 <input type="hidden" name="prazo_credito" value="<?php echo $prazo_credito ?>">
                                 <input type="hidden" name="montante" value="<?php echo $valor_solicitado ?>">
                                 <button class="btn btn-success" type="submit">Disponibilizar Credito</button>
                              </form>
                              <br>
                              <?php
                                 }
                                 }
                                 }
                                 ?>
                              <!-- Histórico de Pagamentos Recentes -->
                              <?php
                                 if ($resultPagamentosCredito->num_rows > 0) {
                                     echo '<h5>Histórico de Pagamentos Recentes:</h5>';
                                     echo "<ul>";
                                     while ($row = $resultPagamentosCredito->fetch_assoc()) {
                                         echo "<li>Data: " . $row['data_prevista'] . ", Montante Pago:  " . $row['montante_confirmado'] . ", Status: " . $row['status'] . "</li>";
                                     }
                                     echo "</ul>";
                                 } else {
                                     echo "Nenhum pagamento registrado.";
                                 }
                                 ?>
                              <br>
                              <!-- Informações sobre atrasos de pagamento -->
                              <?php
                                 if ($resultAtrasosPagamento->num_rows > 0) {
                                     echo '<h5>Informações sobre Atrasos de Pagamento:</h5>';
                                     echo "<ul>";
                                     while ($row = $resultAtrasosPagamento->fetch_assoc()) {
                                         echo "<li>Data de Atraso: " . $row['data_atraso'] . ", Montante de Juros: R$ " . $row['montante_juros'] . ", Status: " . $row['status'] . "</li>";
                                     }
                                     echo "</ul>";
                                 } else {
                                     echo "Nenhum atraso de pagamento registrado.";
                                 }
                                 ?>
                              <!-- Ações Rápidas -->
                              <div class="mt-3">
                                 <?php
                                    if ($cargo_id == 2 || $cargo_id == 3) {
                                       if ($statussb !== "Reprovado Por Diretor" && $statussb !== "Aprovado Por Diretor") {
                                          ?>
                                 <a href="pagina_aprovacao_reprovacao.html" class="btn btn-primary">Aprovação/Reprovação 1</a>
                                 <?php
                                    }
                                    }
                                    elseif ($cargo_id == 1) {
                                    if ($statussb !== "Reprovado Por Supervisor" && $statussb !== "Aprovado Por Supervisor" && $statussb !== "Reprovado Por Diretor" && $statussb !== "Aprovado Por Diretor") {
                                        ?>
                                 <a href="pagina_aprovacao_reprovacao.html" class="btn btn-primary">Aprovação/Reprovação</a>
                                 <?php
                                    }
                                    }
                                    
                                    elseif ($cargo_id == 0) {
                                    if ($statussb !== "Reprovado Por Analista" && $statussb !== "Aprovado Por Analista" && $statussb !== "Reprovado Por Supervisor" && $statussb !== "Aprovado Por Supervisor" && $statussb !== "Reprovado Por Diretor" && $statussb !== "Aprovado Por Diretor") {
                                        ?>
                                 <a href="pagina_aprovacao_reprovacao.html" class="btn btn-primary">Aprovação/Reprovação</a>
                                 <?php
                                    }
                                    }
                                    ?>
                                 <a href="" class="btn btn-dark">Histórico de Pagamentos</a>
                                 <a href="../../clientes/dados_cliente?conta_do_cliente=<?php echo $id_cliente_encript;?>" class="btn btn-light">Detalhes do Cliente</a>
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