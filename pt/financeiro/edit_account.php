<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
         session_start();

         if(!isset($_GET['account_id']))
         {
            
           $error_message = "Conta não encontrada";
           header("Location: bankaccount_list.php?error_message=". urlencode($error_message));
           // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }
         include("../views/include/head.php");
         include("../../banco/config.php");
         include_once("../config/auth.php");
         include_once("consultas/contas/tipos.php");
         
         include("consultas/contas/buscar.php");
 
         if(!$bank_account)
         {
            
           $error_message = "Conta não encontrado";
           header("Location: bankaccount_list.php?error_message=". urlencode($error_message));
           // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
         }

         

         ?>

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
                                 <h4 class="card-title">Editar Conta Bancária <span class="text-info"><?=$bank_account['numero_conta']?></span></h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="processar/contas/editar/basico.php" method="post" class="form-horizontal">
                                 <input type="hidden" name="id_conta" value="<?=$bank_account['id']?>">
                                 <div class="row">
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="nome">Nome do Titular *</label>
                                       <div class="mb-2">
                                          <input type="text" class="form-control" id="nome" value="<?=$bank_account['nome_conta']??''?>" name="nome" placeholder="Nome" required />
                                       </div>
                                    </div>
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="banco">Banco *</label>
                                       <div class="mb-2">
                                          <input type="text" class="form-control" id="banco" name="banco" value="<?=$bank_account['banco']??''?>" placeholder="Banco" required />
                                       </div>
                                    </div>
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="number">Numero da conta *</label>
                                       <div class="mb-2">
                                          <input type="number" min="0" class="form-control" id="numero" name="numero" value="<?=$bank_account['numero_conta']??''?>" placeholder="Numero da Conta" required />
                                       </div>
                                    </div>
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="iban">IBAN *</label>
                                       <div class="mb-2">
                                          <input type="number" min="0" class="form-control" id="iban" name="iban" value="<?=$bank_account['IBAN']??''?>" placeholder="IBAN da Conta" required />
                                       </div>
                                    </div>
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="saldo">Saldo Actual *</label>
                                       <div class="mb-2">
                                          <input type="number" min="0" class="form-control" id="saldo" name="saldo" value="<?=$bank_account['saldo']??''?>" placeholder="Saldo actual" required />
                                       </div>
                                    </div>
                                    
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="tipo">Tipo de Conta</label>
                                       <div class="mb-2">
                                          <select class="form-control" name="tipo" id="tipo" required>
                                             <option selected disabled>Selecionar</option>
                                             <?php foreach($account_types as $item): ?>
                                                <option value="<?=$item['id']?>" <?=$item['id']==$bank_account['tipo_conta_id']?'selected':''?>  ><?=$item['tipo_conta']?></option>
                                             <?php endforeach; ?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 
                                 <div class="form-group">
                                    <div class="form-check">
                                       <input required class="form-check-input" type="checkbox" checked id="uagree" name="uagree">
                                       <label class="form-check-label" for="uagree">Eu Confirmo estas informações*</label>
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