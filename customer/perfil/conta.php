<?php 
      session_start();

        include("../../banco/config.php");
        include_once("../config/auth.php");
       
        if(!$user_id)
        {
            $error_message = "Ocorreu um erro. Não tem permissão para ver isto";
            header("Location: ../home/index.php?error_message=". urlencode($error_message));
        }
        try{

            $query = "SELECT * FROM clientes  WHERE id = '$user_id' ";
    
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $cliente = null;
            if ($result->num_rows > 0) {
                $cliente = $result->fetch_assoc();
            }else{
                $error_message = "Ocorreu um erro. Dados Não disponíveis";
                header("Location: ../home/index.php?error_message=". urlencode($error_message));
            }
            
        }catch(Exception $e)
        {
            $error_message = "Ocorreu um erro. Dados Não disponíveis";
            header("Location: ../home/index.php?error_message=". urlencode($error_message));
        }
        
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
                            <h4 class="content-title mb-0 my-auto">Informações da Conta</h4>
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
                                <form method="POST" action="processar/conta/editar/basico.php">
                                    <div class="form-group">
                                        <label for="nome">Nome</label>
                                        <input type="text" class="form-control" name="nome" id="nome" value="<?=$cliente['nome']??$user_name??'Indisponível'?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?=$cliente['email']??$user_email??'Indisponível'?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefone">Telefone</label>
                                        <input type="tel" class="form-control" name="telefone" id="telefone" value="<?=$cliente['telefone']??$user_phone??'Indisponível'?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="endereco">Endereço</label>
                                        <input type="text" class="form-control" name="endereco" id="endereco" value="<?=$cliente['endereco']??$user_adress??'Indisponível'?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
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
</body>
</html>
