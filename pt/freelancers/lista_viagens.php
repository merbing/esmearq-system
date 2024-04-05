<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         include("../../banco/config.php");
         include("../views/include/head.php");
         include("consultas/viagens/dados.php");
         include_once("../config/auth.php");

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
                              <h1>Lista de Viagens</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       Clientes
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Lista de Viagens</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        
                        <div class="mt-2">
                              <a href="adicionar_viagem.php" class="btn btn-sm btn-info">Adicionar</a>
                              <a role="button" data-toggle="modal" data-target="#Modal" class="btn btn-warning btn-sm text-light">Notificar Clientes</a>
                              <!-- MODAL Notify-->
                              <div class="modal" tabindex="-1" id="Modal">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title">Notificar Vários Cliente</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <form action="notificar_viagem.php" method="post">
                                       <div class="modal-body">
                                             <p class="text-info mb-3" id="text" style="font-size: 1.1em;">Deseja notificar vários clientes sobre a aproximação de suas viagens?</p>
                                             <div id="form" class="row">
                                             <div class="col-6">
                                                <label for="">Dias restantes para viagem</label>
                                                <input type="number" name="days" id="days" min="1" class="form-control">
                                             </div>
                                             </div>
                                             <div id="spinner" class=" mt-3 text-center">
                                                   <h4 class=" mb-3">Notificando. Por favor aguarde...</h4>
                                                   <img src="../assets/img/loading.gif" width="70px" height="70px" alt="">
                                             </div>
                                             <div id="sucesso" class=" mt-3 text-center">
                                                   <h4 class=" mb-3">Clientes notificados com sucesso!</h4>
                                                   <img src="../assets/img/checked.png" width="70px" height="70px" alt="">
                                             </div>
                                             <div id="error" class=" mt-3 text-center">
                                                   <h4 class=" mb-3">Não foi possível notificar clientes!</h4>
                                                   <img src="../assets/img/remove.png" width="70px" height="70px" alt="">
                                             </div>
                                             <!-- <div>
                                                <h5>Cliente: <span style="font-weight: normal;"> <?=$item['client_name']?> </span></h3>
                                                <h5>Destino: <span style="font-weight: normal;"><?=$item['destino']?> </span></h3>
                                             </div> -->
                                       </div>
                                       <div class="modal-footer" id="botoes">
                                       <a id="notificar" class="btn btn-info text-light">Notificar</a>   
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                       <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                       </div>
                                       </form>
                                    </div>
                                  </div>
                              </div>
                              <!-- END MODAL -->
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
                                 <form class="" action="pesquisar_clientes.php" method="get">
                                    <div class="row">
                                       <div class="col-md-10">
                                          <input placeholder="Pesquise pelos seus clientes aqui..." class="form-control" type="search" name="termo" id="">
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
                                          <th>Data de Viagem</th>
                                          <th>Hora de Viagem</th>
                                          <th>Destino</th>
                                          <th>Realizada</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       
                                       <?php 
                                          
                                       foreach($viagens as $item): ?>
                                       <tr>
                                          <td><?php echo $item['client_name'] ?></td>
                                          <td><?php echo $item['data_viagem'] ?></td>
                                          <td><?php echo $item['hora_viagem'] ?></td>
                                          <td><?php echo $item['destino'] ?></td>
                                          <td><?php echo $item['realizado']==1?"SIM":"NÃO" ?></td>
                                          <td>
                                             <!-- <a href="dados_cliente.php?cliente_id=<?=base64_encode($item['id']);?>" class="btn btn-sm btn-icon btn-success"><i class="dripicons dripicons-preview"></i></a> -->
                                             <a href="editar_viagem.php?viagem_id=<?=base64_encode($item['id']);?>" class="btn btn-sm btn-info">Editar</a>
                                             <a role="button" data-toggle="modal" data-target="#Modal<?=$item['id']?>"  class="btn btn-sm  btn-danger text-light">Excluir</a>
                                             <a role="button" data-toggle="modal" data-target="#ModalNotify<?=$item['id']?>" class="btn  btn-warning text-light btn-sm"><i class="fe fe-bell"></i></a>
                                             <!-- MODAL -->
                                             <div class="modal" tabindex="-1" id="Modal<?=$item['id']?>">
                                               <div class="modal-dialog">
                                                   <div class="modal-content">
                                                    <div class="modal-header">
                                                         <h5 class="modal-title">Excluir Viagem</h5>
                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                         </button>
                                                      </div>
                                                      <div class="modal-body">
                                                            <p class="text-warning mb-3" style="font-size: 1.4em;">Tem a certeza que deseja excluir esta viagem?</p>
                                                            <div>
                                                               <h5>Cliente: <span style="font-weight: normal;"> <?=$item['client_name']?> </span></h3>
                                                               <h5>Destino: <span style="font-weight: normal;"><?=$item['destino']?> </span></h3>
                                                            </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                      <a  class="btn btn-danger text-light" href="remover_viagem.php?viagem_id=<?=base64_encode($item['id']);?>" >Excluir</a>   
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
      <script src="../assets/js/jquery-3.3.1.min.js"></script>
      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
      <script>
         $(document).ready(function(){
            
            $("#spinner").hide();
            $("#sucesso").hide();
            $("#error").hide();

            $("#notificar").click(function(){
               // alert();
               // exit();
               $("#form").hide();
               $("#botoes").hide();
               $("#text").hide();
               $("#sucesso").hide();
               $("#error").hide();
               $("#spinner").fadeIn();

               $.ajax({
                  url: "<?=BASE_URL?>pt/clientes/notificar_viagem.php",
                  method:"POST", 
                  dataType:"json",
                  data:{
                     days: $("#days").val()
                  },
                  success: function(result){
                     console.log(result);
                     if((result != undefined) && (result != null)  )
                     {
                        if( (result.status!= undefined) &&  (result.status!= null) )
                        {
                           if(result.status == "success")
                           {
                              $("#spinner").hide();
                              $("#sucesso").fadeIn();
                           }else{
                              $("#spinner").hide();
                              $("#sucesso").hide();
                              $("#error").fadeIn();
                           }
                        }
                     } 
                  },
                  error: function(xhr){
                     console.log(xhr);
                     alert("An error occured: " + xhr.status + " " + xhr.statusText);
                  }
            });
            
            });



         });
         
      </script>
   </body>
</html>