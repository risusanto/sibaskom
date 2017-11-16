<?php 
$level = $this->session->userdata('level');
$nik = $this->session->userdata('nik');
?>
<div class="col-xs-12">
	<div class="card">
		<div class="card-header">
			<strong>Dashboard</strong>
		</div>
		<div class="card-block">
			<h2>Welcome Back, <?php echo $this->session->userdata('nama'); ?>!</h2>
		    <p>This section represents the area that only logged in user can access.</p>
		</div>
	</div>
	<div class="card" <?= ($level == "2") ? "hidden" : "" ?>>
		<div class="card-header">
			<strong>Notifikasi Data Sertifikat</strong>
		</div>
		<div class="card-block">
			<div class="row">
				<div class="col-sm-12 col-lg-6">
				    <ul class="icons-list">
		                <li>
		                    <i class="icon-book-open bg-danger"></i>
		                    <div class="desc">
		                        <div class="title">3 Bulan</div>
		                        <small>Expired sertifikat mendekati 3 bulan</small>
		                    </div>
		                    <div class="value">
		                        <div class="small text-muted">data</div>
		                        <strong><?= $jml3Bulan ?></strong>
		                    </div>
		                    <div class="actions">
		                        <button type="button" class="btn btn-link text-muted" onclick="location.href='<?= base_url() ?>index.php/field/listEx/3'"><i class="icon-settings"></i>
		                        </button>
		                    </div>
		                </li>
		                <li>
		                    <i class="icon-book-open bg-warning"></i>
		                    <div class="desc">
		                        <div class="title">6 Bulan</div>
		                        <small>Expired sertifikat mendekati 6 bulan</small>
		                    </div>
		                    <div class="value">
		                        <div class="small text-muted">data</div>
		                        <strong><?= $jml6Bulan ?></strong>
		                    </div>
		                    <div class="actions">
		                        <button type="button" onclick="location.href='<?= base_url() ?>index.php/field/listEx/6'" class="btn btn-link text-muted"><i class="icon-settings"></i>
		                        </button>
		                    </div>
		                </li>
		                <li>
		                    <i class="icon-book-open bg-success"></i>
		                    <div class="desc">
		                        <div class="title">1 Tahun</div>
		                        <small>Expired sertifikat mendekati 1 tahun</small>
		                    </div>
		                    <div class="value">
		                        <div class="small text-muted">data</div>
		                        <strong><?= $jml12Bulan ?></strong>
		                    </div>
		                    <div class="actions">
		                        <button type="button" onclick="location.href='<?= base_url() ?>index.php/field/listEx/12'" class="btn btn-link text-muted"><i class="icon-settings"></i>
		                        </button>
		                    </div>
		                </li>
		            </ul>
		        </div>
		        <div class="col-sm-12 col-lg-3">
                    <div class="card card-inverse card-info">
                        <div class="card-block pb-0">
                        	<h3><i class="icon-people"></i></h3>
                            <h4 class="mb-0"><?= $countUser; ?></h4>
                            <p>Total Pegawai</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3">
                    <div class="card card-inverse card-info">
                        <div class="card-block pb-0">
                        	<h3><i class="icon-layers"></i></h3>
                            <h4 class="mb-0"><?= $countSertifikat; ?></h4>
                            <p>Total Sertifikat</p>
                        </div>
                    </div>
                </div>
		    </div>
		</div>
	</div>
</div>
<?php
$flashmessage = $this->session->flashdata('message');
if (!empty($flashmessage)) {
?>
    <script type="text/javascript">
        $(document).ready(function(){
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Pemberitahuan',
                // (string | mandatory) the text inside the notification
                text: '<?=$flashmessage?>'
            });
            return false;
        });
    </script>
<?php
}
?>
