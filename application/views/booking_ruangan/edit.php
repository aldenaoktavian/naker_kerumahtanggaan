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
            <form action="<?php echo base_url().'booking_ruangan/edit/'.$id; ?>" method="POST">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Kode Booking Ruangan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="kode_booking" value="<?php echo $detail_booking_ruangan['kode_booking']; ?>" readonly />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Tanggal Booking Ruangan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" id="tgl_book" name="tgl_book" onchange="checkAvailability()" placeholder="Tanggal Booking Ruangan" value="<?php echo $detail_booking_ruangan['tgl_book']; ?>" required />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Jam Mulai Rapat
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <select name="start_hour" id="start_hour" class="form-control" style="width: 45%;float: left;" onchange="checkAvailability()" required>
                            <?php 
                                for($i=1; $i<24; $i++){ 
                                    $numb = ($i < 10 ? "0".$i : $i);
                                    $hour_select = date('H', strtotime($detail_booking_ruangan['start_time']));
                            ?>
                            <option value="<?php echo $numb; ?>" <?php echo ($numb == $hour_select ? 'selected' : ''); ?>><?php echo $numb; ?></option>
                            <?php } ?>
                        </select>
                        <span style="width: 10%;float: left;text-align: center;">:</span>
                        <select name="start_menit" id="start_menit" class="form-control" style="width: 45%;" onchange="checkAvailability()" required>
                            <?php 
                                for($i=1; $i<60; $i++){ 
                                    $numb = ($i < 10 ? "0".$i : $i);
                                    $menit_select = date('i', strtotime($detail_booking_ruangan['start_time']));
                            ?>
                            <option value="<?php echo $numb; ?>" <?php echo ($numb == $menit_select ? 'selected' : ''); ?>><?php echo $numb; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Jam Selesai Rapat
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <select name="end_hour" id="end_hour" class="form-control" style="width: 45%;float: left;" onchange="checkAvailability()" required>
                            <?php 
                                for($i=1; $i<24; $i++){ 
                                    $numb = ($i < 10 ? "0".$i : $i);
                                    $hour_select = date('H', strtotime($detail_booking_ruangan['end_time']));
                            ?>
                            <option value="<?php echo $numb; ?>" <?php echo ($numb == $hour_select ? 'selected' : ''); ?>><?php echo $numb; ?></option>
                            <?php } ?>
                        </select>
                        <span style="width: 10%;float: left;text-align: center;">:</span>
                        <select name="end_menit" id="end_menit" class="form-control" style="width: 45%;" onchange="checkAvailability()" required>
                            <?php 
                                for($i=1; $i<60; $i++){ 
                                    $numb = ($i < 10 ? "0".$i : $i);
                                    $menit_select = date('i', strtotime($detail_booking_ruangan['end_time']));
                            ?>
                            <option value="<?php echo $numb; ?>" <?php echo ($numb == $menit_select ? 'selected' : ''); ?>><?php echo $numb; ?></option>
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
                        <input type="text" class="form-control" name="direktorat" placeholder="Direktorat" value="<?php echo $detail_booking_ruangan['direktorat']; ?>" required />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Nama Pemesan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="nama_pemesan" placeholder="Nama Pemesan" value="<?php echo $detail_booking_ruangan['nama_pemesan']; ?>" required />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Jumlah Peserta
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="jml_peserta" placeholder="Jumlah Peserta" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php echo $detail_booking_ruangan['jml_peserta']; ?>" required />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Agenda Meeting
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <textarea class="form-control" name="agenda_meeting" placeholder="Agenda Meeting" style="height: 100px; resize: none;" required /><?php echo $detail_booking_ruangan['agenda_meeting']; ?></textarea>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?php echo base_url().'booking_ruangan'; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function checkAvailability(){
        var start_book = $('#start_hour').val() + ":" + $('#start_menit').val();
        var end_book = $('#end_hour').val() + ":" + $('#end_menit').val();
        $.post(base_url + "booking_ruangan/check_availability",
        {
          tgl_book: $('#tgl_book').val(),
          start_book: start_book,
          end_book: end_book
        },
        function(data,status){
            $('#ruangan_id').html(data);
        });
    }
</script>
<?php include(APPPATH."views/includes/footer.php"); ?>