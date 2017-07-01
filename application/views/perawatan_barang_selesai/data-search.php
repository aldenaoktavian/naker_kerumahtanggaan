            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kode Perawatan</td>
                        <td>Nama Pemesan</td>
                        <td>Direktorat</td>
                        <td>Nama Barang</td>
                        <td>Tanggal</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nourut = 1;
                    foreach($all_perawatan_selesai as $perawatan_selesai){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $perawatan_selesai['kode_perawatan']; ?></td>
                        <td><?php echo $perawatan_selesai['nama_pemesan']; ?></td>
                        <td><?php echo $perawatan_selesai['direktorat']; ?></td>
                        <td><?php echo $perawatan_selesai['nama_barang']; ?></td>
                        <td><?php echo date('d M Y',strtotime($perawatan_selesai['tgl_perawatan'])); ?></td>
                        <td><?php echo $perawatan_selesai['status']; ?></td>
                        <td>
                            <a href="<?php echo base_url().'perawatan_barang_selesai/edit/'.md5($perawatan_selesai['id']); ?>"><button type="button" class="btn btn-default">Approve</button></a>
                        </td>
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
                    <button type="button" onclick="load_page('<?php echo base_url().'perawatan_barang_selesai/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>