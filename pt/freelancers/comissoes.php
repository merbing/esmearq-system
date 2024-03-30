<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         if(!isset($_GET['freelancer_id']))
         {
            
           $error_message = "Freelancer não encontrado";
           header("Location: lista.php?error_message=". urlencode($error_message));
           // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
         include("../views/include/head.php");
         include("../../banco/config.php");
         include("consultas/freelancers/buscar.php");
         include("consultas/freelancers/comissoes.php");
         include_once("../../config/auth.php");
         if(!$freelancer)
         {
            
           $error_message = "Freelancer não encontrado";
           header("Location: lista.php?error_message=". urlencode($error_message));
           // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
         // verificar se  o utilizador tem permissao para ver essa pagina
         if(!in_array("Ver Clientes",$permissoes) ){
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
                              <h1>Comissões do Freelancer - <span class="text-info"><?=$freelancer['nome']?></span> </h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       Informações do Freelancer
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Comissões </li>
                                 </ol>
                              </nav>
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
                  
                
                  
                  <div class="row ">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-body">
                           <div class="datatable-wrapper table-responsive">
                                 <form class="" action="pesquisar_clientes.php" method="get">
                                    <!-- <div class="row">
                                       <div class="col-md-10">
                                          <input placeholder="Pesquise pelos seus clientes aqui..." class="form-control" type="search" name="termo" id="">
                                       </div>
                                       <div class="col">
                                          <button type="submit" class="btn btn-primary">Pesquisar</button>
                                       </div>
                                    </div> -->
                                 </form>
                                 <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                          <th>Nº da Fatura</th>
                                          <th>Cliente</th>
                                          <th>Comissão</th>
                                          <th>Paga</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       
                                       <?php 
                                          
                                       foreach($comissoes as $item): ?>
                                       <tr>
                                          <td><?php echo $item['id_fatura'] ?></td>
                                          <td><?php echo $item['client_name'] ?></td>
                                          <td><?php echo $item['comissao'] ?> AKZ</td>
                                          <td><?php echo $item['pago']==1?"SIM":"NÃO" ?></td>
                                          <!-- <td><?php echo $item['realizado']==1?"SIM":"NÃO" ?></td> -->
                                          <td>
                                             <?php if($item['pago']==0): ?>
                                                <a role="button" data-toggle="modal" data-target="#ModalPagar<?=$item['id']?>" class="btn  btn-primary text-light btn-sm">Pagar</a>
                                             <?php endif;?>
                                             <!-- <a href="dados_cliente.php?cliente_id=<?=base64_encode($item['id']);?>" class="btn btn-sm btn-icon btn-success"><i class="dripicons dripicons-preview"></i></a> -->
                                             <!-- <a href="editar_viagem.php?viagem_id=<?=base64_encode($item['id']);?>" class="btn btn-sm btn-info">Editar</a> -->
                                             <!-- <a role="button" data-toggle="modal" data-target="#Modal<?=$item['id']?>"  class="btn btn-sm  btn-danger text-light">Excluir</a> -->
                                             <!-- MODAL -->
                                             <div class="modal" tabindex="-1" id="ModalPagar<?=$item['id']?>">
                                               <div class="modal-dialog">
                                                   <div class="modal-content">
                                                    <div class="modal-header">
                                                         <h5 class="modal-title">Pagar Comissão</h5>
                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                         </button>
                                                      </div>
                                                      <div class="modal-body">
                                                            <p class="text-info mb-3" style="font-size: 1.4em;">Deseja registar esta comissão como paga?</p>
                                                      </div>
                                                      <div class="modal-footer">
                                                      <a  class="btn btn-danger text-light" href="pagar_comissao.php?freelancer_id=<?=base64_encode($item['id_freelancer']);?>&comissao_id=<?=base64_encode($item['id']);?>" >SIM</a>   
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <!-- END MODAL -->


                                             <!-- MODAL Notify-->
                                             <div class="modal" tabindex="-1" id="ModalNotify<?=$item['id']?>">
                                               <div class="modal-dialog">
                                                   <div class="modal-content">
                                                    <div class="modal-header">
                                                         <h5 class="modal-title">Notificar Cliente</h5>
                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                         </button>
                                                      </div>
                                                      <div class="modal-body">
                                                            <p class="text-warning mb-3" style="font-size: 1.1em;">Deseja notificar <span class="text-info"><?=$item['client_name']?></span> </br>sobre a data da viagem?</p>
                                                            <!-- <div>
                                                               <h5>Cliente: <span style="font-weight: normal;"> <?=$item['client_name']?> </span></h3>
                                                               <h5>Destino: <span style="font-weight: normal;"><?=$item['destino']?> </span></h3>
                                                            </div> -->
                                                      </div>
                                                      <div class="modal-footer">
                                                      <a  class="btn btn-info text-light" href="notificar_viagem.php?viagem_id=<?=base64_encode($item['id']);?>" >Notificar</a>   
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
                        </div>
                     </div>
                  </div>


                  <!-- <div class="row mt-4">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-body">
                              <div class="row justify-content-center align-items-center border-top pt-4 mt-5">
                                 <div class="col-6 border-right">
                                    <h4>Serviços</h4>
                                    <div class="form-group">
                                       <a href="../credito/adicionar?conta_do_cliente="><button class="btn btn-outline-primary">Nova Prestação</button></a>
                                       <a href="../credito/credito_atividade?cliente_selecionado=" ><button class="btn btn-outline-primary">Histórico</button></a>
                                    </div>
                                 </div>
                                 <div class="col-6">
                                    <h4>Conta</h4>
                                    <div class="form-group">
                                       <a href="editar?conta_do_cliente=" ><button class="btn btn-outline-primary">Editar Conta</button></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> -->
                  <!-- <div class="row">
                     <div class="col-xl-3 col-sm-6">
                        <div class="card card-statistics">
                           <div class="card-body">

                              <div class="text-center p-2">
                                 <div class="mb-2">
                                    <img src="../assets/img/file-icon/pdf.png" alt="png-img">
                                 </div>
                                 <h4 class="mb-0">Extrato Báncario Atual</h4>
                                 <a href="" class="btn btn-light" download>Download</a>
                                 <a href="" class="btn btn-dark" download>Impressão</a>

                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-sm-6">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="text-center p-2">
                                 <div class="mb-2">
                                    <img src="../assets/img/file-icon/pdf.png" alt="png-img">
                                 </div>
                                 <h4 class="mb-0">Extrato Báncario Atual</h4>
                                 <a href="" class="btn btn-light" download>Download</a>
                                 <a href="" class="btn btn-dark" download>Impressão</a>

                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-sm-6">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="text-center p-2">
                                 <div class="mb-2">
                                    <img src="../assets/img/file-icon/pdf.png" alt="png-img">
                                 </div>
                                 <h4 class="mb-0">Declaração de Serviço</h4>
                                 <a href="" class="btn btn-light" download>Download</a>
                                 <a href="" class="btn btn-dark" download>Impressão</a>

                              </div>
                           </div>
                        </div>
                     </div>
                  </div> -->
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