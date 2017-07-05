<?php include(APPPATH."views/includes/header.php"); ?>
<div class="blank">
	<div class="blank-page">
    	<h4><?php echo $menu_title; ?></h4>
        <div style="margin-top:50px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 status-detail">
                    <?php echo strtoupper($detail_booking_ruangan['status_keterangan']); ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Kode Booking Ruangan
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" value="<?php echo $detail_booking_ruangan['kode_booking']; ?>" disabled>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Tanggal Booking Ruangan
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" value="<?php echo $detail_booking_ruangan['tgl_book']; ?>" disabled>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Jam Mulai Rapat
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" value="<?php echo date("H:i", strtotime($detail_booking_ruangan['start_time'])); ?>" disabled>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Durasi Meeting
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" value="<?php echo $detail_booking_ruangan['durasi']; ?> Jam" disabled>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Nama Ruangan
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" value="<?php echo $detail_booking_ruangan['nama_ruangan']; ?>" disabled>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Direktorat
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" value="<?php echo $detail_booking_ruangan['direktorat']; ?>" disabled>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Nama Pemesan
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" value="<?php echo $detail_booking_ruangan['nama_pemesan']; ?>" disabled>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Jumlah Peserta
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" value="<?php echo $detail_booking_ruangan['jml_peserta']; ?>" disabled>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Agenda Meeting
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" value="<?php echo $detail_booking_ruangan['agenda_meeting']; ?>" disabled>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space <?php echo $detail_booking_ruangan['is_canceled']; ?>">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Keterangan Dibatalkan
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" value="<?php echo $detail_booking_ruangan['keterangan']; ?>" disabled>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <a href="<?php echo base_url().'booking_ruangan_history'; ?>"><button type="button" class="btn btn-default">Kembali</button></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php include(APPPATH."views/includes/footer.php"); ?>