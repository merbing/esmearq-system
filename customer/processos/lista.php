<?php 
session_start();
include("../../banco/config.php");
include("../config/auth.php");
include_once("consultas/processos/dados.php");
?>
<!DOCTYPE html>
<html lang="pt">
<?php 
    include("../views/include/head.php");
?>

<body class="main-body app sidebar-mini Light-mode">
    <!-- Loader -->
    <div id="global-loader" class="light-loader">
        <img src="../assets/img/loaders/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
    <!-- Page -->
    <div class="page">
        <!-- main-sidebar opened -->
        <?php require_once("../views/include/menu.php")?>
        <!-- main-sidebar -->
        <!-- main-content -->
        <div class="main-content app-content">
            <!-- main-header -->
            <?php require_once("../views/include/header.php")?>
            <!-- /main-header -->
            <!-- mobile-header -->
            <?php require_once("../views/include/mobile_header.php")?>
            <!-- mobile-header -->
            <!-- container -->
            <div class="container-fluid">
                <!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto">Lista de Processos de Serviços</h4>
                        </div>
                    </div>
                </div>
                <!-- breadcrumb -->
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title mg-b-10">Processos de Serviços</h4>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Serviço</th>
                                                <th>Status</th>
                                                <th>Data de Solicitação</th>
                                                <th>Data de Conclusão</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Aqui você pode listar os processos de serviços -->
                                            <?php foreach($processos as $item):  ?>
                                            <tr>
                                                <td><?=$item['service_name']?></td>
                                                <td><?=$item['state_name']?></td>
                                                <td><?=date("d-m-Y",strtotime($item['data_inicio']))?></td>
                                                <td><?=date("d-m-Y",strtotime($item['data_fim']))?></td>
                                                <td><a class="btn btn-sm btn-dark" href="detalhes.php?processo_id=<?=base64_encode($item['id'])?>">Detalhes</a></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            
                                            <!-- Adicione mais processos conforme necessário -->
                                        </tbody>
                                    </table>
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
        <?php require_once("../views/include/menu_notificacoes.php")?>
        <!-- Right-sidebar-closed -->
    </div>
    <!--End Page -->
    <?php require_once("../views/include/links_scrpt.php")?>
</body>
</html>
