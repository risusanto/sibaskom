<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slide/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slide/css/custom.css" />
<script type="text/javascript" src="<?= base_url() ?>assets/slide/js/modernizr.custom.79639.js"></script>
<noscript>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slide/css/styleNoJS.css" />
</noscript>

<div class="container d-table demo-2">
    <div class="d-100vh-va-middle">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card-group">
                    <div class="card p-2">
                    	<form action="<?= base_url() ?>index.php/login/sendResetPassword" method="post">
                            <div class="card-block">
                                <h4>Sistem Database Sertifikasi dan Kompetensi (SI BASKOM)</h4>
                                <p class="text-muted">Forget your account</p>
                                <div class="input-group mb-1">
                                    <span class="input-group-addon"><i class="icon-user"></i>
                                    </span>
                                    <input type="text" class="form-control" name="nik" placeholder="NIP">
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <button type="submit" class="btn btn-primary px-2">Submit</button>
                                    </div>
                                    <div class="col-xs-6 text-xs-right">
                                        <a href="<?= base_url() ?>index.php/login" class="btn btn-link px-0">Ke halam Login</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
 					<div class="card card-inverse card-primary py-3 hidden-md-down" style="width:44%">
 						<div class="card-block text-xs-center">
                            <div>
                                <i><h4>"Listrik untuk Kehidupan yang Lebih Baik"</h4></i>
                            </div>
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