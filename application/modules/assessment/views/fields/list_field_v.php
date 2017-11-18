<div class="col-xs-12">
    <form action="<?= $form_action ?>" id="form" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="card">
            <div class="card-header">
               <i class="fa fa-align-justify"></i> <?= $box_title ?>
            </div>
            <div class="card-block">
                <div class="form-group row">
                    <label class="col-sm-3 form-control-label" for="input-small">Upload File</label>
                    <div class="col-sm-6">
                        <input type="file" id="file-input" name="userfile" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary" name="upload"><i class="fa fa-dot-circle-o"></i> Submit</button>
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