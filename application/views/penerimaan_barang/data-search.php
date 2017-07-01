            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kode Pengadaan</td>
                        <td>Jenis Barang</td>
                        <td>Nama Barang</td>
                        <td>Merk</td>
                        <td>Direktorat</td>
                        <td>Nama Pemesan</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nourut = 1;
                    foreach($all_penerimaan_barang as $data_penerimaan){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $data_penerimaan['kode_pengadaan']; ?></td>
                        <td><?php echo $data_penerimaan['nama_jenis']; ?></td>
                        <td><?php echo $data_penerimaan['nama_barang']; ?></td>
                        <td><?php echo $data_penerimaan['merk']; ?></td>
                        <td><?php echo $data_penerimaan['direktorat']; ?></td>
                        <td><?php echo $data_penerimaan['nama_pemesan']; ?></td>
                        <td><?php echo $data_penerimaan['status']; ?></td>
                        <td>
                            <a href="<?php echo base_url().'penerimaan_barang/edit/'.md5($data_penerimaan['id']); ?>"><button type="button" class="btn btn-default">Approve</button></a>
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
                    <button type="button" onclick="load_page('<?php echo base_url().'penerimaan_barang/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>