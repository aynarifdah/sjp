<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Api extends CI_Model
{
    public function cekstatus($nik)
    {
        $this->db->select('
            pp.tanggal_pengajuan AS TanggalPengajuan, 
            rs.nama_rumah_sakit AS RumahSakit, 
            pp.nama_pemohon AS NamaPemohon, 
            sjp.nama_pasien AS NamaPasien,
            sjp.feedback AS Feedback,
            sp.status_pengajuan AS StatusPengajuan, 
            js.nama_jenis AS Jenis');
        $this->db->from('permohonan_pengajuan pp');
        $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
        $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
        $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
        $this->db->join('jenis_sjp js', 'sjp.jenis_sjp = js.id_jenissjp', 'left');
    
        $this->db->where('nik !=', '');
        $this->db->where('nik =', $nik);
    
        $this->db->order_by('pp.tanggal_pengajuan', 'desc');
        
        $query = $this->db->get();
    
        $result['total_data'] = $query->num_rows();
        $result['pengajuan'] = $query->result();
    
        return $result;
    }    

}