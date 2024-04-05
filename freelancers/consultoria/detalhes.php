<?php 
      session_start();

        if(!isset($_GET['agendamento_id']))
        {
          $error_message = "Agendamento não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }
        include("../views/include/head.php");
        include("../../banco/config.php");
        include_once("../config/auth.php");
        include("consultas/agendamentos/buscar.php");
        include_once("consultas/estados/buscar_cancelado.php");
        // var_dump($consulta);
        // exit;
        if(!$consulta)
        {
          $error_message = "Agendamento não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }

        // verificar se  o utilizador tem permissao para ver essa pagina
        // if(!in_array("Ver Lista das Consultorias",$permissoes) ){
        //     header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
         
        //  }
    ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include("../views/include/head.php"); ?>
</head>
<body class="main-body app sidebar-mini Light-mode">
    <!-- Loader -->
    <div id="global-loader" class="light-loader">
        <img src="../assets/img/loaders/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
    <!-- Page -->
    <div class="page">
        <!-- main-sidebar opened -->
        <?php require_once("../views/include/menu.php"); ?>
        <!-- main-sidebar -->
        <!-- main-content -->
        <div class="main-content app-content">
            <!-- main-header -->
            <?php require_once("../views/include/header.php"); ?>
            <!-- /main-header -->
            <!-- mobile-header -->
            <?php require_once("../views/include/mobile_header.php"); ?>
            <!-- mobile-header -->
            <!-- container -->
            <div class="container-fluid">
                <!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">Detalhes da Consultoria</h4>
                        </div>
                    </div>
                    <!-- <?php include("../views/include/cta_btn.php"); ?> -->
                </div>
                <!-- breadcrumb -->
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                            <div>
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
                                <h5 class="card-title">Informações da Consultoria</h5>
                                <p>ID da Consultoria: <span style="font-weight:bold"><?=$consulta['id']??'Não disponível'?></span></p>
                                <p>Cliente: <span style="font-weight:bold"><?=$consulta['client_name']??'Não disponível'?></span></p>
                                <p>Destino: <span style="font-weight:bold"><?=$consulta['pais_destino']??'Não disponível'?></span></p>
                                <p>Data: <span style="font-weight:bold"><?=$consulta['data_consulta']?(date("d-m-Y",strtotime($consulta['data_consulta']))):'Não disponível'?></span></p>
                                <p>Hora:  <span style="font-weight:bold"><?=$consulta['data_consulta']?(date("h:i",strtotime($consulta['data_consulta']))):'Não disponível'?></span></p>
                                <p>Status: <span style="font-weight:bold;text-transform:uppercase"><?=$consulta['state_name']??'Não disponível'?></span></p>
                                <!-- Botão para cancelar a consultoria -->
                                <!-- <?php if($state): ?>
                                    <?php if($state['id']!= $consulta['state_id']): ?>
                                        <button id="cancelar-consultoria" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirmar-cancelamento">Cancelar Consultoria</button>
                                    <?php endif ?>
                                <?php endif; ?> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    <!-- Right-sidebar-->
    <?php require_once("../views/include/menu_notificacoes.php"); ?>
    <!-- Right-sidebar-closed -->
    </div>
    <!--End Page -->
    <?php require_once("../views/include/links_scrpt.php"); ?>

    <!-- Modal de confirmação para cancelar a consultoria -->
    <div class="modal fade" id="modal-confirmar-cancelamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar Cancelamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja cancelar esta consultoria?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <!-- Botão para confirmar o cancelamento -->
                    <a href="processar/agendamentos/editar/cancelar.php?agendamento_id=<?=base64_encode($consulta['id'])?>" class="btn btn-danger">Confirmar</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('cancelar-consultoria').addEventListener('click', function() {
            $('#modal-confirmar-cancelamento').modal('show');
        });
    </script>
</body>
</html>
