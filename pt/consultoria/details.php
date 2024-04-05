<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 

        if(!isset($_GET['agendamento_id']))
        {
          $error_message = "Agendamento não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }
        include("../views/include/head.php");
        include("../../banco/config.php");
        include("consultas/agendamentos/buscar.php");
        include_once("../config/auth.php");

        if(!$consulta)
        {
          $error_message = "Agendamento não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }

        // verificar se  o utilizador tem permissao para ver essa pagina
        if(!in_array("Ver Lista das Consultorias",$permissoes) ){
            header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
         
         }
    ?>
   </head>
   <body>
      <!-- begin app -->
      <div class="app">
         <!-- begin app-wrap -->
         <!-- begin app-header -->
         <?php include("../views/include/header.php");?>
         <?php include("../views/include/menu.php");?>
         <!-- end app-header -->
         <!-- begin app-main -->
         <!-- begin app-container -->
         <div class="app-container">
            <!-- begin app-main -->
            <div class="app-main" id="main">
               <!-- begin container-fluid -->
               <div class="container-fluid">
                  <!-- begin row -->
                  <div class="row">
                     <div class="col-md-12 m-b-30">
                        <!-- begin page title -->
                        <div class="d-block d-sm-flex flex-nowrap align-items-center">
                           <div class="page-title mb-2 mb-sm-0">
                              <h1>Informações da Consulta</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                    Consultas
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Lista de Consultas</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        <!-- end page title -->
                     </div>
                  </div>
                  <!-- end row -->
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
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card card-statistics">
                           <div class="card-body ">
                            <h4>Dados da consulta <a href="editar_agendamento.php?agendamento_id=<?=base64_encode($consulta['id'])?>" class="btn btn-info btn-xs ml-2">Editar</a></h4>
                            <div class="row m-1 p-3 border border-grey rounded-lg" style="border-radius: 5px;">
                                <div class="col-3">
                                    <h5>Cliente</h5>
                                    <h4 class="text-secondary"><?=$consulta['client_name']?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Serviço</h5>
                                    <h4 class="text-secondary"><?=$consulta['service_name']?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Destino</h5>
                                    <h4 class="text-secondary"><?=$consulta['pais_destino']?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Estado</h5>
                                    <h4 class="text-secondary " style="text-transform: uppercase;"><?=$consulta['state_name']?></h4>
                                </div>

                            </div>

                            <?php if($consulta['state_name'] != "em espera"): ?>
                                <h4>
                                Detalhes da consulta
                                <?php if(isset($detalhes['id'])):?> 
                                    <a href="editar_detalhes.php?agendamento_id=<?=base64_encode($consulta['id'])?>" class="btn btn-info btn-xs ml-2">Editar</a>
                                <?php else: ?>
                                    <a href="iniciando.php?agendamento_id=<?=base64_encode($consulta['id'])?>" class="btn btn-xs btn-info">Iniciar</a>
                                 <?php endif; ?>
                            </h4>
                                <!-- <h4 class="mt-5">Detalhes da consulta 
                                    <a href="editar_detalhes.php?agendamento_id=<?=base64_encode($consulta['id'])?>" class="btn btn-info btn-xs ml-2">Editar</a></h4> -->
                              <div class="m-1 p-3 border border-grey rounded-lg" style="border-radius: 5px;">
                                <div class="row " >
                                <!-- <div class="col-12">
                                    <h5>Razões da viagem</h5>
                                    <h4 class="text-secondary"><?=$detalhes['razoes_viagem']??'------'?></h4>
                                </div> -->
                                <div class="col-3">
                                    <h5>Motivo da viagem</h5>
                                    <h4 class="text-secondary"><?=$detalhes['motivo_viagem']??'------'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Já Esteve na embaixada?</h5>
                                    <h4 class="text-secondary"><?=$detalhes['esteve_embaixada']??'------'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Visto Concedido?</h5>
                                    <h4 class="text-secondary"><?=$detalhes['visto_concedido']??'------'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Quantidade de Reprovações</h5>
                                    <h4 class="text-secondary"><?=$detalhes['vezes_nao_aprovado']??'------'?></h4>
                                </div>
                                

                            </div>
                            <div class="row mt-5">
                                 <div class="col-3">
                                    <h5>Ano de Visto</h5>
                                    <h4 class="text-secondary"><?=$detalhes['ano_visto']??'------'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Vinheta</h5>
                                    <h4 class="text-secondary"><?=$detalhes['ano_vinheta_visto']??'------'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Data de Vencimento do Visto</h5>
                                    <h4 class="text-secondary"><?=$detalhes['data_vencimento_visto']??'------'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Motivo de Reprovação</h5>
                                    <h4 class="text-secondary"><?=$detalhes['motivo_reprovacao']!=null?$detalhes['motivo_reprovacao']:'Não indicado'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Tipo de Visto</h5>
                                    <h4 class="text-secondary"><?=$detalhes['tipo_visto']??'------'?></h4>
                                </div>
                            </div>
                            <div class="row mt-5">
                                 <div class="col-3">
                                    <h5>Quantidade de Filhos</h5>
                                    <h4 class="text-secondary"><?=$detalhes['quantidade_filhos']??'------'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Responsabilidade das despesas</h5>
                                    <h4 class="text-secondary"><?=$detalhes['pessoa_responsavel']??'------'?></h4>
                                </div>
                                
                            </div>
                            <div class="row mt-5">
                            <div class="col-3">
                                    <h5>Nome do Responsavel</h5>
                                    <h4 class="text-secondary"><?=$detalhes['nome_responsavel']!=null?$detalhes['nome_responsavel']:'Não indicado'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Telefone do responsavel</h5>
                                    <h4 class="text-secondary"><?=$detalhes['telefone_responsavel']!=null?$detalhes['telefone_responsavel']:'Não indicado'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Endereço do responsavel</h5>
                                    <h4 class="text-secondary"><?=$detalhes['endereco_responsavel']!=null?$detalhes['endereco_responsavel']:'Não indicado'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Tipo de trabalho</h5>
                                    <h4 class="text-secondary"><?=$detalhes['trabalhando']??'------'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Nome da Empresa</h5>
                                    <h4 class="text-secondary"><?=$detalhes['nome_empresa']??'------'?></h4>
                                </div>
                                <div class="col-3">
                                    <h5>Função</h5>
                                    <h4 class="text-secondary"><?=$detalhes['funcao']??'------'?></h4>
                                </div>

                            </div>
                            <div class="row mt-5">
                            <div class="col-3">
                                    <h5>Utente Elegível</h5>
                                    <?php if(isset($detalhes['utente_legivel'])): ?>
                                        <h4 class="text-secondary"><?=($detalhes['utente_legivel']=='1'?'Sim':'Não')??''?></h4>
                                    <?php else: ?>
                                        <h4 class="text-secondary">-----</h4>
                                    <?php endif; ?>
                                    
                                </div>
                                <div class="col-3">
                                    <h5>Recomendação</h5>
                                    <h4 class="text-secondary"><?=$detalhes['recomendacao']??'------'?></h4>
                                </div>
                            </div>
                            </div>
                            <?php endif; ?>
                              
                           </div>
                        </div>
                     </div>
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
      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>