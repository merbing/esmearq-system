<?php 
      session_start();

        include("../views/include/head.php");
        include("../../banco/config.php");
        require_once("../config/auth.php");
        // include("consultas/clientes/buscar.php");
        include_once("consultas/servicos/dados.php");
       
        include("consultas/clientes/servicos.php");
        
      
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
                            <h4 class="content-title mb-0 my-auto">Serviços solicitados</h4>
                            
                        </div>
                        
                    <a class="btn btn-primary mt-3 text-light" href="solicitar_servico.php">+ Solicitar</a>
            
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
                                <?php if(count($servicos)>0): ?>
                                <?php foreach($servicos as $item): ?>

                                <div class="card mb-3  border-bottom ">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h5 class="card-title "><?=$item['id']?></h5>
                                        <p>Serviço: <span style="font-weight: bold;"><?php echo ($item['service_name']) ?></span> </p>
                                        <p>Cliente: <span style="font-weight: bold;"><?php echo ($item['client_name']) ?></span> </p>
                                        <p>Data de solicitação: <span style="font-weight: bold;"><?php echo ($item['created_at']) ?></span></p>
                                        <p>Estado: <span style="font-weight: bold;"><?php echo $item['estado']==1?"CONCLUÍDO":"PENDENTE" ?></span></p>
                                      </div>
                                </div>
                                
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <h5 class="text-danger text-center mt-3">Sem Serviços Ainda</h5>
                                <?php endif; ?>
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
