							<?php foreach($new_notif_updates as $notif){ ?>
								<li>
	                                <a href="<?php echo $notif['notif_url'].($notif['notif_status'] == 0 ? '/'.md5($notif['id']) : ''); ?>">
	                                    <div class="user-new" style="width:100px;">
	                                        <p><?php echo $notif['notif_desc']; ?>...</p>
	                                        <span><?php echo $notif['notif_time']; ?></span>
	                                    </div>
	                                    <div class="user-new-left">
	                                        <?php echo $notif['notif_icon']; ?>
	                                    </div>
	                                    <div class="clearfix"> </div>
	                                </a>
	                            </li>
							<?php } ?>
								<li><a href="<?php echo base_url().'notifikasi/all'; ?>" class="view">Lihat semua notifikasi</a></li>