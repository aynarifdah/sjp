<?php

class Dinkes extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('text');
    $this->load->model('M_SJP');
    $this->load->model('M_data');
    $this->load->library('custom_upload');
    auth_menu();
    is_login();

}
private function load($title = '', $datapath = '')
{
    $page = array(
        "head"    => $this->load->view('template/head', array("title" => $title), true),
        "header"  => $this->load->view('template/header', false, true),
        "sidebar" => $this->load->view('dinkes/template/sidebar', false, true),
        "main_js" => $this->load->view('template/main_js', false, true),
        "footer"  => $this->load->view('template/footer', false, true)
    );
    return $page;
}

public function detail_pengajuan($idsjp, $id_pengajuan){
    $id_jenis_izin = 1;
    $level = $this->session->userdata('level');
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

    $data['datapermohonan'] = $this->M_SJP->detail_permohonansjp($idsjp);
    $data['anggaran'] = $this->M_SJP->anggaran_pasien();
    $data['penyakit'] = $this->M_SJP->diagpasien($idsjp);
    $data['riwayatpengajuan'] = $this->M_SJP->riwayatsjpasien($nik->nik);
    $data['id_sjp'] = $idsjp;
    $data['kethasilsurvey'] = $this->M_SJP->kethasilsurvey($idsjp);
    $data['getdokumenpersyaratan'] = $this->M_SJP->getdokumenpersyaratan($id_pengajuan, $id_jenis_izin);
    $data['level'] = $level;
    $data['controller'] = $this->instansi();
         //echo $nik->nik;die;
//var_dump( $data['getdokumenpersyaratan']);die;
    $data['content'] = $this->load->view('detail_pengajuan', $data ,true,false);
    $this->load->view('template/default_template', $data);
}
public function uploadDokPersyaratan($id_pengajuan)
{
    $id_jenis_izin = 1; //jenis izin sjp
    $nama_persyaratan = 4; //id persyaratan sktm
    $id_status_pengajuan = 5; //status diubah menjadi proses persetujuan
    $file = $this->custom_upload->single_upload('file', array(
        'upload_path' => './uploads/dokumen/',
        'allowed_types' => 'jpg|jpeg|bmp|png|gif'

    ));

    $persyaratan = array(
      'id_jenis_izin'  => $id_jenis_izin,
      'attachment'     => $file,
      'id_pengajuan'   =>  $id_pengajuan,
      'id_persyaratan' => $nama_persyaratan,

  );
  if (!empty($file)) {
         $this->db->insert('attachment', $persyaratan);
    }
   // var_dump($persyaratan);die;

    $datapengajuan = array('id_status_pengajuan' =>  $id_status_pengajuan);
    $this->db->where('id_pengajuan', $id_pengajuan);
    $this->db->update('permohonan_pengajuan', $datapengajuan);
    redirect('Dinkes/pengajuan_sjp','refresh');
}

public function persetujuan_sjp_kayankesru(){
    $path = "";
    $id_status_pengajuan = 5;
    $datax= array(
        'datapermohonan' => $this->M_SJP->select_persetujuan_sjp_kayankesru($id_status_pengajuan),
        'puskesmas'         => $this->M_data->getPuskesmas(),
        'rs'                => $this->M_data->getRS(),
        'statuspengajuan'   => $this->M_data->getStatusPengajuan()
    );
    $data = array(
        "page"    => $this->load("Persetujuan SJP kayankesru", $path) ,
        "content" => $this->load->view('persetujuan_sjp_kayankesru', $datax, true)
    );

    $this->load->view('template/default_template', $data);
}
public function gethasilsurvey()
{
    $id_sjp = $this->input->post('id_sjp');
    $data = $this->M_SJP->gethasilsurvey($id_sjp);
    echo json_encode($data);
}

public function detail_pengajuan_klaim($idsjp){
    $level = $this->session->userdata('level');
    $path = "";
    $data['page'] = $this->load("Detail Pengajuan", $path);
    $this->db->select('nik');
    $this->db->from('sjp');
    $this->db->where('id_sjp', $idsjp);
    $nik = $this->db->get()->row();

    $data['datapermohonan'] = $this->M_SJP->detail_permohonansjp($idsjp);
    $data['penyakit'] = $this->M_SJP->diagpasien($idsjp);
    $data['riwayatpengajuan'] = $this->M_SJP->riwayatsjpasien($nik->nik);
         //echo $nik->nik;die;
    $data['content'] = $this->load->view('detail_pengajuan_klaim', $data ,true,false);
    $this->load->view('template/default_template', $data);

}
public function updatestatbayar()
{
    //$id_sjp = $this->input->get('get');
    if (!empty($this->input->get('get'))) {
        $idsjp = explode(",", $this->input->get('get'));
    }else{
        $idsjp = '';
    }
    $id_rumah_sakit = 1;
    $datay = array(
        'dataklaim' => $this->M_SJP->view_pembayaran_klaimdinas($idsjp),
        'penyakit'  => $this->M_SJP->diagpasien(),

    );
        // var_dump($datay['penyakit']);die;
    $path = "";
    $data = array(
        "page"    => $this->load("entry klaim", $path) ,
        "content" => $this->load->view('entry_pembayaran_klaim', $datay, true)
    );

    $this->load->view('template/default_template', $data);
}
public function proses_update_bayar(){
  $id_sjp = $this->input->post('id_sjp');
  $tanggal_bayar = $this->input->post('tanggalbayar');
  $nomortagihan   = $this->input->post('nomor_tagihan');
  $nominalklaim   = $this->input->post('nominal_klaim');
  $catatanklaim   = $this->input->post('catatan_klaim');
  $dataklaim = array();
         $index = 0; // Set index array awal dengan 0
           foreach ($id_sjp as $key ) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($dataklaim, array(
              'id_sjp'      => $key,
              'tanggal_pembayaran'   => $tanggal_bayar,
              'status_klaim'    => 4,
          ));
            $index++; }
            $this->db->update_batch('sjp',$dataklaim,'id_sjp');
            redirect ('Dinkes/pengajuan_klaim/4', 'refresh');
        }
        public function rekapitulasi_sjp(){
            $path = "";
            $data = array(
                "page"    => $this->load("Rekapitulasi SJP", $path) ,
                "content" => $this->load->view('rekapitulasi_Sjp', false, true)
            );

            $this->load->view('template/default_template', $data);
        }
public function input_pembiayaan()
        {
            $datanominal = $this->input->post('nominal');
            $id_sjp = $this->input->post('id_sjp');
    $status = 3; // menjadi menunggu pembayaran
    $dataupdate = array(
        'nominal_pembiayaan' => $datanominal,
        'status_klaim' => $status,
        'tanggal_persetujuan_klaim' => date("Y-m-d")
    );
    $updatepembiayaan = $this->M_SJP->input_nominal_pembiayaan($dataupdate, $id_sjp);
    echo json_encode($updatepembiayaan);

}

    // public function Halaman_login(){
    //     $this->load->view('Halaman_login');
    // }
 public function export_excel_pembiayaan()
{
   $id_status_klaim = 3;
 $data = array( 'title' => 'Laporan Excel Pembiayaan',
 'dataklaim' => $this->M_SJP->getdatapengajuanklaim($id_status_klaim),
 'penyakit' => $this->M_SJP->diagpasien(),
);
 $this->load->view('laporan_excel_pembiayaan',$data);

}

// public function Halaman_utama(){
//     $this->load->view('Halaman_utama');
// }
// public function Dashboard(){
//    $this->load->view('Halaman_dashboard');
// }
// public function Halaman_pengajuan(){
//    $this->load->view('Halaman_pengajuan');
// }
// public function Halaman_detail_pengajuan(){
//    $this->load->view('Halaman_detail_pengajuan');
// }
// public function Halaman_input_pasien(){
//    $this->load->view('Halaman_input_pasien');
// }
// public function Halaman_input_pasien_dinsos(){
//     $this->load->view('Halaman_input_pasien_dinsos');
// }
// public function Halaman_permohonan_baru(){
//    $this->load->view('Halaman_permohonan_baru');
// }
// public function Halaman_survey(){
//    $this->load->view('Halaman_survey');
// }
// public function Halaman_cetak_sjp(){
//    $this->load->view('Halaman_cetak_sjp');
// }
// public function Halaman_sjp(){
//    $this->load->view('Halaman_sjp');
// }
// public function Halaman_persetujuan_sjp(){
//    $this->load->view('Halaman_persetujuan_sjp');
// }
// public function Halaman_detail_survey(){
//    $this->load->view('Halaman_detail_survey');
// }
// public function Halaman_pengantar_puskesmas(){
//  $this->load->view('Halaman_pengantar_puskesmas');
// }
// public function Halaman_gallery_dokumen_persyaratan(){
//  $this->load->view('Halaman_gallery_dokumen_persyaratan');
// }
// public function Halaman_pengajuan_sjp(){
//  $this->load->view('Halaman_pengajuan_sjp');
// }
// public function Halaman_siap_survey(){
//     $this->load->view('Halaman_siap_survey');
// }
// public function Halaman_rekapitulasi_sjp(){
//     $this->load->view('Halaman_rekapitulasi_sjp');
// }

// ////////////////////////////////////////////////////////////////////////////////////////////////////
// MAHDI - (Maaf, biar gampang kebaca)
// ////////////////////////////////////////////////////////////////////////////////////////////////////

public function index(){
 $path = "";
 $anggaran_tahun     = $this->M_SJP->anggaran();
 $nominal_pembiayaan = $this->M_SJP->nominal_pembiayaan();
 $sisa_anggaran      = $anggaran_tahun[0]["nominal_anggaran"] - $nominal_pembiayaan[0]['nominal'];

 $d = [
    'kecamatan'         => $this->M_SJP->wilayah('kecamatan'),
    'tahun'             => $this->M_SJP->tahun(),
    'bulan'             => $this->M_SJP->bulan(),
    'jumlah_sjp'        => $this->M_SJP->jumlah_sjp(),
    'anggaran_tahun'    => $anggaran_tahun[0]["nominal_anggaran"],
    'sisa_anggaran'     => $sisa_anggaran,
    'nominal_pembiayaan' => $nominal_pembiayaan[0]['nominal'],
    'total_pasien'       => $this->M_SJP->total_pasien(),
    'distribusi'         => json_encode($this->M_SJP->distribusi()),
    'jumlah_kunjungan_bulan' => json_encode($this->M_SJP->jumlah_kunjungan_bulan()),
    'trend_pasien'      => $this->M_SJP->trend_pasien(),
    'jenis_rawat'      => $this->M_SJP->jenis_rawat(),
    'chartJenisRawat'   => json_encode($this->M_SJP->chartJenisRawat()),
    'controller'        => $this->instansi()
 ];

 // var_dump($d["chartJenisRawat"]);die;

 $data = array(
        "page"    => $this->load("Dashboard", $path) ,
        "content" => $this->load->view('dashboard', $d, true)
    );

 $this->load->view('template/default_template', $data);
}


public function Filter(){
    $bulan      = $this->input->post('bulan');
    $tahun      = $this->input->post('tahun');
    $kecamatan  = $this->input->post('kecamatan');
    $kelurahan  = $this->input->post('kelurahan');
    $orderDistribusi = $this->input->post('orderDistribusi');

    $anggaran_tahun     = $this->M_SJP->anggaran($bulan,$tahun,$kecamatan,$kelurahan);
    $nominal_pembiayaan = $this->M_SJP->nominal_pembiayaan($bulan,$tahun,$kecamatan,$kelurahan);
    // $sisa_anggaran      = $anggaran_tahun[0]["nominal_anggaran"] - $nominal_pembiayaan[0]['nominal'];

    $data = [
        'jumlah_sjp'            => $this->M_SJP->jumlah_sjp($bulan,$tahun,$kecamatan,$kelurahan),
        'anggaran_tahun'        => $anggaran_tahun,
        // 'sisa_anggaran'         => $sisa_anggaran,
        'nominal_pembiayaan'    => $nominal_pembiayaan,
        'total_pasien'          => $this->M_SJP->total_pasien($bulan,$tahun,$kecamatan,$kelurahan),
        'distribusi'            => $this->M_SJP->distribusi($bulan,$tahun,$kecamatan,$kelurahan, $orderDistribusi),
        'jumlah_kunjungan_bulan'=> $this->M_SJP->jumlah_kunjungan_bulan($bulan,$tahun,$kecamatan,$kelurahan),
        'trend_pasien'          => json_decode($this->M_SJP->trend_pasien($bulan,$tahun,$kecamatan,$kelurahan)),
        'jenis_rawat'           => $this->M_SJP->jenis_rawat($bulan,$tahun,$kecamatan,$kelurahan),
        'chartJenisRawat'       => $this->M_SJP->chartJenisRawat($bulan,$tahun,$kecamatan,$kelurahan)
    ];

    // var_dump($data["jumlah_kunjungan_bulan"]);die;
    // header('Content-Type: application/json');
    echo json_encode($data);
}

public function orderDistribusi(){
    $bulan      = $this->input->post('bulan');
    $tahun      = $this->input->post('tahun');
    $kecamatan  = $this->input->post('kecamatan');
    $kelurahan  = $this->input->post('kelurahan');
    $orderDistribusi = $this->input->post('orderDistribusi');
    $data = [
        'distribusi' => json_encode($this->M_SJP->distribusi($bulan,$tahun,$kecamatan,$kelurahan, $orderDistribusi))
    ];
    echo $data["distribusi"];
}

// From Function Lama
public function getalldatapermohonan(){
    if ($this->input->post() !== Null) {
        $puskesmas  = $this->input->post("puskesmas");
        $rs         = $this->input->post("rs");
        $status     = $this->input->post("status");
        $cari       = $this->input->post("cari");
        $datasjp    = $this->M_SJP->select_pengajuan_sjp_all(Null,$puskesmas,$rs,$status,$cari);
    } else {
        $datasjp = $this->M_SJP->select_pengajuan_sjp_all();
    }
   $result = [
        'data' => $datasjp,
        'draw' => '',
        'recordsFiltered' => '',
        'recordsTotal' => '',
        'query' => $this->db->last_query(),
    ];
    echo json_encode($result);
}

public function pengajuanall(){
    $level = $this->session->userdata('level');
    $datax= array(
        'level'             => $level,
        'puskesmas'         => $this->M_data->getPuskesmas(),
        'rs'                => $this->M_data->getRS(),
        'statuspengajuan'   => $this->M_data->getStatusPengajuan(),
        'controller'        => $this->instansi()
    );

    $path = "";
    $data = array(
        "page"    => $this->load("Pengajuan", $path) ,
        "content" => $this->load->view('pengajuanall', $datax, true)
    );

    $this->load->view('template/default_template', $data);
}

public function pengajuan_sjp(){
    // $id_status_pengajuan = 3;
    $path = "";
    $datax= array(
        'datapermohonan' => $this->M_SJP->select_pengajuan_sjp(),
        'puskesmas'         => $this->M_data->getPuskesmas(),
        'rs'                => $this->M_data->getRS(),
        'statuspengajuan'   => $this->M_data->getStatusPengajuan()
    );
    $data = array(
        "page"    => $this->load("Pengajuan SJP", $path) ,
        "content" => $this->load->view('dinkes/pengajuan_sjp', $datax, true)
    );

    $this->load->view('template/default_template', $data);
}

public function getpersetujuansjpdinas(){
    if ($this->input->post() !== Null) {
        $puskesmas  = $this->input->post("puskesmas");
        $rs         = $this->input->post("rs");
        $status     = $this->input->post("status");
        $cari       = $this->input->post("cari");
        $data       = $this->M_SJP->getpersetujuansjpdinas($puskesmas,$rs,$status,$cari);
    } else {
        $data       = $this->M_SJP->getpersetujuansjpdinas();
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

public function pengajuan_klaim($id_status_klaim = null){
    $datax = array(
        'status_klaim'      => $id_status_klaim,
        'rs'                => $this->M_data->getRS(),
        'statusklaim'       => $this->M_data->getStatusKlaim()
    );
    $path = "";
    $data = array(
        "page"    => $this->load("Pengajuan klaim", $path) ,
        "content" => $this->load->view('pengajuan_klaim', $datax, true)
    );

    $this->load->view('template/default_template', $data);
}

public function getdatapengajuanklaim(){
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

public function daftar_pembiayaan(){
   $id_status_klaim = 3;
   $datay = array(
    'dataklaim' => $this->M_SJP->getdatapengajuanklaim($id_status_klaim),
    'penyakit' => $this->M_SJP->diagpasien(),
    'rs'            => $this->M_data->getRS(),
    'controller'    => $this->instansi()
  );
   //var_dump($datay['dataklaim']);die;
   $path = "";
   $data = array(
    "page"    => $this->load("Daftar pembiayaan", $path) ,
    "content" => $this->load->view('daftar_pembiayaan', $datay, true)
  );

   $this->load->view('template/default_template', $data);
}

public function UserManagement(){
    if ($this->session->userdata('level') != 1) {
        redirect('Dinkes','refresh');exit();
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
public function AddPejabat(){

      $path = "";
      $data = array(
        "page"    => $this->load("add_pejabat", $path) ,
        "content" => $this->load->view('add_pejabat', false, true)
    );

    $this->load->view('template/default_template', $data);
}

public function tambah_pejabat(){
      $nip           = $this->input->post('nip');
      $nama_pejabat  = $this->input->post('nama_pejabat');
      $jabatan       = $this->input->post('jabatan');
      $instansi      = $this->input->post('instansi');
      $tanda_tangan  = $this->input->post('tanda_tangan');

      $datapejabat = array(
               'nip'          => $nip,
               'nama_pejabat' => $nama_pejabat,
               'jabatan'      => $jabatan,
               'instansi'     => $instansi,
               'tanda_tangan' => $tanda_tangan,
      );
        $this->db->insert('pejabat', $datapejabat);
        $id_pejabat = $this->db->insert_id();
redirect('Dinkes/UserManagement/');
}

public function AddUser(){
    if ($this->session->userdata('level') != 1) {
        redirect('Dinkes','refresh');exit();
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
        redirect('Dinkes','refresh');exit();
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
        'query' => $this->db->last_query()
        // 'token' => $this->security->get_csrf_hash()
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

public function getKelurahan(){
    $KecId = $this->input->post('id');
    $kel   = $this->M_SJP->wilayah_kelurahan('kelurahan', $KecId);
    echo json_encode($kel);
}

public function logCetak(){
    $idUser         = $this->input->post("idUser");
    $idInstansi     = $this->input->post("idInstansi");
    $pengajuan      = $this->input->post("pengajuan");
    $type           = $this->input->post("type");
    $desc           = $this->input->post("desc");
    helper_log($type,$desc,$idInstansi,$pengajuan);
}

public function approvesjp($idsjp, $id_pengajuan){
    $tanggalsurat = $this->input->post('tgl_persetujuan');
    $statuspersetujuan = $this->input->post('status_pengajuan');
    $nomor_surat = '401/'.$idsjp.'/'.$id_pengajuan.'.'.date_format(date_create($tanggalsurat),"dmy").'/ Yankesru dan PK';
    $datasjp = array(
        'tanggal_surat'     =>  $tanggalsurat,
        'nomor_surat'       =>  $nomor_surat,
        'id_user_menyetujui'=> $this->session->userdata('id_user')
    );
    $this->db->where('id_sjp', $idsjp);
    $this->db->where('id_pengajuan', $id_pengajuan);
    $this->db->update('sjp', $datasjp);

    $datapengajuan = array(
        'id_status_pengajuan' =>  $statuspersetujuan,
        'tanggal_selesai' =>  $tanggalsurat
    );
    $this->db->where('id_pengajuan', $id_pengajuan);
    $this->db->update('permohonan_pengajuan', $datapengajuan);
    redirect('Dinkes/pengajuan_sjp','refresh');
}

public function getRs(){
    $id = $this->input->post('id');
    $rs = $this->M_SJP->getRs();
    echo json_encode($rs);
}

public function getPuskesmas(){
    $id  = $this->input->post('id');
    $pus = $this->M_SJP->getPuskesmas();
    echo json_encode($pus);
}

 public function CetakTest($id_sjp)
    {
      // setlocale(LC_ALL, 'in_ID');
       $sjp = $this->M_SJP->detail_cetak($id_sjp);
       $diagpasien = $this->M_SJP->diagpasien($id_sjp);
       $diag = implode(', ', array_column($diagpasien, 'namadiag'));
       $img = base_url('/assets/uploads/cap.png');
       $img_kop = base_url('/assets/images/kop_surat.png');
       $ttd = base_url('assets/images/tandatangan.PNG');

       // print_r($idtest);
       // $this->load->view('cetak_test', $data);
       $this->load->library('dompdf_gen');
       $paper_size = 'A4';
       $orientation = 'portrait';
       $html = $this->drawpdf($img, $img_kop, $ttd, $diag, $sjp);
       // $this->dompdf->set_paper($paper_size, $orientation);
       $this->dompdf->load_html($html);
       $this->dompdf->set_option('isRemoteEnabled', TRUE);
       $this->dompdf->render();
       $this->dompdf->stream("CetakTest_.pdf", ['Attachment' =>0]);
      //  $this->dompdf->stream("CetakTest_$t.pdf");
    }

        public function drawpdf($img, $img_kop, $ttd, $diag, $sjp) {
       
      $html =
      '<html><head>
        <meta charset="utf-8">
        <title>Surat Jaminan Pelayanan</title>
        <style>
        body {
          margin-top:0px;
          margin-left:10px;
        }
        #kop {
          margin-bottom:30px;
        }
        .a { display: inline-block; width: 70px; font-size:16px;}
        .b { display: inline-block; width: 20px; font-size:16px;}
        .c { display: inline-block; width: 400px; font-size:16px;}

        table {
        border-collapse: collapse;
        width: 100%;
        }
        th, td {
        text-align: left;
        padding: 5px;
        }

        .content {
        font-family:Times New Roman;
        font-size:16px;
        text-align:justify;
        margin-left: 100px;
        margin-right: 30px;
        }
        .right{
        float:right;
        }

        .left{
        float:left;
        }

        </style>
      </head><body>
        <img src='.$img_kop.' alt="" id="kop" width="100%">
        <br>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Depok, '.date("d M Y", strtotime($sjp[0]->tanggal_surat)).'<br>


         <span class="a">Nomor</span> <span class="b">:</span><span class="c">443.24/P2P/2020</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepada :<br>

         <span class="a">Lamp</span> <span class="b">:</span><span class="c">1 (satu) berkas</span>Yth. Direktur '.$sjp[0]->nama_rumah_sakit.'<br>
        <span class="a">Hal</span> <span class="b">:</span> <span class="c">Surat Jaminan Pelayanan</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Di
 
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Tempat<br>
     
  
      <br>
      <div class="row">
        <div class="col-lg-12">

          Dari hasil penelitian kami atas surat-surat dari :
            <table class="table table-borderless table-sm">
              <tbody>
                <tr>
                  <td style="width: 30%">Nama Pasien</td>
                  <td style="width: 5%">:</td>
                  <td>'.strtoupper($sjp[0]->nama_pasien).'</td>
                </tr>
                <tr>
                  <td style="width: 30%">Tanggal Lahir</td>
                  <td style="width: 5%">:</td>
                  <td>'.$sjp[0]->tanggal_lahir.'</td>
                </tr>
                <tr>
                  <td style="width: 30%">Jenis Kelamin</td>
                  <td style="width: 5%">:</td>
                  <td>'.strtoupper($sjp[0]->jenis_kelamin).'</td>
                </tr>
                <tr>
                  <td style="width: 30%">Tgl. Mulai Rawat</td>
                  <td style="width: 5%">:</td>
                  <td>'.$sjp[0]->mulai_rawat.'</td>
                </tr>
                <tr>
                  <td style="width: 30%">Alamat</td>
                  <td style="width: 5%">:</td>
                  <td>'.$sjp[0]->alamatpasien.'</td>
                </tr>
              </tbody>
            </table><br>
      
          Ternyata pasien tersebut memenuhi syarat :
           <table class="table table-borderless table-sm">
            <tbody>
              <tr>
                <td  style="width: 30%">Dirawat di</td>
                <td style="width: 5%">:</td>
                <td>'.$sjp[0]->nama_kelas.'</td>
              </tr>
              <tr>
                <td  style="width: 30%">Dilakukan</td>
                <td style="width: 5%">:</td>
                <td>'.$sjp[0]->jenis_rawat.'</td>
              </tr>
              
              <tr>
                <td  style="width: 30%">Diagnosa sementara</td>
                <td style="width: 5%">:</td>
                <td>'.$diag.'</td>
              </tr>
              <tr>
                <td  style="width: 30%">Diberikan jaminan</td>
                <td style="width: 5%">:</td>
                <td>'.$sjp[0]->mulai_rawat.' s/d '.$sjp[0]->selesai_rawat.'</td>
              </tr>
              <tr>
                <td  style="width: 30%">Jaminan</td>
                <td style="width: 5%">:</td>
                <td>'.$sjp[0]->nama_jenis.'</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      <p>Atas biaya Pemerintah Kota Depok dengan ketentuan yang berlaku. Biaya tersebut agar diajukan oleh Rumah Sakit secara kolektif sebelum tanggal 10 pada bulan berikutnya.</p>
 <img src='.$ttd.' alt="" id="kop" width="280" height="161" align="right">

      </body></html>';
      return $html;
    }

// ////////////////////////////////////////////////////////////////////////////////////////////////////
// MAHDI - (Maaf, biar gampang kebaca)
// ////////////////////////////////////////////////////////////////////////////////////////////////////

}
