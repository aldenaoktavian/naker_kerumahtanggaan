            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kode Jadwal</td>
                        <td>Bulan Tugas</td>
                        <td>Tahun Tugas</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nourut = 1;
                    foreach($all_tugas_cleaning as $data_cleaning){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $data_cleaning['kode_jadwal']; ?></td>
                        <td><?php echo $data_cleaning['bulan_tugas']; ?></td>
                        <td><?php echo $data_cleaning['tahun_tugas']; ?></td>
                        <td>
                            <a href="<?php echo base_url().'tugas_cleaning/edit/'.md5($data_cleaning['id']); ?>"><button type="button" class="btn btn-default">Edit</button></a>
                            <a href="#" onclick="deleteData('<?php echo base_url().'tugas_cleaning/delete/'.md5($data_cleaning['id']); ?>')"><button type="button" class="btn btn-danger">Delete</button></a>
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
                    <button type="button" onclick="load_page('<?php echo base_url().'tugas_cleaning/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>