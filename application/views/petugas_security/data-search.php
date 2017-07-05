            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kode Petugas</td>
                        <td>Nama Petugas</td>
                        <td>No Telepon</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nourut = $limit + 1;
                    foreach($all_petugas as $data_petugas){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $data_petugas['kode_petugas']; ?></td>
                        <td><?php echo $data_petugas['nama_petugas']; ?></td>
                        <td><?php echo $data_petugas['no_telp']; ?></td>
                        <td>
                            <a href="<?php echo base_url().'petugas_security/edit/'.md5($data_petugas['id']); ?>"><button type="button" class="btn btn-default <?php echo $is_update; ?>">Edit</button></a>
                            <a href="#" onclick="deleteData('<?php echo base_url().'petugas_security/delete/'.md5($data_petugas['id']); ?>')"><button type="button" class="btn btn-danger <?php echo $is_delete; ?>">Delete</button></a>
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
                    <button type="button" onclick="load_page('<?php echo base_url().'petugas_security/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>