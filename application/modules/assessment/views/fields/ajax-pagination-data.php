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
          <th width="" style="vertical-align: middle;">Tanggal Awal Berlaku</th>
          <th width="" style="vertical-align: middle;">Tanggal Akhir Berlaku</th>
          <th width="" style="vertical-align: middle;">Hasil Assessment</th>
          <th width="" style="vertical-align: middle;">Rekomendasi</th>
          <th width="" style="vertical-align: middle;">Waktu Alert</th>
          <th width="" style="vertical-align: middle;">File Evidence</th>
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
                      <?= $post['hasil_assesment']; ?>
                  </td>
                  <td class="list-item">
                      <?= $post['rekomendasi']; ?>
                  </td>
                  <td class="list-item">
                      <?= (isset($post['waktu_alert'])) ? date("d-m-Y", strtotime($post['waktu_alert'])) : "";?>
                  </td>
                  <td class="list-item">
                      <?= ($post['file_evidence'] != "") ? anchor('diklat/download/'.$post['id_diklat'].'/list', substr($post['file_evidence'], 0, 20)."", array('class' => '"')) : '';?>
                  </td>
                  <td class="list-item" <?= ($level == "2") ? "hidden" : "" ?>>
                      <?=anchor('assessment/ubah/'.$post['id_diklat'].'', '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-sm btn-outline-warning"'));?><br>&nbsp;
                      <?=anchor('assessment/hapus/'.$post['id_diklat'].'', '<i class="icon-trash"></i> Remove', array('class' => 'btn btn-sm btn-outline-danger"', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));?>
                  </td>
                </tr>
                <!-- <div ><a href="javascript:void(0);"><h2></h2></a></div> -->
            <?php endforeach; else: ?>
            <p>Post(s) not available.</p>
            <?php endif; ?>
    </tbody>
</table>
<?php echo $this->ajax_pagination->create_links(); ?>
