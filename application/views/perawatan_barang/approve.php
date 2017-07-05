<?php include(APPPATH."views/includes/header.php"); 
// echo $detail_request[0]['id'];;exit;
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui-1.9.2.custom.css">
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.9.2.custom.js"></script>
<script>
    $(function() {
        $( "#tgl_perawatan" ).datepicker({
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Kode Perawatan Barang
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="kode_perawatan" value="<?php echo $detail_request[0]['kode_perawatan']; ?>" readonly />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Jenis Barang
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="jenis_barang_id2" value="<?php echo $jns_brg['nama_jenis']; ?>" readonly />
                        <input type="hidden" class="form-control" name="jenis_barang_id" value="<?php echo $detail_request[0]['jenis_barang_id']; ?>" readonly />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Tanggal Perawatan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" id="tgl_perawatan" name="tgl_perawatan" placeholder="Tanggal Perawatan" value="<?php echo $detail_request[0]['tgl_perawatan']; ?>" readonly />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Nama Barang
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" value="<?php echo $detail_request[0]['nama_barang']; ?>" readonly />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Nama Pemesan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="nama_pemesan" placeholder="Nama Pemesan" value="<?php echo $detail_request[0]['nama_pemesan']; ?>" readonly />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Direktorat
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="direktorat" placeholder="Direktorat" value="<?php echo $detail_request[0]['direktorat']; ?>" readonly />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Alasan Perawatan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <textarea class="form-control" name="alasan_perawatan" placeholder="Alasan Perawatan" style="height: 100px; resize: none;" readonly /><?php echo $detail_request[0]['alasan_perawatan']; ?></textarea>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Lokasi
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <textarea class="form-control" name="lokasi" placeholder="Lokasi" style="height: 100px; resize: none;" readonly /><?php echo $detail_request[0]['lokasi']; ?></textarea>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Usulan / Tindakan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <textarea class="form-control" name="usulan" placeholder="Usulan / Tindakan" style="height: 100px; resize: none;" readonly /><?php echo $detail_request[0]['usulan']; ?></textarea>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Foto Bukti sebelum perawatan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <img  src="<?php echo base_url().'uploads/perawatan_barang/'.$detail_request[0]['bukti_foto_sebelum'] ?>" />
                    </div>
                </div>
                <form action="<?php echo base_url().'perawatan_barang/approve/'.$id; ?>" method="POST">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            Status
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <select name="status" id="status" class="form-control" required>
                                <option value="A">Approve</option>
                                <option value="R">Reject</option>
                            </select>
                        </div>
                    </div>
                    <div id="ket-area" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space hidden">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            Keterangan
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <textarea name="alasan_reject" class="form-control" style="height: 100px; resize: none;" placeholder="Keterangan"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="<?php echo base_url().'perawatan_barang'; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $('#status').on('change', function(){
        if($(this).val() == 'R'){
            $('#ket-area').removeClass('hidden');
        } else{
            $('#ket-area').addClass('hidden');
        }
    });
</script>
<?php include(APPPATH."views/includes/footer.php"); ?>