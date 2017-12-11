<table class="table table-bordered">
	<tr>
		<th>Waktu</th>
	</tr>
	<?php 
		foreach($waktu as $row)
		{
	?>
	<tr>
		<td><?php echo $row->waktu ?></td>
	</tr>
	<?php
		}
	?>
</table>