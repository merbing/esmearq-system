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
         // include("consultas/clientes/processos.php");
         include_once("../config/auth.php");
         if(!$freelancer)
         {
            
           $error_message = "Freelancer não encontrado";
           header("Location: lista.php?error_message=". urlencode($error_message));
           // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
         // verificar se  o utilizador tem permissao para ver essa pagina
         // if(!in_array("Ver Clientes",$permissoes) ){
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
                              <h1>Informações do Freelancer</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       Freelancer
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Informações</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        <div class="mt-3">
                           <a href="freelancer_clientes.php?freelancer_id=<?=base64_encode($freelancer['id'])?>" class="btn btn-sm btn-info">Ver Clientes</a>
                           <a href="editar_freelancer.php?freelancer_id=<?=base64_encode($freelancer['id'])?>" class="btn btn-sm btn-dark">Editar</a>
                           <?php if($freelancer['ativo']==1): ?>
                                 <a class="btn btn-sm btn-danger text-light" data-toggle="modal" data-target="#ModalDisable">Desactivar conta</a>
                              <?php else:?>
                                 <a class="btn btn-sm btn-success text-light" data-toggle="modal" data-target="#ModalEnable">Activar Conta</a>
                              <?php endif;?>

                              
                              <div class="modal" tabindex="-1" id="ModalDisable">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                       <h4 class="modal-title">Desactivar conta de utilizador?</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                       </div>
                                       <div class="modal-body">
                                          <p class="text-dark">Se desativar, este Freelancer deixará de ter acesso ao sistema</p>
                                       </div>
                                       <div class="modal-footer">
                                          <a href="disable.php?freelancer_id=<?=base64_encode($freelancer['id'])?>" class="btn btn-danger text-light" >Desactivar</a>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
                                       </div>
                                    </div>
                                 </div>
                                 </div>

                                 <div class="modal" tabindex="-1" id="ModalEnable">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                       <h4 class="modal-title">Activar conta de utilizador?</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                       </div>
                                       <div class="modal-body">
                                          <p class="text-dark">Se activar, este Freelancer poderá ter acesso ao sistema</p>
                                       </div>
                                       <div class="modal-footer">
                                          <a href="enable.php?freelancer_id=<?=base64_encode($freelancer['id'])?>" class="btn btn-success text-light" >Activar</a>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
                                       </div>
                                    </div>
                                 </div>
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
                  <!-- <div class="card card-statistics widget-social-box1 px-2">
                     <div class="card-body pb-3 pt-4">
                        <div class="text-center">
                           <div class="pt-1 bg-img m-auto"><img class="img-fluid" src="../assets/img/avtar/user.jfif" alt="socialwidget-img"></div>
                           <div class="mt-3">
                              <h4 class="mb-1"><?=$freelancer['nome']?></h4>
                              <p class="mb-0 text-muted"><a href="javascript:void(0)"></a></p>
                              <ul class="nav justify-content-between mt-4 px-3 py-2">
                                 <li class="flex-fill">
                                    <h3 class="mb-0">Telefone</h3>
                                    <p><?=$freelancer['telefone']?></p>
                                 </li>
                                 <li class="flex-fill">
                                    <h3 class="mb-0">Email</h3>
                                    <p><?=$freelancer['email']?></p>
                                 </li>
                                 <li class="flex-fill">
                                    <h3 class="mb-0">NIF</h3>
                                    <p><?=$freelancer['nif']?></p>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div> -->
                  <!-- Cliente Info -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-body">
                              <!-- <h4 class="card-title">Informações Básica:</h4> -->
                              <div class="row">
                                 <div class="col-4 mb-3">
                                    <h5 class="">Nome</h5>
                                    <h4 class="text-info"><?=$freelancer['nome']?></h4>
                                 </div>
                                 <div class="col-4">
                                    <h5 class="">Email</h5>
                                    <h4 class="text-info"><?=$freelancer['email']?></h4>
                                 </div>
                                 <div class="col-4">
                                    <h5 class="">Telefone</h5>
                                    <h4 class="text-info"><?=$freelancer['telefone']?></h4>
                                 </div>
                                 
                                 <div class="col-4">
                                    <h5 class="">NIF</h5>
                                    <h4 class="text-info"><?=$freelancer['nif']?></h4>
                                 </div>
                                 
                                 <div class="col-4">
                                    <h5 class="">BANCO</h5>
                                    <h4 class="text-info"><?=$freelancer['banco']?></h4>
                                 </div>
                                 <div class="col-4">
                                    <h5 class="">Numero da Conta</h5>
                                    <h4 class="text-info"><?=$freelancer['numero_da_conta']?></h4>
                                 </div>
                                 <div class="col-4">
                                    <h5 class="">IBAN</h5>
                                    <h4 class="text-info"><?=$freelancer['iban']?></h4>
                                 </div>
                                 <div class="col-4">
                                    <h5 class="">Estado da Conta</h5>
                                    <h4 class="text-info"><?=$freelancer['ativo']==1?"Activada":"Desactivada"?></h4>
                                 </div>

                              </div>
                             
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Mais Dados -->
                  

                  


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