<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
       if(!isset($_GET['funcionario_id']))
       {
          
         $error_message = "Funcionário não encontrado";
         header("Location: lista.php?error_message=". urlencode($error_message));
         // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
       }
       include("../views/include/head.php");
       include("../../banco/config.php");
       include("consultas/funcionarios/buscar.php");
       include_once("../config/auth.php");
       include("consultas/departamentos/dados.php");
       include("consultas/papeis/dados.php");
       include("consultas/agencias/dados.php");
       if(!$employe)
       {
          
         $error_message = "Funcionário não encontrado";
         header("Location: lista.php?error_message=". urlencode($error_message));
         // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
       }

       if(!in_array("Ver Funcionários",$permissoes) ){
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
         <div class="modal" tabindex="-1" id="MyModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Concluído</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?=$message?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
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
                  <div class="mb-2">
                     <a href="lista.php" class="btn btn-sm btn-dark">Voltar a lista</a>
                  </div>
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
                                 <h4 class="card-title">Editar Funcionário - <span class="text-info"><?=$employe['nome']?></span></h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="processar/funcionarios/editar_info/basicas.php" method="post" class="form-horizontal">
                                 <input type="hidden" name="id_funcionario" value="<?=$employe['id']?>">
                                 <div class="row">
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="nome">Nome Completo*</label>
                                       <div class="mb-2">
                                          <input type="text" class="form-control" id="nome" value="<?=$employe['nome']?>" name="name" placeholder="Nome" required />
                                       </div>
                                    </div>
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="Endereço">Endereço residencial*</label>
                                       <div class="mb-2">
                                          <input type="text" class="form-control" id="Endereço" name="address" value="<?=$employe['endereco']?>" placeholder="Endereço" required />
                                       </div>
                                    </div>
                                 
                                 </div>
                                 <div class="row">
                                    <div class="col-4 form-group">
                                       <label class="control-label" for="Telefone">Número de Telefone*</label>
                                       <div class="mb-2">
                                          <input type="text" class="form-control" id="Telefone" name="phonenumber" value="<?=$employe['telefone']?>" placeholder="Telefone" required />
                                       </div>
                                    </div>
                                    <div class="col-4 form-group">
                                       <label class="control-label" for="uemail">Email*</label>
                                       <div class="mb-2">
                                          <input type="email" class="form-control" id="uemail" name="email" value="<?=$employe['email']?>" placeholder="Email" required />
                                       </div>
                                    </div>
                                    <div class="col-4 form-group">
                                       <label class="control-label" for="uemail">Salário*</label>
                                       <div class="mb-2">
                                          <input type="number" min="0" class="form-control" id="uemail" name="salary" value="<?=$employe['salario']?>" placeholder="Salario" required />
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
                                             <option value="<?=$agency['id']?>" <?=($employe['id_agencia']==$agency['id'])?'selected':''?>     ><?=$agency['nome']?></option>
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
                                             <option value="<?=$department['id']?>" <?=($employe['id_departamento']==$department['id'])?'selected':''?>   ><?=$department['nome']?></option>
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
                                             <option value="<?=$role['id']?>"  <?=($employe['id_papel']==$role['id'])?'selected':''?>  ><?=$role['nome']?></option>
                                          <?php endforeach; ?>
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
      <script>
         $(document).ready(function(){

            $('#MyModal').modal('show')
            
         })
        
      </script>
   </body>
</html>