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
            'dataexcel' => $this->M_SJP->getpersetujuansjpdinas()
        );
        $this->load->view('exportexcel/pengajuan_sjp_baru', $data);
    }
    public function persetujuan_sjp_kayankesru()
    {
        $data = array(
            'title' => 'persetujuan_sjp_kayankesru',
            'dataexcel' => $this->M_SJP->getpersetujuansjpdinas()
        );
        $this->load->view('exportexcel/excel_persetujuan_sjp_kayankesru', $data);
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

}
