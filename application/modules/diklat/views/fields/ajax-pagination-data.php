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
          <th width="" style="vertical-align: middle;">Awal Berlaku Sertifikat</th>
          <th width="" style="vertical-align: middle;">Akhir Berlaku Sertifikat</th>
          <th width="" style="vertical-align: middle;">No. Sertifikat</th>
          <th width="" style="vertical-align: middle;">Judul Diklat</th>
          <th width="" style="vertical-align: middle;">Penyelenggara</th>
          <th width="" style="vertical-align: middle;">Waktu Alert</th>
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
                  <td class="list-item">
                      <?= ($post['file_sertifikat'] != "") ? anchor('field/download/'.$post['id_sertifikat'].'/list', substr($post['file_sertifikat'], 0, 20)."", array('class' => '"')) : '';?>
                  </td>
                  <td class="list-item" <?= ($level == "2") ? "hidden" : "" ?>>
                      <?=anchor('diklat/ubah/'.$post['id_diklat'].'', '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-sm btn-outline-warning"'));?><br>&nbsp;
                      <?=anchor('diklat/hapus/'.$post['id_diklat'].'', '<i class="icon-trash"></i> Remove', array('class' => 'btn btn-sm btn-outline-danger"', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));?>
                  </td>
                </tr>
                <!-- <div ><a href="javascript:void(0);"><h2></h2></a></div> -->
            <?php endforeach; else: ?>
            <p>Post(s) not available.</p>
            <?php endif; ?>
    </tbody>
</table>
<?php echo $this->ajax_pagination->create_links(); ?>
