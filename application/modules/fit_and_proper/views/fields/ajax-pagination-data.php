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
        <th width="" style="vertical-align: middle;">Job Suksesi</th>
        <th width="" style="vertical-align: middle;">Pengusi</th>
        <th width="" style="vertical-align: middle;">Hasil Fit and Proper</th>
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
                        <?= $post['job_suksesi']; ?>
                    </td>
                    <td class="list-item">
                        <?= $post['penguji']; ?>
                    </td>
                    <td class="list-item">
                        <?= $post['hasil_fit_and_proper']; ?>
                    </td>
                    <td class="list-item">
                        <?= ($post['file_evidence'] != "") ? anchor('fit_and_proper/download/'.$post['id_fit_and_proper'], substr($post['file_evidence'], 0, 20)."", array('class' => '"')) : '';?>
                    </td>
                    <td class="list-item" <?= ($level == "2") ? "hidden" : "" ?>>
                        <?=anchor('fit_and_proper/ubah/'.$post['id_fit_and_proper'].'', '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-sm btn-outline-warning"'));?><br>&nbsp;
                        <?=anchor('fit_and_proper/hapus/'.$post['id_fit_and_proper'].'', '<i class="icon-trash"></i> Remove', array('class' => 'btn btn-sm btn-outline-danger"', 'onclick' => "return confirm('Tekan OK untuk melanjutkan penghapusan data')"));?>
                    </td>
                </tr>
                <!-- <div ><a href="javascript:void(0);"><h2></h2></a></div> -->
            <?php endforeach; else: ?>
            <p>Post(s) not available.</p>
            <?php endif; ?>
    </tbody>
</table>
<?php echo $this->ajax_pagination->create_links(); ?>
