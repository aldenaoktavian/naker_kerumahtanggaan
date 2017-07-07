<?php include(APPPATH."views/includes/header.php"); ?>
<div class="blank">
	<div class="blank-page">
    	<h4><?php echo $menu_title; ?></h4>
        <div style="margin-top:50px;">
            <div style="margin-bottom: 10px;">
                <a href="<?php echo base_url().'perpanjangan_stnk_report/print_data' ?>" target="_blank"><button class="btn btn-primary">Print All Data</button></a>
                <input type="text" id="search" data-url="<?php echo base_url().'perpanjangan_stnk_report/data_search/0/'; ?>" class="form-control" placeholder="Search" style="max-width: 250px;float: right;" />
            </div>
            <?php if(isset($_SESSION['perpanjangan_stnk_report']['message'])){ ?>
                <div style="color:<?php echo $_SESSION['perpanjangan_stnk_report']['message_color']; ?>;"><?php echo $_SESSION['perpanjangan_stnk_report']['message']; ?></div>
            <?php } ?>
            <div id="data_search"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
$( document ).ready(function(){
    $('#data_search').load("<?php echo base_url().'perpanjangan_stnk_report/data_search'; ?>");
});

$('#search').on('keydown', function(e){
    if(e.which == 13){
        var url_search = $(this).attr('data-url') + $(this).val();
        $('#data_search').load(url_search);
    }
});

function load_page(url_page){
    var data_search = $('#search').val();
    var url_search = url_page + data_search;
    $('#data_search').load(url_search);
}
</script>
<?php 
unset($_SESSION['perpanjangan_stnk_report']);
include(APPPATH."views/includes/footer.php"); 
?>