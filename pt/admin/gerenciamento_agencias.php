<?php 
   include("../env/auth_check.php");
   include("env/auth_check.php");
   ?>
<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
         include("../views/include/head.php");
         include("../banco/config.php");
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
                              <h1>Gerenciamento de Agências</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       Gerenciamento
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Gerenciamento de Agências</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        <!-- end page title -->
                     </div>
                  </div>
                  <!-- end row -->
                  <div class="row">
                     <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card card-statistics">
                           <div class="card-header">
                              <div class="card-heading">
                                 <h4 class="card-title">Gerenciamento de Agências</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <div class="row no-gutters icon-list">
                                 <div class="icon-wrap col-sm-6 col-md-6 col-xl-4"><a href="agencia_lista"><i class="dripicons dripicons-list"></i><code>Lista de Agências</code></a></div>
                                 <div class="icon-wrap col-sm-6 col-md-4 col-xl-4"><a href="agencia_pesquisar"><i class="dripicons dripicons-search"></i><code>Pesquisar Agências</code></a></div>
                                 <div class="icon-wrap col-sm-6 col-md-4 col-xl-4"><a href="agencia_adicionar"><i class="dripicons dripicons-plus"></i><code>Adicionar Agências</code></a></div>
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