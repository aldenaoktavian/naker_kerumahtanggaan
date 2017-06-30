<?php include(APPPATH."views/includes/header.php"); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui-1.9.2.custom.css">
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.9.2.custom.js"></script>
<div class="blank">
    <div class="blank-page">
        <h4><?php echo $menu_title; ?></h4>
        <div style="margin-top:50px;">
            <form action="<?php echo base_url().'tugas_security/edit/'.$id; ?>" method="POST">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Kode Jadwal
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="kode_jadwal" value="<?php echo $security[0]['kode_jadwal']; ?>" readonly />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Bulan Tugas
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <select name="bulan_tugas" class="form-control">
                        <?php foreach($bulan as $a=>$b){ ?>
                            <option value="<?php echo $a; ?>" <?php if($b == $security[0]['bulan_tugas']){echo "selected";} ?> ><?php echo $b; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Tahun Tugas
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <select name="tahun_tugas" class="form-control">
                        <?php foreach($tahun as $c=>$d){ ?>
                            <option value="<?php echo $c; ?>" <?php if($d == $security[0]['tahun_tugas']){echo "selected";} ?> ><?php echo $d; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- detail -->
                <div>
                    <table class="table table-striped">
                        <tr>
                            <th>Nama Petugas Security</th>
                            <th>No Telepon</th>
                            <th>Lokasi</th>
                            <th><a style="cursor:pointer;" onclick="clickAdd();"><span style="background:#aaa;padding:1px 7px;">+</span></a></th>
                        </tr>
                        <?php if ($detail_security > 0) { ?>
                            <?php foreach ($detail_security as $i=>$v) { //echo "<pre>"; print_r($v); echo "</pre>"; exit; ?>
                        <tr id="tr<?php echo $i;?>">
                        <?php if (isset($v['id']) and !empty($v['id'])){?>
                            <td>
                                <select id="Detail<?php echo $i; ?>PetugasId" name="data[detail][<?php echo $i; ?>][petugas_id]" onchange="changePetugas(0,this.value);" class="form-control">
                                    <option value="0">--Pilih Petugas--</option>
                                    <?php foreach($data_petugas_security as $ptgs){ ?>
                                        <option value="<?php echo $ptgs['id']; ?>" <?php if($v['petugas_id'] == $ptgs['id']){echo "selected";} ?> ><?php echo $ptgs['nama_petugas']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><input type="text" class="form-control" id="Detail<?php echo $i; ?>NoTelp" name="data[detail][<?php echo $i; ?>][no_telp]" placeholder="No Telp" readonly /></td>
                            <td><input type="text" class="form-control" id="Detail<?php echo $i; ?>Lokasi" name="data[detail][<?php echo $i; ?>][lokasi]" placeholder="Lokasi" value="<?php echo $v['lokasi']?>" /></td>
                            <td><a style="cursor:pointer;" onclick="$('#tr<?php echo $i;?>').detach();"><span style="background:#aaa;padding:1px 8px;">-</span></a></td>
                        </tr>
                            <?php } }
                        }else{ ?>
                        <tr id="tr0">
                            <td>
                                <select id="Detail0PetugasId" name="data[detail][0][petugas_id]" onchange="changePetugas(0,this.value);" class="form-control">
                                    <option value="0">--Pilih Petugas--</option>
                                    <?php foreach($data_petugas_security as $ptgs){ ?>
                                        <option value="<?php echo $ptgs['id']; ?>"><?php echo $ptgs['nama_petugas']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><input type="text" class="form-control" id="Detail0NoTelp" name="data[detail][0][no_telp]" placeholder="No Telp" readonly /></td>
                            <td><input type="text" class="form-control" id="Detail0Lokasi" name="data[detail][0][lokasi]" placeholder="Lokasi" /></td>
                            <td><a style="cursor:pointer;" onclick="$('#tr0').detach();"><span style="background:#aaa;padding:1px 8px;">-</span></a></td>
                        </tr>
                        <?php } ?>

                        <tr id="trHiddenCounterDetail" style="display:none;">
                            <input id="tr_d_counterDetail" type="hidden" value="<?php echo $detail_security?(sizeof($detail_security)-1):0;?>">
                        </tr>
                         
                    </table>
                </div> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?php echo base_url().'tugas_security'; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>

<div style="display:none;" id="htmlDetail">
<xzztr id="trzzz">
<xzztd>
    <select id="DetailzzzPetugasId" name="data[detail][zzz][petugas_id]" onchange="changePetugas(zzz,this.value);" class="form-control">
        <option value="0">--Pilih Petugas--</option>
        <?php foreach($data_petugas_security as $ptgs){ ?>
            <option value="<?php echo $ptgs['id']; ?>"><?php echo $ptgs['nama_petugas']; ?></option>
        <?php } ?>
    </select>
</xzztd>

<xzztd><input type="text" id="DetailzzzNoTelp" class="form-control" name="data[detail][zzz][no_telp]" placeholder="No Telp" readonly /></xzztd>
<xzztd><input type="text" id="DetailzzzLokasi" class="form-control" name="data[detail][zzz][lokasi]" placeholder="Lokasi" /></xzztd>
<xzztd><a style="cursor:pointer;" onclick="$('#trzzz').detach();"><span style="background:#aaa;padding:1px 8px;">-</span></a></xzztd>
</xzztr>
</div>
 
<script type="text/javascript">
    $(function() {
        $( "#tgl_pengadaan" ).datepicker({
            dateFormat:"yy-mm-dd",
            yearRange: "-100:+0",
            changeMonth: true,
            changeYear: true
        });
        for(var i=0;i<=Number($('#tr_d_counterDetail').val());i++){
            changePetugas(i,$('#Detail'+i+'PetugasId').val());
        }
    });
    function clickAdd(){
    html=$('#htmlDetail').html().toString();
    var nextCounter=Number($('#tr_d_counterDetail').val())+1;
    $('#tr_d_counterDetail').val(nextCounter);
    while (html != (html = html.replace("zzz", nextCounter)));
    while (html != (html = html.replace("xzz", '')));
    $('#trHiddenCounterDetail').before(html);
    }

    function changePetugas(id,val){
        $.ajax({
             type: "POST",
             url: "<?php echo base_url().'tugas_security/notelp_petugas/'; ?>"+val,
             dataType:"json",
             success: function (response) {
                var obj = $.parseJSON(response);
                 
                 $('#Detail'+id+'NoTelp').val(obj);
            }
        });
    }
</script>

<?php include(APPPATH."views/includes/footer.php"); ?>