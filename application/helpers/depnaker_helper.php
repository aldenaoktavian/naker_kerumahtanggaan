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

function getKodePenerimaanBarang()
{
	$CI = get_instance();

	$last_id = $CI->db->select('max(id) AS id')->get_where('pengadaan_barangs',array('status'=>'A'))->row_array();

	$new_number = (int)$last_id['id'] + 1;

	$kode = "ACC".$new_number;

	return $kode;
}