<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masyarakat extends CI_Controller {
	
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
        "head"    => $this->load->view('template/head', array("title" => $title), true),
        "header"  => $this->load->view('masyarakat/header', false, true),
        "navbar" => $this->load->view('masyarakat/navbar', false, true),
        "main_js" => $this->load->view('template/main_js', false, true),
        "footer"  => $this->load->view('masyarakat/footer', false, true)
    );
    return $page;
}

	public function index()
	{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('masyarakat/index', false, true)
   );

    $this->load->view('masyarakat/default_template', $data);
   }
	public function informasipersyaratan()
		{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('masyarakat/informasipersyaratan', false, true)
   );

    $this->load->view('masyarakat/default_template', $data);
   }

	public function cekstatuspengajuan()
	{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('masyarakat/cekstatuspengajuan', false, true)
   );

    $this->load->view('masyarakat/default_template', $data);
   }

	public function pilihpasien()
	{
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('masyarakat/pilihpasien', false, true)
   );

    $this->load->view('masyarakat/default_template', $data);
   }

	public function inputpasienbaru()
	{
   $data = array (
       'topik'        => $this->M_SJP->diagnosa(),
       'dokumen'      => $this->M_SJP->dokumen_persyaratan(),
       'kecamatan'    => $this->M_SJP->wilayah('kecamatan'),
       'rumahsakit'   => $this->M_SJP->rumahsakit(),
       'kelas_rawat'  => $this->M_SJP->kelas_rawat(),
       'jenisjaminan' => $this->M_SJP->jenisjaminan(),
   );
	$path = "";
    $data = array(
       "page"    => $this->load("input pasien baru", $path) ,
       "content" => $this->load->view('masyarakat/inputpasienbaru', $data, true)
   );

    $this->load->view('masyarakat/default_template', $data);
   }

   public function input_pasien(){
        $id_puskesmas = 1; //set id puskesmas 1 rsud depok nanti diubah sesuai session
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
        // if($this->db->insert('permohonan_pengajuan', $datasjp, $datapermohonan, $data)){
        //     echo "<script>alert('Data Pasien BERHASIL ditambahkan!')</script>";
        // } else {
        //     echo "<script>alert('Data Pasien GAGAL ditambahkan!')</script>";
        // }

        redirect(site_url('masyarakat/index'));
        

        // $this->load->view('input_pasien');
        // $path = "";
   //      $data = array(
   //          "page" => $this->load("Input Pasien", $path) ,
   //          "content" => $this->load->view('input_pasien', false, true)
   //      );

   //      $this->load->view('template/default_template', $data);
    }
    
// public function edit_data_pasien(){
//     $path = "";
//     $data = array(
//         "page"    => $this->load("Edit Pasien", $path) ,
//         "content" => $this->load->view('edit_data_pasien', false, true)
//     );

//     $this->load->view('template/default_template', $data);
// }
    

	public function inputpasienlama(){

   $data = array (
       'topik'        => $this->M_SJP->diagnosa(),
       'dokumen'      => $this->M_SJP->dokumen_persyaratan(),
       'kecamatan'    => $this->M_SJP->wilayah('kecamatan'),
       'rumahsakit'   => $this->M_SJP->rumahsakit(),
       'kelas_rawat'  => $this->M_SJP->kelas_rawat(),
       'jenisjaminan' => $this->M_SJP->jenisjaminan(),

   );
	$path = "";
    $data = array(
       "page"    => $this->load("Index", $path) ,
       "content" => $this->load->view('masyarakat/inputpasienlama', $data, true)
   );

    $this->load->view('masyarakat/default_template', $data);
   }
      public function input_pasien_lama(){
        $id_puskesmas = 1; //set id puskesmas 1 rsud depok nanti diubah sesuai session
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
        // if($this->db->insert('permohonan_pengajuan', $datasjp, $datapermohonan, $data)){
        //     echo "<script>alert('Data Pasien BERHASIL ditambahkan!')</script>";
        // } else {
        //     echo "<script>alert('Data Pasien GAGAL ditambahkan!')</script>";
        // }

        redirect(site_url('masyarakat/index'));
        

        // $this->load->view('input_pasien');
        // $path = "";
   //      $data = array(
   //          "page" => $this->load("Input Pasien", $path) ,
   //          "content" => $this->load->view('input_pasien', false, true)
   //      );

   //      $this->load->view('template/default_template', $data);
    }
    
// public function edit_data_pasien(){
//     $path = "";
//     $data = array(
//         "page"    => $this->load("Edit Pasien", $path) ,
//         "content" => $this->load->view('edit_data_pasien', false, true)
//     );

//     $this->load->view('template/default_template', $data);
// }
    


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

public function ceknikk()
  {
    $nik = $this->input->post('nik');
    $data = $this->M_SJP->ceknikk($nik);


    echo json_encode($data);
  }

  public function getstatus(){
    $nik = $this->input->post('nik');
    $data = $this->M_SJP->cekstatus($nik);
      $result = [
        'data' => $data,
        'draw' => '',
        'recordsFiltered' => '',
        'recordsTotal' => '',
        'query' => $this->db->last_query(),
    ];
    echo json_encode($result);
  }

}
