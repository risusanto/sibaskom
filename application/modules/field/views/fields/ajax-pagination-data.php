<?php 
$level = $this->session->userdata('level');
$nik = $this->session->userdata('nik');
?>
<table class="table table-bordered table-condensed">
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
            <?php $i=0; if(!empty($posts)): foreach($posts as $post): $i++; ?>
                <tr>
                    <td class="list-item">
                        <?= $post['nip']; ?>
                    </td>
                    <td class="list-item">
                        <?= $post['nama']; ?>
                    </td>
                    <td class="list-item">
                        <?= $post['unit']; ?>
                    </td>
                    <td class="list-item">
                        <?= $post['kode_diklat']; ?>
                    </td>
                    <td class="list-item">
                        <?= $post['judul_diklat']; ?>
                    </td>
                    <td class="list-item">
                        <?= $post['kode_sertifikat']; ?>
                    </td>
                    <td class="list-item">
                        <?= $post['penyelenggara']; ?>
                    </td>
                    <td class="list-item">
                        <?= (isset($post['tanggal_mulai_pelatihan'])) ? date("d-m-Y", strtotime($post['tanggal_mulai_pelatihan'])) : ""; ?>
                    </td>
                    <td class="list-item">
                        <?= (isset($post['masa_belaku_sertifikat'])) ? date("d-m-Y", strtotime($post['masa_belaku_sertifikat'])) : "";?>
                    </td>
                    <td class="list-item">
                        <?= ($post['masa_alert'] != "") ? $post['masa_alert']." bulan" : ""; ?>
                    </td>
                    <td class="list-item">
                        <?= ($post['file_sertifikat'] != "") ? anchor('field/download/'.$post['id_sertifikat'].'/list', substr($post['file_sertifikat'], 0, 20)."", array('class' => '"')) : '';?>
                    </td>
                    <td class="list-item" <?= ($level == "2") ? "hidden" : "" ?>>
                        <?=anchor('field/ubah/'.$post['id_sertifikat'].'', '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-sm btn-outline-warning"'));?><br>&nbsp;
                        <?=anchor('field/hapus/'.$post['id_sertifikat'].'', '<i class="icon-trash"></i> Remove', array('class' => 'btn btn-sm btn-outline-danger"', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));?>
                    </td>
                </tr>
                <!-- <div ><a href="javascript:void(0);"><h2></h2></a></div> -->
            <?php endforeach; else: ?>
            <p>Post(s) not available.</p>
            <?php endif; ?>
    </tbody>
</table>
<?php echo $this->ajax_pagination->create_links(); ?>