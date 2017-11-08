<div class="col-xs-12">
    <form action="<?= $form_action ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
		<input type="hidden" name="id_level" value="<?php echo set_value('id_level', isset($default['id_level']) ? $default['id_level'] : ''); ?>">
	    <div class="card">
	        <div class="card-header">
	           <i class="fa fa-align-justify"></i> <?= $box_title ?>
	        </div>
	        <div class="card-block">
        	    <div class="form-group row">
	                <label class="col-md-3 form-control-label" for="text-input">Nama Level</label>
	                <div class="col-md-9">
	                    <input type="text" id="text-input" class="form-control" name="nama_level" placeholder="Nama Level" value="<?php echo set_value('nama_level', isset($default['nama_level']) ? $default['nama_level'] : ''); ?>">
	                </div>
	            </div>
		    </div>
			<div class="card-footer">
	            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
	            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
	        </div>
		</div>
	</form>
</div>
