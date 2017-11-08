<form id="form" action="<?= $form_action ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
	<input type="hidden" name="id_user" value="<?php echo set_value('id_user', isset($default['id_user']) ? $default['id_user'] : ''); ?>">
	<input type="hidden" name="nik" value="<?php echo set_value('nik', isset($default['nik']) ? $default['nik'] : ''); ?>">
	<input type="hidden" name="flag" value="<?php echo set_value('flag', isset($default['flag']) ? $default['flag'] : ''); ?>">
<?php echo validation_errors(); ?>
 	<div class="col-md-12">
    	<div class="card">
	        <div class="card-header">
	           <i class="fa fa-align-justify"></i> <?= $box_title ?>
	        </div>
	        <div class="card-block">
	        	<div class="form-group" <?= ($default['flag'] == 'resetpassword') ? 'hidden' : '' ?>>
	                <label class="" for="text-input">Password Lama</label>
	                <div class="">
	                    <input type="password" class="form-control" name="password" placeholder="Password Lama" value="" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Password Baru</label>
	                <div class="">
	                    <input type="password" id="password" class="form-control" name="password_baru" placeholder="Password Baru" value="" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Password Konfirmasi</label>
	                <div class="">
	                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password Konfirmasi" value="" required>
	                </div>
	            </div>
		    </div>
		    <div class="card-footer">
	            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
	            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
	        </div>
		</div>
	</div>
</form>
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