<?php
helper('url');
$uri = service('uri');
$basePath = $uri->getPath();

$routePath = trim(str_replace('/projects/videosPlatform', '', $basePath), '/');
?>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="<?php echo base_url('admin'); ?>">
                        <i class="fas fa-home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('admin/clients') ?>">
                        <i class="fas fa-users"></i>
                        <span data-key="t-dashboard">Clients</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('admin/media_clips') ?>">
                        <i class="fas fa-folder"></i>
                        <span data-key="t-dashboard">Media Clips</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-box"></i>
                        <span data-key="t-components">Components</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo base_url('admin/industries/manage') ?>" data-key="t-alerts">Industries</a></li>
                        <li><a href="<?php echo base_url('admin/media-houses/manage') ?>" data-key="t-buttons">Media Houses</a></li>
                        <li><a href="<?php echo base_url('admin/slots/manage') ?>" data-key="t-cards">Slots</a></li>
                        <li><a href="<?php echo base_url('admin/platforms/manage') ?>" data-key="t-carousel">Platforms</a></li>
                    </ul>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Settings</li>
                <li>
                    <a href="<?php echo base_url('admin/settings') ?>">
                        <i class="fas fa-cog"></i>
                        <span data-key="t-horizontal">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-user-cog"></i>
                        <span data-key="t-components">User Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo base_url('admin/users') ?>" data-key="t-alerts">Users</a></li>
                        <li><a href="<?php echo base_url('admin/groups/add') ?>" data-key="t-alerts">User Groups</a></li>
                        <li><a href="<?php echo base_url('admin/permissions') ?>" data-key="t-buttons">Permissions</a></li>
                    </ul>
                </li>
            </ul>

            <!-- <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="assets/images/giftbox.png" alt="">
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16">Unlimited Access</h5>
                        <p class="font-size-13">Upgrade your plan from a Free trial, to select ‘Business Plan’.</p>
                        <a href="#!" class="btn btn-primary mt-2">Upgrade Now</a>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- Sidebar -->
    </div>
    
</div>