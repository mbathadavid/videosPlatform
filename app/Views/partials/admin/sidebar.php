<?php
helper('url');
$uri = service('uri');
$basePath = $uri->getPath();

$routePath = trim(str_replace('/projects/videosPlatform', '', $basePath), '/');
?>
<div class="side-nav vertical-menu nav-menu-light scrollable">
    <div class="nav-logo">
        <div class="w-100 logo">
            <img class="img-fluid" src="<?php echo base_url() ?>/assets/admin/images/logo/logo.png" style="max-height: 70px;" alt="logo">
        </div>
        <div class="mobile-close">
            <i class="icon-arrow-left feather"></i>
        </div>
    </div>
    <ul class="nav-menu">
        <li class="nav-menu-item router-link-<?php if (preg_match('/^(admin)$/i', $routePath)) echo 'active'; ?>">
            <a href="<?php echo base_url('admin'); ?>">
                <i class="feather icon-home"></i>
                <span class="nav-menu-item-title">Dashboard</span>
            </a>
        </li>



        <li class="nav-submenu <?php if (
                                    preg_match('/^(admin\/industries)/i', $routePath) ||
                                    preg_match('/^(admin\/media-houses)/i', $routePath) ||
                                    preg_match('/^(admin\/slots)/i', $routePath) ||
                                    preg_match('/^(admin\/platforms)/i', $routePath)
                                ) echo 'open'; ?>">
            <a class=" nav-submenu-title">
                <i class="feather icon-package"></i>
                <span>Components</span>
                <i class="nav-submenu-arrow"></i>
            </a>
            <ul class="nav-menu menu-collapse" style="display:  <?php if (
                                                                    preg_match('/^(admin\/industries)/i', $routePath) ||
                                                                    preg_match('/^(admin\/media-houses)/i', $routePath) ||
                                                                    preg_match('/^(admin\/slots)/i', $routePath) ||
                                                                    preg_match('/^(admin\/platforms)/i', $routePath)
                                                                ) echo 'block'; ?>">
                <li class="nav-menu-item router-link-<?php if (preg_match('/^(admin\/industries)/i', $routePath)) echo 'active'; ?>">
                    <a href="<?php echo base_url('admin/industries/manage') ?>">Industries</a>
                </li>
                <li class="nav-menu-item router-link-<?php if (preg_match('/^(admin\/media-houses)/i', $routePath)) echo 'active'; ?>">
                    <a href="<?php echo base_url('admin/media-houses/manage') ?>">Media Houses</a>
                </li>
                <li class="nav-menu-item router-link-<?php if (preg_match('/^(admin\/slots)/i', $routePath)) echo 'active'; ?>">
                    <a href="<?php echo base_url('admin/slotsmanage') ?>">Slots</a>
                </li>
                <li class="nav-menu-item router-link-<?php if (preg_match('/^(admin\/platforms)/i', $routePath)) echo 'active'; ?>">
                    <a href="<?php echo base_url('admin/platforms/manage') ?>">Platforms</a>
                </li>

            </ul>
        </li>
        <li class="nav-submenu open">
            <a class="nav-submenu-title">
                <i class="feather icon-file-text"></i>
                <span>Forms</span>
                <i class="nav-submenu-arrow"></i>
            </a>
            <ul class="nav-menu menu-collapse">
                <li class="nav-menu-item">
                    <a href="v-form-elements.html">Form Elements</a>
                </li>
                <li class="nav-menu-item">
                    <a href="v-form-layouts.html">Form Layouts</a>
                </li>
                <li class="nav-menu-item">
                    <a href="v-form-validation.html">Form Validation</a>
                </li>
            </ul>
        </li>
        <li class="nav-submenu">
            <a class="nav-submenu-title">
                <i class="feather icon-grid"></i>
                <span>Tables</span>
                <i class="nav-submenu-arrow"></i>
            </a>
            <ul class="nav-menu menu-collapse">
                <li class="nav-menu-item">
                    <a href="v-basic-table.html">Basic Table</a>
                </li>
                <li class="nav-menu-item">
                    <a href="v-data-table.html">Data Table</a>
                </li>
            </ul>
        </li>
        <li class="nav-menu-item">
            <a href="v-chart.html">
                <i class="feather icon-bar-chart"></i>
                <span class="nav-menu-item-title">Chart</span>
            </a>
        </li>
        <li class="nav-group-title">PAGES</li>
        <li class="nav-submenu">
            <a class="nav-submenu-title">
                <i class="feather icon-settings"></i>
                <span>Utility</span>
                <i class="nav-submenu-arrow"></i>
            </a>
            <ul class="nav-menu menu-collapse">
                <li class="nav-menu-item">
                    <a href="v-profile-personal.html">Profile</a>
                </li>
                <li class="nav-menu-item">
                    <a href="v-invoice.html">Invoice</a>
                </li>
                <li class="nav-menu-item">
                    <a href="v-faq.html">FAQ</a>
                </li>
                <li class="nav-menu-item">
                    <a href="v-pricing.html">Pricing</a>
                </li>
                <li class="nav-menu-item">
                    <a href="v-user-list.html">User List</a>
                </li>
            </ul>
        </li>
        <li class="nav-submenu">
            <a class="nav-submenu-title">
                <i class="feather icon-lock"></i>
                <span>Auth</span>
                <i class="nav-submenu-arrow"></i>
            </a>
            <ul class="nav-menu menu-collapse">
                <li class="nav-menu-item">
                    <a href="login.html">Login</a>
                </li>
                <li class="nav-menu-item">
                    <a href="login-v2.html">Login v2</a>
                </li>
                <li class="nav-menu-item">
                    <a href="login-v3.html">Login v3</a>
                </li>
                <li class="nav-menu-item">
                    <a href="register.html">Register</a>
                </li>
                <li class="nav-menu-item">
                    <a href="register-v2.html">Register v2</a>
                </li>
                <li class="nav-menu-item">
                    <a href="register-v3.html">Register v3</a>
                </li>
            </ul>
        </li>
        <li class="nav-submenu">
            <a class="nav-submenu-title">
                <i class="feather icon-slash"></i>
                <span>Errors</span>
                <i class="nav-submenu-arrow"></i>
            </a>
            <ul class="nav-menu menu-collapse">
                <li class="nav-menu-item">
                    <a href="error.html">Error 1</a>
                </li>
                <li class="nav-menu-item">
                    <a href="error-v2.html">Error 2</a>
                </li>
            </ul>
        </li>
    </ul>
</div>