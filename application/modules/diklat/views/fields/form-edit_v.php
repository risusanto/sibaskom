<style>
	.required {color: red;}
</style>
<?= form_open_multipart('diklat/ubah/'.$diklat->id_diklat, ['id' => 'form', 'class' => 'form-horizontal']) ?>
 	<div class="col-xs-12">
    	<div class="card">
	        <div class="card-header">
	           <i class="fa fa-align-justify"></i> Ubah Data Diklat
	        </div>
	        <div class="card-block">
	        	<div class="form-group">
	        		<label for="nip">NIP<span class="required">*</span></label>
	        		<input type="text" name="nip" placeholder="NIP" class="form-control" value="<?=$diklat->nip?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="nama">Nama<span class="required">*</span></label>
	        		<input type="text" name="nama" placeholder="Nama" class="form-control" value="<?=$diklat->nama?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="unit">Unit<span class="required">*</span></label>
	        		<input type="text" name="unit" placeholder="Unit" class="form-control" value="<?=$diklat->unit?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="tanggal_awal_berlaku">Tanggal Awal Berlaku<span class="required">*</span> <small><i>(format: yyyy-mm-dd)</i></small></label>
	        		<input type="text" name="tanggal_awal_berlaku" class="form-control datepicker" placeholder="Tanggal Awal Berlaku" value="<?=$diklat->tanggal_awal_berlaku?>" required readonly>
	        	</div>
	        	<div class="form-group">
	        		<label for="tanggal_akhir_berlaku">Tanggal Akhir Berlaku<span class="required">*</span> <small><i>(format: yyyy-mm-dd)</i></small></label>
	        		<input type="text" name="tanggal_akhir_berlaku" class="form-control datepicker" placeholder="Tanggal Akhir Berlaku" value="<?=$diklat->tanggal_akhir_berlaku?>" required readonly>
	        	</div>
	        	<div class="form-group">
	        		<label for="hasil_assesment">No. Sertifikat<span class="required">*</span></label>
	        		<input type="text" name="no_sertifikat" placeholder="No. Sertifikat" class="form-control" value="<?=$diklat->no_sertifikat?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="rekomendasi">Judul Diklat<span class="required">*</span></label>
	        		<input type="text" name="judul_diklat" placeholder="Judul Diklat" class="form-control" value="<?=$diklat->judul_diklat?>" required>
	        	</div>
						<div class="form-group">
	        		<label for="rekomendasi">Lembaga Penyelenggara<span class="required">*</span></label>
	        		<input type="text" name="lembaga_penyelenggara" placeholder="Lembaga Penyelenggara" class="form-control" value="<?=$diklat->lembaga_penyelenggara?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="waktu_alert">Waktu Alert<span class="required">*</span> <small><i>(format: yyyy-mm-dd)</i></small></label>
	        		<input type="text" name="waktu_alert" class="form-control datepicker" placeholder="Waktu Alert" value="<?=$diklat->waktu_alert?>" required readonly>
	        	</div>
	        	<div class="form-group">
	        		<label for="file_evidence">File Sertifikat<span class="required">*</span></label>
	        		<input type="file" name="file_sertifikat" class="form-control" placeholder="File Sertifikat">
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
