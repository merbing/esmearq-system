<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         if(!isset($_GET['cliente_id']))
         {
            
           $error_message = "Cliente não encontrado";
           header("Location: lista.php?error_message=". urlencode($error_message));
           // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
         include("../views/include/head.php");
         include("../../banco/config.php");
         include("consultas/clientes/buscar.php");
         include("consultas/clientes/processos.php");
         include_once("../../config/auth.php");
         if(!$cliente)
         {
            
           $error_message = "Cliente não encontrado";
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
                              <h1>Informações do Cliente</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       Informações do Cliente
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Informações do Cliente</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        <div class="mt-3">
                           <a href="viagens_cliente.php?cliente_id=<?=base64_encode($cliente['id'])?>" class="btn btn-sm btn-info">Viagens</a>
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
                              <h4 class="mb-1"><?=$cliente['nome']?></h4>
                              <p class="mb-0 text-muted"><a href="javascript:void(0)"></a></p>
                              <ul class="nav justify-content-between mt-4 px-3 py-2">
                                 <li class="flex-fill">
                                    <h3 class="mb-0">Telefone</h3>
                                    <p><?=$cliente['telefone']?></p>
                                 </li>
                                 <li class="flex-fill">
                                    <h3 class="mb-0">Email</h3>
                                    <p><?=$cliente['email']?></p>
                                 </li>
                                 <li class="flex-fill">
                                    <h3 class="mb-0">NIF</h3>
                                    <p><?=$cliente['nif']?></p>
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
                                    <h4 class="text-info"><?=$cliente['nome']?></h4>
                                 </div>
                                 
                                 <div class="col-3">
                                    <h5 class="">Data de Nascimento</h5>
                                    <h4 class="text-info"><?=$cliente['data_de_nascimento']?></h4>
                                 </div>
                                 <div class="col-4">
                                    <h5 class="">Endereço</h5>
                                    <h4 class="text-info"><?=$cliente['endereco']?></h4>
                                 </div>
                                 
                                 <div class="col-4">
                                    <h5 class="">Email</h5>
                                    <h4 class="text-info"><?=$cliente['email']?></h4>
                                 </div>
                                 <div class="col-3">
                                    <h5 class="">NIF</h5>
                                    <h4 class="text-info"><?=$cliente['nif']?></h4>
                                 </div>
                                 
                                 <div class="col-2">
                                    <h5 class="">Estado Civil</h5>
                                    <h4 class="text-info"><?=$cliente['estado_civil']?></h4>
                                 </div>
                                 <div class="col-2">
                                    <h5 class="">Nacionalidade</h5>
                                    <h4 class="text-info"><?=$cliente['nacionalidade']?></h4>
                                 </div>

                              </div>
                              <!-- <ul class="list-unstyled">
                              <li>Nome: <strong><?=$cliente['nome']?></li>
                              <li>Endereço: <strong><?=$cliente['endereco']?></li>
                              <li>NIF:<strong><?=$cliente['nif']?></li>
                              <li>Data de Nascimento: <strong><?=$cliente['data_de_nascimento']?></li>
                              <li>Estado Civil: <strong><?=$cliente['estado_civil']?></li>
                              <li>Nacionalidade: <strong><?=$cliente['nacionalidade']?></li>
                              </ul> -->
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Mais Dados -->
                  <h4>DOCUMENTOS</h4>
                  <div class="row">
                     <?php foreach($documentos as $documento): ?>
                     <div class="col-xl-3 col-sm-6">
                        <div class="card card-statistics">
                           <div class="card-body">

                              <div class="text-center p-2">
                                 <div class="mb-2">
                                    <?php if(  (explode(".",$documento['nome_arquivo']))[1] == "pdf" ): ?>
                                       <img src="../assets/img/file-icon/pdf.png" alt="png-img">
                                    <?php else: ?>
                                       <img src="../assets/img/file-icon/jpg.png" alt="png-img">
                                    <?php endif; ?>
                                    
                                 </div>
                                 <h4 class="mb-3"><?=$documento['nome_documento']?></h4>
                                 <!-- <a href="arquivos/<?=$documento['nome_arquivo']?>" class="btn btn-sm btn-light" download>Download</a> -->
                                 <a href="arquivos/<?=$documento['nome_arquivo']?>" class="btn btn-icon btn-sm btn-info" target="_blank"><i  class="dripicons dripicons-preview"></i></a>
                                 <a href="editar_arquivo.php?file_id=<?=base64_encode($documento['id'])?>" class="btn btn-icon btn-sm btn-info"><i  class="dripicons dripicons-pencil"></i></a>
                                 <a role="button"   class=" btn btn-icon btn-sm btn-danger text-light"
                                 data-toggle="modal" data-target="#Modal<?=$documento['id']?>" ><i  class="dripicons dripicons-trash"></i></a>
                                    <!-- href="processar/cliente/remover_arquivo.php?file_id=<?=base64_encode($documento['id'])?>&cliente_id=<?=base64_encode($cliente['id'])?>" -->
                                 <div class="modal" tabindex="-1" id="Modal<?=$documento['id']?>">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title">Excluir Documento</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                                <p class="text-warning " style="font-size: 1.4em;">Tem a certeza que deseja excluir este documento?</p>
                                          </div>
                                          <div class="modal-footer">
                                          <a  class="btn btn-danger text-light" href="processar/cliente/remover_arquivo.php?file_id=<?=base64_encode($documento['id'])?>&cliente_id=<?=base64_encode($cliente['id'])?>" >Excluir</a>   
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                          </div>
                                        </div>
                                    </div>
                                 </div>
                                 <!-- <a href="" class="btn btn-dark" download>Impressão</a> -->

                              </div>
                           </div>
                        </div>
                     </div>
                     <?php endforeach; ?>
                  </div>

                  <h4 class="mt-5">PROCESSOS</h4>
                  <div class="row ">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-body">
                           <div class="datatable-wrapper table-responsive">
                                 <form class="" action="pesquisar.php" method="get">
                                    <!-- <div class="row">
                                       <div class="col-md-10">
                                          <input placeholder="Pesquise pelos seus processos aqui..." class="form-control" type="search" name="termo" id="">
                                       </div>
                                       <div class="col">
                                          <button type="submit" class="btn btn-primary">Pesquisar</button>
                                       </div>
                                    </div> -->
                                 </form>
                                 <table id="datatable" class="display compact table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                          <!-- <th>Cliente</th> -->
                                          <th>Serviço</th>
                                          <!-- <th>Descrição</th> -->
                                          <th>Estado</th>
                                          <th>Data de Inicio</th>
                                          <th>Data de Conclusão</th>
                                          <th>Funcionário Responsável</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach($processos as $processo): ?>
                                       <tr>
                                          <!-- <td><?=$processo['client_name']?></td> -->
                                          <td><?=$processo['service_name']?></td>
                                          <!-- <td><?=$processo['descricao']?></td> -->
                                          <td style="text-transform: uppercase;"><?=$processo['state_name']?></td>
                                          <td><?=$processo['data_inicio']?></td>
                                          <td><?=$processo['data_fim']?></td>
                                          <td><?=$processo['funcionario_name']?></td>
                                          <td>
                                             <a href="../processos/details.php?processo_id=<?php echo base64_encode($processo['id']); ?>" class="btn btn-icon btn-sm btn-success"><i class="dripicons dripicons-preview"></i></a>
                                             
                                             <a role="button" data-toggle="modal" data-target="#Modal<?=$processo['id']?>" class="btn btn-icon btn-sm btn-danger text-light"><i class="dripicons dripicons-trash"></i> </a>
                                             <?php if($processo['state_name']!='terminado'): ?>
                                                <a href="../processos/terminar.php?processo_id=<?php echo base64_encode($processo['id']); ?>" class="btn btn-sm btn-info">Terminar</a>
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
                                                      <a  class="btn btn-danger text-light" href="../processos/remover.php?processo_id=<?php echo base64_encode($processo['id']); ?>" >Excluir</a>   
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