<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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