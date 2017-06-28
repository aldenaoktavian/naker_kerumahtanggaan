			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
<style type="text/css">
	.alert-dismissible{
		font-size: 12px;
	}
</style>
<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var socket = io.connect( 'http://'+window.location.hostname+':3000' );
	
	var data = <?php echo (isset($_SESSION['data_socket']) ? $_SESSION['data_socket'] : 0); ?>;
	if(data != 0){
        for (var i = 0, len = data.length; i < len; i++) {
			socket.emit('new_notif', { 
	        	new_unread_notif_count: data[i]['new_unread_notif_count'],
	        	new_notif_desc: data[i]['notif_desc'],
	        	new_notif_url: data[i]['notif_url'],
	        	new_user_id: data[i]['user_id']
	        });
		}
	}

	var new_unread_notif_count = <?php echo (isset($_SESSION['new_unread_notif_count']) ? $_SESSION['new_unread_notif_count'] : '-'); ?>;
	if(new_unread_notif_count != '-'){
		socket.emit('new_unread_notif_count', { 
        	new_count: new_unread_notif_count
        });
	}
});

var socket = io.connect( 'http://'+window.location.hostname+':3000' );

socket.on( 'new_notif', function( data ) {
	var active_user_id = <?php echo $_SESSION['login']['id_user']; ?>;
	
	if(data.new_user_id == active_user_id){
		$( "#count_unread_message" ).html( data.new_unread_notif_count );
		$( "#dropdown-notif" ).load( base_url + 'notif/load_unread_notif/' + data.new_user_id );
		toastr.info('<a href="' + data.new_notif_url + '" target="_blank" style="text-decoration: underline;">' + data.new_notif_desc + '</a>', '', {timeOut: 500000, positionClass : 'toast-bottom-right'});
	}
});

socket.on( 'new_unread_notif_count', function( data ) {
	var active_user_id = <?php echo $_SESSION['login']['id_user']; ?>;
	
	$( "#count_unread_message" ).html( data.new_count );
	$( "#dropdown-notif" ).load( base_url + 'notif/load_unread_notif/' + active_user_id );
});
</script>
<?php
	unset($_SESSION['new_unread_notif_count']);
	unset($_SESSION['data_socket']);
?>
</body>
</html>