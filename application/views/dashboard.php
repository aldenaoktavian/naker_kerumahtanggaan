<?php include(APPPATH."views/includes/header.php"); ?>
<script src="<?php echo base_url(); ?>assets/js/pie-chart.js" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('.pie-load').pieChart({
            barColor: '#3bb2d0',
            trackColor: '#eee',
            lineCap: 'round',
            lineWidth: 8,
            onStep: function (from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });       
    });
</script>
<style type="text/css">
	.content-top-1:last-child {
		margin-bottom: 1em;
	}
</style>
<div class="blank">
	<?php if(isset($ongoing_pengadaan_barang)){ ?>
	<div class="col-md-4 ">
		<div class="content-top-1">
			<div class="col-md-6 top-content">
				<h5>Request Barang</h5>
				<label><?php echo $ongoing_pengadaan_barang['count_ongoing']; ?></label>
			</div>
			<div class="col-md-6 top-content1">	   
				<div class="pie-load pie-title-center" data-percent="<?php echo $ongoing_pengadaan_barang['persentase'] ?>"><span class="pie-value"><?php echo $ongoing_pengadaan_barang['persentase'] ?>%</span></div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<?php } ?>
	<?php if(isset($ongoing_penerimaan_barang)){ ?>
	<div class="col-md-4 ">
		<div class="content-top-1">
			<div class="col-md-6 top-content">
				<h5>Penerimaan Barang</h5>
				<label><?php echo $ongoing_penerimaan_barang['count_ongoing']; ?></label>
			</div>
			<div class="col-md-6 top-content1">	   
				<div class="pie-load pie-title-center" data-percent="<?php echo $ongoing_penerimaan_barang['persentase'] ?>"> <span class="pie-value"><?php echo $ongoing_penerimaan_barang['persentase'] ?>%</span></div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<?php } ?>
	<?php if(isset($ongoing_perawatan_barang)){ ?>
	<div class="col-md-4 ">
		<div class="content-top-1">
			<div class="col-md-6 top-content">
				<h5>Request Perawatan</h5>
				<label><?php echo $ongoing_perawatan_barang['count_ongoing']; ?></label>
			</div>
			<div class="col-md-6 top-content1">	   
				<div class="pie-load pie-title-center" data-percent="<?php echo $ongoing_perawatan_barang['persentase'] ?>"> <span class="pie-value"><?php echo $ongoing_perawatan_barang['persentase'] ?>%</span></div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<?php } ?>
	<?php if(isset($ongoing_perawatan_selesai)){ ?>
	<div class="col-md-4 ">
		<div class="content-top-1">
			<div class="col-md-6 top-content">
				<h5>Perawatan Selesai</h5>
				<label><?php echo $ongoing_perawatan_selesai['count_ongoing']; ?></label>
			</div>
			<div class="col-md-6 top-content1">	   
				<div class="pie-load pie-title-center" data-percent="<?php echo $ongoing_perawatan_selesai['persentase'] ?>"><span class="pie-value"><?php echo $ongoing_perawatan_selesai['persentase'] ?>%</span></div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<?php } ?>
	<?php if(isset($ongoing_perpanjangan_stnk)){ ?>
	<div class="col-md-4 ">
		<div class="content-top-1">
			<div class="col-md-6 top-content">
				<h5>Perpanjangan STNK</h5>
				<label><?php echo $ongoing_perpanjangan_stnk['count_ongoing']; ?></label>
			</div>
			<div class="col-md-6 top-content1">	   
				<div class="pie-load pie-title-center" data-percent="<?php echo $ongoing_perpanjangan_stnk['persentase'] ?>"> <span class="pie-value"><?php echo $ongoing_perpanjangan_stnk['persentase'] ?>%</span></div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<?php } ?>
	<?php if(isset($ongoing_booking_ruangan)){ ?>
	<div class="col-md-4 ">
		<div class="content-top-1">
			<div class="col-md-6 top-content">
				<h5>Booking Ruangan</h5>
				<label><?php echo $ongoing_booking_ruangan['count_ongoing']; ?></label>
			</div>
			<div class="col-md-6 top-content1">	   
				<div class="pie-load pie-title-center" data-percent="<?php echo $ongoing_booking_ruangan['persentase'] ?>"> <span class="pie-value"><?php echo $ongoing_booking_ruangan['persentase'] ?>%</span></div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<?php } ?>
</div>
<div class="clearfix"></div>
<?php include(APPPATH."views/includes/footer.php"); ?>