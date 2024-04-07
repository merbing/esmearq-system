<?php 
      session_start();

      include("../views/include/head.php");
        include("../../banco/config.php");
        include_once("../config/auth.php");
       
        if(!$auth_funcionario_id)
        {
            $error_message = "Ocorreu um erro. Não tem permissão para ver isto";
            header("Location: ../home/index.php?error_message=". urlencode($error_message));
        }
        try{

            $query = "SELECT * FROM funcionarios  WHERE id = '$auth_funcionario_id' ";
    
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $funcionario = null;
            if ($result->num_rows > 0) {
                $funcionario = $result->fetch_assoc();
            }else{
                $error_message = "Ocorreu um erro. Dados Não disponíveis";
                header("Location: ../home/index.php?error_message=". urlencode($error_message));
            }
            
        }catch(Exception $e)
        {
            $error_message = "Ocorreu um erro. Dados Não disponíveis";
            header("Location: ../home/index.php?error_message=". urlencode($error_message));
        }

?>
        <!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
      
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
                  <!-- <div class="mb-2">
                     <a href="lista.php" class="btn btn-sm btn-dark">Voltar a lista</a>
                  </div> -->
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
                                 <h4 class="card-title">Meus dados pessoais </h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="processar/conta/editar/basico.php" method="post" class="form-horizontal">
                                 
                                 <div class="row">
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="nome">Nome Completo*</label>
                                       <div class="mb-2">
                                          <input type="text" class="form-control" id="nome" name="name" value="<?=$funcionario['nome']??$auth_user_name??'' ?>" placeholder="Nome" required />
                                       </div>
                                    </div>
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="Endereço">Endereço residencial*</label>
                                       <div class="mb-2">
                                          <input type="text" class="form-control" id="Endereço" value="<?=$funcionario['endereco']??'' ?>" name="address" placeholder="Endereço" required />
                                       </div>
                                    </div>
                                 
                                 </div>
                                 <div class="row">
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="Telefone">Número de Telefone*</label>
                                       <div class="mb-2">
                                          <input type="text" class="form-control" id="Telefone" value="<?=$funcionario['telefone']??$auth_user_phone??'' ?>" name="phonenumber" placeholder="Telefone" required />
                                       </div>
                                    </div>
                                    <div class="col-6 form-group">
                                       <label class="control-label" for="uemail">Email*</label>
                                       <div class="mb-2">
                                          <input type="email" class="form-control" id="uemail" name="email" value="<?=$funcionario['email']??$auth_user_email??'' ?>" placeholder="Email" required />
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