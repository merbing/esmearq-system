<?php 
      session_start();

        if(!isset($_GET['cliente_id']))
        {
          $error_message = "Cliente não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }
        include("../views/include/head.php");
        include("../../banco/config.php");
        include_once("../config/auth.php");
        include("consultas/clientes/buscar.php");
        include_once("consultas/servicos/dados.php");
        // include_once("consultas/estados/buscar_cancelado.php");
        // var_dump($consulta);
        // exit;
        if(!$cliente)
        {
          $error_message = "Cliente não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }
        include("consultas/clientes/servicos.php");
        // var_dump($services);
        // exit;
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
                            <h4 class="content-title mb-0 my-auto">Serviços solicitados do Cliente</h4>
                            
                        </div>
                        
                    <a class="btn btn-primary mt-3 text-light" role="button" data-toggle="modal" data-target="#modal-solicitar">+ Solicitar</a>
                    <div class="modal fade" id="modal-solicitar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Solicitar Serviço para <?=$cliente['nome']?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="processar/clientes/adicionar/servico.php" method="post">
                        <input type="hidden" name="id_cliente" value="<?=$cliente['id']?>">
                        <div class="form-group mb-2">
                            <select class="form-control" name="id_service" id="id_service" required>
                                <option selected disabled>Selecione o Serviço</option>
                                <?php foreach($services as $item): ?>
                                   <option value="<?=$item['id']?>"><?=$item['nome']?></option>
                                <?php endforeach;  ?>

                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary ">Solicitar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
                
            </div>
        </div>
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
                                <?php if(count($servicos)>0): ?>
                                <?php foreach($servicos as $item): ?>

                                <div class="card mb-3  border-bottom ">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <h5 class="card-title "><?=$item['id']?></h5>
                                        <p>Serviço: <span style="font-weight: bold;"><?php echo ($item['service_name']) ?></span> </p>
                                        <p>Data de solicitação: <span style="font-weight: bold;"><?php echo ($item['created_at']) ?></span></p>
                                        <!-- <p>Estado: <span style="font-weight: bold;text-transform:uppercase"><?=$item['telefone']?></span></p> -->
                                        <!-- <p>Quantidade de Processos: <span style="font-weight: bold;text-transform:uppercase"></span></p> -->
                                        <!-- <a href="cliente_servicos.php?cliente_id=<?=base64_encode($item['id'])?>" class="btn btn-primary">Serviços</a> -->
                                        <!-- <a href="detalhes.php?cliente_id=<?=base64_encode($item['id'])?>" class="btn btn-primary">Ver Mais</a> -->
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
