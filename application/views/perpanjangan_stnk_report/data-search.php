            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Pemegang</td>
                        <td>Direktorat</td>
                        <td>Nomor Polisi</td>
                        <td>Jenis Kendaraan</td>
                        <td>Masa Berlaku STNK</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nourut = 1;
                    foreach($all_stnk as $data_stnk){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $data_stnk['pemegang']; ?></td>
                        <td><?php echo $data_stnk['direktorat']; ?></td>
                        <td><?php echo $data_stnk['no_pol']; ?></td>
                        <td><?php echo $data_stnk['nama_jenis']; ?></td>
                        <td><?php echo date('d M Y',strtotime($data_stnk['masa_akhir_perpanjangan'])); ?></td>
                    </tr>
                <?php $nourut++; } ?>
                </tbody>
            </table>
            <div id="pagination" style="margin-bottom: 20px; margin-top: 20px;">
                <button type="button" class="btn btn-default"><<</button>
                <?php 
                    for($numb=1; $numb<=$pages; $numb++){ 
                        $curr_page = 0 + ($currentPage / 2);
                ?>
                    <button type="button" onclick="load_page('<?php echo base_url().'perpanjangan_stnk/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>