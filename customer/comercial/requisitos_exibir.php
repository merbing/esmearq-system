<!DOCTYPE html>
<html lang="pt">
<?php 
    include("../views/include/head.php");
    include("../env/auth_check.php");
    include("../env/banco/config.php");
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
                            <h4 class="content-title mb-0 my-auto">Requisitos de Visto</h4>
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
                                        <h4 class="card-title mg-b-10">Requisitos para o País: <?php echo isset($_GET['country']) ? $_GET['country'] : ''; ?></h4>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Requisitos</th>
                                                <th>Detalhes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Documento de Identidade</td>
                                                <td>Passaporte válido</td>
                                            </tr>
                                            <tr>
                                                <td>Comprovante de Residência</td>
                                                <td>Conta de luz ou água recente</td>
                                            </tr>
                                            <!-- Adicione mais requisitos conforme necessário -->
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
