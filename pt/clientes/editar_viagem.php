<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
      session_start();

         if(!isset($_GET['viagem_id']))
         {
            
           $error_message = "Viagem não encontrada";
           header("Location: lista.php?viagens.php?error_message=". urlencode($error_message));
           // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
         include("../views/include/head.php");
         include("../../banco/config.php");
         include("consultas/viagens/buscar.php");
         include("consultas/clientes/dados.php");
         include_once("../../config/auth.php");
 
         if(!$viagem)
         {
            
           $error_message = "Viagem não encontrada";
           header("Location: lista.php?viagens.php?error_message=". urlencode($error_message));
           // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }

         // verificar se  o utilizador tem permissao para ver essa pagina
         if(!in_array("Ver Clientes",$permissoes) ){
            header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
         
         }

         ?>
   </head>
   <body>
      <?php 
         if(isset($_SESSION['success']))
         {
            $message = $_SESSION['success'];
      ?>
         <script>
            alert("<?php echo $message?>");
         </script>
      <?php 
      $_SESSION['success'] = null;
         }
      ?>
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
                     <div class="col-md-12">
                        <div class="card card-statistics">
                           <div class="card-header">
                              <div class="card-heading">
                                 <h4 class="card-title">Editar dados da Viagem <span class="text-info"><?=$viagem['id']?></span> </h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="processar/viagens/editar/basico.php" method="post" class="form-horizontal">
                              
                                 <input type="hidden" name="id_viagem" value="<?=$viagem['id']?>">
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Pesquisar...">
                                    <br>
                                    <label class="control-label" for="Cliente">Cliente*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="id_client" id="id_cliente" required>
                                          <option selected disabled>Selecionar</option>
                                          <?php foreach($clients as $client): ?>
                                             <option value="<?=$client['id']?>"  <?=($client['id']==$viagem['client_id'])?'selected':''?>   ><?=$client['nome']?></option>
                                          <?php endforeach;  ?>

                                       </select>
                                    </div>
                                 </div>
                                 
                                        
                                 <div class="row">
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="date">Data de Viagem*</label>
                                    <div class="mb-2">
                                       <input type="date" class="form-control" value="<?=$viagem['data_viagem']?>" name="date" placeholder="Data" required />
                                    </div>
                                 </div>

                                 <div class="col-4 form-group">
                                    <label class="control-label" for="horario">Hora de Viagem</label>
                                    <div class="mb-2">
                                       <input type="time" class="form-control" value="<?=$viagem['hora_viagem']?>" id="time" name="time" placeholder="Data" required />
                                    </div>
                                 </div>
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="horario">Destino</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" value="<?=$viagem['destino']?>" id="destino" name="destino" placeholder="Destino da viagem" required />
                                    </div>
                                 </div>
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="horario">Viagem Realizada?</label>
                                    <div class="mb-2">
                                          <select class="form-control" name="realizada" id="">
                                             <option value="1" <?=$viagem['realizado']==1?'selected':''?>>SIM</option>
                                             <option value="0" <?=$viagem['realizado']==0?'selected':''?>>NÃO</option>
                                          </select>
                                    </div>
                                 </div>
                                  


                                 </div>
                              
                                 
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Guardar</button>
                                 </div>
                              </form>
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
      <script>
         function handleNacionalidade() {
             var nacionalidadeSelect = document.getElementById('nacionalidade');
             var nacionalidadeInput = document.getElementById('nacionalidade_input');
             var outraNacionalidadeDiv = document.getElementById('outra_nacionalidade');
             
             if (nacionalidadeSelect.value === 'Outra') {
                 outraNacionalidadeDiv.style.display = 'block';
                 nacionalidadeInput.removeAttribute('disabled');
             } else {
                 outraNacionalidadeDiv.style.display = 'none';
                 nacionalidadeInput.setAttribute('disabled', 'disabled');
             }
         }
      </script>
      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>