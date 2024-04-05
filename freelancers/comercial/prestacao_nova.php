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
                            <h4 class="content-title mb-0 my-auto">Inscrição de Serviço</h4>
                        </div>
                    </div>
                    <?php include("../views/include/cta_btn.php")?>
                </div>
                <!-- breadcrumb -->
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <h5 class="card-title">Selecione o Serviço</h5>
                                <form action="inscrever_servico.php" method="post">
                                    <div class="form-group">
                                        <label for="servico">Serviço:</label>
                                        <select class="form-control" id="servico" name="servico" required>
                                            <option value="" selected disabled>Selecione o serviço</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Inscrever</button>
                                </form>
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
