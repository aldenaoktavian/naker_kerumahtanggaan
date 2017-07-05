<?php include(APPPATH."views/includes/header.php"); ?>
<style type="text/css">
    thead tr td {
        font-weight: bold;
    }
</style>
<div class="blank">
	<div class="blank-page">
    	<h4><?php echo $menu_title; ?></h4>
        <div style="margin-top:50px;">
            <form action="<?php echo base_url().'user_category/privileges/'.$id; ?>" method="POST">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td></td>
                                <td>View</td>
                                <td>Add</td>
                                <td>Edit</td>
                                <td>Delete</td>
                                <td>Approve</td>
                            </tr>
                            <tr>
                                <td align="center">Module</td>
                                <td><input type="checkbox" id="all_view" onclick="check_all('view')"></td>
                                <td><input type="checkbox" id="all_add" onclick="check_all('add')"></td>
                                <td><input type="checkbox" id="all_edit" onclick="check_all('edit')"></td>
                                <td><input type="checkbox" id="all_delete" onclick="check_all('delete')"></td>
                                <td><input type="checkbox" id="all_approve" onclick="check_all('approve')"></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($all_priv_modules as $data_module){ ?>
                            <tr>
                                <td><?php echo $data_module['module_alias'] ?></td>
                                <td><input type="checkbox" class="<?php echo $data_module['module_name'] ?> view" name="<?php echo $data_module['module_name'] ?>[0]" value="1" <?php echo ($data_module['is_view'] == 1 ? "checked" : ""); ?>></td>
                                <td><input type="checkbox" class="<?php echo $data_module['module_name'] ?> add" name="<?php echo $data_module['module_name'] ?>[1]" value="1" <?php echo ($data_module['is_insert'] == 1 ? "checked" : ""); ?>></td>
                                <td><input type="checkbox" class="<?php echo $data_module['module_name'] ?> edit" name="<?php echo $data_module['module_name'] ?>[2]" value="1" <?php echo ($data_module['is_update'] == 1 ? "checked" : ""); ?>></td>
                                <td><input type="checkbox" class="<?php echo $data_module['module_name'] ?> delete" name="<?php echo $data_module['module_name'] ?>[3]" value="1" <?php echo ($data_module['is_delete'] == 1 ? "checked" : ""); ?>></td>
                                <td><input type="checkbox" class="<?php echo $data_module['module_name'] ?> approve" name="<?php echo $data_module['module_name'] ?>[4]" value="1" <?php echo ($data_module['is_approve'] == 1 ? "checked" : ""); ?>></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-space">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?php echo base_url().'user_category'; ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
function check_all(type){
    if($("#all_" + type).prop("checked") == true){
        $("." + type).prop("checked", true);
    } else{
        $("." + type).prop("checked", false);
    }
}
</script>
<?php include(APPPATH."views/includes/footer.php"); ?>