            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kode Jenis Kendaraan</td>
                        <td>Nama Jenis Kendaraan</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nourut = 1;
                    foreach($all_jenis_kendaraan as $data_jenis_kendaraan){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $data_jenis_kendaraan['kode_jenis']; ?></td>
                        <td><?php echo $data_jenis_kendaraan['nama_jenis']; ?></td>
                        <td>
                            <a href="<?php echo base_url().'jenis_kendaraan/edit/'.md5($data_jenis_kendaraan['id']); ?>"><button type="button" class="btn btn-default">Edit</button></a>
                            <a href="#" onclick="deleteData('<?php echo base_url().'jenis_kendaraan/delete/'.md5($data_jenis_kendaraan['id']); ?>')"><button type="button" class="btn btn-danger">Delete</button></a>
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
                    <button type="button" onclick="load_page('<?php echo base_url().'jenis_kendaraan/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>