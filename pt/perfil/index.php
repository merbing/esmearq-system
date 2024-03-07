<?php 
   include("../env/auth_check.php");
   ?>
<!DOCTYPE html>
<html lang="pt">
   <head> 
      <?php 
         include("../views/include/head.php");
         include("../banco/config.php");
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
                     <div class="col-md-12">
                        <div class="card card-statistics">
                           <div class="card-body">
                              <div class="row tabs-contant">
                                 <div class="col-xxl-6">
                                    <div class="card card-statistics">
                                       <div class="card-header">
                                          <div class="card-heading">
                                             <h4 class="card-title">Minhas Informações Pessoais</h4>
                                          </div>
                                       </div>
                                       <div class="card-body">
                                          <div class="tab">
                                             <form action="processar/funcionario/senha.php" method="post" class="form-horizontal">
                                                <div class="form-group">
                                                   <label for="nome_funcionario">Nome</label>
                                                   <input type="text" class="form-control" id="nome_funcionario" value="<?php echo $user_name?>" placeholder="Nome do Funcionário" disabled />
                                                </div>
                                                <div class="form-group">
                                                   <label for="cargo_id">Cargo</label>
                                                   <select class="form-control" id="cargo_id">
                                                      <option value="" selected disabled><?php 
                                                      if ($cargo_id == 0){
                                                        echo "Analista";
                                                      }
                                                      elseif($cargo_id == 1){
                                                        echo "Supervisor";
                                                      }
                                                      elseif($cargo_id == 2){
                                                        echo "Diretor";
                                                      }
                                                      elseif ($cargo_id == 3){
                                                      echo "Diretor";
                                                    } 
                                                      ?></option>
                                                   </select>
                                                </div>
                                                <div class="form-group">
                                                   <label for="agencia_id">Agência</label>
                                                   <select class="form-control" id="agencia_id">
                                                      <?php
                                                         $query = "SELECT id_agencia, nome_agencia FROM agencias WHERE id_agencia = $agencia_id ";
                                                         $resultado = mysqli_query($conn, $query);
                                                         
                                                         while ($linha = mysqli_fetch_assoc($resultado)) {
                                                             echo "<option selected disabled value='" . $linha['id_agencia'] . "'>" . $linha['nome_agencia'] . "</option>";
                                                         }
                                                         ?>
                                                   </select>
                                                </div>
                                                <div class="form-group">
                                                   <label for="email">E-mail</label>
                                                   <input type="email" disabled class="form-control" id="email" value="<?php echo $user_email ?>" placeholder="E-mail" />
                                                </div>
                                                <input type="hidden" name="funcionario_id" value="<?php echo $funcionario_id?>">
                                                <div class="form-group">
                                                   <label for="telefone">Senha</label>
                                                   <input type="password" class="form-control" id="Senha" placeholder="Senha Atual" required name="senha_atual" />
                                                </div>
                                                <div class="form-group">
                                                   <label for="telefone">Nova Senha</label>
                                                   <input type="password" class="form-control" id="Senha" placeholder="Nova Senha" required name="nova_senha" />
                                                </div>
                                                <button type="submit" class="btn btn-primary">Atualizar</button>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
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
        var url = window.location.href;
        var mensagemEncoded = url.split('?mensagem=')[1]; // Obtém a parte após '?mensagem='

        var mensagemDecoded = decodeURIComponent(mensagemEncoded.replace(/\+/g, ' '));

        alert(mensagemDecoded);
    </script>
      <script src="../assets/js/vendors.js"></script>
      <!-- custom app -->
      <script src="../assets/js/app.js"></script>
   </body>
</html>