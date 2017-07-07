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
				<td>Kode Kendaraan</td>
				<td>Jenis Kendaraan</td>
				<td>Merk / Type</td>
				<td>Tahun</td>
				<td>No Polisi</td>
				<td>Pemegang</td>
				<td>Masa Berlaku Pada Pajak</td>
			</tr>
		</thead>
		<tbody>
		<?php foreach($all_stnk as $data){ ?>
			<tr>
				<td><?php echo $data['kode_kendaraan']; ?></td>
				<td><?php echo $data['nama_jenis']; ?></td>
				<td><?php echo $data['merk']; ?></td>
				<td><?php echo $data['tahun']; ?></td>
				<td><?php echo $data['no_pol']; ?></td>
				<td><?php echo $data['pemegang']; ?></td>
				<td><?php echo date('d F Y', strtotime($data['masa_stnk'])); ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</body>
</html>