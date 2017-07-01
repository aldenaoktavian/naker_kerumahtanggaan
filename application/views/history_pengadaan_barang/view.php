<?php include(APPPATH."views/includes/header.php"); 
// echo $detail_request[0]['id'];;exit;
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui-1.9.2.custom.css">
<div class="blank">
    <div class="blank-page">
        <h4><?php echo $menu_title; ?></h4>
        <?php 
        if($detail_request[0]['status'] == 'S'){ ?>
            <div style="float:right;background-color:#00ff00;text-align:center;width:150px;height:30px;">Status Success</div>
        <?php
        }else{ ?>
            <div style="float:right;background-color:#ff1a1a;text-align:center;width:150px;height:30px;">Status Reject</div>
        <?php
        }
        ?>
        
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
                    Tanggal Request
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" id="tgl_pengadaan" name="tgl_pengadaan" placeholder="Tanggal Request" value="<?php echo $detail_request[0]['tgl_pengadaan']; ?>" readonly />
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
            <?php 
            if($detail_request[0]['status'] == 'S'){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Keterangan
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="textarea" class="form-control" name="keterangan" placeholder="Keterangan" value="<?php echo $detail_request[0]['keterangan']; ?>" readonly />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Bukti Foto
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <img  src="<?php echo base_url().'uploads/penerimaan_barang/'.$detail_request[0]['bukti_foto'] ?>" />
                    </div>
                </div>
            <?php
            }else{ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Alasan Reject
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="textarea" class="form-control" name="alasan_reject" placeholder="Alasan Reject" value="<?php echo $detail_request[0]['remark']; ?>" readonly />
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php include(APPPATH."views/includes/footer.php"); ?>