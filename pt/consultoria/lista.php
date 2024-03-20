<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         include("../../banco/config.php");
         include("../views/include/head.php");
         include("consultas/agendamentos/dados.php");
         include_once("consultas/estados/dados.php");
         include_once("../../config/auth.php");

         // verificar se  o utilizador tem permissao para ver essa pagina
       if(!in_array("Ver Lista das Consultorias",$permissoes) ){
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
                              <h1>Lista de Consultorias</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                    Consultas
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Lista de Consultorias</li>
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
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="datatable-wrapper table-responsive">
                                 <form class="" action="pesquisar_consultorias.php" method="get">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <input placeholder="Pesquise pelo nome do cliente" class="form-control" type="search" name="termo" id="">
                                       </div>
                                       <div class="col-3 form-group">
                                    
                                          <div class="mb-2">
                                             <select class="form-control" name="id_state" id="id_cliente" required>
                                                <option selected disabled>Selecionar o estado</option>
                                                <?php foreach($states as $item): ?>
                                                   <option style="text-transform: uppercase;" value="<?=$item['id']?>"><?=$item['nome']?></option>
                                                <?php endforeach;  ?>

                                             </select>
                                          </div>
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
                                          <th>País</th>
                                          <th>Data da Consulta</th>
                                          <th>Estado</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach($consultas as $consulta): ?>
                                       <tr>
                                          <td><?=$consulta['client_name']?></td>
                                          <td><?=$consulta['service_name']?></td>
                                          <td><?=$consulta['pais_destino']?></td>
                                          <td><?=$consulta['data_consulta']?></td>
                                          <td style="text-transform: uppercase;"><?=$consulta['state_name']?></td>
                                          <td>
                                             <a href="details.php?agendamento_id=<?php echo base64_encode($consulta['id']); ?>" class="btn btn-icon btn-success"><i class="dripicons dripicons-preview"></i></a>
                                             <?php if(in_array("Iniciar Consultoria",$permissoes) ):?>
                                             <?php if (  strcmp($consulta['state_name'],"em espera") == 0 ): ?>
                                                <a href="iniciando.php?agendamento_id=<?=base64_encode($consulta['id'])?>" class="btn btn-info">Iniciar</a>
                                             <?php else: ?>
                                             <?php endif; ?>
                                             <?php endif;?>
                                          </td>
                                       </tr>
                                       <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <th>Número de Conta</th>
                                          <th>Nome</th>
                                          <th>Profissão</th>
                                          <th>Sálario</th>
                                          <th>Telefone</th>
                                          <th>Email</th>
                                          <th>Perfil</th>
                                       </tr>
                                    </tfoot>
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