<style>
	.block {
	display: block;
}
	form.form-horizontal label.error {
		display: none;
	}
</style>
<?php 
$level = $this->session->userdata('level');
$nik = $this->session->userdata('nik');
$nama_lengkap = $this->session->userdata('nama');
$unit = $this->session->userdata('unit');
?>
<form id="form" action="<?= $form_action ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
	<input type="hidden" name="id_sertifikat" value="<?php echo set_value('id_sertifikat', isset($default['id_sertifikat']) ? $default['id_sertifikat'] : ''); ?>">
 	<div class="col-xs-12">
    	<div class="card">
	        <div class="card-header">
	           <i class="fa fa-align-justify"></i> <?= $box_title ?>
	        </div>
	        <div class="card-block">
        	    <div class="form-group">
	                <label class="" for="text-input">NIP</label>
	                <div class="">
	                    <input type="text" class="form-control" name="nip" placeholder="NIP" <?php if ($level != "2"){ ?> value="<?php echo set_value('nip', isset($default['nip']) ? $default['nip'] : ''); ?>" <? }else{ ?> value="<?= $nik ?>" <?php } ?>  <?= ($level == "2") ? "readonly" : "" ?> required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Nama</label>
	                <div class="">
	                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" <?php if ($level != "2"){ ?>  value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" <? }else{ ?> value="<?= $nama_lengkap ?>" <?php } ?> <?= ($level == "2") ? "readonly" : "" ?> required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Unit</label>
	                <div class="">
	                    <input type="text" class="form-control" name="unit" placeholder="Unit" <?php if ($level != "2"){ ?> value="<?php echo set_value('unit', isset($default['unit']) ? $default['unit'] : ''); ?>" <? }else{ ?> value="<?= $unit ?>" <?php } ?> <?= ($level == "2") ? "readonly" : "" ?> required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Kode Diklat</label>
	                <div class="">
	                    <input type="text" class="form-control" name="kode_diklat" placeholder="Kode Diklat" value="<?php echo set_value('kode_diklat', isset($default['kode_diklat']) ? $default['kode_diklat'] : ''); ?>" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Judul Diklat</label>
	                <div class="">
	                    <input type="text" class="form-control" name="judul_diklat" placeholder="Judul Diklat" value="<?php echo set_value('judul_diklat', isset($default['judul_diklat']) ? $default['judul_diklat'] : ''); ?>" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Kode Sertifikat</label>
	                <div class="">
	                    <input type="text" class="form-control" name="kode_sertifikat" placeholder="Kode Sertifikat" value="<?php echo set_value('kode_sertifikat', isset($default['kode_sertifikat']) ? $default['kode_sertifikat'] : ''); ?>" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Penyelenggara</label>
	                <div class="">
	                    <input type="text" class="form-control" name="penyelenggara" placeholder="Penyelenggara" value="<?php echo set_value('penyelenggara', isset($default['penyelenggara']) ? $default['penyelenggara'] : ''); ?>" required>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Tanggal Mulai Pelatihan</label>
	                <div class="">
	                    <input type="text" class="form-control datepicker" name="tanggal_mulai_pelatihan" placeholder="Tanggal Mulai Pelatihan" value="<?php echo set_value('tanggal_mulai_pelatihan', isset($default['tanggal_mulai_pelatihan']) && $default['masa_belaku_sertifikat'] != "0000-00-00" ? date("d-m-Y", strtotime($default['tanggal_mulai_pelatihan'])) : ''); ?>" required readonly>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">Masa Berlaku Sertifikat</label>
	                <div class="">
	                    <input type="text" class="form-control datepicker" name="masa_belaku_sertifikat" placeholder="Masa Berlaku Sertifikat" value="<?php echo set_value('masa_belaku_sertifikat', isset($default['masa_belaku_sertifikat']) && $default['masa_belaku_sertifikat'] != "0000-00-00" ? date("d-m-Y", strtotime($default['masa_belaku_sertifikat'])) : ''); ?>" required readonly>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">File Sertifikat</label>
	                <?php if(isset($default['file_sertifikat'])) { ?>
	                	<p>
	                	<?=anchor('field/download/'.$default['id_sertifikat'].'/edit', substr($default['file_sertifikat'], 0, 20)."..<br>", array('class' => '"'));?>
	                	</p>
	                <?php } ?>
	                <div class="">
	                    <input type="file" class="form-control" name="file_sertifikat" placeholder="File Sertifikat">
	                </div>
	            </div>
	            <div class="form-group" <?= ($level == "2") ? "hidden" : "" ?>>
	                <label class="" for="text-input">Masa Alert Berlaku Sertifikat</label>
	                <div class="">
	                    <label class="radio-inline margin-left5" for="inline-radio1">
                            <input type="radio" id="inline-radio1" name="masa_alert" value="0" <?= (isset($default['masa_alert']) && $default['masa_alert'] == 0) ? 'checked' : ''; ?> <?= ($level != "2") ? "required" : "" ?>> None
                        </label>
                        <label class="radio-inline margin-left5" for="inline-radio2">
                            <input type="radio" id="inline-radio2" name="masa_alert" value="3" <?= (isset($default['masa_alert']) && $default['masa_alert'] == 3) ? 'checked' : ''; ?> > 3 Bulan
                        </label>
                        <label class="radio-inline margin-left5" for="inline-radio3">
                            <input type="radio" id="inline-radio3" name="masa_alert" value="6" <?= (isset($default['masa_alert']) && $default['masa_alert'] == 6) ? 'checked' : ''; ?> > 6 Bulan
                        </label>
                        <label class="radio-inline margin-left5" for="inline-radio4">
                            <input type="radio" id="inline-radio4" name="masa_alert" value="12" <?= (isset($default['masa_alert']) && $default['masa_alert'] == 12) ? 'checked' : ''; ?> > 1 Tahun
                        </label>
                        <label for="masa_alert" class="error">Please select your gender</label>
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
	$('.datepicker').datepicker({
	    format: 'dd-mm-yyyy',
	    autoclose: true,
	    todayHighlight: true,
	    language: 'id'
	});
</script>
