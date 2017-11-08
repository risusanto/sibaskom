<form id="form" action="<?= $form_action ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
	<input type="hidden" name="id_user" value="<?php echo set_value('id_user', isset($default['id_user']) ? $default['id_user'] : ''); ?>">
	<input type="hidden" name="flag" value="<?php echo set_value('flag', isset($default['flag']) ? $default['flag'] : ''); ?>">
<?php echo validation_errors(); ?>
 	<div class="col-md-12" <?= (isset($default['flag'])) ? 'hidden' : '' ?>>
    	<div class="card">
	        <div class="card-header">
	           <i class="fa fa-align-justify"></i> Form Data Login
	        </div>
	        <div class="card-block">
        	    <div class="form-group">
	                <label class="" for="text-input">NIP</label>
	                <div class="">
	                    <input type="text" class="form-control" name="nik" placeholder="NIP" value="<?php echo set_value('nik', isset($default['nik']) ? $default['nik'] : ''); ?>" required>
	                </div>
	            </div>
	            <?php if(!isset($default['nik'])){ ?>
	            <div class="form-group">
	                <label class="" for="text-input">Password</label>
	                <div class="">
	                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" value="<?php echo set_value('password', isset($default['password']) ? $default['password'] : ''); ?>" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Password Konfirmasi</label>
	                <div class="">
	                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password Konfirmasi" value="" required>
	                </div>
	            </div>
	            <?php } ?>
	            <div class="form-group">
	                <label class="" for="text-input">Level User</label>
	                <div class="">
	                    <?php 
							$options = array(
							    ''          => 'Pilih Level',
							    '1'        	=> 'Administrator',
							    '2'    		=> 'User'
							    );
							echo form_dropdown('id_level', $options, set_value('id_level', (isset($default['id_level'])) ? $default['id_level'] : ''), 'class="form-control" required') ;
						?>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Status Aktif</label>
	                <div class="">
	            		<input type="checkbox" name="aktif" data-size="small" data-on-text="Aktif" data-off-text="Tidak Aktif" <?= (isset($default['aktif']) && $default['aktif'] == 1) ? 'checked="true"' : ''; ?> >
	                </div>
	            </div>
		    </div>
		</div>
	</div>
	<div class="col-md-12">
    	<div class="card">
	        <div class="card-header">
	           <i class="fa fa-align-justify"></i> Form Biodata
	        </div>
	        <div class="card-block">
	        	<div class="form-group">
	                <label class="" for="text-input">Nama Lengkap</label>
	                <div class="">
	                    <input type="text" class="form-control" name="full_name" placeholder="Nama Lengkap" value="<?php echo set_value('full_name', isset($default['full_name']) ? $default['full_name'] : ''); ?>" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Unit</label>
	                <div class="">
	                    <input type="text" class="form-control" name="unit" placeholder="Unit" value="<?php echo set_value('unit', isset($default['unit']) ? $default['unit'] : ''); ?>" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Bagian</label>
	                <div class="">
	                    <input type="text" class="form-control" name="bagian" placeholder="Bagian" value="<?php echo set_value('bagian', isset($default['bagian']) ? $default['bagian'] : ''); ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Email Korporat</label>
	                <div class="">
	                    <input type="email" class="form-control" name="email_korporat" placeholder="Email Korporat" value="<?php echo set_value('email_korporat', isset($default['email_korporat']) ? $default['email_korporat'] : ''); ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Email Non Korporat</label>
	                <div class="">
	                    <input type="email" class="form-control" name="email_nonkorporat" placeholder="Email Non Korporat" value="<?php echo set_value('email_nonkorporat', isset($default['email_nonkorporat']) ? $default['email_nonkorporat'] : ''); ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">No Handphone</label>
	                <div class="">
	                    <input type="number" class="form-control" name="no_hp" placeholder="No Handphone" value="<?php echo set_value('no_hp', isset($default['no_hp']) ? $default['no_hp'] : ''); ?>">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Foto</label>
 					<?php if(isset($default['photo'])){ ?>
		            	<div class="row">
		                	<img src="<?= base_url()."uploads/photo/".$default['photo'] ?>" alt="foto" class="col-md-3" style="max-height: 300px">	
		                </div>
	                <?php } ?>
	                <div class="">
	                    <input type="file" id="photo" name="photo" class="form-control">
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
<script>
	$("[name='aktif']").bootstrapSwitch();
</script>
