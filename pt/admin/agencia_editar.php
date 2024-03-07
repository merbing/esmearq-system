<?php
include("../env/auth_check.php");
include("env/auth_check.php");
include("../banco/config.php");
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include("../views/include/head.php"); ?>
</head>
<body>
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <!-- begin app-header -->
        <?php
        include("../views/include/header.php");
        include("../views/include/menu.php");
        ?>
        <!-- end app-header -->
        <!-- begin app-main -->
        <!-- begin app-container -->
        <div class="row">
                     <div class="col-12 mb-2">
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
                  </div>
        <div class="app-container">
            <!-- begin app-main -->
            <div class="app-main" id="main">
                <!-- begin container-fluid -->
                <div class="container-fluid">
                    <!-- begin row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="row tabs-contant">
                                        <div class="col-xxl-6">
                                            <div class="card card-statistics">
                                                <div class="card-header">
                                                    <div class="card-heading">
                                                        <h4 class="card-title">Editar Ponto</h4>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab">
                                                        <?php
                                                        if (isset($_GET['agencia_selecionado'])) {
                                                            $agencia_selecionada = $_GET['agencia_selecionado'];
                                                            if ($cargo_id == 3 || $cargo_id == 4) {

                                                            // Consultar os dados da agência com base no ID
                                                            $query = "SELECT * FROM agencias WHERE id_agencia = ?";
                                                            $stmt = $conn->prepare($query);
                                                            $stmt->bind_param("i", $agencia_selecionada);
                                                            $stmt->execute();
                                                            $result = $stmt->get_result();

                                                            if ($result->num_rows > 0) {
                                                                // Capturar os dados da agência
                                                                $agencia = $result->fetch_assoc();
                                                                $nome_agencia = $agencia['nome_agencia'];
                                                                $endereco_agencia = $agencia['endereco'];
                                                                $provincia_agencia = $agencia['provincia'];
                                                                $telefone_agencia = $agencia['telefone'];
                                                                ?>
                                                                <form action="processar/agencia/editar.php" method="post" class="form-horizontal">
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="id_agencia" value="<?php echo $agencia_selecionada; ?>" />
                                                                        <label for="nome_agencia">Nome da Agência</label>
                                                                        <input type="text" value="<?php echo $nome_agencia; ?>" class="form-control" id="nome_agencia" name="nome_agencia" placeholder="Nome da Agência" required />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="endereco">Endereço</label>
                                                                        <input type="text" value="<?php echo $endereco_agencia; ?>" class="form-control" id="endereco" name="endereco" placeholder="Endereço" required />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="provincia">Província</label>
                                                                        <input value="<?php echo $provincia_agencia; ?>" type="text" class="form-control" id="provincia" name="provincia" placeholder="Província" required />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="telefone">Telefone</label>
                                                                        <input value="<?php echo $telefone_agencia; ?>" type="tel" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required />
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Atualizar</button>
                                                                </form>
                                                                <hr>
                                                                <?php
                                                                
                                                                     if ($cargo_id == 3) {

                                                                  ?>
                                                                <div class="card-heading">
                                                                    <h4 class="card-title">Remover Agência</h4>
                                                                </div>
                                                                <button class="btn btn-danger" data-toggle="modal" data-target="#confirmacaoModal">Remover</button>
                                                            <?php
                                                            }
                                                            } else {
                                                                // Se a agência não for encontrada, redirecionar para a página de erro
                                                                echo "Nenhuma agência foi selecionada";
                                                            }
                                                        }else{
                                                            $error_message = "<p style='color:red'>Você não tem permissão suficiente para aceder esta página!</p>";
                                                            echo $error_message;
                                                        }}
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container-fluid -->
                </div>
                <!-- end app-main -->
            </div>
            <!-- end app-container -->
            <!-- begin footer -->
        </div>
        <!-- end app-container -->
    </div>
    <!-- end app-wrap -->
    </div>
    <!-- end app -->
    <!-- plugins -->
    <div class="modal fade" id="confirmacaoModal" tabindex="-1" role="dialog" aria-labelledby="confirmacaoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmacaoModalLabel">Confirmação de Remoção</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja remover esta agência?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="processar/agencia/remover.php" method="post">
                        <input type="hidden" value="<?php echo $agencia_selecionada; ?>" name="id_agencia">
                        <button class="btn btn-danger">Confirmar Remoção</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/vendors.js"></script>
    <!-- custom app -->
    <script src="../assets/js/app.js"></script>
</body>
</html>
