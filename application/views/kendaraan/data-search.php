            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kode Kendaraan</td>
                        <td>Pemegang</td>
                        <td>Merk / Type</td>
                        <td>Nomor Polisi</td>
                        <td>Masa Berlaku Pada Pajak</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nourut = 1;
                    foreach($all_kendaraan as $data_kendaraan){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $data_kendaraan['kode_kendaraan']; ?></td>
                        <td><?php echo $data_kendaraan['pemegang']; ?></td>
                        <td><?php echo $data_kendaraan['merk']; ?></td>
                        <td><?php echo $data_kendaraan['no_pol']; ?></td>
                        <td><?php echo date('d M Y',strtotime($data_kendaraan['masa_stnk'])); ?></td>
                        <td>
                            <a href="<?php echo base_url().'kendaraan/view/'.md5($data_kendaraan['id']); ?>"><button type="button" class="btn btn-default">View</button></a>
                            <a href="<?php echo base_url().'kendaraan/edit/'.md5($data_kendaraan['id']); ?>"><button type="button" class="btn btn-default">Edit</button></a>
                            <a href="#" onclick="deleteData('<?php echo base_url().'kendaraan/delete/'.md5($data_kendaraan['id']); ?>')"><button type="button" class="btn btn-danger">Delete</button></a>
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
                    <button type="button" onclick="load_page('<?php echo base_url().'kendaraan/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>