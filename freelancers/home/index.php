<!DOCTYPE html>
<html lang="pt">
<head>
    <?php 
        include("../views/include/head.php");
        // include("../env/auth_check.php");
        include("../../banco/config.php");
        include("../config/auth.php");
        
        
    ?>
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
                            <h4 class="content-title mb-0 my-auto"><span style="font-weight: normal;">Bem-vindo,</span> <?php echo $_SESSION['nome_usuario']; ?></h4>
                        </div>
                    </div>
                    <!-- <?php include("../views/include/cta_btn.php")?> -->
                </div>
                <!-- breadcrumb -->
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title mg-b-10">O que você gostaria de fazer hoje?</h4>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-4 mb-4">
                                            <a href="../perfil/conta.php" class="text-decoration-none">
                                                <div class="card rounded-10 shadow">
                                                    <div class="card-body text-center">
                                                        <i class="mdi mdi-account-circle menu__icon"></i>
                                                        <h5 class="card-title mt-3">Meu Perfil</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <a href="../consultoria/agendar.php" class="text-decoration-none">
                                                <div class="card rounded-10 shadow">
                                                    <div class="card-body text-center">
                                                        <i class="mdi mdi-earth menu__icon"></i>
                                                        <h5 class="card-title mt-3">Meus Clientes</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <a href="../financeiro/comissoes.php" class="text-decoration-none">
                                                <div class="card rounded-10 shadow">
                                                    <div class="card-body text-center">
                                                        <i class="mdi mdi-file-document menu__icon"></i>
                                                        <h5 class="card-title mt-3">Minhas Comissões</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
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
