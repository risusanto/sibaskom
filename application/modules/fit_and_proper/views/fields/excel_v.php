<?php
$filename = 'rekap-data-fit_and_proper.xls';
header("Content-Type:application/vnd.ms-excel");
header('Content-Disposition: attachment; filename='.$filename);

?>
<table border="1">
    <thead>
        <tr>
        <th style="vertical-align: middle;">NIP</th>
        <th style="vertical-align: middle;">Nama</th>
        <th style="vertical-align: middle;">Unit</th>
        <th style="vertical-align: middle;">Job Suksesi</th>
        <th style="vertical-align: middle;">Pengusi</th>
        <th style="vertical-align: middle;">Hasil Fit and Proper</th>
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
                                        <?= $post['job_suksesi']; ?>
                                    </td>
                                    <td class="list-item">
                                        <?= $post['penguji']; ?>
                                    </td>
                                    <td class="list-item">
                                        <?= $post['hasil_fit_and_proper']; ?>
                                    </td>
                </tr>
                <!-- <div ><a href="javascript:void(0);"><h2></h2></a></div> -->
            <?php endforeach; else: ?>
            <p>Post(s) not available.</p>
            <?php endif; ?>
    </tbody>
</table>
