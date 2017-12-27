<table class="table table-bordered">
	<tr>
		<td>Waktu</td>
	</tr>
	<?php
		foreach($waktu as $row)
		{
	?>
	<tr>
		<td><?php echo $this->kualifikasi->format_waktu($row->lap) ?></td>
	</tr>
	<?php
		}
	?>
</table>