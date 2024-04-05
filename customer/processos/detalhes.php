<?php 
      session_start();

        if(!isset($_GET['processo_id']))
        {
          $error_message = "Processo não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }
        include("../../banco/config.php");
        include_once("../config/auth.php");
        include("consultas/processos/buscar.php");
        // include_once("consultas/estados/buscar_cancelado.php");
        // var_dump($consulta);
        // exit;
        if(!$processo)
        {
          $error_message = "Processo não encontrado";
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
                            <h4 class="content-title mb-0 my-auto">Detalhes do Processo de Serviço</h4>
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
                                        <h4 class="card-title mg-b-10">Detalhes do Processo</h4>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Serviço:</td>
                                                <td><span style="font-weight: bold;"><?=$processo['service_name']?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Status:</td>
                                                <td><span style="font-weight: bold;"><?=$processo['state_name']?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Data de Solicitação:</td>
                                                <td><span style="font-weight: bold;"><?=date("d-m-Y",strtotime($processo['data_inicio']))?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Data de Conclusão:</td>
                                                <td><span style="font-weight: bold;"><?=date("d-m-Y",strtotime($processo['data_inicio']))?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Detalhes do Pedido:</td>
                                                <td><?=$processo['descricao']?></td>
                                            </tr>
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
