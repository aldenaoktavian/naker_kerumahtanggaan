<html>
<head>
    <title><?php echo $title; ?></title>
    <style type="text/css" media="print">
    @page 
    {
        size:  auto;
        margin: 0mm;
        size: landscape;
    }

    @media print {
	tr.vendorListHeading {
	    background-color: #1a4567 !important;
	    -webkit-print-color-adjust: exact; 
	}}

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;
    }

    body
    {
        margin: 10mm 15mm 10mm 15mm;
    }

    table {
	    border-collapse: collapse;
	}

	thead tr td {
		background-color: #c5c4c4;
		font-weight: bold;
	}

    table, tr, td {
    	border-style: solid;
    	border-width: 2px;
    	border-color: #a29f9f;
    	padding: 5px;
    	text-align: center;
    }

    h3 {
    	text-align: center;
    }
    </style>
</head>
<body onload="window.print()">
	<h3><?php echo $title; ?></h3><br/>
	<table width="100%">
		<thead>
			<tr>
				<td>Kode Perawatan Barang</td>
				<td>Jenis Barang</td>
				<td>Tanggal Perawatan</td>
				<td>Nama Barang</td>
				<td>Nama Pemesan</td>
				<td>Direktorat</td>
				<td>Alasan Perawatan</td>
				<td>Lokasi</td>
				<td>Usulan / Tindakan</td>
			</tr>
		</thead>
		<tbody>
		<?php foreach($all_perawatan_barang as $data){ ?>
			<tr>
				<td><?php echo $data['kode_perawatan']; ?></td>
				<td><?php echo $data['nama_jenis']; ?></td>
				<td><?php echo date('d F Y', strtotime($data['tgl_perawatan'])); ?></td>
				<td><?php echo $data['nama_barang']; ?></td>
				<td><?php echo $data['nama_pemesan']; ?></td>
				<td><?php echo $data['direktorat']; ?></td>
				<td><?php echo $data['alasan_perawatan']; ?></td>
				<td><?php echo $data['lokasi']; ?></td>
				<td><?php echo $data['usulan']; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</body>
</html>