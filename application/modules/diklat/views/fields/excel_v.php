<?php
$filename = 'rekap-data-diklat.xls';
header("Content-Type:application/vnd.ms-excel");
header('Content-Disposition: attachment; filename='.$filename);

?>
<table border="1">
    <thead>
        <tr>
          <th style="vertical-align: middle;">NIP</th>
          <th style="vertical-align: middle;">Nama</th>
          <th style="vertical-align: middle;">Unit</th>
          <th style="vertical-align: middle;">Awal Berlaku Sertifikat</th>
          <th style="vertical-align: middle;">Akhir Berlaku Sertifikat</th>
          <th style="vertical-align: middle;">No. Sertifikat</th>
          <th style="vertical-align: middle;">Judul Diklat</th>
          <th style="vertical-align: middle;">Penyelenggara</th>
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
                      <?= (isset($post['tanggal_awal_berlaku'])) ? date("d-m-Y", strtotime($post['tanggal_awal_berlaku'])) : ""; ?>
                  </td>
                  <td class="list-item">
                      <?= (isset($post['tanggal_akhir_berlaku'])) ? date("d-m-Y", strtotime($post['tanggal_akhir_berlaku'])) : "";?>
                  </td>
                  <td class="list-item">
                      <?= $post['no_sertifikat']; ?>
                  </td>
                  <td class="list-item">
                      <?= $post['judul_diklat']; ?>
                  </td>
                  <td class="list-item">
                      <?= $post['lembaga_penyelenggara']; ?>
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
