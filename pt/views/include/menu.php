<?php 
include_once("../../config/auth.php");


?>
<?php $lozalizador = "../";?>
<aside class="app-navbar">
    <!-- begin sidebar-nav -->
    <div class="sidebar-nav scrollbar scroll_light">
        <ul class="metismenu" id="sidebarNav">
            <li class="nav-static-title">Dashboard</li>
            <li class="active">
                <a href="<?php echo $lozalizador;?>" aria-expanded="false">
                    <i class="nav-icon ti ti-dashboard"></i>
                    <span class="nav-title">Visão Geral</span>
                </a>
            </li>

            <?php if(in_array("Ver Factura",$permissoes) || in_array("Ver Serviços",$permissoes)):?>
            <li class="nav-static-title">Comercial</li>
            <li>
                <a href="../comercial/" aria-expanded="false">
                    <i class="nav-icon ti ti-shopping-cart"></i>
                    <span class="nav-title">Atividades Comerciais</span>
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array("Ver Clientes",$permissoes) ):?>
            <li class="nav-static-title">Clientes</li>
            <li>
                <a href="../clientes/" aria-expanded="false">
                    <i class="nav-icon ti ti-list"></i>
                    <span class="nav-title">Atividades de Clientes</span>
                </a>
            </li>
            <?php endif; ?>
            <?php if(in_array("Ver Lista das Consultorias",$permissoes) ):?>
            <li class="nav-static-title">Constultoria</li>
            <li>
                <a href="../consultoria/" aria-expanded="false">
                    <i class="nav-icon ti ti-shopping-cart"></i>
                    <span class="nav-title">Atividades de Consultoria</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(in_array("Ver Processo",$permissoes) ):?>
            <li class="nav-static-title">Processos</li>
            <li>
                <a href="../processos/" aria-expanded="false">
                    <i class="nav-icon ti ti-shopping-cart"></i>
                    <span class="nav-title">Atividades de Processos</span>
                </a>
            </li>
            <?php endif;?>

            <?php if(in_array("Ver Atividade",$permissoes) ):?>
            <li class="nav-static-title">TODO</li>
            <li>
                <a href="../daily_do/" aria-expanded="false">
                    <i class="nav-icon ti ti-list"></i>
                    <span class="nav-title">Atividades de Diárias</span>
                </a>
            </li>
            <?php  endif;?>
            <?php if(in_array("Ver Transação",$permissoes) || in_array("Ver Contas Bancárias",$permissoes)):?>
            <li class="nav-static-title">Financeiro</li>
            <li>
                <a href="../financeiro/" aria-expanded="false">
                    <i class="nav-icon ti ti-money"></i>
                    <span class="nav-title">Atividades Financeiras</span>
                </a>
            </li>
            <?php endif;?>

            <?php if(in_array("Ver Funcionários",$permissoes) ):?>
            <li class="nav-static-title">Recursos Humanos</li>
            <li>
                <a href="../rh/" aria-expanded="false">
                    <i class="nav-icon ti ti-user"></i>
                    <span class="nav-title">Atividades de RH</span>
                </a>
            </li>
            <li>
                <a href="../freelancers/" aria-expanded="false">
                    <i class="nav-icon ti ti-user"></i>
                    <span class="nav-title">Freelancers</span>
                </a>
            </li>
            <?php endif;?>
            <?php if(in_array("Ver Agência",$permissoes) ):?>
            <li class="nav-static-title">Administrativo</li>
            <li>
                <a href="../admin/" aria-expanded="false">
                    <i class="nav-icon ti ti-settings"></i>
                    <span class="nav-title">Atividades Administrativas</span>
                </a>
            </li>
            <?php endif;?>
            <li class="nav-static-title">Ajuda e Suporte</li>

            <li>
                <a href="central-ajuda.html" aria-expanded="false">
                    <i class="nav-icon ti ti-info-alt"></i>
                    <span class="nav-title">Central de Ajuda</span>
                </a>
            </li>

            <li class="nav-static-title">Sair</li>
            <li>
                <a href="../../logout.php" aria-expanded="false">
                    <i class="nav-icon ti ti-shift-right"></i>
                    <span class="nav-title">Sair do Sistema</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- end sidebar-nav -->
</aside>
