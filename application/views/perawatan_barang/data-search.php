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
                    $nourut = $limit + 1;
                    foreach($all_perawatan_barang as $data_perawatan){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $data_perawatan['kode_perawatan']; ?></td>
                        <td><?php echo $data_perawatan['nama_pemesan']; ?></td>
                        <td><?php echo $data_perawatan['direktorat']; ?></td>
                        <td><?php echo $data_perawatan['nama_barang']; ?></td>
                        <td><?php echo date('d M Y',strtotime($data_perawatan['tgl_perawatan'])); ?></td>
                        <td>Requested</td>
                        <td>
                            <a href="<?php echo base_url().'perawatan_barang/edit/'.md5($data_perawatan['id']); ?>"><button type="button" class="btn btn-default <?php echo $is_update; ?>">Edit</button></a>
                             <a href="<?php echo base_url().'perawatan_barang/approve/'.md5($data_perawatan['id']); ?>"><button type="button" class="btn btn-default <?php echo $is_approve; ?>">Approve</button></a>
                            <a href="#" onclick="deleteData('<?php echo base_url().'perawatan_barang/delete/'.md5($data_perawatan['id']); ?>')"><button type="button" class="btn btn-danger <?php echo $is_delete; ?>">Delete</button></a>
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
                    <button type="button" onclick="load_page('<?php echo base_url().'perawatan_barang/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>