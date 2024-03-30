<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
         include("../../banco/config.php");
         include("../views/include/head.php");
         include("consultas/clientes/dados.php");
         include_once("../../config/auth.php");

         // verificar se  o utilizador tem permissao para ver essa pagina
         if(!in_array("Adicionar Documentos de Clientes",$permissoes) ){
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
                                 <h4 class="card-title">Inserção de Documentos</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form enctype="multipart/form-data" action="processar/cliente/adicionar_info/files.php" method="post" class="form-horizontal" id="formDocumentos">
                                 <!-- <input type="hidden" name="user_id" value="<?php echo $user_id ?>"> -->
                                 <!-- <input type="hidden" name="agencia_id" value="<?php echo $agencia_id ?>"> -->
                                 <!-- <input type="hidden" name="cliente_id" value="<?php echo $cliente_id ?>"> -->
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Pesquisar...">
                                    <br>
                                    <label class="control-label" for="Cliente">Cliente*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="client_id" id="cliente_id" required>
                                          <option selected disabled>Selecionar</option>
                                          <?php foreach($clients as $client): ?>
                                          <option value="<?=$client['id']?>"><?=$client['nome']?></option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="documentos">
                                    <div class="form-group">
                                       <label class="control-label" for="doc_nome">Nome do Documento*</label>
                                       <input type="text" class="form-control" name="doc_nome[]" placeholder="Nome do Documento" required />
                                    </div>
                                    <div class="form-group">
                                       <input type="file" name="documento[]" accept=".jpg, .jpeg, .png, .pdf" class="form-control" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <button type="button" class="btn btn-dark" id="novo_doc" onclick="adicionarDocumento()">Adicionar Novo Documento</button>
                                    <button type="submit" class="btn btn-primary" name="signup" id="inserir" value="Sign up">Inserir</button>
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
      <script>
         function filterOptions() {
             var input, filter, select, options, option, i, txtValue;
             input = document.getElementById("searchInput");
             filter = input.value.toUpperCase();
             select = document.getElementById("client_id");
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
         
         function adicionarDocumento() {
         var novoDocumentoHTML = `
         <div class="form-group">
            <label class="control-label" for="doc_nome">Nome do Documento*</label>
            <input type="text" class="form-control" name="doc_nome[]" placeholder="Nome do Documento" required />
         </div>
         <div class="form-group">
            <input type="file" name="documento[]" accept=".jpg, .jpeg, .png, .pdf" class="form-control" required />
         </div>
         `;
         var inserirAntesDe = document.querySelector('#novo_doc');
         inserirAntesDe.insertAdjacentHTML('beforebegin', novoDocumentoHTML);
         }
         
      </script>
      <!-- plugins -->
      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>