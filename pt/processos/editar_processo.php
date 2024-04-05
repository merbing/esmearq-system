<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 

         if(!isset($_GET['processo_id']))
         {
            $error_message = "Processo não encontrado";
            header("Location: lista.php?error_message=". urlencode($error_message));
             // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
         include("../views/include/head.php");
         include("../../banco/config.php");
         include("consultas/processos/buscar.php");
         include("consultas/estados/dados.php");
         include("consultas/servicos/dados.php");
         include("../clientes/consultas/clientes/dados.php");
         include("../rh/consultas/funcionarios/dados.php");
         include_once("../config/auth.php");

        if(!$processo)
        {
          $error_message = "Processo não encontrado";
          header("Location: lista.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }

               // verificar se  o utilizador tem permissao para ver essa pagina
     if(!in_array("Atualizar Processo",$permissoes) ){
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
                                 <h4 class="card-title">Editar Processo de <span class="text-info"><?=$processo['client_name']?> - </span><?=$processo['id']?></h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="processar/processos/editar/basico.php" method="post" class="form-horizontal">
                                 <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                 <input type="hidden" name="agencia_id" value="<?php echo $agencia_id ?>">
                                 <input type="hidden" name="funcionario_id" value="<?=$id_funcionario?>">
                                 <input type="hidden" name="processo_id" value="<?=$processo['id']?>">
                                 <input type="hidden" class="form-control" name="password" value="<?php echo $senhaGerada ?>" />
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Pesquisar...">
                                    <br>
                                    <label class="control-label" for="Cliente">Cliente*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="id_client" id="id_cliente" required>
                                          <option selected disabled>Selecionar</option>
                                          <?php foreach($clients as $client): ?>
                                             <option value="<?=$client['id']?>" <?=($client['id']==$processo['client_id'])?'selected':''?> > <?=$client['nome']?></option>
                                          <?php endforeach;  ?>

                                       </select>
                                    </div>
                                 </div>

                                 <div class="row">
                                 <div class="col-6 form-group">
                                    
                                    <label class="control-label" for="Cliente">Estado*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="id_state" id="id_cliente" required>
                                          <option selected disabled>Selecionar</option>
                                          <?php foreach($states as $item): ?>
                                             <option style="text-transform: uppercase;" value="<?=$item['id']?>" <?=($item['id']==$processo['state_id'])?'selected':''?>><?=$item['nome_estado']?> </option>
                                          <?php endforeach;  ?>

                                       </select>
                                    </div>
                                 </div>  
                                    <div class="col-6 form-group">
                                    
                                    <label class="control-label" for="Cliente">Serviço*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="id_service" id="id_cliente" required>
                                          <option selected disabled>Selecionar</option>
                                          <?php foreach($services as $item): ?>
                                             <option value="<?=$item['id']?>" <?=($item['id']==$processo['service_id'])?'selected':''?>><?=$item['nome']?></option>
                                          <?php endforeach;  ?>

                                       </select>
                                    </div>
                                 </div>       
                                 </div>

                                 <div class="row">
                                 <div class="col-6 form-group">
                                    <label class="control-label" for="data_inicio">Data de Início*</label>
                                    <div class="mb-2">
                                       <input type="date" class="form-control" name="data_inicio" value="<?=(explode(" ",$processo['data_inicio']))[0]?>" placeholder="Data" required />
                                    </div>
                                 </div>

                                 <div class="col-6 form-group">
                                    <label class="control-label" for="horario">Data de Conclusão</label>
                                    <div class="mb-2">
                                       <input type="date" class="form-control" id="data_fim" name="data_fim" value="<?=(explode(" ",$processo['data_fim']))[0]?>" placeholder="Data" />
                                    </div>
                                 </div>
                                  

                                 </div>
                                 <div class="row">
                                 <div class="col-6 form-group">
                                    <label class="control-label" for="horario">Descrição do Processo</label>
                                    <div class="mb-2">
                                       <textarea class="form-control" name="descricao" id="" cols="30" rows="5"><?=$processo['descricao']?></textarea>
                                    </div>
                                 </div>
                                 <div class="col-6 form-group">
                                    
                                    <label class="control-label" for="Cliente">Funcionario Responsável*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="funcionario_id" id="id_cliente" required>
                                          <option selected disabled>Selecionar</option>
                                          <?php foreach($employes as $item): ?>
                                             <option value="<?=$item['id']?>" <?=($item['id']==$processo['funcionario_responsavel_id'])?'selected':''?>><?=$item['nome']?></option>
                                          <?php endforeach;  ?>

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
      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>