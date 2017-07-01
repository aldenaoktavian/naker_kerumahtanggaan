<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function load_default()
{
	$result = array_merge(left_menu(), notif_list());

	return $result;
}

function db_get_one_data($field, $table, $where)
{
	$CI = get_instance();
	$CI->db->select($field);
	$data = $CI->db->get_where($table, $where)->row_array();
	return $data[$field];
}

function notif_list($id_user=0)
{
	$CI = get_instance();

	$CI->load->model('notif_model');

	if($id_user == 0){
		$id_user = $_SESSION['login']['id_user'];
	}

	$notif_updates = $CI->notif_model->all_notif($id_user, 0, 5);
	$date_now = new DateTime();
	foreach ($notif_updates as $key => $value) {
		$date_created = new DateTime($value['created']);
		$diff_notif = date_diff($date_created, $date_now);
		if($diff_notif->y != 0){
			$notif_updates[$key]['notif_time'] = $diff_notif->y." tahun yang lalu.";
		} else if($diff_notif->m != 0){
			$notif_updates[$key]['notif_time'] = $diff_notif->m." bulan yang lalu.";
		} else if($diff_notif->d != 0){
			$notif_updates[$key]['notif_time'] = $diff_notif->d." hari yang lalu.";
		} else if($diff_notif->h != 0){
			$notif_updates[$key]['notif_time'] = $diff_notif->h." jam yang lalu.";
		} else if($diff_notif->i != 0){
			$notif_updates[$key]['notif_time'] = $diff_notif->i." menit yang lalu.";
		} else if($diff_notif->s != 0){
			$notif_updates[$key]['notif_time'] = $diff_notif->s." detik yang lalu.";
		}
		$notif_updates[$key]['notif_desc'] = substr($value['notif_desc'], 0, 25);
		$notif_updates[$key]['notif_icon'] = ($value['notif_status'] == 0 ? '<i class="fa fa-circle"></i>' : '');
	}
	$data['notif_updates'] = $notif_updates;
	$data['unread_notif_count'] = $CI->notif_model->unread_notif_count($_SESSION['login']['id_user']);

	return $data;
}

function getKodeRuangan()
{
	$CI = get_instance();

	$last_id = $CI->db->select('max(id) AS id')->get_where('ruangans')->row_array();

	$new_number = (int)$last_id['id'] + 1;

	$kode = "RUANG".$new_number;

	return $kode;
}

function getKodePetugas()
{
	$CI = get_instance();

	$last_id = $CI->db->select('max(id) AS id')->get_where('petugas')->row_array();

	$new_number = (int)$last_id['id'] + 1;

	$kode = "PTGS".$new_number;

	return $kode;
}

function getKodeBookingRuangan()
{
	$CI = get_instance();

	$last_id = $CI->db->select('max(id) AS id')->get_where('booking_ruangans')->row_array();

	$new_number = (int)$last_id['id'] + 1;

	$kode = "BOOK".$new_number;

	return $kode;
}

function getKodeBarang()
{
	$CI = get_instance();

	$last_id = $CI->db->select('max(id) AS id')->get_where('jenis_barangs')->row_array();

	$new_number = (int)$last_id['id'] + 1;

	$kode = "BR".$new_number;

	return $kode;
}

function getKodePengadaanBarang()
{
	$CI = get_instance();

	$last_id = $CI->db->select('max(id) AS id')->get_where('pengadaan_barangs')->row_array();

	$new_number = (int)$last_id['id'] + 1;

	$kode = "REQ".$new_number;

	return $kode;
}

function getKodePerawatanBarang()
{
	$CI = get_instance();

	$last_id = $CI->db->select('max(id) AS id')->get_where('perawatan_barangs')->row_array();

	$new_number = (int)$last_id['id'] + 1;

	$kode = "MNT".$new_number;

	return $kode;
}

function getKodeJenisKendaraan()
{
	$CI = get_instance();

	$last_id = $CI->db->select('max(id) AS id')->get_where('jenis_kendaraans')->row_array();

	$new_number = (int)$last_id['id'] + 1;

	$kode = "VCT".$new_number;

	return $kode;
}

function getKodeKendaraan()
{
	$CI = get_instance();

	$last_id = $CI->db->select('max(id) AS id')->get_where('kendaraans')->row_array();

	$new_number = (int)$last_id['id'] + 1;

	$kode = "VHC".$new_number;

	return $kode;
}

function getKodeJadwalCleaning()
{
	$CI = get_instance();

	$last_id = $CI->db->select('max(id) AS id')->get_where('jadwal_tugas',array('tipe'=>'C'))->row_array();

	$new_number = (int)$last_id['id'] + 1;

	$kode = "SCL".$new_number;

	return $kode;
}

function getKodeJadwalSecurity()
{
	$CI = get_instance();

	$last_id = $CI->db->select('max(id) AS id')->get_where('jadwal_tugas',array('tipe'=>'S'))->row_array();

	$new_number = (int)$last_id['id'] + 1;

	$kode = "SSC".$new_number;

	return $kode;
}

function saveNotif($data_notif, $notif_receiver)
{
	$CI = get_instance();

	$CI->load->model('notif_model');

	$type_desc = db_get_one_data('type_desc', 'notif_types', array('id'=>$data_notif['notif_type_id']));
	$notif_desc = str_replace("[nama_user]", $_SESSION['login']['nama_user'], $type_desc);

	$i = 0;
	foreach($notif_receiver as $data_user){
		$data_add_notif = array(
				'user_id'	=> $data_user['user_id'],
				'notif_type_id'	=> $data_notif['notif_type_id'],
				'notif_desc'	=> $notif_desc,
				'notif_url'		=> $data_notif['notif_url'],
				'created'		=> date("Y-m-d H:i:s")
			);

		$add_notif = $CI->notif_model->add_notif($data_add_notif);
		if($add_notif != 0){
			require_once APPPATH.'libraries/phpmailer/PHPMailerAutoload.php';
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host = SMTP_HOST; 
			$mail->SMTPSecure = SMTP_SECURE;
			$mail->Port = SMTP_PORT;
			$mail->SMTPAuth = true;
			$mail->Username = MAIL_SENDER_NOTIF;
			$mail->Password = PASS_MAIL_SENDER_NOTIF;
			$mail->From = MAIL_SENDER_NOTIF_ALIAS;
			$mail->FromName = 'Depnaker Kerumahtanggaan';
			$mail->Subject  = "[Depnaker Kerumahtanggaan] Notification";
			$mail->IsHTML(true);
			$mail->MsgHTML($notif_desc);
			$mail->AltBody = 'This is a plain-text message body';
			$mail->addAddress($data_user['email']);
				
			if (!$mail->send()) {
				$result['message'] = "Mailer Send Error: " . $mail->ErrorInfo;
			} else{
				$result['message'] = "sukses";
				$new_unread_notif_count = $CI->notif_model->unread_notif_count($data_user['user_id']);
				$detail_notif = $CI->notif_model->detail_notif($add_notif);
				// echo "<pre>"; print_r($detail_notif);echo "</pre>";
				// foreach ($detail_notif as $value) {
					$detail_notif['notif_url'] = $value['notif_url']."/".md5($value['id']);
				// }
				$_SESSION['data_socket'][$i] = array_merge($detail_notif, array('new_unread_notif_count'=>$new_unread_notif_count));
			}
			$i++;
		}
	}
	$_SESSION['data_socket'] = json_encode($_SESSION['data_socket']);

	return $result;
}