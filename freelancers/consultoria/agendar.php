<?php
session_start();
include("../../banco/config.php");
include("../config/auth.php");
include_once("consultas/servicos/dados.php");
include("../clientes/consultas/clientes/dados.php");

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
                            <h4 class="content-title mb-0 my-auto">Agendamento de Consultoria</h4>
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
                                <h5 class="card-title">Detalhes da Consultoria</h5>
                                <form action="processar/agendamentos/adicionar/basico.php" method="POST">
                                <div class="form-group">
                                    <div class="mb-2">
                                       <select class="form-control" name="id_client" id="id_cliente" required>
                                          <option selected disabled>Selecionar Cliente</option>
                                          <?php foreach($clientes as $client): ?>
                                             <option value="<?=$client['id']?>"><?=$client['nome']?></option>
                                          <?php endforeach;  ?>

                                       </select>
                                    </div>
                                 </div>
                                    <div class="form-group">
                                        <label for="pais">País Destino:</label>
                                        <input type="text" class="form-control" id="pais" name="pais" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="data">Data da Consultoria:</label>
                                        <input type="date" class="form-control" id="data" name="data" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="hora">Hora da Consultoria:</label>
                                        <input type="time" class="form-control" id="hora" name="hora" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="Cliente">Serviço*</label>
                                        <div class="mb-2">
                                        <select class="form-control" name="id_service" id="id_cliente" required>
                                          <option selected disabled>Selecionar</option>
                                          <?php foreach($services as $item): ?>
                                             <option value="<?=$item['id']?>"><?=$item['nome']?></option>
                                          <?php endforeach;  ?>

                                       </select>
                                    </div>
                                 </div>  
                                    <!-- <div class="form-group">
                                        <label for="mensagem">Mensagem Adicional:</label>
                                        <textarea class="form-control" id="mensagem" name="mensagem" rows="3"></textarea>
                                    </div> -->
                                    <button type="submit" class="btn btn-primary">Agendar Consultoria</button>
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
    <?php require_once("../views/include/menu_notificacoes.php"); ?>
    <!-- Right-sidebar-closed -->
    </div>
    <!--End Page -->
    <?php require_once("../views/include/links_scrpt.php"); ?>
    <script>
         function filterOptions() {
             var input, filter, select, options, option, i, txtValue;
             input = document.getElementById("searchInput");
             filter = input.value.toUpperCase();
             select = document.getElementById("id_cliente");
             options = select.getElementsByTagName("option");
             for (i = 0; i < options.length; i++) {
                 option = options[i];
                 txtValue = option.textContent || option.innerText;
                 if (txtValue.toUpperCase().indexOf(filter) > -1) {
                     option.style.display = "";
                 } else {
                     option.style.display = "none";
                 }
             }
         }
         
         document.addEventListener("DOMContentLoaded", function() {
             document.getElementById("searchInput").addEventListener("input", filterOptions);
         });
         
      </script>
</body>
</html>
