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
<div class="col-xs-12">
    <div class="card">
        <div class="card-header">
           <i class="fa fa-align-justify"></i> Data Duplikat
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th width="" style="vertical-align: middle;">#</th>
                            <th width="" style="vertical-align: middle;">NIP</th>
                            <th style="vertical-align: middle;">Nama</th>
                            <th style="vertical-align: middle;">Unit</th>
                            <th style="vertical-align: middle;">Bagian</th>
                            <th style="vertical-align: middle;">Email Korporat</th>
                            <th style="vertical-align: middle;">Email Non Korporat</th>
                            <th style="vertical-align: middle;">No. Handphone</th>
                            <th width="" style="vertical-align: middle;">Level</th>
                            <th width="" style="vertical-align: middle;">Status</th>
                            <th width="" style="vertical-align: middle;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            foreach ($query as $row){
                            $i++;
                            //level
                            $level = '';
                            if($row->id_level == 1)
                                $level = "Administrator";
                            else if($row->id_level == 2)
                                $level = "Officer";
                            echo "<tr>";
                            echo    "<td>$i</td>";
                            echo    "<td>$row->nik</td>";
                            echo    "<td class='capital'>$row->full_name</td>";
                            echo    "<td class='capital'>$row->unit</td>";
                            echo    "<td class='capital'>$row->bagian</td>";
                            echo    "<td class='capital'>$row->email_korporat</td>";
                            echo    "<td class='capital'>$row->email_nonkorporat</td>";
                            echo    "<td class='capital'>$row->no_hp</td>";
                            echo    "<td class='capital'>$level</td>";
                            echo    "<td class='capital'>".(($row->aktif ==1) ? '<span class="tag tag-success">Aktif</span>' : '<span class="tag tag-danger">Tidak Aktif</span>')."</td>";
                        ?>
                                <td align="center">
                                   <?=anchor('user/hapus/'.$row->id_user.'', '<i class="icon-trash"></i> Remove', array('class' => 'btn btn-sm btn-outline-danger"', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));?>
                                    
                                </td>
                            </tr>
                        <?php    
                            } //end forearch
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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