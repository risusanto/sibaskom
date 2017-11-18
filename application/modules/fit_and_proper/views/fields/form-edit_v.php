<style>
	.required {color: red;}
</style>
<?= form_open_multipart('fit_and_proper/ubah/'.$fit_and_proper->id_fit_and_proper, ['id' => 'form', 'class' => 'form-horizontal']) ?>
 	<div class="col-xs-12">
    	<div class="card">
	        <div class="card-header">
	           <i class="fa fa-align-justify"></i> Edit Data Fit and Proper
	        </div>
	        <div class="card-block">
	        	<div class="form-group">
	        		<label for="nip">NIP<span class="required">*</span></label>
	        		<input type="text" name="nip" placeholder="NIP" class="form-control" value="<?=$fit_and_proper->nip?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="nama">Nama<span class="required">*</span></label>
	        		<input type="text" name="nama" placeholder="Nama" class="form-control" value="<?=$fit_and_proper->nama?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="unit">Unit<span class="required">*</span></label>
	        		<input type="text" name="unit" placeholder="Unit" class="form-control" value="<?=$fit_and_proper->unit?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="job_suksesi">Job Suksesi<span class="required">*</span></label>
	        		<input type="text" name="job_suksesi" placeholder="Job Suksesi" class="form-control" value="<?=$fit_and_proper->job_suksesi?>" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="penguji">Penguji<span class="required">*</span></label>
	        		<input type="text" name="penguji" placeholder="Penguji" class="form-control" value="<?=$fit_and_proper->penguji?>" required>
	        	</div>
				<div class="form-group">
	        		<label for="hasil_fit_and_proper">Hasil Fit and Proper<span class="required">*</span></label>
	        		<input type="text" name="hasil_fit_and_proper" placeholder="Hasil Fit and Proper" class="form-control" value="<?=$fit_and_proper->hasil_fit_and_proper?>" required>
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
