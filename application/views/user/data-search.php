            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama Lengkap</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nourut = 1;
                    foreach($all_user as $data_user){ 
                ?>
                    <tr>
                        <td><?php echo $nourut; ?></td>
                        <td><?php echo $data_user['fullname']; ?></td>
                        <td><?php echo $data_user['username']; ?></td>
                        <td><?php echo $data_user['email']; ?></td>
                        <td>
                            <a href="<?php echo base_url().'user/edit/'.md5($data_user['id']); ?>"><button type="button" class="btn btn-default">Edit</button></a>
                            <?php if($data_user['id'] != 1){ ?>
                            <a href="#" onclick="deleteData('<?php echo base_url().'user/delete/'.md5($data_user['id']); ?>')"><button type="button" class="btn btn-danger">Delete</button></a>
                            <?php } ?>
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
                    <button type="button" onclick="load_page('<?php echo base_url().'user/data_search/'.$numb.'/'; ?>')" class="btn btn-<?php echo ($numb-1 == (int)$curr_page ? 'reverse' : 'default'); ?> btn-page"><?php echo $numb; ?></button>
                <?php } ?>
                <button type="button" class="btn btn-default">>></button>
            </div>