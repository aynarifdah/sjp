<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function tahun(){
		$this->db->select("year(tanggal_surat)");
		$this->db->distinct();
		$json = $this->db->get('sjp')->result_array();

		echo json_encode($json);
	}

	public function bulan(){
		$this->db->select("MONTH(tanggal_surat)");
		$this->db->distinct();
		$json = $this->db->get('sjp')->result_array();

		echo json_encode($json);
	}

	public function kecamatan(){
		$this->db->select("kd_kecamatan as id, kecamatan as text");
		$this->db->distinct();
		$json = $this->db->get('d_wilayah')->result_array();

		echo json_encode($json);
	}

	public function kelurahan($kecamatan){
		$this->db->select("kd_kelurahan as id, kelurahan as text");
		$this->db->distinct();
		$json = $this->db->get('d_wilayah')->result_array();

		echo json_encode($json);
	}



// ////////////////////////////////////////////////////////////////////////////////////////////////////
// MAHDI - (Maaf, biar gampang kebaca)
// ////////////////////////////////////////////////////////////////////////////////////////////////////

	public function getPuskesmas($id=Null){
	  	$this->db->select("id_puskesmas, nama_puskesmas");
	  	$this->db->from("puskesmas");
	  	if (!empty($id)) {
	  		$this->db->where("id_puskesmas =", $id);
	  	}
	  	return $this->db->get()->result_array();
	}

	public function getRS($id=Null){
	  	$this->db->select("id_rumah_sakit, nama_rumah_sakit");
	  	$this->db->from("rumah_sakit");
	  	if (!empty($id)) {
	  		$this->db->where("id_rumah_sakit =", $id);
	  	}
	  	return $this->db->get()->result_array();
	}

	public function getStatusPengajuan($id=Null){
	  	$this->db->select("id_statuspengajuan, status_pengajuan");
	  	$this->db->from("status_pengajuan");
	  	if (!empty($id)) {
	  		$this->db->where("id_statuspengajuan =", $id);
	  	}
	  	return $this->db->get()->result_array();
	}

	public function getStatusKlaim($id=Null){
	  	$this->db->select("id_statusklaim, nama_statusklaim");
	  	$this->db->from("status_klaim");
	  	if (!empty($id)) {
	  		$this->db->where("id_statusklaim =", $id);
	  	}
	  	return $this->db->get()->result_array();
	}

	public function getLevel($id=Null){
	  	$this->db->select("id_level, nama_level");
	  	$this->db->from("level");
	  	if (!empty($id)) {
	  		$this->db->where("id_level =", $id);
	  	}
	  	return $this->db->get()->result_array();
	}

	public function getInstansi($id=Null){
	  	$this->db->select("id_instansi, nama_instansi");
	  	$this->db->from("instansi");
	  	if (!empty($id)) {
	  		$this->db->where("id_instansi =", $id);
	  	}
	  	return $this->db->get()->result_array();
	}



// ////////////////////////////////////////////////////////////////////////////////////////////////////
// MAHDI - (Maaf, biar gampang kebaca)
// ////////////////////////////////////////////////////////////////////////////////////////////////////


	public function getJamPengajuan(){
	  	$this->db->select('*');
	  	$this->db->from('jam_pengajuan');
	  	return $this->db->get()->result_array();
	}

	public function getJamSurvey(){
	  	$this->db->select('*');
	  	$this->db->from('jam_survey');
	  	return $this->db->get()->result_array();
	}
}

/* End of file M_data.php */
/* Location: ./application/models/M_data.php */