            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
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
                    foreach($all_history_barang as $data_history){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $data_history['nama_pemesan']; ?></td>
                        <td><?php echo $data_history['direktorat']; ?></td>
                        <td><?php echo $data_history['nama_barang']; ?></td>
                        <td><?php echo date('d M Y',strtotime($data_history['tgl_pengadaan'])); ?></td>
                        <td><?php echo $data_history['status']; ?></td>
                        <td>
                            <a href="<?php echo base_url().'history_pengadaan_barang/view/'.md5($data_history['id']); ?>"><button type="button" class="btn btn-default">View</button></a>
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
                    <button type="button" onclick="load_page('<?php echo base_url().'history_pengadaan_barang/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>