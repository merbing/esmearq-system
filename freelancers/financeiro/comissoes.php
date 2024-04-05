<?php 
session_start();
include("../../banco/config.php");
include("../config/auth.php");
include_once("consultas/comissoes/dados.php");
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
                            <h4 class="content-title mb-0 my-auto">Lista de Comissões</h4>
                        </div>
                    </div>
                </div>
                <!-- breadcrumb -->
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="w-100 mb-5">
                                    <div class="w-100  d-flex justify-content-between">
                                        <h4 class="card-title mg-b-10 mb-4">Comissões</h4>
                                        <div class="">
                                <form action="" method="post">
                                    <div class="row ">
                                    <div class="col-4 form-group">
                                        <label for="data_inicio">Data de Início:</label>
                                        <input type="date" value="<?=$_POST['data_inicio']??''?>" class="form-control" id="data_inicio" name="data_inicio">
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="data_fim">Data de Fim:</label>
                                        <input type="date" class="form-control" value="<?=$_POST['data_fim']??''?>" id="data_fim" name="data_fim">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Pago:</label>
                                        <select name="pago" id="" class="form-control">
                                            <option value="1" <?=(isset($_POST['pago']) && $_POST['pago']==1)?'selected':''?> >Sim</option>
                                            <option value="0" <?=(isset($_POST['pago']) && $_POST['pago']==0)?'selected':''?>>Não</option>
                                        </select>
                                    </div>
                                    <div class="col-2 d-flex align-items-center ">
                                    <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
                                    </div>    
                                </div>
                                    
                                </form>
                                </div>
                                    </div>

                                    <div>
                                        <?php if(isset($_POST['data_inicio'])): ?>
                                        <p>Filtro Aplicado: </br>
                                        Inicio: <span class="mr-3" style="font-weight: bolder;"><?=$_POST['data_inicio']?></span>
                                        Fim: <span class="mr-3" style="font-weight: bolder;"><?=$_POST['data_fim']??''?></span>
                                        Pago: <span class="mr-4" style="font-weight: bolder;"><?=$_POST['pago']==1?"Sim":"Não"?></span>
                                        <a href="comissoes.php" class="btn btn-sm btn-dark">Limpar Filtro</a>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                    
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th>Nº da Fatura</th>
                                          <th>Cliente</th>
                                          <th>Comissão</th>
                                          <th>Paga</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Aqui você pode listar os processos de serviços -->
                                            <?php foreach($comissoes as $item):  ?>
                                            <tr>
                                            <td><?php echo $item['id_fatura'] ?></td>
                                            <td><?php echo $item['client_name'] ?></td>
                                            <td><?php echo $item['comissao'] ?> AKZ</td>
                                            <td><?php echo $item['pago']==1?"SIM":"NÃO" ?></td>
                                            <!-- <td><a class="btn btn-sm btn-dark" href="detalhes.php?processo_id=<?=base64_encode($item['id'])?>">Detalhes</a></td> -->
                                            </tr>
                                            <?php endforeach; ?>
                                            
                                            <!-- Adicione mais processos conforme necessário -->
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
