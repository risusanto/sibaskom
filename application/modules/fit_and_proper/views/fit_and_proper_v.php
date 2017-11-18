<style>
    /* Pagination */
    div.pagination {
        padding:2px;
        margin: 20px 10px;
    }

    div.pagination a {
        color: #fff;
        background-color: #20a8d8;
        border-color: #20a8d8;
        padding: 0.5rem 0.75rem;
    }
    div.pagination a:hover, div.pagination a:active {
        color: #167495;
        background-color: #cfd8dc;
        border-color: #ddd;
    }
    div.pagination span.current {
            color: #fff;
            background-color: #20a8d8;
            border-color: #20a8d8;
            padding: 0.5rem 0.75rem;
        }
    div.pagination span.disabled {
            display:none;
        }
    .pagination ul li{display: inline-block;}
    .pagination ul li a.active{opacity: .5;}
</style>
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var nama_pegawai = $('#nama_pegawai').val();
    var nip = $('#nip').val();

    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/fit_and_proper/ajaxPaginationData/'+page_num,
        data:'page='+page_num+'&nip='+nip+'&nama_pegawai='+nama_pegawai+'&sortBy='+sortBy,
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (html) {
            $('#postList').html(html);
            $('.loading').fadeOut("slow");
        }
    });
}

function reportFilter(page_num) {
    page_num = page_num?page_num:0;
    var nama_pegawai = $('#nama_pegawai').val();
    var nip = $('#nip').val();

    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/fit_and_proper/report/'+page_num,
        data:'page='+page_num+'&nip='+nip+'&nama_pegawai='+nama_pegawai+'&sortBy='+sortBy,
        datatype: 'excel',
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (html) {

        }
    });
}
</script>
<?php
$level = $this->session->userdata('level');
$nik = $this->session->userdata('nik');
?>
<div class="col-xs-12">
    <div class="card">
        <div class="card-header">
           <i class="fa fa-align-justify"></i> <?= $box_title ?>
            <div class="float-xs-right">
                <?=anchor('fit_and_proper/tambah/', '<i class="icon-note"></i> Add', array('class' => 'btn btn-sm'));?>
            </div>
        </div>
        <div class="card-block">
            <div class="pading5">
                <form action="<?= $form_action ?>" method="post" class="form-inline">
                    <label class="form-control-label" for="input-large">Filter : </label>
                    <div class="form-group">
                        <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" <?= ($level == "2") ? "hidden" : "" ?>>
                    </div>
                    <div class="form-group">
                        <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai" <?= ($level == "2") ? "hidden" : "" ?>>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" onclick="searchFilter()"><i class="fa fa-dot-circle-o"></i> Search</button>
                        <button type="submit" class="btn btn-success" onclick="reportFilter()" <?= ($level == "2") ? "hidden" : "" ?>><i class="fa fa-file-excel-o"></i> Excel</button>
                    </div>
                </form>
            </div>
            <div id="postList" class="table-responsive">
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

                            <?php endforeach; else: ?>
                            <p>Post(s) not available.</p>
                            <?php endif; ?>
                    </tbody>
                </table>
                <?php echo $this->ajax_pagination->create_links(); ?>
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
