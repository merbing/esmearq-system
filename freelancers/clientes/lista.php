<?php 
session_start();
include("../../banco/config.php");
include("../config/auth.php");
include_once("consultas/clientes/dados.php");

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
                            <h4 class="content-title mb-0 my-auto">Meus Clientes</h4>
                        </div>
                    </div>
                    <div>
                        <a href="adicionar.php" class="btn btn-primary">+ Adicionar Cliente</a>
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
                                <!-- <h5 class="card-title">
                                    <a href="lista.php" class="btn btn-primary">Agendadas</a>
                                    <a href="lista.php?estado=concluido" class="btn btn-dark">Concluidas</a>
                                    <a href="lista.php?estado=cancelado" class="btn btn-danger ">Canceladas</a>
                                </h5> -->
                                <?php if(count($clientes)>0): ?>
                                <?php foreach($clientes as $item): ?>

                                <div class="card mb-3  border-bottom ">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h5 class="card-title "><?=$item['id']?></h5>
                                        <p>Nome: <span style="font-weight: bold;"><?php echo ($item['nome']) ?></span> </p>
                                        <p>Email: <span style="font-weight: bold;"><?php echo ($item['email']) ?></span></p>
                                        <p>Telefone: <span style="font-weight: bold;text-transform:uppercase"><?=$item['telefone']?></span></p>
                                        <!-- <p>Quantidade de Processos: <span style="font-weight: bold;text-transform:uppercase"></span></p> -->
                                        <a href="cliente_servicos.php?cliente_id=<?=base64_encode($item['id'])?>" class="btn btn-dark">Serviços</a>
                                        <a href="detalhes.php?cliente_id=<?=base64_encode($item['id'])?>" class="btn btn-primary">Ver Mais</a>
                                    </div>
                                </div>
                                
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <h5 class="text-danger text-center mt-3">Sem Clientes Ainda</h5>
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
</body>
</html>
