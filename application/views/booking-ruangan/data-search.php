            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama Ruangan</td>
                        <td>Tanggal Booking</td>
                        <td>Jam Booking</td>
                        <td>Direktorat</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nourut = 1;
                    foreach($all_booking_ruangan as $data_ruangan){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $data_ruangan['nama_ruangan']; ?></td>
                        <td><?php echo date("d M Y", strtotime($data_ruangan['tgl_book'])); ?></td>
                        <td><?php echo $data_ruangan['jam_book']; ?></td>
                        <td><?php echo $data_ruangan['direktorat']; ?></td>
                        <td><?php echo ($data_ruangan['status'] == 0 ? "Terbooking" : ""); ?></td>
                        <td>
                            <a href="<?php echo base_url().'booking_ruangan/edit/'.md5($data_ruangan['id']); ?>"><button type="button" class="btn btn-default">Edit</button></a>
                            <a href="#" onclick="deleteData('<?php echo base_url().'booking_ruangan/delete/'.md5($data_ruangan['id']); ?>')"><button type="button" class="btn btn-danger">Delete</button></a>
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
                    <button type="button" onclick="load_page('<?php echo base_url().'booking_ruangan/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>