<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         include("../../banco/config.php");
         include("../views/include/head.php");
         include("consultas/faturas/pesquisar.php");
         include_once("../../config/auth.php");
         if(!in_array("Ver Factura",$permissoes) ){
            header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
         
         }
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
                              <h1>Lista de Faturas</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                    Faturas
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Lista de Faturas</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        <div class="mt-3">
                           <a href="adicionar_faturas.php" class="btn btn-info btn-sm">Adicionar</a>
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
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="datatable-wrapper table-responsive">
                                 <form class="" action="pesquisar_faturas.php" method="get">
                                    <div class="row">
                                       <div class="col-md-10">
                                          <input placeholder="Pesquise pelas suas faturas aqui..." class="form-control" 
                                          type="search" name="termo" id="">
                                       </div>
                                       <div class="col">
                                          <button type="submit" class="btn btn-primary">Pesquisar</button>
                                       </div>
                                    </div>
                                 </form>
                                 <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                          <th>Cliente</th>
                                          <th>Serviço</th>
                                          <th>Empresa</th>
                                          <th>Valor</th>
                                          <th>Desconto aplicado</th>
                                          <th>Pago</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach($faturas as $item): ?>
                                       <tr>
                                          <td><?=$item['client_name']?></td>
                                          <td><?=$item['service_name']?></td>
                                          <td><?=$item['nome_empresa']?></td>
                                          <td><?=$item['valor']?></td>
                                          <td><?=$item['desconto']?>%</td>
                                          <td style="text-transform: uppercase;"><?=($item['pago']==1)?'SIM':'NÃO'?></td>
                                          
                                          <td>
                                             <a href="details_fatura.php?fatura_id=<?php echo base64_encode($item['id']); ?>" class="btn btn-icon btn-sm btn-success"><i class="dripicons dripicons-preview"></i></a>
                                             <a href="print.php?fatura_id=<?php echo base64_encode($item['id']); ?>" class="btn btn-sm  btn-info">Imprimir</a>
                                          
                                          </td>
                                       </tr>
                                       <?php endforeach; ?>
                                    </tbody>
                                    
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
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>