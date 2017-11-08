<div class="col-xs-12">
    <form id="form" action="<?= $form_action ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <input type="hidden" name="id_email_notifikasi" value="<?php echo set_value('id_email_notifikasi', isset($default['id_email_notifikasi']) ? $default['id_email_notifikasi'] : ''); ?>">
        <div class="card">
            <div class="card-header">
               <i class="fa fa-align-justify"></i> <?= $box_title ?>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="text-input">Alamat Email 1</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email1" placeholder="Alamat Email 1" value="<?php echo set_value('email1', isset($default['email1']) ? $default['email1'] : ''); ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="text-input">Alamat Email 2</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email2" placeholder="Alamat Email 2" value="<?php echo set_value('email2', isset($default['email2']) ? $default['email2'] : ''); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="text-input">Alamat Email 3</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email3" placeholder="Alamat Email 3" value="<?php echo set_value('email3', isset($default['email3']) ? $default['email3'] : ''); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="text-input">Alamat Email 4</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email4" placeholder="Alamat Email 4" value="<?php echo set_value('email4', isset($default['email4']) ? $default['email4'] : ''); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 form-control-label" for="text-input">Alamat Email 5</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" name="email5" placeholder="Alamat Email 5" value="<?php echo set_value('email5', isset($default['email5']) ? $default['email5'] : ''); ?>">
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