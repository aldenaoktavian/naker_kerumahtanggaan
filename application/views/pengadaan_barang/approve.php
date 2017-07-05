<?php include(APPPATH."views/includes/header.php"); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui-1.9.2.custom.css">
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.9.2.custom.js"></script>
<script>
    $(function() {
        $( "#tgl_pengadaan" ).datepicker({
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
                    Kode Pengadaan Barang
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="kode_pengadaan" value="<?php echo $detail_request[0]['kode_pengadaan']; ?>" readonly />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Jenis Barang
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="jenis_barang_id" value="<?php echo $jns_brg['nama_jenis']; ?>" readonly />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Tanggal Request
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" id="tgl_pengadaan" name="tgl_pengadaan" placeholder="Tanggal Request" value="<?php echo $detail_request[0]['tgl_pengadaan']; ?>" readonly />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Merk
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="merk" placeholder="Merk" value="<?php echo $detail_request[0]['merk']; ?>" readonly />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Qty
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="qty" placeholder="Qty" value="<?php echo $detail_request[0]['qty']; ?>" readonly />
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
                    Nama Pemesan
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="nama_pemesan" placeholder="Nama Pemesan" value="<?php echo $detail_request[0]['nama_pemesan']; ?>" readonly />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Alasan Pengadaan
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="textarea" class="form-control" name="alasan_pengadaan" placeholder="Alasan Pengadaan" value="<?php echo $detail_request[0]['alasan_pengadaan']; ?>" readonly />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Spesifikasi Barang
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="textarea" class="form-control" name="spesifikasi" placeholder="Spesifikasi" value="<?php echo $detail_request[0]['spesifikasi']; ?>" readonly />
                </div>
            </div>
            <form action="<?php echo base_url().'pengadaan_barang/approve/'.$id; ?>" method="POST">
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
                    <a href="<?php echo base_url().'pengadaan_barang'; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
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