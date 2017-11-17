<style>
	.required {color: red;}
</style>
<?= form_open_multipart('penugasan/ubah/'.$penugasan->id_penugasan, ['id' => 'form', 'class' => 'form-horizontal']) ?>
 	<div class="col-xs-12">
    	<div class="card">
	        <div class="card-header">
	           <i class="fa fa-align-justify"></i> Ubah Data Penugasan Pegawai
	        </div>
	        <div class="card-block">
	        	<div class="form-group">
	        		<label for="nip">NIP<span class="required">*</span></label>
	        		<input type="text" name="nip" placeholder="NIP" class="form-control" value="<?=$penugasan->nip?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="nama">Nama<span class="required">*</span></label>
	        		<input type="text" name="nama" placeholder="Nama" class="form-control" value="<?=$penugasan->nama?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="unit">Unit<span class="required">*</span></label>
	        		<input type="text" name="unit" placeholder="Unit" class="form-control" value="<?=$penugasan->unit?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="tanggal_awal_masa_penugasan">Tanggal Awal Masa Penugasan<span class="required">*</span> <small><i>(format: yyyy-mm-dd)</i></small></label>
	        		<input type="text" name="tanggal_awal_masa_penugasan" class="form-control datepicker" placeholder="Tanggal Awal Masa Penugasan" value="<?=$penugasan->tanggal_awal_masa_penugasan?>" required readonly>
	        	</div>
	        	<div class="form-group">
	        		<label for="lokasi_penugasan">Lokasi Penugasan<span class="required">*</span></label>
	        		<input type="text" name="lokasi_penugasan" placeholder="Lokasi Penugasan" class="form-control" value="<?=$penugasan->lokasi_penugasan?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="lama_penugasan">Lama Penugasan<span class="required">*</span></label>
	        		<input type="text" name="lama_penugasan" placeholder="Lama Penugasan" class="form-control" value="<?=$penugasan->lama_penugasan?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="waktu_alert">Waktu Alert<span class="required">*</span> <small><i>(format: yyyy-mm-dd)</i></small></label>
	        		<input type="text" name="waktu_alert" class="form-control datepicker" placeholder="Waktu Alert" value="<?=$penugasan->waktu_alert?>" required readonly>
	        	</div>
		    </div>
		    <div class="card-footer">
	            <button type="submit" name="edit" value="Submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
	            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
	        </div>
		</div>
	</div>
<?= form_close() ?>
<script>
	$('.datepicker').datepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
	    todayHighlight: true,
	    language: 'id'
	});
</script>
