<table class="table table-bordered">
	<?php
		$waktu_sebelumnya = 0;
		foreach($waktu as $row)
		{
	?>
	<tr>
		<td><?php echo $this->kualifikasi->hitung_waktu($waktu_sebelumnya, $row->waktu) ?></td>
	</tr>
	<?php
		$waktu_sebelumnya = $row->waktu;
		}
	?>
</table>