<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class landingpage extends CI_Controller {
	
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

    
        // $session_user = $this->session->userdata();
        // $data = array (
        //     'site' => 'Landingpage',
        //     'username' => 'Landingpage',
        //     'avataruser' => '',
        //     'list_menu' => '',
        // );
    $page = array(
        "head"    => $this->load->view('landingpage/template/head', array("title" => $title), true),
        "header"  => $this->load->view('landingpage/template/header', false, true),
        "navbar" => $this->load->view('landingpage/template/navbar', false, true),
        "main_js" => $this->load->view('landingpage/template/main_js', false, true),
        "footer"  => $this->load->view('landingpage/template/footer', false, true)
    );
    return $page;
}

	public function index()
	{

        $path = "";
        $data = array(
        "page"    => $this->load("Index", $path),
        "content" => $this->load->view('landingpage/index', false, true)
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
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('landingpage/galeri', false, true)
   );

    $this->load->view('landingpage/template/master', $data);
   }

   public function syarat()
		{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('landingpage/syarat', false, true)
   );

    $this->load->view('landingpage/template/master', $data);
   }

   public function pengajuan()
		{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('landingpage/pengajuan', false, true)
   );

    $this->load->view('landingpage/template/master', $data);
   }

   public function statistik()
		{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('landingpage/statistik', false, true)
   );

    $this->load->view('landingpage/template/master', $data);
   }

    public function kontak()
		{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('landingpage/kontak', false, true)
   );

    $this->load->view('landingpage/template/master', $data);
   }

   public function knowledge()
		{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('landingpage/knowledge', false, true)
   );

    $this->load->view('landingpage/template/master', $data);
   }

   public function pengumuman()
		{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('landingpage/pengumuman', false, true)
   );

    $this->load->view('landingpage/template/master', $data);
   }

   public function agenda()
		{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('landingpage/agenda', false, true)
   );

    $this->load->view('landingpage/template/master', $data);
   }

   public function tujuan()
		{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('landingpage/tujuan', false, true)
   );

    $this->load->view('landingpage/template/master', $data);
   }

   public function manfaat()
		{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('landingpage/manfaat', false, true)
   );

    $this->load->view('landingpage/template/master', $data);
   }

    public function perwal()
		{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('landingpage/perwal', false, true)
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
     
}