
<header class="app-header top-bar">
   <!-- begin navbar -->
   <nav class="navbar navbar-expand-md">
      <!-- begin navbar-header -->
      <div class="navbar-header d-flex align-items-center">
         <a href="javascript:void:(0)" class="mobile-toggle"><i class="ti ti-align-right"></i></a>
         <a class="navbar-brand" href="../">
         <img src="../assets/img/logoa.png" class="img-fluid logo-desktop" alt="logo" />
         <img src="../assets/img/logoa.png" class="img-fluid logo-mobile" alt="logo" />
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
                  <span class="notify">
                  <span class="blink"></span>    
                  <span class="dot"></span>
                  </span> 
                  </a>
                  <div class="dropdown-menu extended animated fadeIn" aria-labelledby="navbarDropdown">
                     <ul>
                        <li class="dropdown-body min-h-240 nicescroll">
                        </li>
                        <li class="dropdown-footer">
                           <a class="font-13" href="../notificacoes/"> Ver Todos As Solicitações
                           </a>
                        </li>
                     </ul>
                  </div>
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
                              <input type="text" class="form-control autocomplete" placeholder="Pesquise aqui" id="autocomplete-ajax" autofocus="autofocus">
                           </div>
                        </form>
                     </div>
                  </div>
               </li>
               <li class="nav-item dropdown user-profile">
                  <a href="javascript:void(0)" class="nav-link dropdown-toggle " id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="../assets/img/avtar/user.jfif" alt="avtar-img">
                  <span class="bg-success user-status"></span>
                  </a>
                  <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                     <div class="bg-gradient px-4 py-3">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="mr-1">
                              <h4 class="text-white mb-0"><?php $user_name?></h4>
                              <small class="text-white"><?php $user_email?></small>
                           </div>
                           <a href="../../Logout.php" class="text-white font-20 tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Logout"> <i
                              class="zmdi zmdi-power"></i></a>
                        </div>
                     </div>
                     <div class="p-4">
                        <a class="dropdown-item d-flex nav-link" href="../perfil/">
                        <i class="fa fa-user pr-2 text-success"></i> Meu Perfil</a>
                        <a class="dropdown-item d-flex nav-link" href="../perfil/solicitacoes_pedidos">
                        <i class="fa fa-envelope pr-2 text-primary"></i> Novas de Solicitações
                        </a>
                        <a class="dropdown-item d-flex nav-link" href="../perfil/solicitacoes_minhas">
                        <i class="fa fa-exclamation-circle pr-2 text-warning"></i> Estado de Solicitações
                        </a>
                        <a class="dropdown-item d-flex nav-link" href="../perfil/">
                        <i class=" ti ti-unlock pr-2 text-info"></i> Minha Senha
                        </a>
                        <div class="row mt-2">
                           <div class="col">
                              <a class="bg-light p-3 text-center d-block" href="../perfil/solicitacoes_solicitar">
                              <i class="fe fe-plus font-20 text-primary"></i>
                              <span class="d-block font-13 mt-2">Nova Solicitação</span>
                              </a>
                           </div>
                        </div>
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