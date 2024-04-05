<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         include("../../banco/config.php");
         include("../views/include/head.php");
         include("consultas/requisitos/dados.php");
         include_once("../config/auth.php");

         // if(!in_array("Ver Serviços",$permissoes) ){
         //    header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
         
         // }
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
                              <h1>Lista de Requisitos Turisticos</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                    Requisitos Turisticos
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Lista de Serviços</li>
                                 </ol>
                              </nav>
                           </div>

                        </div>

                        <div class="mt-3">
                           <a href="adicionar_requisitos.php" class="btn btn-sm btn-success">Adicionar</a>
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
                              <!-- <div class="datatable-wrapper table-responsive">
                                 <form class="" action="pesquisar_clientes" method="get">
                                    <div class="row">
                                       <div class="col-md-10">
                                          <input placeholder="Pesquise pelos seus servicos aqui..." class="form-control" type="search" name="termo_pesquisa" id="">
                                       </div>
                                       <div class="col">
                                          <button type="submit" class="btn btn-primary">Pesquisar</button>
                                       </div>
                                    </div>
                                 </form>
                                 <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                          <th>ID</th>
                                          
                                          <th>Serviço</th>
                                          <th>Custo</th>
                                          <th>Duração (dias)</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($services as $item): ?>
                                       <tr>
                                          <td><?php echo $item['id'] ?></td>
                                          <td style="text-transform: uppercase;"><?php echo $item['nome'] ?></td>
                                          <td style="text-transform: uppercase;"><?php echo $item['custo'] ?></td>
                                          <td style="text-transform: uppercase;"><?php echo $item['prazo_dias'] ?></td>
                                          <td>
                                             <a href="editar_servico.php?service_id=<?=base64_encode($item['id']);?>" class="btn btn-sm btn-success">Editar</a>
                                            
                                          </td>
                                       </tr>
                                       <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                       
                                    </tfoot>
                                 </table>
                              </div> -->

                              <div class="accordion" id="accordionExample">
                     <?php foreach($requisitos as $item):?>
  <div class="card mb-1">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0 d-flex align-items-center">
        <!-- <button class="btn btn-danger btn-link mr-1" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        >
        </button> -->
        <div class="d-flex align-items-center justify-content-between" style="width: 80%;">
        <a href=""  role="button" class="" data-toggle="collapse" data-target="#collapse<?=$item['id']?>" aria-expanded="true" aria-controls="collapseOne">
            <i class="dripicons dripicons-chevron-down"></i> <span><?=$item['pais']?></span>
         </a> <span class="text-light btn btn-success right"><?=$item['taxa']?> AKZ</span>
        </div>
      </h5>
    </div>

    <div id="collapse<?=$item['id']?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
         <!-- <?=$item['requisitos']?> -->
         <?php $requirements = explode(",",$item['requisitos']);  ?>
         <ul>
            <?php foreach($requirements as $requirement): ?>
               <li><?=$requirement?></li>
            <?php endforeach; ?>
         </ul>
         <a href="editar_requisito.php?requisito_id=<?=base64_encode($item['id'])?>" class="btn btn-sm btn-info mt-3">Editar</a>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

  
  
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