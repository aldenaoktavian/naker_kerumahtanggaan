            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kode Jadwal</td>
                        <td>Bulan Tugas</td>
                        <td>Tahun Tugas</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nourut = $limit + 1;
                    foreach($all_tugas_security as $data_security){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $data_security['kode_jadwal']; ?></td>
                        <td><?php echo $bulan[$data_security['bulan_tugas']]; ?></td>
                        <td><?php echo $data_security['tahun_tugas']; ?></td>
                        <td>
                            <a href="<?php echo base_url().'tugas_security/view/'.md5($data_security['id']); ?>"><button type="button" class="btn btn-default">View</button></a>
                            <a href="<?php echo base_url().'tugas_security/edit/'.md5($data_security['id']); ?>"><button type="button" class="btn btn-default <?php echo $is_update; ?>">Edit</button></a>
                            <a href="#" onclick="deleteData('<?php echo base_url().'tugas_security/delete/'.md5($data_security['id']); ?>')"><button type="button" class="btn btn-danger <?php echo $is_delete; ?>">Delete</button></a>
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
                    <button type="button" onclick="load_page('<?php echo base_url().'tugas_security/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>