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
                <table id="datatable" class="table table-condensed">
                    <thead>
                        <tr>
                            <th width="" style="vertical-align: middle;">#</th>
                            <th width="" style="vertical-align: middle;">NIP</th>
                            <th width="30%" style="vertical-align: middle;">Nama</th>
                            <th width="" style="vertical-align: middle;">Unit</th>
                            <th width="" style="vertical-align: middle;">Kode Diklat</th>
                            <th width="" style="vertical-align: middle;">Judul Diklat</th>
                            <th width="" style="vertical-align: middle;">Kode Sertifikat</th>
                            <th width="" style="vertical-align: middle;">Penyelenggara</th>
                            <th width="" style="vertical-align: middle;">Tanggal Mulai Pelatihan</th>
                            <th width="" style="vertical-align: middle;">Masa Berlaku Sertifikat</th>
                            <th width="" style="vertical-align: middle;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=0;
                        foreach ($query as $row){
                        $i++;
                        //level
                        echo "<tr>";
                        echo    "<td>$i</td>";
                        echo    "<td>$row->nip</td>";
                        echo    "<td class='capital'>$row->nama</td>";
                        echo    "<td class='capital'>$row->unit</td>";
                        echo    "<td class='capital'>$row->kode_diklat</td>";
                        echo    "<td class='capital'>$row->judul_diklat</td>";
                        echo    "<td class='capital'>$row->kode_sertifikat</td>";
                        echo    "<td class='capital'>$row->penyelenggara</td>";
                        echo    "<td class='capital'>$row->tanggal_mulai_pelatihan</td>";
                        echo    "<td class='capital'>$row->masa_belaku_sertifikat</td>";
                    ?>
                            <td align="center">
                               
                                    <?=anchor('field/list_field/hapus/'.$row->id_sertifikat.'', '<i class="icon-trash"></i> Remove', array('class' => 'btn btn-sm btn-outline-danger"', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));?>
                                
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