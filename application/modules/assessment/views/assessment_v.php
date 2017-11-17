<div class="col-xs-12">
	<div class="card">
		<div class="card-header">
			<i class="fa fa-align-justify"></i> Assessment
			<div class="float-xs-right">
                <?= anchor('assessment/tambah/', '<i class="icon-note"></i> Add', array('class' => 'btn btn-sm')) ?>
            </div>
		</div>
		<div class="card-block">
			<table class="table table-hover table-striped">
				<thead>
					<th>No.</th>
					<th>ID Assessment</th>
					<th>NIP</th>
					<th>Nama</th>
					<th>Unit</th>
					<th>Tanggal Awal Berlaku</th>
					<th>Tanggal Akhir Berlaku</th>
					<th>Hasil Assessment</th>
					<th>Rekomendasi</th>
					<th>Waktu Alert</th>
					<th>File Evidence</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php $i = 0; foreach ($assessment as $row): ?>
					<tr>
						<td><?= ++$i ?></td>
						<td><?= $row->id_assesment ?></td>
						<td><?= $row->nip ?></td>
						<td><?= $row->nama ?></td>
						<td><?= $row->unit ?></td>
						<td><?= $row->tanggal_awal_berlaku ?></td>
						<td><?= $row->tanggal_akhir_berlaku ?></td>
						<td><?= $row->hasil_assesment ?></td>
						<td><?= $row->rekomendasi ?></td>
						<td><?= $row->waktu_alert ?></td>
						<td><?= $row->file_evidence ?></td>
						<td>
							<a href="#" class="btn btn-outline-warning btn-sm"><i class="icon-wrench"></i> Edit</a> 
							<a href="#" class="btn btn-outline-danger btn-sm"><i class="icon-trash"></i> Delete</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>