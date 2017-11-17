<?php
$filename = 'rekap-data-penugasan.xls';
header("Content-Type:application/vnd.ms-excel");
header('Content-Disposition: attachment; filename='.$filename);

?>
<table border="1">
    <thead>
        <tr>
        <th style="vertical-align: middle;">NIP</th>
        <th style="vertical-align: middle;">Nama</th>
        <th style="vertical-align: middle;">Unit</th>
        <th style="vertical-align: middle;">Lokasi Penugasan</th>
        <th style="vertical-align: middle;">Tanggal Awal Masa Penugasan</th>
        <th style="vertical-align: middle;">Lama Penugasan</th>
        <th style="vertical-align: middle;">Waktu Alert</th>
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
                        <?= $post['lokasi_penugasan']; ?>
                    </td>
                    <td class="list-item">
                        <?= (isset($post['tanggal_awal_masa_penugasan'])) ? date("d-m-Y", strtotime($post['tanggal_awal_masa_penugasan'])) : ""; ?>
                    </td>
                    <td class="list-item">
                    <?= $post['lama_penugasan']; ?>
                    </td>
                    <td class="list-item">
                        <?= (isset($post['waktu_alert'])) ? date("d-m-Y", strtotime($post['waktu_alert'])) : "";?>
                    </td>
                </tr>
                <!-- <div ><a href="javascript:void(0);"><h2></h2></a></div> -->
            <?php endforeach; else: ?>
            <p>Post(s) not available.</p>
            <?php endif; ?>
    </tbody>
</table>
