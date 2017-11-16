<?php
$level = $this->session->userdata('level');
$nik = $this->session->userdata('nik');
?>
<div class="col-xs-12">
	<div class="card">
		<div class="card-header">
			<strong>Data Penugasan</strong>
		</div>
		<div class="card-block">
			<h2>Welcome Back, <?php echo $this->session->userdata('nama'); ?>!</h2>
		    <p>This section represents the area that only logged in user can access.</p>
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
