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
                            <h4 class="content-title mb-0 my-auto">Verificar Ganhos por Data Personalizada</h4>
                        </div>
                    </div>
                </div>
                <!-- breadcrumb -->
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="data_inicio">Data de Início:</label>
                                        <input type="date" class="form-control" id="data_inicio" name="data_inicio">
                                    </div>
                                    <div class="form-group">
                                        <label for="data_fim">Data de Fim:</label>
                                        <input type="date" class="form-control" id="data_fim" name="data_fim">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Verificar Ganhos</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /row -->
                <!-- Ganho total -->
                <?php if(isset($_POST['data_inicio']) && isset($_POST['data_fim'])): ?>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Ganhos Totais</h5>
                                <p>Intervalo de datas: <?php echo $_POST['data_inicio']; ?> - <?php echo $_POST['data_fim']; ?></p>
                                <p>Ganho Total: kz 1.500,00</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!-- /Ganho total -->
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
