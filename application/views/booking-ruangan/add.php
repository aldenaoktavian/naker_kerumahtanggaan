<?php include(APPPATH."views/includes/header.php"); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui-1.9.2.custom.css">
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.9.2.custom.js"></script>
<script>
    $(function() {
        $( "#tgl_book" ).datepicker({
            dateFormat:"yy-mm-dd",
            yearRange: "-100:+0",
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<div class="blank">
	<div class="blank-page">
    	<h4><?php echo $menu_title; ?></h4>
        <div style="margin-top:50px;">
            <form action="<?php echo base_url().'booking_ruangan/add'; ?>" method="POST">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Kode Booking Ruangan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="kode_booking" value="<?php echo $getKodeBookingRuangan; ?>" readonly />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Tanggal Booking Ruangan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" id="tgl_book" name="tgl_book" onchange="checkAvailability()" placeholder="Tanggal Booking Ruangan" required />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Jam Booking Ruangan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <select name="jam_book" id="jam_book" class="form-control" onchange="checkAvailability()" required>
                            <?php 
                                for($i=1; $i<=24; $i++){ 
                                    $time_value = date('H:i', strtotime($i.':00:00'));
                            ?>
                            <option value="<?php echo $time_value; ?>"><?php echo $time_value; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Durasi Meeting
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <select name="durasi" id="durasi" class="form-control" onchange="checkAvailability()" required>
                            <?php for($i=1; $i<=10; $i++){ ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Nama Ruangan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <select name="ruangan_id" id="ruangan_id" class="form-control">
                        <?php foreach($data_ruangan as $list_ruangan){ ?>
                            <option value="<?php echo $list_ruangan['id']; ?>"><?php echo $list_ruangan['nama_ruangan']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Direktorat
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="direktorat" placeholder="Direktorat" required />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Nama Pemesan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="nama_pemesan" placeholder="Nama Pemesan" required />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Jumlah Peserta
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="jml_peserta" placeholder="Jumlah Peserta" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Agenda Meeting
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <textarea class="form-control" name="agenda_meeting" placeholder="Agenda Meeting" style="height: 100px; resize: none;" required /></textarea>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?php echo base_url().'ruangan'; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function checkAvailability(){
        $.post(base_url + "booking_ruangan/check_availability",
        {
          tgl_book: $('#tgl_book').val(),
          jam_book: $('#jam_book').val(),
          durasi: $('#durasi').val()
        },
        function(data,status){
            $('#ruangan_id').html(data);
        });
    }
</script>
<?php include(APPPATH."views/includes/footer.php"); ?>