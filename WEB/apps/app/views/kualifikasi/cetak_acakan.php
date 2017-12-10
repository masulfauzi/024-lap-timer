<html>
	<head>
		<title>Cetak hasil acakan pembalap</title>
	</head>
	<body>
		<button onclick="window.print();">Print</button>
		<h2>Grup Kualifikasi</h2>
		<table>
			<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>Callsign</th>
				<th>Tim</th>
				<th>Grup</th>
				<th>Channel</th>
			</tr>
			<?php
				$no = 1;
				foreach($pembalap as $row)
				{
			?>
			<tr align="center">
				<td><?php echo $no ?></td>
				<td><?php echo $row->nama_pembalap ?></td>
				<td><?php echo $row->callsign ?></td>
				<td><?php echo $row->tim ?></td>
				<td><?php echo $row->grup ?></td>
				<td><?php echo $row->channel ?></td>
			</tr>
			<?php
				$no ++;
				}
			?>
		</table>
	</body>
</html>