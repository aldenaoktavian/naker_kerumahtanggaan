<?php include(APPPATH."views/includes/header.php"); ?>
<div class="blank">
	<div class="blank-page">
    	<h4><?php echo $menu_title; ?></h4>
        <div style="margin-top:50px;">
            <div style="margin-bottom: 10px;">
                <a href="<?php echo base_url().'booking_ruangan/add'; ?>"><button class="btn btn-primary">Add Booking Ruangan</button></a>
                <!--a href="#" onclick="print_data()"><button class="btn btn-primary">Print All Data</button></a-->
                <input type="text" id="search" data-url="<?php echo base_url().'booking_ruangan/data_search/0/'; ?>" class="form-control" placeholder="Search" style="max-width: 250px;float: right;" />
            </div>
            <?php if(isset($_SESSION['booking_ruangan']['message'])){ ?>
                <div style="color:<?php echo $_SESSION['booking_ruangan']['message_color']; ?>;"><?php echo $_SESSION['booking_ruangan']['message']; ?></div>
            <?php } ?>
            <div id="data_search"></div>
        </div>
    </div>
</div>
<div id="contentPrint">
<style type="text/css">
@media print{
  body{ background-color:#FFFFFF; background-image:none; color:#000000 }
  #ad{ display:none;}
  #leftbar{ display:none;}
  #contentarea{ width:100%;}
}
</style>
yas
</div>
<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
<script type="text/javascript">
$( document ).ready(function(){
    $('#data_search').load("<?php echo base_url().'booking_ruangan/data_search'; ?>");
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

function print_data(){
    window.frames["print_frame"].document.body.innerHTML=document.getElementById("contentPrint").innerHTML;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
</script>
<?php 
unset($_SESSION['booking_ruangan']);
include(APPPATH."views/includes/footer.php"); 
?>