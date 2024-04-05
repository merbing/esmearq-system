<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 

        if(!isset($_GET['processo_id']))
        {
          $error_message = "Processo não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }
        include("../views/include/head.php");
        include("../../banco/config.php");
        include("consultas/processos/buscar.php");
        include_once("../config/auth.php");

        if(!$processo)
        {
          $error_message = "Processo não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }

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
                              <h1>Informações do Processo <span class="text-info"><?=$processo['id']?></span></h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                    Processo
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Detalhes do Processo</li>
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
                           <div class="card-body ">
                            <h4>Dados do Processo <a href="editar_processo.php?processo_id=<?=base64_encode($processo['id'])?>" class="btn btn-info btn-xs ml-2">Editar</a></h4>
                            <div class="row m-1 p-3 border border-grey rounded-lg" style="border-radius: 5px;">
                                <div class="col-3">
                                    <h5>Cliente</h5>
                                    <h4 class="text-secondary"><?=$processo['client_name']?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Serviço</h5>
                                    <h4 class="text-secondary"><?=$processo['service_name']?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Data de Início</h5>
                                    <h4 class="text-secondary " style=";"><?=(explode(" ",$processo['data_inicio']))[0]?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Data de Conclusão</h5>
                                    <h4 class="text-secondary"><?=(explode(" ",$processo['data_fim']))[0]?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Estado</h5>
                                    <h4 class="text-secondary " style="text-transform: uppercase;"><?=$processo['state_name']?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Funcionario Responsável</h5>
                                    <h4 class="text-secondary"><?=$processo['funcionario_name']?></h4>
                                </div>

                            </div>
                            <h4 class="mt-3">Descrição do Processo </h4>
                            <div class="row m-1 p-3 border border-grey rounded-lg" style="border-radius: 5px;">
                                <div class="col-12">
                                    <!-- <h5>Cliente</h5> -->
                                    <h4 class="text-secondary"><?=$processo['descricao']?></h4>
                                </div>
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