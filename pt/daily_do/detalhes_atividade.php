<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 
         if(!isset($_GET['atividade_id']))
         {
            if(isset($_GET['user_id']))
            {
                $error_message = "Atividade não encontrada";
                header("Location: minhas_atividades.php?error_message=". urlencode($error_message));
            }else{
                $error_message = "Atividade não encontrada";
                header("Location: lista.php?error_message=". urlencode($error_message));
            }
           
           // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
         include("../views/include/head.php");
         include("../../banco/config.php");
         include("consultas/buscar.php");
        //  include("consultas/clientes/processos.php");
         include_once("../config/auth.php");
         if(!$activity)
         {
            
            if(isset($_GET['user_id']))
            {
                $error_message = "Atividade não encontrada";
                header("Location: minhas_atividades.php?error_message=". urlencode($error_message));
            }else{
                $error_message = "Atividade não encontrada";
                header("Location: lista.php?error_message=". urlencode($error_message));
            }
         }

         try{
            $query = "SELECT * FROM momentos WHERE id_atividade='".$activity['id']."'; ";
       
            
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $momentos = [];
            if ($result->num_rows > 0) {
                                     // Obtém os dados do cliente
                while($moment = $result->fetch_assoc()){
                 $momentos[] = $moment; 
                }
            }
         }catch(Exception $e)
         {
            $momentos = [];
         }

         $time_elapsed = 0;
         $hour_elapsed = 0;
         $last_instant = null;
         $actual_instant=null;
         $all_last_instant = [];
         if($activity['state']==3){
            
            try{
               foreach($momentos as $moment){
                  if($moment['momento']==1){
                     // if($last_instant == null){
                        $last_instant = $moment['instante'];
                        $all_last_instant[] = $last_instant;
                        $last_moment=1;
                     // }else{

                     // }
                  }else if($moment['momento']==2 && $last_instant!=null){
                     $start = date_create($last_instant);
                     $end = date_create($moment['instante']);
                     $interval = date_diff($start,$end,true);
                     if($interval->h!=0){
                        $hour_elapsed+=$interval->h;
                     }
                     if($interval->h!=0 && ($time_elapsed+$interval->i)>=60){
                        $hour_elapsed+=1;
                        $time_elapsed = ($time_elapsed+$interval->i) - 60;
                     }else{
                        $time_elapsed+= $interval->i;
                     }
                     $last_moment = 2;  
                     // echo "</br>MIN:".$interval->i."<br/>"; 
                     // echo "HOUR:".($interval->h);
                     // exit;
                     $all_last_instant[] = $last_instant;
                  }else if($moment['momento']==3 && $last_moment==1 && $last_instant!=null){
                     $start = date_create($last_instant);
                     $end = date_create($moment['instante']);
                     $interval = date_diff($start,$end,true);
                     if($interval->h!=0){
                        $hour_elapsed+=$interval->h;
                     }
                     $time_elapsed+= $interval->i;
                     // echo "</br>MIN:".$interval->i."<br/>";
                     $all_last_instant[] = $last_instant;
                  }
               }

               // var_dump($all_last_instant);
               // echo "<br/>HOURS:".$hour_elapsed;
               // echo "<br/>MINUTES:".$time_elapsed;
               // exit;
               
            }catch(Exception $e){

            }
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
                              <h1>Detalhes da Actividade</h1>
                           </div>
                           <div class="ml-auto d-flex align-items-center">
                              <nav>
                                 <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                       <a href="../"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                       Atividade
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Informações da Atividade</li>
                                 </ol>
                              </nav>
                           </div>
                        </div>
                        <div class="mt-3">
                           

                               
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
                 
                  <!-- Cliente Info -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-body">
                              <!-- <h4 class="card-title">Informações Básica:</h4> -->
                              <div class="row">
                                 <div class="col-8 mb-3">
                                    <h5 class="">Atividade</h5>
                                    <h4 class="text-info"><?=$activity['atividade']?></h4>
                                 </div>
                                 
                                 <div class="col-4">
                                    <h5 class="">Funcionario</h5>
                                    <h4 class="text-info"><?=$activity['funcionario_name']?></h4>
                                 </div>
                                 <div class="col-3">
                                    <h5 class="">Inicio</h5>
                                    <h4 class="text-info"><?=date("d-m-Y",strtotime($activity['data_inicio']))?></h4>
                                 </div>
                                 <div class="col-3">
                                    <h5 class="">Fim Previsto</h5>
                                    <h4 class="text-info"><?=date("d-m-Y",strtotime($activity['data_fim']))?></h4>
                                 </div>
                                 
                                 <div class="col-3">
                                    <h5 class="">Estado</h5>
                                    <h4 class="">
                                    <?php if($activity['state']==0):?>
                                                    <span>PENDENTE</span>
                                                <?php elseif($activity['state']==1):?>
                                                    <span class="text-dark">EM ANDAMENTO</span>
                                                <?php elseif($activity['state']==2):?>
                                                    <span class="text-dark">EM PAUSA</span>
                                                <?php elseif($activity['state']==3):?>
                                                    <span class="text-info">CONCLUÍDO</span>
                                                <?php elseif($activity['state']==4):?>
                                                    <span class="text-danger">CANCELADO</span>
                                                <?php endif;?>
                                    </h4>
                                 </div>
                                 <div class="col-3">
                                 <?php if($activity['state']==3):?>
                                    <h5 class="">Tempo decorrido</h5>
                                    <?php if($hour_elapsed>0): ?>
                                       <h4 class="text-info"><?=$hour_elapsed?>h:<?=$time_elapsed?>min</h4>
                                    <?php else: ?>
                                       <h4 class="text-info"><?=$time_elapsed?> min</h4>
                                    <?php endif; ?>
                                    
                                    <?php endif;?>
                                 </div>
                                 

                              </div>
                             
                           </div>
                        </div>
                     </div>
                  </div>


                    <h4>MOMENTOS</h4>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-body">
                              <!-- <h4 class="card-title">Informações Básica:</h4> -->
                              <div class="row">
                                 <div class="col-4">
                                    <ul>
                                        <?php foreach($momentos as $moment): ?>
                                        <li><h5>
                                        <?php if($activity['state']==0):?>
                                                    <span>PENDENTE</span>
                                                <?php elseif($moment['momento']==1):?>
                                                    <span class="text-dark">EM ANDAMENTO</span>
                                                <?php elseif($moment['momento']==2):?>
                                                    <span class="text-dark">EM PAUSA</span>
                                                <?php elseif($moment['momento']==3):?>
                                                    <span class="text-info">CONCLUÍDO</span>
                                                <?php elseif($moment['momento']==4):?>
                                                    <span class="text-danger">CANCELADO</span>
                                                <?php endif;?>
                                             - <span style="font-weight: normal;"><?=$moment['instante']?></span></h5></li>
                                        <?php endforeach; ?>
                                   </ul>
                                    
                                 </div>
                                 

                              </div>
                             
                           </div>
                        </div>
                     </div>
                  </div>
                

                 
                  <!-- <div class="row mt-4">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-body">
                              <div class="row justify-content-center align-items-center border-top pt-4 mt-5">
                                 <div class="col-6 border-right">
                                    <h4>Serviços</h4>
                                    <div class="form-group">
                                       <a href="../credito/adicionar?conta_do_cliente="><button class="btn btn-outline-primary">Nova Prestação</button></a>
                                       <a href="../credito/credito_atividade?cliente_selecionado=" ><button class="btn btn-outline-primary">Histórico</button></a>
                                    </div>
                                 </div>
                                 <div class="col-6">
                                    <h4>Conta</h4>
                                    <div class="form-group">
                                       <a href="editar?conta_do_cliente=" ><button class="btn btn-outline-primary">Editar Conta</button></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> -->
                  <!-- <div class="row">
                     <div class="col-xl-3 col-sm-6">
                        <div class="card card-statistics">
                           <div class="card-body">

                              <div class="text-center p-2">
                                 <div class="mb-2">
                                    <img src="../assets/img/file-icon/pdf.png" alt="png-img">
                                 </div>
                                 <h4 class="mb-0">Extrato Báncario Atual</h4>
                                 <a href="" class="btn btn-light" download>Download</a>
                                 <a href="" class="btn btn-dark" download>Impressão</a>

                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-sm-6">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="text-center p-2">
                                 <div class="mb-2">
                                    <img src="../assets/img/file-icon/pdf.png" alt="png-img">
                                 </div>
                                 <h4 class="mb-0">Extrato Báncario Atual</h4>
                                 <a href="" class="btn btn-light" download>Download</a>
                                 <a href="" class="btn btn-dark" download>Impressão</a>

                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-sm-6">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="text-center p-2">
                                 <div class="mb-2">
                                    <img src="../assets/img/file-icon/pdf.png" alt="png-img">
                                 </div>
                                 <h4 class="mb-0">Declaração de Serviço</h4>
                                 <a href="" class="btn btn-light" download>Download</a>
                                 <a href="" class="btn btn-dark" download>Impressão</a>

                              </div>
                           </div>
                        </div>
                     </div>
                  </div> -->
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