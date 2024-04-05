<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         include("../../banco/config.php");
         include("../views/include/head.php");
         include("consultas/papeis/permissoes.php");
         include("consultas/permissoes/dados.php");
         include_once("../config/auth.php");

         if(!in_array("Ver Cargo",$permissoes) ){
            header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
         
         }
         ?>
   </head>
   <body>
   <?php 
         if(isset($_SESSION['success']))
         {
            $message = $_SESSION['success'];
      ?>
         <div class="modal" tabindex="-1" id="ModalMessage">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Concluído</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?=$message?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
      <?php 
      $_SESSION['success'] = null;
         }
      ?>


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
                              <h1>Lista de Permissões do <?=$papel['nome']?></h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                    Atividades Diária
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Lista de Atividades</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        <div class="mt-3">
                           <a href="#" role="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#MyModal">Adicionar</a>
                        </div>
                        <div>
                        <div class="modal" tabindex="-1" id="MyModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar Permissão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="processar/papeis/adicionar_info/permissao.php" method="post">
      <div class="modal-body">
      
         <input type="hidden" name="papel_id" value="<?=$papel['id']?>">
          <div class="form-group">
          <select class="form-control" name="permissao_id" id="estado_civil" required>
                                          <option selected disabled>Selecionar Permissão</option>
                                          <?php foreach($permitions as $permition): ?>
                                             <option value="<?=$permition['id']?>"><?=$permition['permissao']?></option>
                                          <?php endforeach; ?>
                                       </select>
          </div>
       
      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary" >Adicionar</button>
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
      </form>
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
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="datatable-wrapper table-responsive">
                                 <form class="" action="pesquisar_clientes" method="get">
                                    <div class="row">
                                       <div class="col-md-10">
                                          <input placeholder="Pesquise pelos seus funcionarios aqui..." class="form-control" type="search" name="termo_pesquisa" id="">
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
                                          
                                          <th>Permissão</th>
                                          <th>Ação</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($papel_permitions as $item): ?>
                                       <tr>
                                          <td><?php echo $item['id'] ?></td>
                                          <td><?php echo $item['permissao'] ?></td>
                                          <td>
                                             <a href="show.php?id=<?=base64_encode($item['id']);?>" class="btn btn-icon btn-success"><i class="dripicons dripicons-preview"></i></a>
                                              
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
      <script>
         $(document).ready(function(){

            $('#ModalMessage').modal('show')
            
         })
        
      </script>
   </body>
</html>