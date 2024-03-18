<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
         include("../../banco/config.php");
         include("../views/include/head.php");
         include("../rh/consultas/funcionarios/dados.php");
         include_once("../../config/auth.php");
         
           // verificar se  o utilizador tem permissao para ver essa pagina
       if(!in_array("Adicionar Atividade",$permissoes) ){
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
                                 <h4 class="card-title">Nova Atividade</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="processar/adicionar_info/basicas.php" method="post" class="form-horizontal">
                                 <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                 <input type="hidden" name="agencia_id" value="<?php echo $agencia_id ?>">
                                 <input type="hidden" class="form-control" name="password" value="<?php echo $senhaGerada ?>" />
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Pesquisar...">
                                    <br>
                                    <label class="control-label" for="Funcionario">Funcionario*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="id_funcionario" id="id_funcionario" required>
                                          <option selected disabled>Selecionar</option>
                                          <?php foreach($employes as $item): ?>
                                             <option value="<?=$item['id']?>"><?=$item['nome']?></option>
                                          <?php endforeach;  ?>

                                       </select>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="control-label" for="nome">Atividade a Executar*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" id="atividade" name="atividade" placeholder="Descrição da actividade" required />
                                    </div>
                                 </div>
                                 <div class="row">
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="nif">Data de Inicio</label>
                                    <div class="mb-2">
                                       <input type="date" class="form-control" id="data_inicio" name="data_inicio" placeholder="Data" />
                                    </div>
                                 </div>
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="nif">Data de Conclusão</label>
                                    <div class="mb-2">
                                       <input type="date" class="form-control" id="data_fim" name="data_fim" placeholder="Data" />
                                    </div>
                                 </div>
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="nome">Estado</label>
                                    <div class="mb-2">
                                       <select name="status" class="form-control" id="">
                                          <option value="em_andamento" selected>Em andamento</option>
                                          <option value="concluida" disabled>Concluida</option>
                                          <option value="cancelada" disabled>Cancelada</option>
                                       </select>
                                    </div>
                                 </div>
                                 
                                 </div>
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Salvar</button>
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


         function filterOptions() {
             var input, filter, select, options, option, i, txtValue;
             input = document.getElementById("searchInput");
             filter = input.value.toUpperCase();
             select = document.getElementById("id_funcionario");
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