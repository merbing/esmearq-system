<!DOCTYPE html>
<html lang="pt">
   <head>
      <?php 

        if(!isset($_GET['fatura_id']))
        {
          $error_message = "Fatura não encontrada";
          header("Location: lista_faturas.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }
        include("../views/include/head.php");
        include("../../banco/config.php");
        include("consultas/faturas/buscar.php");
        include("consultas/contas/dados.php");
         include("consultas/servicos/dados.php");
         include("../clientes/consultas/clientes/dados.php");
        include_once("../../config/auth.php");

        if(!$fatura)
        {
          $error_message = "Fatura não encontrada";
          header("Location: lista_faturas.php?error_message=". urlencode($error_message));
          // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }
        // verificar se  o utilizador tem permissao para ver essa pagina
        if(!in_array("Ver Factura",$permissoes) ){
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
                           <?php
                            // Verifica se há uma mensagem de erro
                            if (isset($_GET['warning_message'])) {
                            ?>
                         <div class="mt-1 alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Aviso:</strong> <?php echo urldecode($_GET['warning_message']); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ti ti-close"></i>
                            </button>
                         </div>
                         <?php } ?> 
                            
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-md-12">
                         <div class="card card-statistics">
                            <div class="card-header">
                               <div class="card-heading">
                                  <h4 class="card-title">Editar Fatura nº <span class="text-info"><?=$fatura['id']?></span></h4>
                               </div>
                            </div>
                            <div class="card-body">
                               <form action="processar/faturas/editar/basico.php" method="post" class="form-horizontal">
                                  <!-- <input type="hidden" name="user_id" value="<?php echo $user_id ?>"> -->
                                  <!-- <input type="hidden" name="agencia_id" value="<?php echo $agencia_id ?>"> -->
                                  <!-- <input type="hidden" name="funcionario_id" value="<?=$id_funcionario?>"> -->
                                  <!-- <input type="hidden" class="form-control" name="password" value="<?php echo $senhaGerada ?>" /> -->
                                  <input type="hidden" name="id_fatura" value="<?=$fatura['id']?>">
                                  <div class="form-group">
                                     <input type="text" class="form-control" id="searchInput" placeholder="Pesquisar...">
                                     <br>
                                     <label class="control-label" for="Cliente">Cliente*</label>
                                     <div class="mb-2">
                                        <select class="form-control" name="id_client" id="id_cliente" required>
                                           <option selected disabled>Selecionar</option>
                                           <?php foreach($clients as $client): ?>
                                              <option value="<?=$client['id']?>" <?= ($fatura['client_id']==$client['id'])?"selected": '' ?>    ><?=$client['nome']?></option>
                                           <?php endforeach;  ?>
 
                                        </select>
                                     </div>
                                  </div>
 
                                  <div class="row">
                                  <div class="col-6 form-group">
                                     
                                     <label class="control-label" for="id_conta">Conta Bancaria*</label>
                                     <div class="mb-2">
                                        <select class="form-control" name="id_conta" id="id_conta" required>
                                           <option selected disabled>Selecionar</option>
                                           <?php foreach($accounts as $item): ?>
                                              <option style="text-transform: uppercase;" value="<?=$item['id']?>" <?= ($fatura['conta_id']==$item['id'])?"selected": '' ?> > <?=$item['nome_conta']?></option>
                                           <?php endforeach;  ?>
 
                                        </select>
                                     </div>
                                  </div>  
                                     <div class="col-6 form-group">
                                     
                                     <label class="control-label" for="Servico">Serviço*</label>
                                     <div class="mb-2">
                                        <select class="form-control" name="id_service" id="id_servico" required>
                                           <option selected disabled>Selecionar</option>
                                           <?php foreach($services as $item): ?>
                                              <option value="<?=$item['id']?>" <?= ($fatura['service_id']==$item['id'])?"selected": '' ?>  data-price="<?=$item['custo']?>"><?=$item['nome']?></option>
                                           <?php endforeach;  ?>
 
                                        </select>
                                     </div>
                                  </div>       
                                  </div>
                               
                                  <div class="row">
 
                                  <div class="col-4 form-group">
                                     <label class="control-label" for="nome_empresa">Empresa*</label>
                                     <div class="mb-2">
                                        <input type="text" class="form-control" value="<?=$fatura['nome_empresa']?>" name="nome_empresa" placeholder="Nome da Empresa" required />
                                     </div>
                                  </div>
                                  <div class="col-4 form-group">
                                     <label class="control-label" for="email">Email*</label>
                                     <div class="mb-2">
                                        <input type="text" class="form-control" value="<?=$fatura['email']?>" name="email_empresa" placeholder="Email da Empresa" required />
                                     </div>
                                  </div>
                                  <div class="col-4 form-group">
                                     <label class="control-label" for="telefone">Telefone*</label>
                                     <div class="mb-2">
                                        <input type="text" class="form-control" value="<?=$fatura['telefone']?>" name="telefone_empresa" placeholder="Telefone da Empresa" required />
                                     </div>
                                  </div>
                                  
                                  <div class="col-4 form-group">
                                     <label class="control-label" for="endereco">Endereço*</label>
                                     <div class="mb-2">
                                        <input type="text" class="form-control" value="<?=$fatura['endereco']?>" name="endereco_empresa" placeholder="Endereço da Empresa" required />
                                     </div>
                                  </div>
                                  <div class="col-4 form-group">
                                     <label class="control-label" for="price">Valor do Serviço (KZ)*</label>
                                     <div class="mb-2">
                                        <input type="number" class="form-control" min='0'  value="0" id="price" name="valor" placeholder="Valor da fatura" disabled/>
                                     </div>
                                  </div>
                                  <div class="col-4 form-group">
                                     <label class="control-label" for="desconto">Desconto aplicado(%)*</label>
                                     <div class="mb-2">
                                        <input type="number" class="form-control" min='0'value="<?=$fatura['desconto']?>"  max="100" value="0" name="desconto" placeholder="Valor do desconto aplicado" required />
                                     </div>
                                  </div>
                                  <div class="col-4 form-group">
                                     
                                     <label class="control-label" for="Cliente">Pago*</label>
                                     <div class="mb-2">
                                        <select class="form-control" name="id_pago" id="id_pago" required>
                                           <option selected disabled>Selecionar</option>
                                           <option value="1" <?=($fatura['pago']==1)?'selected':''?>>Sim</option>
                                           <option value="0" <?=($fatura['pago']==0)?'selected':''?>>Não</option>
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
       <script src="../assets/js/jquery-3.3.1.min.js"></script>
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
          
 
          $(document).ready(function(){
 
             $("#id_servico").on("change",function(){
                var option_price = $('option:selected', this).attr('data-price');
                console.log(option_price);
 
                $("#price").val(option_price);
             });
 
          });
       </script>
       <script src="../assets/js/vendors.js"></script>
       <!-- custom app -->
       <script src="../assets/js/app.js"></script>
    </body>
 </html>