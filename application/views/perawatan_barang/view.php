<?php include(APPPATH."views/includes/header.php"); 
// echo $detail_request[0]['id'];;exit;
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui-1.9.2.custom.css">
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
                    Tanggal Perawatan
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="tgl_perawatan" placeholder="Tanggal Perawatan" value="<?php echo $detail_request[0]['tgl_perawatan']; ?>" readonly />
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
                    <input type="textarea" class="form-control" name="alasan_perawatan" placeholder="Alasan Perawatan" value="<?php echo $detail_request[0]['alasan_perawatan']; ?>" readonly />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Lokasi
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="textarea" class="form-control" name="lokasi" placeholder="Lokasi" value="<?php echo $detail_request[0]['lokasi']; ?>" readonly />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Bukti Foto
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <img  src="<?php echo base_url().'uploads/perawatan_barang/'.$detail_request[0]['bukti_foto_sebelum'] ?>" />
                </div>
            </div>
            
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php include(APPPATH."views/includes/footer.php"); ?>