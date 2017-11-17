<style>
	.required {color: red;}
</style>
<?= form_open_multipart('assessment/ubah/'.$assessment->id_assesment, ['id' => 'form', 'class' => 'form-horizontal']) ?>
 	<div class="col-xs-12">
    	<div class="card">
	        <div class="card-header">
	           <i class="fa fa-align-justify"></i> Edit Data Assessment
	        </div>
	        <div class="card-block">
	        	<div class="form-group">
	        		<label for="nip">NIP<span class="required">*</span></label>
	        		<input type="text" name="nip" placeholder="NIP" class="form-control" value="<?=$assessment->nip?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="nama">Nama<span class="required">*</span></label>
	        		<input type="text" name="nama" placeholder="Nama" class="form-control" value="<?=$assessment->nama?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="unit">Unit<span class="required">*</span></label>
	        		<input type="text" name="unit" placeholder="Unit" class="form-control" value="<?=$assessment->unit?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="tanggal_awal_berlaku">Tanggal Awal Berlaku<span class="required">*</span> <small><i>(format: yyyy-mm-dd)</i></small></label>
	        		<input type="text" name="tanggal_awal_berlaku" class="form-control datepicker" placeholder="Tanggal Awal Berlaku" value="<?=$assessment->tanggal_awal_berlaku?>" required readonly>
	        	</div>
	        	<div class="form-group">
	        		<label for="tanggal_akhir_berlaku">Tanggal Akhir Berlaku<span class="required">*</span> <small><i>(format: yyyy-mm-dd)</i></small></label>
	        		<input type="text" name="tanggal_akhir_berlaku" class="form-control datepicker" placeholder="Tanggal Akhir Berlaku" value="<?=$assessment->tanggal_akhir_berlaku?>" required readonly>
	        	</div>
	        	<div class="form-group">
	        		<label for="hasil_assesment">Hasil Assessment<span class="required">*</span></label>
	        		<input type="text" name="hasil_assesment" placeholder="Hasil Assessment" class="form-control" value="<?=$assessment->hasil_assesment?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="rekomendasi">Rekomendasi<span class="required">*</span></label>
	        		<input type="text" name="rekomendasi" placeholder="Rekomendasi" class="form-control" value="<?=$assessment->rekomendasi?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="waktu_alert">Waktu Alert<span class="required">*</span> <small><i>(format: yyyy-mm-dd)</i></small></label>
	        		<input type="text" name="waktu_alert" class="form-control datepicker" placeholder="Waktu Alert" value="<?=$assessment->waktu_alert?>" required readonly>
	        	</div>
	        	<div class="form-group">
	        		<label for="file_evidence">File Evidence<span class="required">*</span></label>
	        		<input type="file" name="file_evidence" class="form-control" placeholder="File Evidence">
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
