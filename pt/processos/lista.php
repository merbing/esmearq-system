<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         include("../../banco/config.php");
         include("../views/include/head.php");
         include("consultas/processos/dados.php");
         include_once("../../config/auth.php");

                    // verificar se  o utilizador tem permissao para ver essa pagina
     if(!in_array("Ver Processo",$permissoes) ){
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
                              <h1>Lista de Processos</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                    Processos
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Lista de Processos</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        <div class="mt-3">
                           <a href="adicionar.php" class="btn btn-info btn-sm">Adicionar</a>
                        </div>
                        <!-- end page title -->
                     </div>
                  </div>
                  <!-- end row -->
                  <div class="row">
                     <div class="col-12 mb-2">
                       

                        <?php
                           // Verifica se há uma mensagem de erro
                           if (isset($_GET['error_message'])) { ?>
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
                            <!-- Verifica se há uma mensagem de aviso -->
                           <?php  if(isset($_GET['warning_message'])): ?>
                           <div class="mt-2 alert alert-warning alert-dismissible fade show" role="alert">
                           <strong>Aviso:</strong> <?php echo urldecode($_GET['warning_message']); ?>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <i class="ti ti-close"></i>
                           </button>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="datatable-wrapper table-responsive">
                                 <form class="" action="pesquisar.php" method="get">
                                    <div class="row">
                                       <div class="col-md-10">
                                          <input placeholder="Pesquise pelos seus processos aqui..." class="form-control" type="search" name="termo" id="">
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
                                          <!-- <th>Descrição</th> -->
                                          <th>Estado</th>
                                          <th>Data de Inicio</th>
                                          <th>Data de Conclusão</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach($processos as $processo): ?>
                                       <tr>
                                          <td><?=$processo['client_name']?></td>
                                          <td><?=$processo['service_name']?></td>
                                          <!-- <td><?=$processo['descricao']?></td> -->
                                          <td style="text-transform: uppercase;"><?=$processo['state_name']?></td>
                                          <td><?=$processo['data_inicio']?></td>
                                          <td><?=$processo['data_fim']?></td>
                                          <td>
                                             <a href="details.php?processo_id=<?php echo base64_encode($processo['id']); ?>" class="btn btn-icon btn-sm btn-success"><i class="dripicons dripicons-preview"></i></a>
                                             
                                             <a role="button" data-toggle="modal" data-target="#Modal<?=$processo['id']?>" class="btn btn-icon btn-sm btn-danger text-light"><i class="dripicons dripicons-trash"></i> </a>
                                             <?php if($processo['state_name']!='terminado'): ?>
                                                <a href="terminar.php?processo_id=<?php echo base64_encode($processo['id']); ?>" class="btn btn-sm btn-info">Terminar</a>
                                             <?php endif; ?>

                                             <!-- MODAL -->
                                             <div class="modal" tabindex="-1" id="Modal<?=$processo['id']?>">
                                               <div class="modal-dialog">
                                                   <div class="modal-content">
                                                    <div class="modal-header">
                                                         <h5 class="modal-title">Excluir Processo</h5>
                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                         </button>
                                                      </div>
                                                      <div class="modal-body">
                                                            <p class="text-warning mb-3" style="font-size: 1.4em;">Tem a certeza que deseja excluir este processo?</p>
                                                            <div>
                                                               <h5>Cliente: <span style="font-weight: normal;"> <?=$processo['client_name']?> </span></h3>
                                                               <h5>Serviço: <span style="font-weight: normal;"><?=$processo['service_name']?> </span></h3>
                                                            </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                      <a  class="btn btn-danger text-light" href="remover.php?processo_id=<?php echo base64_encode($processo['id']); ?>" >Excluir</a>   
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- END MODAL -->
                                          </td>
                                       </tr>
                                       <?php endforeach; ?>
                                    </tbody>
                                    
                                 </table>
                              </div>

                              <!-- END DIV TABLE -->
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