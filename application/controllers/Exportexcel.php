<?php

class Exportexcel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->model('M_SJP');
        $this->load->library('custom_upload');
    }


    // Dinkes
    public function data_semua_pengajuan()
    {
        $data = array(
            'title' => 'data_semua_pengajuan',
            'dataexcel' => $this->M_SJP->select_pengajuan_sjp_all()
        );
        $this->load->view('exportexcel/data_semua_pengajuan', $data);
    }
    public function pengajuan_sjp_baru()
    {
        $data = array(
            'title' => 'pengajuan_sjp_baru',
            'dataexcel' => $this->M_SJP->getpersetujuansjpdinas(Null, Null, 4, Null)
        );
        $this->load->view('exportexcel/pengajuan_sjp_baru', $data);
    }
    public function persetujuan_sjp_kayankesru()
    {
        $data = array(
            'title' => 'persetujuan_sjp_kayankesru',
            'dataexcel' => $this->M_SJP->getpersetujuansjpdinas(Null, Null, 5, Null)
        );
        $this->load->view('exportexcel/excel_persetujuan_sjp_kayankesru', $data);
    }

    public function disetujui_sjp()
    {
        $data = array(
            'title' => 'disetujui_sjp',
            'dataexcel' => $this->M_SJP->getpersetujuansjpdinas(Null, Null, 6, Null)
        );
        $this->load->view('exportexcel/excel_disetujui_sjp', $data);
    }

    public function ditolak_sjp()
    {
        $data = array(
            'title' => 'ditolak_sjp',
            'dataexcel' => $this->M_SJP->getpersetujuansjpdinas(Null, Null, 7, Null)
        );
        $this->load->view('exportexcel/excel_ditolak_sjp', $data);
    }

    public function pengajuan_klaim()
    {
        $data = array(
            'title' => 'pengajuan_klaim',
            'dataexcel' => $this->M_SJP->getdatapengajuanklaim()
        );
        $this->load->view('exportexcel/excel_pengajuan_klaim', $data);
    }
    public function persetujuan_klaim()
    {
        $data = array(
            'title' => 'persetujuan_klaim',
            'dataexcel' => $this->M_SJP->getdatapengajuanklaim(2)
        );
        $this->load->view('exportexcel/excel_persetujuan_klaim', $data);
    }
    public function pembayaran_klaim()
    {
        $data = array(
            'title' => 'pembayaran_klaim',
            'dataexcel' => $this->M_SJP->getdatapengajuanklaim(3)
        );
        $this->load->view('exportexcel/excel_pembayaran_klaim', $data);
    }
    public function sudah_bayar_klaim()
    {
        $data = array(
            'title' => 'sudah_bayar_klaim',
            'dataexcel' => $this->M_SJP->getdatapengajuanklaim(4)
        );
        $this->load->view('exportexcel/excel_sudah_bayar_klaim', $data);
    }

    public function user_management()
    {
        $data = array(
            'title' => 'user_management',
            'dataexcel' => $this->M_SJP->getAllUserDinkes()
        );
        $this->load->view('exportexcel/excel_user_management', $data);
    }


    // Dinkes


    // Puskesmas

    public function load_variable()
    {
        $auth_data = $this->session->userdata();
        $id_puskesmas = $auth_data['id_join'];
        $id_join = $auth_data['id_join'];
        $id_instansi = $auth_data['instansi'];
        return [
            'id_puskesmas' => $id_puskesmas,
            'id_join' => $id_join,
            'id_instansi' => $id_instansi
        ];
    }

    public function pkm_pengajuan()
    {
        $var = $this->load_variable();

        $data = array(
            'title' => 'pengajuan',
            'dataexcel' => $this->M_SJP->view_permohonansjp_pus(null, $var['id_puskesmas'], null, null, null, $var['id_join'], $var['id_instansi'])
        );
        $this->load->view('exportexcel/excel_pkm_pengajuan', $data);
    }

    public function pkm_pengajuan_baru()
    {
        $var = $this->load_variable();

        $data = array(
            'title' => 'pengajuan_baru',
            'dataexcel' => $this->M_SJP->view_permohonansjp_pus(2, $var['id_puskesmas'], null, null, null, $var['id_join'], $var['id_instansi'])
        );
        $this->load->view('exportexcel/excel_pkm_pengajuan_baru', $data);
    }

    public function pkm_persetujuan_sjp()
    {
        $var = $this->load_variable();

        $data = array(
            'title' => 'persetujuan_sjp',
            'dataexcel' => $this->M_SJP->view_permohonansjp_pus(6, $var['id_puskesmas'], null, null, null, $var['id_join'], $var['id_instansi'])
        );
        $this->load->view('exportexcel/excel_pkm_persetujuan_sjp', $data);
    }

    // Puskesmas
}
