<?php include(APPPATH."views/includes/header.php"); ?>
<style type="text/css">
	.tr-link {
		cursor: pointer;
	}

	.table-row p {
		font-size: 14px !important;
	}
</style>
<div class="blank">
	<div class="blank-page">
		<h4><?php echo $menu_title; ?></h4>
    	<table class="table" style="margin-top:50px;">
            <tbody>
            <?php foreach($notif_list as $notif){ ?>
            	<tr class="table-row tr-link" onclick="openLink('<?php echo $notif['notif_url'].($notif['notif_status'] == 0 ? '/'.md5($notif['id']) : ''); ?>')">
                    <td class="table-text">
                        <p><?php echo $notif['notif_desc_full']; ?></p>
                    </td>
                    <td class="march">
                       <?php echo $notif['notif_time']; ?>
                    </td>
                    <td>
                    	<?php echo $notif['notif_icon']; ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
		</table>
    </div>
</div>
<script type="text/javascript">
function openLink(url){
	window.location.href = url;
}
</script>
<?php include(APPPATH."views/includes/footer.php"); ?>