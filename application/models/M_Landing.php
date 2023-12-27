<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Landing extends CI_Model {

    public function count_data_kekerasan($kecamatan = null, $kelurahan = null)
    {
        $this->db->select('*');
        $this->db->from('sjp');
        $this->db->join('permohonan_pengajuan pp', 'pp.id_pengajuan = sjp.id_pengajuan', 'left');
        if(!empty($kecamatan)) {
            $this->db->where('sjp.kd_kecamatan', $kecamatan);
        }
        if(!empty($kelurahan)) {
            $this->db->where('sjp.kd_kelurahan', $kelurahan);
        }

        $query = $this->db->get()->num_rows();
        return $query;
    }
}