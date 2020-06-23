<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_log extends CI_Model {
	public function save_log($log)
	{
		$sql = $this->db->insert_string('history_log', $log);
		$query = $this->db->query($sql);

		return $this->db->affected_rows($sql);
	}

	public function get_log($kondisi){
		$this->db->select('hl.*,user.nama');
		$this->db->where($kondisi);
		$this->db->from('history_log hl');
		$this->db->join('user', 'user.id_user = hl.log_user', 'left');
		return $this->db->get()->result_array();
	}

	public function getLast_log($kondisi){
		$this->db->select('hl.*,user.nama');
		$this->db->where($kondisi);
		$this->db->from('history_log hl');
		$this->db->join('user', 'user.id_user = hl.log_user', 'left');
		$this->db->order_by('log_id', 'desc');
		$this->db->limit(1);
		return $this->db->get()->result_array();
	}
}

/* End of file M_log.php */
/* Location: ./application/models/M_log.php */