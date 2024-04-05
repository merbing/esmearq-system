<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
         include("../views/include/head.php");
         include("../../banco/config.php");
         include_once("../config/auth.php");
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
                              <h1>Gestão de RH</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                    Gestão
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Gerenciamento de RH</li>
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
                  <?php if(in_array("Ver Funcionários",$permissoes) ):?>
                  <div class="row">
                     <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card card-statistics">
                           <div class="card-header">
                              <div class="card-heading">
                                 <h4 class="card-title">Gestão de Funcionários</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <div class="row no-gutters icon-list">
                              <?php if(in_array("Adicionar Funcionário",$permissoes) ):?>
                                 <div class="icon-wrap col-sm-6 col-md-6 col-xl-4"><a href="adicionar.php"><i class="dripicons dripicons-plus"></i><code>Novo Funcionário</code></a></div>
                                 <?php endif;?>
                                 <div class="icon-wrap col-sm-6 col-md-4 col-xl-4"><a href="lista.php"><i class="dripicons dripicons-checklist"></i><code>Todos</code></a></div>
                                 <!-- <div class="icon-wrap col-sm-6 col-md-4 col-xl-4"><a href="lista"><i class="dripicons dripicons-warning"></i><code>Funcionários Desativados</code></a></div> -->
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end container-fluid -->
                  </div>
                  <?php endif;?>
                  <div class="row">
                     <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card card-statistics">
                           <div class="card-header">
                              <div class="card-heading">
                                 <h4 class="card-title">Gestão de Departamentos</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <div class="row no-gutters icon-list">
                                 <div class="icon-wrap col-sm-6 col-md-6 col-xl-4"><a href="adicionar_departamentos.php"><i class="dripicons dripicons-plus"></i><code>Novo Departamento</code></a></div>
                                 <div class="icon-wrap col-sm-6 col-md-4 col-xl-4"><a href="lista_departamentos.php"><i class="dripicons dripicons-checklist"></i><code>Todos</code></a></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end container-fluid -->
                  </div>
                  <?php if(in_array("Ver Cargo",$permissoes) ):?>
                  <div class="row">
                     <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card card-statistics">
                           <div class="card-header">
                              <div class="card-heading">
                                 <h4 class="card-title">Gestão de Permissões Por Cargos</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <div class="row no-gutters icon-list">
                              <?php if(in_array("Novo Cargo",$permissoes) ):?>
                                 <div class="icon-wrap col-sm-6 col-md-6 col-xl-4"><a href="adicionar_papel.php"><i class="dripicons dripicons-plus"></i><code>Novo Papel(Cargo)</code></a></div>
                                 <?php endif;?>
                                 <div class="icon-wrap col-sm-6 col-md-4 col-xl-4"><a href="lista_papeis.php"><i class="dripicons dripicons-checklist"></i><code>Lista de Papeis</code></a></div>
                                 
                                 <!-- <div class="icon-wrap col-sm-6 col-md-6 col-xl-4"><a href="adicionar_permissao.php"><i class="dripicons dripicons-plus"></i><code>Novo Permissão</code></a></div> -->
                                 <!-- <div class="icon-wrap col-sm-6 col-md-4 col-xl-4"><a href="lista_permissoes.php"><i class="dripicons dripicons-checklist"></i><code>Lista de Permissões</code></a></div> -->
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- end container-fluid -->
                  </div>
                  <?php endif;?>
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