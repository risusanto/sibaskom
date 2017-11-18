<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/favicon.jpg">

    <title>SIMOPS | Sistem Informasi Monitoring Data Bidang Pengembangan SDM</title>

    <!-- Icons -->
    <link href="<?= base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/mystyle.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/form-validation.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/bootstrap-switch/css/bootstrap-switch.css" rel="stylesheet">
    
    <!-- Bootstrap and necessary plugins -->
    <script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/bower_components/pace/pace.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/datatables/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/datatables/css/responsive.bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/datatables/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/datatables/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/datatables/js/responsive.bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/gritter/css/jquery.gritter.css" />
    <script type="text/javascript" src="<?= base_url() ?>assets/gritter/js/jquery.gritter.js"></script>


    <!-- Plugins and scripts required by all views -->
    <script src="<?= base_url() ?>assets/bower_components/chart.js/dist/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap-switch/js/bootstrap-switch.js"></script>

    <!-- datepicker -->
    <script src="<?= base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js"></script>
    <link href="<?= base_url() ?>assets/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet">

    <!-- validasi form -->
    <script src="<?= base_url() ?>assets/js/jquery.validate.js"></script>
    <script>
        $().ready(function() {
            // validate the comment form when it is submitted
            $("#form").validate({
                rules: {
                        confirm_password: {
                        equalTo: "#password"
                    }
                }
            });
        });
    
        $(document).ready( function () {
            $('#datatable').DataTable({
                "ordering":  true,
                "scrollX": false
            });
        } );
    </script>

</head>
