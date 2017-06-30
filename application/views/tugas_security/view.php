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
                    Kode Jadwal
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="kode_jadwal" value="<?php echo $detail_cleaning[0]['kode_jadwal']; ?>" readonly />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    Bulan Tugas
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" id="bulan_tugas" name="bulan_tugas" placeholder="Bulan Tugas" value="<?php echo $bulan[$detail_cleaning[0]['bulan_tugas']]; ?>" readonly />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Tahun Tugas
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="tahun_tugas" value="<?php echo $detail_cleaning[0]['tahun_tugas']; ?>" readonly />
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Petugas</td>
                            <td>No Telp</td>
                            <td>Lokasi</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no = 0;
                    foreach ($detail_cleaning_detail as $a => $b) { ?>
                        <tr>
                            <td><?php echo ++$no ?></td>
                            <td><?php echo $b['nama_petugas'] ?></td>
                            <td><?php echo $b['no_telp'] ?></td>
                            <td><?php echo $b['lokasi'] ?></td>
                        </tr>
                    <?php    
                    }
                        ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php include(APPPATH."views/includes/footer.php"); ?>