<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
       session_start();
         include("../../banco/config.php");
         include("../views/include/head.php");
         include("consultas/departamentos/dados.php");
         include("consultas/papeis/dados.php");
         include("consultas/agencias/dados.php");
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
                                 <h4 class="card-title">Novo Funcionário</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="processar/funcionarios/adicionar_info/basicas.php" method="post" class="form-horizontal">
                                 
                                 <div class="row">
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="nome">Nome Completo*</label>
                                       <div class="mb-2">
                                          <input type="text" class="form-control" id="nome" name="name" placeholder="Nome" required />
                                       </div>
                                    </div>
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="Endereço">Endereço residencial*</label>
                                       <div class="mb-2">
                                          <input type="text" class="form-control" id="Endereço" name="address" placeholder="Endereço" required />
                                       </div>
                                    </div>
                                 
                                 </div>
                                 <div class="row">
                                    <div class="col-4 form-group">
                                       <label class="control-label" for="Telefone">Número de Telefone*</label>
                                       <div class="mb-2">
                                          <input type="text" class="form-control" id="Telefone" name="phonenumber" placeholder="Telefone" required />
                                       </div>
                                    </div>
                                    <div class="col-4 form-group">
                                       <label class="control-label" for="uemail">Email*</label>
                                       <div class="mb-2">
                                          <input type="email" class="form-control" id="uemail" name="email" placeholder="Email" required />
                                       </div>
                                    </div>
                                    <div class="col-4 form-group">
                                       <label class="control-label" for="uemail">Salário*</label>
                                       <div class="mb-2">
                                          <input type="number" min="0" class="form-control" id="uemail" name="salary" placeholder="Salario" required />
                                       </div>
                                    </div>
                                 </div>
                                 
                                 <div class="row">
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="state">Agência*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="agency" id="estado_civil" required>
                                          <option selected disabled>Selecionar</option>
                                          <?php foreach($agencies as $agency): ?>
                                             <option value="<?=$agency['id']?>"><?=$agency['nome']?></option>
                                          <?php endforeach; ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="state">Departamento*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="department" id="estado_civil" required>
                                          <option selected disabled>Selecionar</option>
                                          <?php foreach($departments as $department): ?>
                                             <option value="<?=$department['id']?>"><?=$department['nome']?></option>
                                          <?php endforeach; ?>
                                          </select>
                                    </div>
                                 </div>
                                 <div class="col-4 form-group">
                                    <label class="control-label" for="state">Nivel de Acesso*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="role_id" id="estado_civil" required>
                                          <option selected disabled>Selecionar</option>
                                          <?php foreach($roles as $role): ?>
                                             <option value="<?=$role['id']?>"><?=$role['nome']?></option>
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