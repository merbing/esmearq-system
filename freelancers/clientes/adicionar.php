<?php
session_start();
include("../../banco/config.php");
include("../config/auth.php");

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include("../views/include/head.php"); ?>
    <title>ESMEARQ - Área Freelancer - <?=$user_name??$_SESSION['nome_usuario']?></title>
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
                            <h4 class="content-title mb-0 my-auto">Cadastrar novo cliente</h4>
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
                                <h5 class="card-title">Dados Pessoais do Cliente</h5>
                                <form action="processar/clientes/adicionar/basico.php" method="POST">

                                <input type="hidden" name="id_freelancer" value="<?=$user_id?>">
                                 <div class="form-group">
                                    <label class="control-label" for="nome">Nome Completo*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" id="nome" name="name" placeholder="Nome" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="nif">Número de identificação fiscal*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" id="nif" name="nif" placeholder="NIF" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="data_de_nascimento">Data de Nascimento*</label>
                                    <div class="mb-2">
                                       <input type="date" class="form-control" name="birthdate" placeholder="Data de Nascimento" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="nacionalidade">Nacionalidade*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="nationality" id="nacionalidade" required onchange="handleNacionalidade()">
                                          <option selected disabled>Selecionar</option>
                                          <option value="Angola">Angola</option>
                                          <option value="Outra">Outra</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group" id="outra_nacionalidade">
                                    <label class="control-label" for="foreingh_nationality">Nome da Nacionalidade*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" id="nacionalidade_input" name="foreingh_nationality" placeholder="Nome da Nacionalidade" disabled />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="state">Estado Civil*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="state" id="estado_civil" required>
                                          <option selected disabled>Selecionar</option>
                                          <option value="Solteiro">Solteiro</option>
                                          <option value="Casado">Casado</option>
                                          <option value="Divorciado">Divorciado</option>
                                          <option value="Viúvo">Viúvo</option>
                                          <option value="Separado">Separado</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="Endereço">Endereço residencial*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" id="Endereço" name="address" placeholder="Endereço" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="Telefone">Número de Telefone*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" id="Telefone" name="phonenumber" placeholder="Telefone" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="uemail">Email*</label>
                                    <div class="mb-2">
                                       <input type="email" class="form-control" id="uemail" name="email" placeholder="Email" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="form-check">
                                       <input required class="form-check-input" type="checkbox" checked id="uagree" name="uagree">
                                       <label class="form-check-label" for="uagree">Eu Confirmo estas informações*</label>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Iniciar Cadastro</button>
                                 </div>
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
