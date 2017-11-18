<?php
$nik = $this->session->userdata('nik');
$id_user = $this->session->userdata('id_users');
if ($this->session->userdata('level') == 1) { ?>
<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>index.php/dashboard"><i class="icon-speedometer"></i> Dashboard</a>
            </li>
            <!-- menu admin -->
            <li class="nav-title">
                Main Menu
            </li>
            <li class="nav-item">
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-child"></i> Users</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/user">
                                <i class="fa fa-clone"></i> List Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/user/list_field">
                                <i class="fa fa-list-alt"></i> Import Data Excel
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>index.php/email/ubah/1">
                    <i class="fa fa-envelope-o"></i> Email Notifikasi
                </a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-o"></i> Sertifikat</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/field">
                                <i class="fa fa-clone"></i> List Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/field/list_field">
                                <i class="fa fa-list-alt"></i> Import Data Excel
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-o"></i> Assessment</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/assessment">
                                <i class="fa fa-clone"></i> List Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/assessment/list_field">
                                <i class="fa fa-list-alt"></i> Import Data Excel
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-o"></i> Diklat</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/diklat">
                                <i class="fa fa-clone"></i> List Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/diklat/list_field">
                                <i class="fa fa-list-alt"></i> Import Data Excel
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-o"></i> Fit & Proper Test</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/fit_and_proper">
                                <i class="fa fa-clone"></i> List Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/fit_and_proper/list_field">
                                <i class="fa fa-list-alt"></i> Import Data Excel
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-o"></i> Penugasan</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/penugasan">
                                <i class="fa fa-clone"></i> List Data
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>index.php/penugasan/list_field">
                                <i class="fa fa-list-alt"></i> Import Data Excel
                            </a>
                        </li>
                    </ul>
                </li>
            </li>
            <li class="nav-title">
                Account Menu
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>index.php/user/changepassword/<?= $nik."/".$id_user ?>">
                    <i class="fa fa-key"></i> Change Password
                </a>
                <a class="nav-link" href="<?= base_url() ?>index.php/user/profile/<?= $nik."/".$id_user ?>">
                    <i class="fa fa-user"></i> Edit Profile
                </a>
                <a class="nav-link" href="<?= base_url() ?>index.php/login/logout">
                    <i class="fa fa-lock"></i> Logout
                </a>
            </li>
            <!-- end menu admin -->
        </ul>
    </nav>
</div>
<?php } else { ?>
<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>index.php/dashboard"><i class="icon-speedometer"></i> Dashboard</a>
            </li>
            <!-- menu admin -->
            <li class="nav-title">
                Main Menu
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>index.php/field"><i class="fa fa-file-o"></i> Sertifikat</a>
            </li>
            <li class="nav-title">
                Account Menu
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>index.php/user/changepassword/<?= $nik."/".$id_user ?>">
                    <i class="fa fa-key"></i> Change Password
                </a>
                <a class="nav-link" href="<?= base_url() ?>index.php/user/profile/<?= $nik."/".$id_user ?>">
                    <i class="fa fa-user"></i> Edit Profile
                </a>
                <a class="nav-link" href="<?= base_url() ?>index.php/login/logout">
                    <i class="fa fa-lock"></i> Logout
                </a>
            </li>
            <!-- end menu admin -->
        </ul>
    </nav>
</div>
<?php }?>
