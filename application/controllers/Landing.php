<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->model('M_SJP');
        $this->load->model('M_data');
        // auth_menu();
        // is_login();
    }

    //FUNGSI UNTUK MEMBUAT TEMPLATE
    private function load($title = '', $datapath = '')
    {

        $page = array(
            "head"    => $this->load->view('landingpage/template/head', array("title" => $title), true),
            "header"  => $this->load->view('landingpage/template/header', false, true),
            "navbar"  => $this->load->view('landingpage/template/navbar', false, true),
            "main_js" => $this->load->view('landingpage/template/main_js', false, true),
            "footer"  => $this->load->view('landingpage/template/footer', false, true)
        );
        return $page;
    }

    public function index()
    {

        $path = "";
        $data = [
            'total_pasien'       => $this->M_SJP->total_pasien(),
            'disetujui'       => $this->M_SJP->total_disetujui(),
        ];
        
        $data = array(
            "page"    => $this->load("Index", $path),
            "content" => $this->load->view('landingpage/index', $data, true)
        );

        $this->load->view('landingpage/template/master', $data);
    }
    public function TentangKami()
    {
       $path = "";
       $data = array(
         "page"    => $this->load("Index", $path) ,
         "content" => $this->load->view('landingpage/TentangKami', false, true)
     );

       $this->load->view('landingpage/template/master', $data);
   }

   public function galeri()
   {
        $path = "";
        $data = array(
            "page"    => $this->load("Index", $path),
            "content" => $this->load->view('landingpage/galeri', false, true)
        );

        $this->load->view('landingpage/template/master', $data);
    }

    public function syarat()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Index", $path),
            "content" => $this->load->view('landingpage/syarat', false, true)
        );

        $this->load->view('landingpage/template/master', $data);
    }

    public function pengajuan()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Index", $path),
            "content" => $this->load->view('landingpage/pengajuan', false, true)
        );

        $this->load->view('landingpage/template/master', $data);
    }

    public function statistik()
    {
        $path = "";
        $data = [
            'kecamatan'         => $this->M_SJP->wilayah('kecamatan'),
        ];

        $data = array(
            "page"    => $this->load("Index", $path),
            "content" => $this->load->view('landingpage/statistik', $data, true)
        );

        $this->load->view('landingpage/template/master', $data);
    }

    public function kontak()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Index", $path),
            "content" => $this->load->view('landingpage/kontak', false, true)
        );

        $this->load->view('landingpage/template/master', $data);
    }

    public function knowledge()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Index", $path),
            "content" => $this->load->view('landingpage/knowledge', false, true)
        );

        $this->load->view('landingpage/template/master', $data);
    }

    public function pengumuman()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Index", $path),
            "content" => $this->load->view('landingpage/pengumuman', false, true)
        );

        $this->load->view('landingpage/template/master', $data);
    }

    public function agenda()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Index", $path),
            "content" => $this->load->view('landingpage/agenda', false, true)
        );

        $this->load->view('landingpage/template/master', $data);
    }

    public function tujuan()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Index", $path),
            "content" => $this->load->view('landingpage/tujuan', false, true)
        );

        $this->load->view('landingpage/template/master', $data);
    }

    public function manfaat()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Index", $path),
            "content" => $this->load->view('landingpage/manfaat', false, true)
        );
        $this->load->view('landingpage/template/master', $data);
    }

    public function peraturan()
    {
    	$path = "";
        $data = array(
            "page"    => $this->load("Index", $path) ,
            "content" => $this->load->view('landingpage/peraturan', false, true)
        );

        $this->load->view('landingpage/template/master', $data);
    }

    public function download_no01(){
        force_download('assets-web/img/dokumen/22. PETUNJUK TEKNIS PEMBIAYAAN JAMINAN KESEHATAN BAGI MASYARAKAT.pdf', NULL);
    }

    public function download_no02(){
        force_download('assets-web/img/dokumen/39. PERUBAHAN PERWAL NO 22 TAHUN 2021 TENTANG PETUNJUK TEKNIS PEMBIAYAAN JAMKES BAGI MASYARAKAT.pdf', NULL);
    }

    public function download_no03(){
        force_download('assets-web/img/dokumen/Perwa 31 2022 Parameter kemiskinan.pdf', NULL);
    }

    public function all_statistik()
    {
        $kecamatan = $this->input->post('kecamatan');
        $kelurahan = $this->input->post('kelurahan');

        $data = [
            'jumlah_pasien' => $this->statis->count_data_kekerasan($kecamatan, $kelurahan),
            'jumlah_pengajuan' => $this->statis->count_data_perempuan_dewasa($kecamatan, $kelurahan),
            'pengajuan_disetujui' => $this->statis->count_data_anak($kecamatan, $kelurahan),
        ];
        
        echo json_encode($data);
    }

    public function getKelurahan()
    {
        $KecId = $this->input->post('id');
        $kel   = $this->M_SJP->wilayah_kelurahan('kelurahan', $KecId);
        echo json_encode($kel);
    }

}
