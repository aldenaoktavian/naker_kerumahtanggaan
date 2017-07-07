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
    </style>
</head>
<body onload="window.print()">
	<h3><?php echo $title; ?></h3><br/>
	<table>
		<thead>
			<tr>
				<td>Kode Booking</td>
				<td>Tanggal Booking</td>
				<td>Jam Mulai Rapat</td>
				<td>Jam Selesai Rapat</td>
				<td>Nama Ruangan</td>
				<td>Direktorat</td>
				<td>Nama Pemesan</td>
				<td>Jumlah Peserta</td>
				<td>Agenda Meeting</td>
				<td>Status</td>
			</tr>
		</thead>
		<tbody>
		<?php foreach($all_booking_ruangan as $data){ ?>
			<tr>
				<td><?php echo $data['kode_booking']; ?></td>
				<td><?php echo date('d F Y', strtotime($data['tgl_book'])); ?></td>
				<td><?php echo $data['start_time']; ?></td>
				<td><?php echo $data['end_time']; ?></td>
				<td><?php echo $data['nama_ruangan']; ?></td>
				<td><?php echo $data['direktorat']; ?></td>
				<td><?php echo $data['nama_pemesan']; ?></td>
				<td><?php echo $data['jml_peserta']; ?></td>
				<td><?php echo $data['agenda_meeting']; ?></td>
				<td>Booked</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</body>
</html>