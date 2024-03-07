<header class="app-header top-bar">
   <!-- begin navbar -->
   <nav class="navbar navbar-expand-md">
      <!-- begin navbar-header -->
      <div class="navbar-header d-flex align-items-center">
         <a href="javascript:void:(0)" class="mobile-toggle"><i class="ti ti-align-right"></i></a>
         <a class="navbar-brand" href="index.html">
         <img src="assets/img/logoa.png" class="img-fluid logo-desktop" alt="logo" />
         <img src="assets/img/logoa.png" class="img-fluid logo-mobile" alt="logo" />
         </a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="ti ti-align-left"></i>
      </button>
      <!-- end navbar-header -->
      <!-- begin navigation -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <div class="navigation d-flex">
            <ul class="navbar-nav nav-left">
               <li class="nav-item">
                  <a href="javascript:void(0)" class="nav-link sidebar-toggle">
                  <i class="ti ti-align-right"></i>
                  </a>
               </li>
               <li class="nav-item full-screen d-none d-lg-block" id="btnFullscreen">
                  <a href="javascript:void(0)" class="nav-link expand">
                  <i class="icon-size-fullscreen"></i>
                  </a>
               </li>
            </ul>
            <ul class="navbar-nav nav-right ml-auto">
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fe fe-bell"></i>
                  <?php
                     $status = 'pendente';
                     
                     if ($cargo_id == 1 || $cargo_id == 0) {
                         $sql = "SELECT * FROM submissao_credito
                                 WHERE status = '$status' AND id_agencia = '$agencia_id' ORDER BY id_submissao DESC LIMIT 10";
                     } else {
                         $sql = "SELECT * FROM submissao_credito
                                 WHERE status = '$status' ORDER BY id_submissao DESC LIMIT 10";
                     }
                     
                     $result = $conn->query($sql);
                     
                     if ($result->num_rows > 0) {
                         $num_notificacoes = $result->num_rows;
                     ?>
                  <span class="notify">
                  <span class="blink"></span>
                  <span class="dot"></span>
                  </span>
                  </a>
                  <div class="dropdown-menu extended animated fadeIn" aria-labelledby="navbarDropdown">
                     <ul>
                        <li class="dropdown-header bg-gradient p-4 text-white text-left">Notificações
                           <a href="#" class="float-right btn btn-square btn-inverse-light btn-xs m-0">
                           <span class="font-13"> Ver Todas</span></a>
                        </li>
                        <li class="dropdown-body min-h-240 nicescroll">
                           <ul class="scrollbar scroll_dark max-h-240">
                              <?php
                                 while ($row = $result->fetch_assoc()) {
                                     ?>
                              <li>
                                 <a href="../credito/status_credito?credito_selecionado=<?php echo $row['id_submissao']?>">
                                    <div class="notification d-flex flex-row align-items-center">
                                       <div class="notify-icon bg-img align-self-center">
                                          <div class="bg-type bg-type-md">
                                             <span>C</span>
                                          </div>
                                       </div>
                                       <div class="notify-message">
                                          <p class="font-weight-bold">Novo crédito pendente para conta #<?php echo $row['id_cliente']; ?></p>
                                          <small><?php echo $row['data_submissao']; ?></small>
                                       </div>
                                    </div>
                                 </a>
                              </li>
                              <?php } ?>
                           </ul>
                        </li>
                        <li class="dropdown-footer">
                           <a class="font-13" href="javascript:void(0)"> Ver Todos Créditos Pendentes
                           </a>
                        </li>
                     </ul>
                  </div>
                  <?php } ?>
               </li>
               <li class="nav-item">
                  <a class="nav-link search" href="javascript:void(0)">
                  <i class="ti ti-search"></i>
                  </a>
                  <div class="search-wrapper">
                     <div class="close-btn">
                        <i class="ti ti-close"></i>
                     </div>
                     <div class="search-content">
                        <form>
                           <div class="form-group">
                              <i class="ti ti-search magnifier"></i>
                              <input type="text" class="form-control autocomplete" placeholder="Search Here" id="autocomplete-ajax" autofocus="autofocus">
                           </div>
                        </form>
                     </div>
                  </div>
               </li>
               <li class="nav-item dropdown user-profile">
                  <a href="javascript:void(0)" class="nav-link dropdown-toggle " id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="assets/img/avtar/02.jpg" alt="avtar-img">
                  <span class="bg-success user-status"></span>
                  </a>
                  <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                     <div class="bg-gradient px-4 py-3">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="mr-1">
                              <h4 class="text-white mb-0"><?php echo $user_name?></h4>
                              <small class="text-white"><?php echo $user_email?></small>
                           </div>
                           <a href="../../logout" class="text-white font-20 tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Logout"> <i
                              class="zmdi zmdi-power"></i></a>
                        </div>
                     </div>
                     <div class="p-4">
                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                        <i class="fa fa-user pr-2 text-success"></i> Perfil</a>
                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                        <i class="fa fa-envelope pr-2 text-primary"></i> Tarefas
                        <span class="badge badge-primary ml-auto">6</span>
                        </a>
                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                        <i class=" ti ti-settings pr-2 text-info"></i> Configurações de Conta
                        </a>
                        <a class="dropdown-item d-flex nav-link" href="javascript:void(0)">
                        <i class="fa fa-compass pr-2 text-warning"></i> Need help?</a>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </div>
      <!-- end navigation -->
   </nav>
   <!-- end navbar -->
</header>