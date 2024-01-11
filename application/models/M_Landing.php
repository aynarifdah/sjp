<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Landing extends CI_Model {

    public function count_data_jumlah_pasien($kecamatan = null, $kelurahan = null)
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

    public function count_data_jumlah_pasien_disetujui($kecamatan = null, $kelurahan = null)
    {
        $this->db->select('*');
        $this->db->from('sjp');
        $this->db->join('permohonan_pengajuan pp', 'pp.id_pengajuan = sjp.id_pengajuan', 'left');
        $this->db->where('pp.id_status_pengajuan =', 6);
        if(!empty($kecamatan)) {
            $this->db->where('sjp.kd_kecamatan', $kecamatan);
        }
        if(!empty($kelurahan)) {
            $this->db->where('sjp.kd_kelurahan', $kelurahan);
        }

        $query = $this->db->get()->num_rows();
        return $query;
    }

    public function count_data_jumlah_pasien_berdasarkan_kecamatan($kecamatan = null, $kelurahan = null)
    {
        $this->db->select('COUNT(DISTINCT sjp.id_sjp) as jumlahKec, d_wilayah.kecamatan');
        $this->db->from('sjp');
        $this->db->join('d_wilayah', 'd_wilayah.kecamatan = sjp.kd_kecamatan', 'right');
        $this->db->where('d_wilayah.jenis', 'kecamatan');
        $this->db->where('d_wilayah.kabupaten', 'Depok');
        $this->db->group_by("d_wilayah.kd_kecamatan");

        if(!empty($kecamatan)) {
            $this->db->where('sjp.kd_kecamatan', $kecamatan);
        }
        // if(!empty($kelurahan)) {
        //     $this->db->where('sjp.kd_kelurahan', $kelurahan);
        // }

        $query = $this->db->get()->result_array();
        return $query;
    }

    public function count_data_jumlah_pasien_berdasarkan_kelurahan($kecamatan = null, $kelurahan = null)
    {
        $this->db->select('COUNT(DISTINCT sjp.id_sjp) as jumlahKel, d_wilayah.kelurahan');
        $this->db->from('sjp');
        $this->db->join('d_wilayah', 'd_wilayah.kelurahan = sjp.kd_kelurahan', 'right');
        $this->db->where('d_wilayah.jenis', 'kelurahan');
        $this->db->where('d_wilayah.kabupaten', 'Depok');
        $this->db->group_by("d_wilayah.kd_kelurahan");

        if(!empty($kecamatan)) {
            $this->db->where('sjp.kd_kecamatan', $kecamatan);
        }
        if(!empty($kelurahan)) {
            $this->db->where('sjp.kd_kelurahan', $kelurahan);
        }

        $query = $this->db->get()->result_array();
        return $query;
    }

    public function count_data_jumlah_pasien_berdasarkan_laki_laki($kecamatan = null, $kelurahan = null)
    {
        $this->db->select('jenis_kelamin, COUNT(*) as jumlah_laki');
        $this->db->from('sjp');
        // $this->db->group_by('jenis_kelamin');
        $this->db->where('jenis_kelamin', 'Laki-Laki');

        if(!empty($kecamatan)) {
            $this->db->where('sjp.kd_kecamatan', $kecamatan);
        }
        if(!empty($kelurahan)) {
            $this->db->where('sjp.kd_kelurahan', $kelurahan);
        }

        $query = $this->db->get()->result_array();
        return $query;
    }

    public function count_data_jumlah_pasien_berdasarkan_perempuan($kecamatan = null, $kelurahan = null)
    {
        $this->db->select('sjp.jenis_kelamin, COUNT(*) as jumlah_perempuan');
        $this->db->from('sjp');
        // $this->db->group_by('jenis_kelamin');
        $this->db->where('jenis_kelamin', 'Perempuan');

        if(!empty($kecamatan)) {
            $this->db->where('sjp.kd_kecamatan', $kecamatan);
        }
        if(!empty($kelurahan)) {
            $this->db->where('sjp.kd_kelurahan', $kelurahan);
        }

        $query = $this->db->get()->result_array();
        return $query;
    }

    public function count_data_jumlah_pasien_berdasarkan_jenis_kelamin($kecamatan = null, $kelurahan = null)
    {
        $this->db->select('COUNT(DISTINCT sjp.id_sjp) as jumlah_pasien, sjp.jenis_kelamin');
        $this->db->from('sjp');
        $this->db->group_by('jenis_kelamin');

        if(!empty($kecamatan)) {
            $this->db->where('sjp.kd_kecamatan', $kecamatan);
        }
        if(!empty($kelurahan)) {
            $this->db->where('sjp.kd_kelurahan', $kelurahan);
        }

        $query = $this->db->get()->result_array();
        return $query;
    }
}