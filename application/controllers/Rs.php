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

public function permohonan_sjp()
{
    $data = array (
       'topik'      => $this->M_SJP->diagnosa(),
       'dokumen'    => $this->M_SJP->dokumen_persyaratan(),
       'kecamatan'  => $this->M_SJP->wilayah('kecamatan'),
       'rumahsakit' => $this->M_SJP->rumahsakit(),
       'kelas_rawat' => $this->M_SJP->kelas_rawat(),
       'jenisjaminan' => $this->M_SJP->jenisjaminan(),
           'puskesmas'         => $this->M_data->getPuskesmas(),
   );

        // var_dump($data['rumahsakit']);
    $path = "";
    $data = array(
        "page" => $this->load("Input Pasien", $path) ,
        "content" => $this->load->view('input_pasien_rs', $data, true)
    );

    $this->load->view('template/default_template', $data);
}
public function pengajuan_rs(){
    $data = array(
        'puskesmas'         => $this->M_data->getPuskesmas(),
        'rs'                => $this->M_data->getRS(),
        'statuspengajuan'   => $this->M_data->getStatusPengajuan()
    );
    $path = "";
    $data = array(
        "page"    => $this->load("Pengajuan", $path) ,
        "content" => $this->load->view('pengajuan_rs', $data, true)
    );

    $this->load->view('template/default_template', $data);
}
  public function getDataByNIK($nik) {
         $url = 'https://dsw.depok.go.id/Html/ddata?nik='.$nik;

         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         $output = curl_exec($ch);
         curl_close($ch);
         echo json_decode($output);
    }
public function getKelurahan()
{

    $KecId = $this->input->post('id');
    $kel   = $this->M_SJP->wilayah_kelurahan('kelurahan', $KecId);
    echo json_encode($kel);
}

public function getDiagnosa()
{

    $Kd_diagnosa = $this->input->post('id');
    $diagnosa    = $this->M_SJP->diagnosa2($Kd_diagnosa);
    echo json_encode($diagnosa);
}
public function input_pasien(){
        // $id_puskesmas    = $this->input->post('id_puskesmas');
        $nama            = $this->input->post('nama_pemohon');
        $jeniskelamin1   = $this->input->post('jenis_kelamin_pemohon');
        $alamat1         = $this->input->post('alamat_pemohon');
        $rt1             = $this->input->post('rt_pemohon');
        $rw1             = $this->input->post('rw_pemohon');
        $kelurahan1      = $this->input->post('kd_kelurahan_pemohon');
        $kecamatan1      = $this->input->post('kd_kecamatan_pemohon');
        $telepon1        = $this->input->post('telepon_pemohon');
        $whatsapp1       = $this->input->post('whatsapp_pemohon');
        $email1          = $this->input->post('email_pemohon');
        $statushubungan  = $this->input->post('status_hubungan'); 
        //$feedback        = $this->input->post('feedback_dokumen');
        $jenisizin       = 1; //jenis izin sjp dibuat default 
        $datapermohonan           = array(
            'nama_pemohon'          => $nama,
            // 'id_puskesmas'          => $id_puskesmas,
            'jenis_kelamin' => $jeniskelamin1,
            'alamat'        => $alamat1,
            'rt'            => $rt1,
            'rw'            => $rw1,
            'kd_kelurahan'  => $kelurahan1,
            'kd_kecamatan'  => $kecamatan1,
            'telepon'       => $telepon1,
            'whatsapp'      => $whatsapp1,
            'email'         => $email1,
            'status_hubungan'       => $statushubungan,
            'jenis_izin'            => $jenisizin,
            //'feedback_dokumen'   => $feedback
        ); 
          // var_dump($datapermohonan);     
        $this->db->insert('permohonan_pengajuan', $datapermohonan);
        $id_pengajuan = $this->db->insert_id();
        // $id_pengajuan1 = $this->M_SJP->id_pengajuan();
        // foreach ($id_pengajuan1 as $key => $value) {
        //     $id_pengajuan = $value['id_pengajuan'];
        // }
        $id_puskesmas           = $this->input->post('puskesmas');
        $nik           = $this->input->post('nik');
        $nama          = $this->input->post('nama_pasien');
        $jeniskelamin  = $this->input->post('jenis_kelamin_pasien');
        $tempatlahir   = $this->input->post('tempat_lahir');
        $tanggallahir  = $this->input->post('tanggal_lahir');
        $pekerjaan     = $this->input->post('pekerjaan');
        $golongandarah = $this->input->post('golongan_darah');
        $alamat        = $this->input->post('alamat_pasien');
        $rt            = $this->input->post('rt_pasien');
        $rw            = $this->input->post('rw_pasien');
        $kelurahan     = $this->input->post('kd_kelurahan_pasien');
        $kecamatan     = $this->input->post('kd_kecamatan_pasien');
        $telepon       = $this->input->post('telepon_pasien');
        $whatsapp      = $this->input->post('whatsapp_pasien');
        $email         = $this->input->post('email_pasien');
        $jenisrawat    = $this->input->post('jenis_rawat');
        $rumahsakit    = $this->input->post('nama_rumah_sakit');
        $kelas_rawat     = $this->input->post('kelas_rawat');
        $jenisjaminan    = $this->input->post('jenisjaminan'); 
        $mulairawat      = $this->input->post('mulairawat'); 
        $akhirrawat      = $this->input->post('akhirrawat'); 
        $feedback      = $this->input->post('feedback');
       

        $datasjp       = array(
         'id_pengajuan'     => $id_pengajuan,
         'id_puskesmas'     => $id_puskesmas,
         'id_rumah_sakit'   => $rumahsakit,
         'nik'              => $nik,
         'nama_pasien'      => $nama,
         'jenis_kelamin'    => $jeniskelamin,
         'tempat_lahir'     => $tempatlahir, 
         'tanggal_lahir'    => $tanggallahir,
         'pekerjaan'        => $pekerjaan,
         'golongan_darah'   => $golongandarah,
         'alamat'           => $alamat,
         'rt'               => $rt,
         'rw'               => $rw,
         'kd_kelurahan'     => $kelurahan,
         'kd_kecamatan'     => $kecamatan,
         'telepon'          => $telepon,
         'whatsapp'         => $whatsapp,
         'email'            => $email,
         'jenis_rawat'      => $jenisrawat,
         'jenis_sjp'         => $jenisjaminan,
         'kelas_rawat'      => $kelas_rawat,
         'mulai_rawat'      => $mulairawat,
         'selesai_rawat'      => $akhirrawat,
         'feedback'        => $feedback,
         
                    // 'nama_rumah_sakit' => $rumahsakit,
     );  
        // var_dump($datasjp);                    
        $this->db->insert('sjp', $datasjp);
        $id_sjp = $this->db->insert_id();//$this->db->insert_id();

        // $id_sjp1 = $this->M_SJP->id_sjp();
        // foreach ($id_sjp1 as $key => $value) {
        //     $id_sjp = $value['id_sjp'];
        // }

        $kd_diagnosa = $this->input->post('repeater-group'); //echo $kd_diagnosa;die; 
       // var_dump($kd_diagnosa);die;
        $dataDiagnosa = array();

        foreach ($kd_diagnosa as $key ) {
            if($key['diagnosa'] == 'Pilih Diagnosa' || empty($key['diagnosa'])){
                $penyakit = $key['diagnosalainnya'];
            }else{
                 $penyakit = $key['diagnosa'];
            }
            $dataDiagnosa[] = array(
                'id_sjp'      => $id_sjp,
                'id_penyakit' => $penyakit
            );
        }
        $this->db->insert_batch('diagnosa',$dataDiagnosa);
        //helper_log("add", "Permohonan Dikirim" ,$id_pengajuan,  $jenisizin, $id_puskesmas); 
       // var_dump($dataDiagnosa);die;


        // $config['upload_path'] = './assets/dokumen/'; //path folder
        // $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        // $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        // $this->load->library('upload',$config);

        $nama_persyaratan = $this->input->post('nama_persyaratan'); 
       // var_dump($nama_persyaratan);die;
        $dokumen          = $this->input->post('dokumen'); 
        //var_dump($_FILES['dokumen']);die;
        $persyaratan      = array();
        for ($i=0; $i < count($nama_persyaratan); $i++) { 

            $_FILES['file']['name']     = $_FILES['dokumen']['name'][$i];
            $_FILES['file']['type']     = $_FILES['dokumen']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['dokumen']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['dokumen']['error'][$i];
            $_FILES['file']['size']     = $_FILES['dokumen']['size'][$i];
                // File upload configuration
            $uploadPath = 'uploads/dokumen/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

                // Load and initialize upload library

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            //var_dump($this->upload->initialize($config));die;
            if($this->upload->do_upload('file')){
                    // Uploaded file data
                
                $fileData      = $this->upload->data();
                $persyaratan[] = array(
                  'id_jenis_izin'  => $jenisizin,
                  'attachment'     => $fileData['file_name'],
                  //'feedback'       => $feedback,
                  'id_pengajuan'   => $id_pengajuan,
                  'id_persyaratan' => $nama_persyaratan[$i],
              );    
            }
            // else{
            //     echo "gagal";die;
            // }
           // var_dump($persyaratan);die;
    //     if(!$this->upload->do_upload( 'dokumen')){
    //     $this->upload->display_errors();
    //     }else{
    //     echo "Berhasil diupload";
    //     };die;
        }
        if(!empty($persyaratan)){
                // Insert files data into the database
            $this->db->insert_batch('attachment',$persyaratan);

                // Upload status message

        }

    // $this->db->insert_batch('attachment',$persyaratan);
     //var_dump($persyaratan);die;
        redirect(site_url('Rs/pengajuan'));
        

        // $this->load->view('input_pasien');
        // $path = "";
   //      $data = array(
   //          "page" => $this->load("Input Pasien", $path) ,
   //          "content" => $this->load->view('input_pasien', false, true)
   //      );

   //      $this->load->view('template/default_template', $data);
    }
    public function edit_data_pasien($idsjp, $id_pengajuan){
    $id_instansi = $this->session->userdata("instansi");
    $id_join     = $this->session->userdata("id_join");
    if (empty($idsjp) || empty($id_pengajuan)){
        redirect($this->instansi().'UserManagement','refresh');
    }
    $this->load->library('encryption');
    $data = [
        "level"      => $this->M_data->getLevel(),
        'instansi'   => $this->M_data->getInstansi(),
        'controller' => $this->instansi(),
        'kecamatan'  => $this->M_SJP->wilayah('kecamatan'),
        'detail'       => $this->M_SJP->detail_permohonansjp($idsjp, $id_instansi, $id_join),
        'id_pengajuan' => $id_pengajuan
    ];
    // var_dump($data["detail"]);die;

    $path = "";
    $data = array(
        "page"    => $this->load("edit data pasien", $path) ,
        "content" => $this->load->view('edit_data_pasien', $data, true)
    );

    $this->load->view('template/default_template', $data);
}
public function getalldatapermohonan(){
    $id_instansi = $this->session->userdata("id_instansi");
    $id_join     = $this->session->userdata('id_join');

    $id_jenissjp = 3;

    if ($this->input->post() !== Null) {
        $puskesmas  = $this->input->post("puskesmas");
        $rs         = $this->input->post("rumahsakit");
        $status     = $this->input->post("status");
        $cari       = $this->input->post("cari");
        $data       = $this->M_SJP->view_permohonansjp_pus($id_jenissjp,$puskesmas,$rs,$status,$cari,$id_join,$id_instansi);
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
    $id_instansi = $this->session->userdata("instansi");
    $id_join     = $this->session->userdata("id_join");
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
// echo $id_instansi;die;
    // Tanggal Menyetujui
    $data['tanggalMenyetujui'] = $this->M_SJP->getTanggalMenyetujui($idsjp);

    $data['datapermohonan'] = $this->M_SJP->detail_permohonansjp($idsjp, $id_instansi,$id_join);
    $data['anggaran'] = $this->M_SJP->anggaran_pasien();
    $data['penyakit'] = $this->M_SJP->diagpasien($idsjp);
    $data['riwayatpengajuan'] = $this->M_SJP->riwayatsjpasien($nik->nik);
    $data['id_sjp'] = $idsjp;
    $data['kethasilsurvey'] = $this->M_SJP->kethasilsurvey($idsjp);
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
            $this->db->update_batch('sjp',$dataklaim,'id_sjp');  

       // $nama_persyaratan = $this->input->post('nama_persyaratan'); 
      // var_dump($dataklaim);
         $dokumen          = $this->input->post('dokumen'); 
        //var_dump($_FILES['dokumen']);die;
        $persyaratan      = array();
        for ($i=0; $i < count($id_sjp); $i++) { 

            $_FILES['file']['name']     = $_FILES['dokumen']['name'][$i];
            $_FILES['file']['type']     = $_FILES['dokumen']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['dokumen']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['dokumen']['error'][$i];
            $_FILES['file']['size']     = $_FILES['dokumen']['size'][$i];
                // File upload configuration
            $uploadPath = 'uploads/dokumen/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

                // Load and initialize upload library

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            //var_dump($this->upload->initialize($config));die;
            if($this->upload->do_upload('file')){
                    // Uploaded file data
                
                $fileData      = $this->upload->data();
                $persyaratan[] = array(
                  'namafile' => $fileData['file_name'],
                  'id_sjp'   => $id_sjp[$i],
              );    
                 $this->db->update_batch('sjp',$persyaratan,'id_sjp');  


            }
            // else{
            //     echo "gagal";die;
            // }
         //   var_dump($persyaratan);die;
    //     if(!$this->upload->do_upload( 'dokumen')){
    //     $this->upload->display_errors();
    //     }else{
    //     echo "Berhasil diupload";
    //     };die;
        }
   

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
 public function view_permohonanklaim_rs(){
  
   // $id_rumah_sakit = 1;
    // echo $id_instansi;die;
    if ($this->input->post() !== Null) {
          $id_instansi = $this->session->userdata("instansi");
          $id_join     = $this->session->userdata("id_join");
    // echo $id_instansi;die;
        $mulai           = $this->input->post("mulai");
        $akhir           = $this->input->post("akhir");
        $rs              = $this->input->post("rs");
        $status          = $this->input->post("status");
        $cari            = $this->input->post("cari");
        $data            = $this->M_SJP->view_permohonanklaim_rs($mulai,$akhir,$rs,$status,$cari, $id_instansi,$id_join);
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
