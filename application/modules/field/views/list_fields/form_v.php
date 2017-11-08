<form action="<?= $form_action ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
	<input type="hidden" name="id_kegiatan_mf" value="<?php echo set_value('id_kegiatan_mf', isset($default['id_kegiatan_mf']) ? $default['id_kegiatan_mf'] : ''); ?>">
 	<div class="col-xs-12">
    	<div class="card">
	        <div class="card-header">
	           <i class="fa fa-align-justify"></i> <?= $box_title ?>
	        </div>
	        <div class="card-block">
        	    <div class="form-group">
	                <label class="" for="text-input">Nama Kegiatan</label>
	                <div class="">
	                    <input type="text" class="form-control" name="nama_kegiatan_mf" placeholder="Caption Field" value="<?php echo set_value('nama_kegiatan_mf', isset($default['nama_kegiatan_mf']) ? $default['nama_kegiatan_mf'] : ''); ?>" readonly>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="" for="text-input">List Field Kegiatan</label>
	                <div class="">
	                	<div class="col-md-12">
	                		<div class="checkbox">
			                 	<label for="checkbox">
	                                <input type="checkbox" id="checkAll"> Semua
	                            </label>           
                            </div>
	                	</div>
	                    <?php
	                        $i=1;
	                        if($q_list_field->num_rows > 0){
	                        	foreach ($q_list_field->result() as $row){
	                        		//cek apa sudah di ada pada list
	                        		$q_list_field_kegiatan = $this->db->query("SELECT id_kegiatan_mf FROM list_field_kegiatan WHERE id_kegiatan_mf = $default[id_kegiatan_mf] AND id_field = $row->id_field");
	                        		$r_list = $q_list_field_kegiatan->num_rows();

	                        		if (fmod($i,2)) echo '<div class="col-md-6">';
	                    
	                    ?>
	                    	<div class="checkbox">
			                 	<label for="checkbox<?= $i; ?>">
	                                <input type="checkbox" id="checkbox<?= $i; ?>" name="id_field[]" value="<?= $row->id_field ?>" <?= ($r_list == 1) ? 'checked' : ''; ?>> <?= $row->caption." <small>(".$row->nama_level.")</small>" ?>
	                            </label>           
                            </div>
	                    <?php   
	                    		if (fmod($i,2)) echo '</div>';
	                    		$i++;	
	                        	} // end foreach
	                        } //end if
	                    ?>
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
	$('#checkAll').click(function () {    
	     $('input:checkbox').prop('checked', this.checked);    
	 });
</script>
