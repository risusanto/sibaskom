<?php $this->load->view('includes/header'); ?>
<body class="navbar-fixed sidebar-nav fixed-nav">
<?php $this->load->view('includes/nav_bar'); ?>
<?php $this->load->view('includes/sidebar'); ?>

<!-- Main content -->
<main class="main">

    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item" id="datenow"></li>
        <li class="breadcrumb-item" id="clocknow"></li>
    </ol>


    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
				<?php $this->load->view($main_content); ?>
			</div>
		</div>
	</div>
</main>
<script src="<?= base_url() ?>assets/js/jam_tanggal.js"></script>


<?php $this->load->view('includes/footer'); ?>
