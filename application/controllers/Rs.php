<?php

class Rs extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('text');
    $this->load->model('M_SJP');
    $this->load->model('M_data');
    auth_menu();
    is_login();

  }
  private function load($title = '', $datapath = '')
  {
    $page = array(
      "head"    => $this->load->view('template/head', array("title" => $title), true),
      "header"  => $this->load->view('template/header', false, true),
      "sidebar" => $this->load->view('rs/template/sidebar', false, true),
      "main_js" => $this->load->view('template/main_js', false, true),
      "footer"  => $this->load->view('template/footer', false, true)
    );
    return $page;
  }


 public function daftar_klaim($id_status_klaim = null){
 
   //$id_status_klaim = 3;
   $datay = array(
    'status_klaim'      => $id_status_klaim,
    'dataklaim' => $this->M_SJP->getdatapengajuanklaim(),
    'penyakit' => $this->M_SJP->diagpasien(),    
    'controller' => $this->instansi(), 
    'rs'                => $this->M_data->getRS(),
    'statusklaim'       => $this->M_data->getStatusKlaim()
  );
   //var_dump($datay['dataklaim']);die;
   $path = "";
   $data = array(
    "page"    => $this->load("Daftar klaim", $path) ,
    "content" => $this->load->view('daftar_klaim', $datay, true)
  );

   $this->load->view('template/default_template', $data);
 }
 public function getdatapengajuanklaim()
{
    if ($this->input->post() !== Null) {
        $id_status_klaim = $this->input->post('status_klaim');
        $mulai           = $this->input->post("mulai");
        $akhir           = $this->input->post("akhir");
        $rs              = $this->input->post("rs");
        $status          = $this->input->post("status");
        $cari            = $this->input->post("cari");
        $data            = $this->M_SJP->getdatapengajuanklaim($id_status_klaim,$mulai,$akhir,$rs,$status,$cari);
    } else {
        $data            = $this->M_SJP->getdatapengajuanklaim($id_status_klaim);
    }

    $result = [
        'data' => $data,
        'draw' => '',
        'recordsFiltered' => '',
        'recordsTotal' => '',
        'query' => $this->db->last_query(),
    ];
    echo json_encode($result);
}
 public function detail_pengajuan($idsjp, $id_pengajuan){
    $level = $this->session->userdata('level');
    $id_puskesmas = 1;
    $id_jenis_izin = 1;
    $path = "";
    $data['page'] = $this->load("Detail Pengajuan", $path);
    $this->db->select('nik');
    $this->db->from('sjp');
    $this->db->where('id_sjp', $idsjp);
    $nik = $this->db->get()->row();

     // Riwayat Cetak
    $kondisi = [
        'log_tipe' => 4,
        'log_desc'  => "Cetak SJP",
        'log_user'  => $this->session->userdata('id_user'),
        // hl = Tabble history_log
        'hl.id_instansi'  => $this->session->userdata('instansi')
    ];
    $data['riwayat_cetak'] = $this->M_log->getLast_log($kondisi);

    // Tanggal Menyetujui
    $data['tanggalMenyetujui'] = $this->M_SJP->getTanggalMenyetujui($idsjp);

    $data['datapermohonan'] = $this->M_SJP->detail_permohonansjp($idsjp, $id_puskesmas);
    $data['anggaran'] = $this->M_SJP->anggaran_pasien();
    $data['penyakit'] = $this->M_SJP->diagpasien($idsjp);
    $data['riwayatpengajuan'] = $this->M_SJP->riwayatsjpasien($nik->nik);
    $data['id_sjp'] = $idsjp;
    $data['kethasilsurvey'] = $this->M_SJP->kethasilsurvey($idsjp, $id_puskesmas);
    $data['getdokumenpersyaratan'] = $this->M_SJP->getdokumenpersyaratan($id_pengajuan, $id_jenis_izin);
    $data['level'] = $level;
    $data['controller'] = $this->instansi();
    $data['content'] = $this->load->view('detail_pengajuan', $data ,true,false);
    $this->load->view('template/default_template', $data);



}
public function gethasilsurvey()
{
    $id_puskesmas = 1;
    $id_sjp = $this->input->post('id_sjp');
    $data = $this->M_SJP->gethasilsurvey($id_sjp, $id_puskesmas);
    echo json_encode($data);
}

public function entry_klaim(){
  if (!empty($this->input->get('get'))) {
    $idsjp = explode(",", $this->input->get('get'));
  }else{
    $idsjp = '';
  }

        // var_dump($idsjp);die;
        //echo count($idsjp);die;
  $id_rumah_sakit = 1;

  $datay = array(
    'dataklaim' => $this->M_SJP->view_permohonanklaim_rs(Null,Null,Null,Null,Null,$idsjp),
    'penyakit'  => $this->M_SJP->diagpasien(),      

  );
        // var_dump($datay['penyakit']);die;
  $path = "";
  $data = array(
    "page"    => $this->load("entry klaim", $path) ,
    "content" => $this->load->view('entry_klaim', $datay, true)
  );

  $this->load->view('template/default_template', $data);

}
public function proses_entry_klaim(){
  $id_sjp = $this->input->post('id_sjp');
  //var_dump($id_sjp);die;
  $tanggaltagihan = $this->input->post('tanggal_tagihan');
  $nomortagihan   = $this->input->post('nomor_tagihan');
  $nominalklaim   = $this->input->post('nominal_klaim');
  $catatanklaim   = $this->input->post('catatan_klaim');
  $dataklaim = array();
         $index = 0; // Set index array awal dengan 0
           foreach ($id_sjp as $key ) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($dataklaim, array(
              'id_sjp'      => $key,
              'nomor_tagihan'   => $nomortagihan,
              'tanggal_tagihan' => $tanggaltagihan,
              'nominal_klaim'   => $nominalklaim[$index],
              'catatan_klaim'   => $catatanklaim[$index],
              'status_klaim'    => 2,
            ));
            $index++; }

    //var_dump($dataklaim);
            $this->db->update_batch('sjp',$dataklaim,'id_sjp');     
            redirect ('Rs/daftar_klaim', 'refresh'); 
          }

// ////////////////////////////////////////////////////////////////////////////////////////////////////
// MAHDI - (Maaf, biar gampang kebaca)
// ////////////////////////////////////////////////////////////////////////////////////////////////////

// public function Dashboard(){
//     $path = "";
//     $anggaran_tahun     = $this->M_SJP->anggaran();
//     $nominal_pembiayaan = $this->M_SJP->nominal_pembiayaan();
//     $sisa_anggaran      = $anggaran_tahun[0]["nominal_anggaran"] - $nominal_pembiayaan[0]['nominal'];

//     $d = [
//         'kecamatan'         => $this->M_SJP->wilayah('kecamatan'),
//         'tahun'             => $this->M_SJP->tahun(),
//         'bulan'             => $this->M_SJP->bulan(),
//         'jumlah_sjp'        => $this->M_SJP->jumlah_sjp(),
//         'anggaran_tahun'    => $anggaran_tahun[0]["nominal_anggaran"],
//         'sisa_anggaran'     => $sisa_anggaran,
//         'nominal_pembiayaan' => $nominal_pembiayaan[0]['nominal'],
//         'total_pasien'       => $this->M_SJP->total_pasien(),
//         'distribusi'         => $this->M_SJP->distribusi(),
//         'jumlah_kunjungan_bulan' => $this->M_SJP->jumlah_kunjungan_bulan(),
//         'trend_pasien'      => $this->M_SJP->trend_pasien(),
//         'jenis_rawat'      => $this->M_SJP->jenis_rawat(),
//         'chartJenisRawat'   => $this->M_SJP->chartJenisRawat()
//     ];

//     // var_dump( $d['jumlah_kunjungan_bulan'] ); die;

//     $data = [
//         "page"    => $this->load("Dashboard", $path) ,
//         "content" => $this->load->view('dashboard', $d, true)
//     ];

//     $this->load->view('template/default_template', $data);
// }


// public function Filter(){
//     $bulan      = $this->input->post('bulan');
//     $tahun      = $this->input->post('tahun');
//     $kecamatan  = $this->input->post('kecamatan');
//     $kelurahan  = $this->input->post('kelurahan');
//     $orderDistribusi = $this->input->post('orderDistribusi');

//     $anggaran_tahun     = $this->M_SJP->anggaran($bulan,$tahun,$kecamatan,$kelurahan);
//     $nominal_pembiayaan = $this->M_SJP->nominal_pembiayaan($bulan,$tahun,$kecamatan,$kelurahan);
//     // $sisa_anggaran      = $anggaran_tahun[0]["nominal_anggaran"] - $nominal_pembiayaan[0]['nominal'];

//     $data = [
//         'jumlah_sjp'            => $this->M_SJP->jumlah_sjp($bulan,$tahun,$kecamatan,$kelurahan),
//         'anggaran_tahun'        => $anggaran_tahun,
//         // 'sisa_anggaran'         => $sisa_anggaran,
//         'nominal_pembiayaan'    => $nominal_pembiayaan,
//         'total_pasien'          => $this->M_SJP->total_pasien($bulan,$tahun,$kecamatan,$kelurahan),
//         'distribusi'            => $this->M_SJP->distribusi($bulan,$tahun,$kecamatan,$kelurahan, $orderDistribusi),
//         'jumlah_kunjungan_bulan'=> $this->M_SJP->jumlah_kunjungan_bulan($bulan,$tahun,$kecamatan,$kelurahan),
//         'trend_pasien'          => $this->M_SJP->trend_pasien($bulan,$tahun,$kecamatan,$kelurahan),
//         'jenis_rawat'           => $this->M_SJP->jenis_rawat($bulan,$tahun,$kecamatan,$kelurahan),
//         'chartJenisRawat'       => $this->M_SJP->chartJenisRawat($bulan,$tahun,$kecamatan,$kelurahan)
//     ];

//     // var_dump($data["jumlah_kunjungan_bulan"]);die;
//     // header('Content-Type: application/json');
//     echo json_encode($data);
// }

// public function orderDistribusi(){
//     $bulan      = $this->input->post('bulan');
//     $tahun      = $this->input->post('tahun');
//     $kecamatan  = $this->input->post('kecamatan');
//     $kelurahan  = $this->input->post('kelurahan');
//     $orderDistribusi = $this->input->post('orderDistribusi');
//     $data = [
//         'distribusi' => $this->M_SJP->distribusi($bulan,$tahun,$kecamatan,$kelurahan, $orderDistribusi)
//     ];
//     echo json_encode($data);
// }

public function UserManagement(){
    if ($this->session->userdata('level') != 1) {
        redirect('Rs/','refresh');
    }
    $this->load->library('encryption');
    // Tambah
    if ($this->input->post("btntambah") !== null) {
        $nama       = $this->input->post("nama");
        $username   = $this->input->post("username");
        $password   = $this->encryption->encrypt($this->input->post("password"));
        $level      = $this->input->post("level");
        $instansi   = $this->input->post("instansi");

        $data = [
            'nama'      => $nama,
            'username'  => $username,
            'password'  => $password,
            'level'     => $level,
            'id_instansi'  => $instansi
        ];

        if ($this->input->post("id_join") !== null) {
           $data['id_join'] = $this->input->post("id_join");
        }

        if($this->db->insert('user', $data)){
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show mb-1 mt-1"><button type="button" class="close" data-dismiss="alert">&times;</button>User BERHASIL ditambahkan!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning fade show mb-1 mt-1">User GAGAL ditambahkan!</div>');
        }
    }

    // Edit
    if ($this->input->post("btnedit") !== null) {
        $id_user    = $this->input->post("id_user");
        $nama       = $this->input->post("nama");
        $username   = $this->input->post("username");
        $password   = $this->encryption->encrypt($this->input->post("password"));
        $level      = $this->input->post("level");
        $instansi   = $this->input->post("instansi");
        $id_join    = $this->input->post("id_join");

        $this->db->where("id_user =", $id_user);
        $data = [
            'id_user'   => $id_user,
            'nama'      => $nama,
            'username'  => $username,
            'password'  => $password,
            'level'     => $level,
            'id_instansi'  => $instansi,
            'id_join'   => $id_join
        ];
        $this->db->set($data);
        if($this->db->update('user')){
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show mb-1 mt-1"><button type="button" class="close" data-dismiss="alert">&times;</button>User BERHASIL diedit!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning fade show mb-1 mt-1">User GAGAL diedit!</div>');
        }
    }

    // Hapus
    if ($this->input->get("delete") !== null) {
        $id_user    = $this->input->get("delete");
        $this->db->where("id_user =", $id_user);
        if($this->db->delete('user')){
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show mb-1 mt-1"><button type="button" class="close" data-dismiss="alert">&times;</button>User BERHASIL dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning fade show mb-1 mt-1">User GAGAL dihapus!</div>');
        }
    }

    // Tambah Level
    if ($this->input->post("btnTambahLevel") !== null) {
        $level       = $this->input->post("level");
        $data = [
            'nama_level' => $level
        ];
        if($this->db->insert('level', $data)){
            echo "<script>alert('Level BERHASIL ditambahkan!')</script>";
        } else {
            echo "<script>alert('Level GAGAL ditambahkan!')</script>";
        }
    }

    // Tambah Instansi
    if ($this->input->post("btnTambahInstansi") !== null) {
        $instansi       = $this->input->post("instansi");
        $data = [
            'nama_instansi' => $instansi
        ];

        if($this->db->insert('instansi', $data)){
            echo "<script>alert('Instansi BERHASIL ditambahkan!')</script>";
        } else {
            echo "<script>alert('Instansi GAGAL ditambahkan!')</script>";
        }
    }

    $path = "";
    $data = [
        "level"      => $this->M_data->getLevel(),
        'instansi'   => $this->M_data->getInstansi(),
        'status'     => '', // Status User aktif / engga
        'controller' => $this->instansi()
    ];

    $data = array(
        "page"    => $this->load("User Management", $path) ,
        "content" => $this->load->view('user_management', $data, true)
    );

    $this->load->view('template/default_template', $data);
}

public function AddUser(){
    if ($this->session->userdata('level') != 1) {
        redirect('Rs/','refresh');
    }
    $path = "";
    $user = $this->M_SJP->getUser($this->session->userdata('id_user'));
    $data = [
        "level"      => $this->M_data->getLevel(),
        'instansi'   => $this->M_data->getInstansi(),
        'controller' => $this->instansi(),
        'user'       => $user
    ];

    // var_dump($user[0]);die;
    $instansi = $user[0]["id_instansi"];
    if ($instansi == 2) {
        $data["nama_join"] = $this->M_SJP->getRs();
    } else if($instansi == 3){
        $data["nama_join"] = $this->M_SJP->getPuskesmas();
    }

    $data = array(
        "page"    => $this->load("Add User", $path) ,
        "content" => $this->load->view('add_user', $data, true)
    );

    $this->load->view('template/default_template', $data);
}

public function editUser($id){
    if ($this->session->userdata('level') != 1) {
        redirect('Rs/','refresh');
    }
    $this->load->library('encryption');
    if (empty($id)){
        redirect($this->instansi().'UserManagement','refresh');
    }

    $user = $this->M_SJP->getUser($id);
    $data = [
        "level"      => $this->M_data->getLevel(),
        'instansi'   => $this->M_data->getInstansi(),
        'controller' => $this->instansi(),
        'user'       => $user
    ];

    // var_dump($user[0]);die;
    $instansi = $user[0]["id_instansi"];
    if ($instansi == 2) {
        $data["nama_join"] = $this->M_SJP->getRs();
    } else if($instansi == 3){
        $data["nama_join"] = $this->M_SJP->getPuskesmas();
    }

    // var_dump($data[0]);die;

    $path = "";
    $data = array(
        "page"    => $this->load("Add User", $path) ,
        "content" => $this->load->view('edit_user', $data, true)
    );

    $this->load->view('template/default_template', $data);
}

private function instansi(){
    $id_instansi    = $this->session->userdata('instansi');
    switch ($id_instansi) {
        case 1:
            $controller = "Dinkes/";
            break;
        case 2:
            $controller = "Rs/";
            break;
        case 3:
            $controller = "Home/";
            break;
        case 4:
            $controller = "Dinsos/";
            break;
        default:
            $controller = "Auth/";
    }
    return $controller;
}

public function getDataUser(){
    $instansi    = $this->input->get("instansi");
    $cari       = $this->input->post("cari");
    $db = $this->M_SJP->getAllUser($instansi, $cari);
    $result = [
        'data' => $db,
        'draw' => '',
        'recordsFiltered' => '',
        'recordsTotal' => '',
        'query' => $this->db->last_query(),
    ];
    echo json_encode($result);
}

public function getDataUserDinkes(){
    if ($this->input->post() !== Null) {
        $level      = $this->input->post("level");
        $instansi   = $this->input->post("instansi");
        $status     = $this->input->post("status");
        $cari       = $this->input->post("cari");
        $data       = $this->M_SJP->getAllUserDinkes($level,$instansi,$status,$cari);
    } else if($this->input->get() !== Null){
        $level      = $this->input->get("level");
        $instansi   = $this->input->get("instansi");
        $status     = $this->input->get("status");
        $cari       = $this->input->get("cari");
        $data       = $this->M_SJP->getAllUserDinkes($level,$instansi,$status,$cari);
    }else {
        $data       = $this->M_SJP->getAllUserDinkes();
    }

    $result = [
        'data' => $data,
        'draw' => '',
        'recordsFiltered' => '',
        'recordsTotal' => '',
        'query' => $this->db->last_query(),
    ];
    echo json_encode($result);
}


public function index($id_status_klaim=Null){
   $id_rumah_sakit = 1;
   $datay = array(
    'status_klaim'      => $id_status_klaim,
    'dataklaim'         => $this->M_SJP->getdatapengajuanklaim(),
    'statusklaim'       => $this->M_data->getStatusKlaim(),
    // 'dataklaim'         => $this->M_SJP->view_permohonanklaim_rs($id_rumah_sakit),
    'penyakit'          => $this->M_SJP->diagpasien(),
    'controller'        => $this->instansi(),
    'rs'                => $this->M_data->getRS(),
    'statuspengajuan'   => $this->M_data->getStatusPengajuan() 
  );

  //var_dump($datay['dataklaim']);die;
   $path = "";
   $data = array(
    "page"    => $this->load("Draft klaim", $path) ,
    "content" => $this->load->view('draft_klaim_rs', $datay, true)
  );

   $this->load->view('template/default_template', $data);
}
 public function view_permohonanklaim_rs()
{
    // $id_rumah_sakit = 1;
    if ($this->input->post() !== Null) {
        $mulai           = $this->input->post("mulai");
        $akhir           = $this->input->post("akhir");
        $rs              = $this->input->post("rs");
        $status          = $this->input->post("status");
        $cari            = $this->input->post("cari");
        $data            = $this->M_SJP->view_permohonanklaim_rs($mulai,$akhir,$rs,$status,$cari);
        // $data            = $this->M_SJP->getdatapengajuanklaim($id_status_klaim,$mulai,$akhir,$rs,$status,$cari);
    } else {
        $data            = $this->M_SJP->view_permohonanklaim_rs($id_rumah_sakit);
    }

    $result = [
        'data' => $data,
        'draw' => '',
        'recordsFiltered' => '',
        'recordsTotal' => '',
        'query' => $this->db->last_query(),
    ];
    echo json_encode($result);
}

public function getListSJP(){
    if ($this->input->post() !== Null) {
        $puskesmas  = $this->input->post("puskesmas");
        $rs         = $this->input->post("rs");
        $status     = $this->input->post("status");
        $cari       = $this->input->post("cari");
        $data       = $this->M_SJP->view_permohonansjp_pus($id_jenissjp,$puskesmas,$rs,$status,$cari);
    } else {
        $data       = $this->M_SJP->getpersetujuansjpdinas($id_jenissjp);
    }

    $result = [
        'data' => $data,
        'draw' => '',
        'recordsFiltered' => '',
        'recordsTotal' => '',
        'query' => $this->db->last_query(),
    ];
    echo json_encode($result);
}

// ////////////////////////////////////////////////////////////////////////////////////////////////////
// MAHDI - (Maaf, biar gampang kebaca)
// ////////////////////////////////////////////////////////////////////////////////////////////////////          
        } 	
