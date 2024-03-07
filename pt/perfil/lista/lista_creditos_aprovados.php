<?php include("../env/auth_check.php");?>
<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         include("../../banco/config.php");
         include("views/include/head.php");
         
         ?>
   </head>
   <body>
      <!-- begin app -->
      <div class="app">
         <!-- begin app-wrap -->
         <!-- begin app-header -->
         <?php include("views/include/header.php");?>
         <?php include("views/include/menu.php");?>
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
                              <h1>Lista de Créditos Aprovados</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       Créditos Aprovados
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Lista de Créditos Aprovados</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        <!-- end page title -->
                     </div>
                  </div>
                  <!-- end row -->
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="datatable-wrapper table-responsive">
                                 <?php
                                    $status = 'Aprovado';
                                    if($cargo_id == 1 || 0){
                                       $sql = "SELECT * FROM submissao_credito
                                            WHERE status LIKE '%$status%' AND id_agencia = '$agencia_id'";
                                    }else{
                                    
                                    $sql = "SELECT * FROM submissao_credito
                                            WHERE status LIKE '%$status%'";}
                                                                                                            
                                                                                                            $result = $conn->query($sql);
                                                                                                            
                                                                                                            if ($result->num_rows > 0) {
                                                                                                            ?>
                                 <form class="" action="pesquisar_credito" method="get">
                                    <div class="row">
                                       <div class="col">
                                          <input placeholder="Pesquise pelos créditos aqui..." class="form-control" type="search" name="termo_pesquisa" id="">
                                       </div>
                                       <div class="col">
                                          <button type="submit" class="btn btn-primary">Pesquisar</button>
                                       </div>
                                    </div>
                                 </form>
                                 <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                          <th>ID Do Crédito</th>
                                          <th>Número de Conta</th>
                                          <th>Data</th>
                                          <th>Montante</th>
                                          <th>Prazo</th>
                                          <th>Estado</th>
                                          <th>Credito</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
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
                                          <td><a href="status_credito?credito_selecionado=<?php echo $row["id_submissao"]; ?>" class="zmdi zmdi-assignment">Ver Crédito</a></td>
                                       </tr>
                                       <?php
                                          }
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
                                 <?php
                                    } else {
                                        echo "Nenhum resultado encontrado.";
                                    }
                                    
                                    // Fechar a conexão
                                    $conn->close();
                                    ?>
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
      <?php include ("assets/js/alerts/adicionar_cliente/info.php");?>
      <script src="assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="assets/js/app.js"></script>
   </body>
</html>