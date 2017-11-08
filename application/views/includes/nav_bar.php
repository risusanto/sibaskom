<?php
$nik = $this->session->userdata('nik');
$id_user = $this->session->userdata('id_users');
?>
<header class="navbar">
    <div class="container-fluid">
        <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">☰</button>
        <a class="navbar-brand" href="#">SI BASKOM</a>
        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler layout-toggler" href="#">☰</a>
            </li>
        </ul>
        <ul class="nav navbar-nav float-xs-right hidden-md-down">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="hidden-md-down"><?= $this->session->userdata('nama') ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <div class="dropdown-header text-xs-center">
                        <strong>Settings</strong>
                    </div>
                    <a class="dropdown-item" href="<?= base_url() ?>index.php/user/profile/<?= $nik."/".$id_user ?>"><i class="fa fa-user"></i> Edit Profile</a>
                    <a class="dropdown-item" href="<?= base_url() ?>index.php/user/changepassword/<?= $nik."/".$id_user ?>"><i class="fa fa-key"></i> Change Password</a>
                    <a class="dropdown-item" href="<?= base_url() ?>index.php/login/logout"><i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>
            <li class="nav-item"></li>
        </ul>
    </div>
</header>