<?php include(APPPATH."views/includes/header.php"); ?>
<div class="blank">
	<div class="blank-page">
    	<h4><?php echo $menu_title; ?></h4>
        <div style="margin-top:50px;">
            <?php if(isset($message)){ ?>
                <span style="color:red;"><?php echo $message; ?></span><br/><br/>
            <?php } ?>
            <form action="<?php echo base_url().'user/setting'; ?>" method="POST">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Password Lama
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="password" class="form-control" name="old_pass" placeholder="Password Lama" />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Password Baru
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="password" class="form-control" name="new_pass" placeholder="Password Baru" />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        Konfirmasi Password Baru
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <input type="password" class="form-control" name="confirm_new_pass" placeholder="Konfirmasi Password Baru" />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <button type="submit" class="btn btn-primary">Update Setting</button>
                    <a href="<?php echo base_url(); ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<?php include(APPPATH."views/includes/footer.php"); ?>