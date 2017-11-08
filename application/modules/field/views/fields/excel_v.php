<?php
$filename = 'rekap_sertifikat.xls';
header("Content-Type:application/vnd.ms-excel");
header('Content-Disposition: attachment; filename='.$filename);

?>
<table border="1">
    <thead>
        <tr>
            <th style="vertical-align: middle;">NIP</th>
            <th style="vertical-align: middle;">Nama</th>
            <th style="vertical-align: middle;">Unit</th>
            <th style="vertical-align: middle;">Kode Diklat</th>
            <th style="vertical-align: middle;">Judul Diklat</th>
            <th style="vertical-align: middle;">Kode Sertifikat</th>
            <th style="vertical-align: middle;">Penyelenggara</th>
            <th style="vertical-align: middle;">Tanggal Mulai Pelatihan</th>
            <th style="vertical-align: middle;">Masa Berlaku Sertifikat</th>
            <th style="vertical-align: middle;">Batas Waktu Alert</th>
        </tr>
    </thead>
    <tbody>
            <?php $i=0; if(!empty($posts)): foreach($posts as $post): ?>
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
                </tr>
                <!-- <div ><a href="javascript:void(0);"><h2></h2></a></div> -->
            <?php endforeach; else: ?>
            <p>Post(s) not available.</p>
            <?php endif; ?>
    </tbody>
</table>