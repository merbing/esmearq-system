<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
      session_start();
      if(!isset($_GET['freelancer_id']))
      {
         
        $error_message = "Freelancer não encontrado";
        header("Location: lista.php?error_message=". urlencode($error_message));
        // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
      }

        include("../../banco/config.php");
        include("../views/include/head.php");
        include("consultas/freelancers/buscar.php");
        //  include("processar/cliente/senhas.php");
        include_once("../../config/auth.php");
        if(!$freelancer)
        {
            
           $error_message = "Freelancer não encontrado";
           header("Location: lista.php?error_message=". urlencode($error_message));
           // header("Location: ../../../adicionar.php?error_message=" . urlencode($error_message));
        }

         // verificar se  o utilizador tem permissao para ver essa pagina
        if(!in_array("Adicionar Clientes",$permissoes) ){
            header("Location: ".BASE_URL."pt/home/index.php?error_message=".urlencode("Não tem permissão para ver esta página"));
         
        }

         ?>
   </head>
   <body>
      <!-- <?php 
        //  if(isset($_SESSION['success']))
        //  {
        //     $message = $_SESSION['success'];
      ?>
         <script>
            alert("<?php echo $message?>");
         </script>
      <?php 
    //   $_SESSION['success'] = null;
        //  }
      ?> -->
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
                                 <h4 class="card-title">Adicionar Cliente ao freelancer - <span class="text-info"><?=$freelancer['nome']?></span></h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="processar/cliente/adicionar_info/basicas.php" method="post" class="form-horizontal">
                                 <!-- <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                 <input type="hidden" name="agencia_id" value="<?php echo $agencia_id ?>">
                                 <input type="hidden" class="form-control" name="password" value="<?php echo $senhaGerada ?>" /> -->
                                 <input type="hidden" name="id_freelancer" value="<?=$freelancer['id']?>">
                                 <div class="form-group">
                                    <label class="control-label" for="nome">Nome Completo*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" id="nome" name="name" placeholder="Nome" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="nif">Número de identificação fiscal*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" id="nif" name="nif" placeholder="NIF" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="data_de_nascimento">Data de Nascimento*</label>
                                    <div class="mb-2">
                                       <input type="date" class="form-control" name="birthdate" placeholder="Data de Nascimento" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="nacionalidade">Nacionalidade*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="nationality" id="nacionalidade" required onchange="handleNacionalidade()">
                                          <option selected disabled>Selecionar</option>
                                          <option value="Angola">Angola</option>
                                          <option value="Outra">Outra</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group" id="outra_nacionalidade">
                                    <label class="control-label" for="foreingh_nationality">Nome da Nacionalidade*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" id="nacionalidade_input" name="foreingh_nationality" placeholder="Nome da Nacionalidade" disabled />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="state">Estado Civil*</label>
                                    <div class="mb-2">
                                       <select class="form-control" name="state" id="estado_civil" required>
                                          <option selected disabled>Selecionar</option>
                                          <option value="Solteiro">Solteiro</option>
                                          <option value="Casado">Casado</option>
                                          <option value="Divorciado">Divorciado</option>
                                          <option value="Viúvo">Viúvo</option>
                                          <option value="Separado">Separado</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="Endereço">Endereço residencial*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" id="Endereço" name="address" placeholder="Endereço" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="Telefone">Número de Telefone*</label>
                                    <div class="mb-2">
                                       <input type="text" class="form-control" id="Telefone" name="phonenumber" placeholder="Telefone" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label class="control-label" for="uemail">Email*</label>
                                    <div class="mb-2">
                                       <input type="email" class="form-control" id="uemail" name="email" placeholder="Email" required />
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="form-check">
                                       <input required class="form-check-input" type="checkbox" checked id="uagree" name="uagree">
                                       <label class="form-check-label" for="uagree">Eu Confirmo estas informações*</label>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Iniciar Cadastro</button>
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