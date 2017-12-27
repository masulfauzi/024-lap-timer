<html>
	<head>
		<title>Cetak Hasil Kualifikasi</title>
		<link href="<?php echo $this->location('../assets/css/exceltable/excel-2007.css') ?>" rel="stylesheet">
		<style>
			@media print {
			    #hideprint {
			        display: none;
			    }
			}
		</style>
	</head>
	<body>
		<button id="hideprint" onclick="window.print();">Print</button>
		<h2>Hasil Kualifikasi</h2>
		<table class="ExcelTable2007">
			<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>Callsign</th>
				<th>Tim</th>
				<th>Grup</th>
				<th>Waktu</th>
			</tr>
			<?php
				$no = 1;
				foreach($hasil as $row)
				{
			?>
			<tr align="center" >
				<td><?php echo $no ?></td>
				<td><?php echo $row->nama_pembalap ?></td>
				<td><?php echo $row->callsign ?></td>
				<td><?php echo $row->tim ?></td>
				<td><?php echo $row->grup ?></td>
				<td><?php echo $this->kualifikasi->cek_waktu($row->waktu) ?></td>
			</tr>
			<?php
				$no ++;
				}
			?>
		</table>
	</body>
</html>