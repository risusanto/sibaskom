<?php 
$level = $this->session->userdata('level');
$nik = $this->session->userdata('nik');
?>
<div class="col-xs-12">
    <div class="card">
        <div class="card-header">
           <i class="fa fa-align-justify"></i> <?= $box_title ?>
            <div class="float-xs-right">
                <?=anchor('user/tambah/', '<i class="icon-note"></i> Add', array('class' => 'btn btn-sm'));?>
            </div>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th width="" style="vertical-align: middle;">NIP</th>
                            <th width="30%" style="vertical-align: middle;">Nama</th>
                            <th width="" style="vertical-align: middle;">Unit</th>
                            <th width="" style="vertical-align: middle;">Kode Diklat</th>
                            <th width="" style="vertical-align: middle;">Judul Diklat</th>
                            <th width="" style="vertical-align: middle;">Kode Sertifikat</th>
                            <th width="" style="vertical-align: middle;">Penyelenggara</th>
                            <th width="" style="vertical-align: middle;">Tanggal Mulai Pelatihan</th>
                            <th width="" style="vertical-align: middle;">Masa Berlaku Sertifikat</th>
                            <th width="" style="vertical-align: middle;">Batas Waktu Alert</th>
                            <th width="" style="vertical-align: middle;">File Sertifikat</th>
                            <th width="" style="vertical-align: middle;" <?= ($level == "2") ? "hidden" : "" ?>></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            foreach ($query as $post){
                        ?>
							<tr>
                                <td class="list-item">
                                    <?= $post->nip; ?>
                                </td>
                                <td class="list-item">
                                    <?= $post->nama; ?>
                                </td>
                                <td class="list-item">
                                    <?= $post->unit; ?>
                                </td>
                                <td class="list-item">
                                    <?= $post->kode_diklat; ?>
                                </td>
                                <td class="list-item">
                                    <?= $post->judul_diklat; ?>
                                </td>
                                <td class="list-item">
                                    <?= $post->kode_sertifikat; ?>
                                </td>
                                <td class="list-item">
                                    <?= $post->penyelenggara; ?>
                                </td>
                                <td class="list-item">
                                    <?= (isset($post->tanggal_mulai_pelatihan)) ? date("d-m-Y", strtotime($post->tanggal_mulai_pelatihan)) : ""; ?>
                                </td>
                                <td class="list-item">
                                    <?= (isset($post->masa_belaku_sertifikat)) ? date("d-m-Y", strtotime($post->masa_belaku_sertifikat)) : "";?>
                                </td>
                                <td class="list-item">
                                    <?= ($post->masa_alert != "" && $post->masa_alert != "0") ? $post->masa_alert." bulan" : ""; ?>
                                </td>
                                <td class="list-item">
                                    <?= ($post->file_sertifikat != "") ? anchor('field/download/'.$post->id_sertifikat.'/list', substr($post['file_sertifikat'], 0, 20)."", array('class' => '"')) : '';?>
                                </td>
                                <td class="list-item" <?= ($level == "2") ? "hidden" : "" ?>>
                                    <?=anchor('field/ubah/'.$post->id_sertifikat.'', '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-sm btn-outline-warning"'));?><br>&nbsp;
                                    <?=anchor('field/hapus/'.$post->id_sertifikat.'', '<i class="icon-trash"></i> Remove', array('class' => 'btn btn-sm btn-outline-danger"', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));?>
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