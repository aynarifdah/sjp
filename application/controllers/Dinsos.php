<?php

class Dinsos extends CI_Controller
{

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

    //FUNGSI UNTUK MEMBUAT TEMPLATE
    private function load($title = '', $datapath = '')
    {
        $page = array(
            "head"    => $this->load->view('template/head', array("title" => $title), true),
            "header"  => $this->load->view('template/header', false, true),
            "sidebar" => $this->load->view('dinsos/template/sidebar', false, true),
            "main_js" => $this->load->view('template/main_js', false, true),
            "footer"  => $this->load->view('template/footer', false, true)
        );
        return $page;
    }
    public function index()
    {
        redirect('Dinsos/pengajuan_dinsos', 'refresh');
        exit();

        $path = "";
        $data1 = array(
            "page" => $this->load("Dashboard", $path),
            "content" => $this->load->view('dashboard', false, true)
        );
        $data2 = array(
            "page" => $this->load("Login", $path),
            "content" => $this->load->view('login', false, true)
        );

        if (!$this->session->userdata('username') == NULL) {
            $this->load->view('template/default_template', $data1);
        } else {
            $this->load->view('template/login_template', $data2);
        }
    }

    function setujuiSurvey($id_sjp)
    {
        $data_pengajuan = array('id_status_pengajuan' => '1');
        $this->M_SJP->update_id_status_pengajuan($data_pengajuan, $id_sjp);
        redirect('Home/detail_pengajuan', 'refresh');
    }

    public function getDataByNIK($nik)
    {
        $url = 'https://dsw.depok.go.id/Html/ddata?nik=' . $nik;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        echo json_decode($output);
    }

    function tolakSurvey($id_sjp)
    {
        $data_pengajuan = array('id_status_pengajuan' => '2');
        $this->M_SJP->update_id_status_pengajuan($data_pengajuan, $id_sjp);
        redirect('Home/pengajuan', 'refresh');
    }


    public function login()
    {
        $path = "";
        $data = array(
            "page" => $this->load("Login", $path),
            "content" => $this->load->view('login', false, true)
        );

        $this->load->view('template/login_template', $data);
    }

    function logout()
    {
        if ($this->session->userdata('username') == "") {
            redirect('page', 'refresh');
        } else {
            $this->session->set_userdata('authenticated', false);
            $this->session->unset_userdata('id_user');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('nama');
            $this->session->unset_userdata('password');
            $this->session->unset_userdata('level');

            echo "<script>alert('Anda berhasil keluar');</script>";
            redirect('Home/', 'refresh');
        }
    }


    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->M_Login->readBy($username);

        if (empty($user)) {
            $this->session->set_flashdata('message', 'Username tidak ditemukan');
            redirect('Home/');
        } else {
            if ($password == $user->password) {
                $session = array(
                    'authenticated' => true,
                    'id_user' => $user->id_user,
                    'username' => $user->username,
                    'nama'    => $user->nama,
                    'password' => $user->nama,
                    'level'   => $user->level
                );

                $this->session->set_userdata($session);
                redirect('Home/Dashboard');
            } else {
                $this->session->set_flashdata('message', 'Password salah');
                redirect('Home/');
            }
        }
    }

    public function Dashboard()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Dashboard", $path),
            "content" => $this->load->view('dashboard', false, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function detail_pengajuan($idsjp, $id_pengajuan)
    {
        $level = $this->session->userdata('level');

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

        $data['datapermohonan'] = $this->M_SJP->detail_permohonansjp_anjungan($idsjp);
        $data['anggaran'] = $this->M_SJP->anggaran_pasien();
        $data['penyakit'] = $this->M_SJP->diagpasien($idsjp);
        $data['riwayatpengajuan'] = $this->M_SJP->riwayatsjpasien($nik->nik);
        $data['id_sjp'] = $idsjp;
        $data['kethasilsurvey'] = $this->M_SJP->kethasilsurvey($idsjp);
        $data['getdokumenpersyaratan'] = $this->M_SJP->getdokumenpersyaratan($id_pengajuan, $id_jenis_izin);
        $data['level'] = $level;
        $data['controller'] = $this->instansi();
        $data['content'] = $this->load->view('detail_pengajuan', $data, true, false);
        $this->load->view('template/default_template', $data);
        //echo $data['level'];die;
        //var_dump($data['datapermohonan']);die;


    }
    public function gethasilsurvey()
    {
        $id_puskesmas = 1;
        $id_sjp = $this->input->post('id_sjp');
        $data = $this->M_SJP->gethasilsurvey($id_sjp, $id_puskesmas);
        echo json_encode($data);
    }
    public function editpasien()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Edit pasien", $path),
            "content" => $this->load->view('edit_pasien', false, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function permohonan_sjp_dinsos()
    {
        $data = array(
            'topik'      => $this->M_SJP->diagnosa(),
            'dokumen'    => $this->M_SJP->dokumen_persyaratan(),
            'kecamatan'  => $this->M_SJP->wilayah('kecamatan'),
            'rumahsakit' => $this->M_SJP->rumahsakit(),
            'kelas_rawat' => $this->M_SJP->kelas_rawat(),
            'jenisjaminan' => $this->M_SJP->jenisjaminan(),
        );

        // var_dump($data['rumahsakit']);
        $path = "";
        $data = array(
            "page" => $this->load("Input Pasien", $path),
            "content" => $this->load->view('input_pasien_dinsos', $data, true)
        );

        $this->load->view('template/default_template', $data);
        //$this->load->view('input_pasien_dinsos', false);
    }
    public function getKelurahan()
    {

        $KecId = $this->input->post('id');
        $kel   = $this->M_SJP->wilayah_kelurahan('kelurahan', $KecId);
        echo json_encode($kel);
    }
    public function getDiagnosaa()

    {
        //$this->load->view('pages/kontrak/remote', false, FALSE);
        //  header('content-type: text/json');
        //  $search = preg_quote(isset($_REQUEST['search']) ? $_REQUEST['search'] : '');
        //  $start = (isset($_REQUEST['start']) ? $_REQUEST['start'] : 1);
        //  // echo $search;die;
        // // $Kd_diagnosa = $this->input->post('id');
        // $diagnosa    = $this->M_SJP->diagnosatag();
        //  //var_dump($obj);die;
        //  $ret = array();

        //  foreach($diagnosa as $item)
        //  {
        //      if(preg_match('/' . ($start ? '^' : '') . $search . '/i', $item['text']))
        //          {
        //              $ret[] = array('value' => $item['text'], 'text' => $item['text']);
        //          }
        //      }
        //var_dump($ret);die;
        // echo json_encode($ret);
        $search = $this->input->post('search');

        $query = $this->M_SJP->diagnosatag($search);

        if (!empty($query)) {
            echo json_encode(array('responses' => $query));
        } else {
            echo json_encode(array('responses' => 'No Results'));
        }
    }
    public function getDiagnosa()
    {

        $Kd_diagnosa = $this->input->post('id');
        $diagnosa    = $this->M_SJP->diagnosa2($Kd_diagnosa);
        echo json_encode($diagnosa);
    }
    public function getDiagnosaall()
    {

        // $Kd_diagnosa = $this->input->post('id');
        $diagnosa    = $this->M_SJP->diagnosa2();
        echo json_encode($diagnosa);
    }
    public function input_pasien()
    {
        $id_statuspengajuan = 4; //status pengajuan dibuat default karena dinsos tidak ada proses survey
        $nama            = $this->input->post('nama_pemohon');
        $jeniskelamin1   = $this->input->post('jenis_kelamin');
        $alamat1         = $this->input->post('alamat');
        $rt1             = $this->input->post('rt');
        $rw1             = $this->input->post('rw');
        $kelurahan1      = $this->input->post('kd_kelurahan');
        $kecamatan1      = $this->input->post('kd_kecamatan');
        $telepon1        = $this->input->post('telepon');
        $whatsapp1       = $this->input->post('whatsapp');
        $email1          = $this->input->post('email');
        $statushubungan  = $this->input->post('status_hubungan');
        $jenisizin       = 1; //jenis izin sjp dibuat default 
        $datapermohonan           = array(
            'nama_pemohon'    => $nama,
            'jenis_kelamin'   => $jeniskelamin1,
            'alamat'          => $alamat1,
            'rt'              => $rt1,
            'rw'              => $rw1,
            'kd_kelurahan'    => $kelurahan1,
            'kd_kecamatan'    => $kecamatan1,
            'telepon'         => $telepon1,
            'whatsapp'        => $whatsapp1,
            'email'           => $email1,
            'status_hubungan' => $statushubungan,
            'jenis_izin'      => $jenisizin,
            'id_status_pengajuan' => $id_statuspengajuan,
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
        $jeniskelamin  = $this->input->post('jenis_kelamin');
        $tempatlahir   = $this->input->post('tempat_lahir');
        $tanggallahir  = $this->input->post('tanggal_lahir');
        $pekerjaan     = $this->input->post('pekerjaan');
        $golongandarah = $this->input->post('golongan_darah');
        $alamat        = $this->input->post('alamat');
        $rt            = $this->input->post('rt');
        $rw            = $this->input->post('rw');
        $kelurahan     = $this->input->post('kd_kelurahan');
        $kecamatan     = $this->input->post('kd_kecamatan');
        $telepon       = $this->input->post('telepon');
        $whatsapp      = $this->input->post('whatsapp');
        $email         = $this->input->post('email');
        $jenisrawat    = $this->input->post('jenis_rawat');
        $rumahsakit    = $this->input->post('nama_rumah_sakit');
        $kelas_rawat     = $this->input->post('kelas_rawat');
        $jenisjaminan    = $this->input->post('jenisjaminan');
        $mulairawat      = $this->input->post('mulairawat');
        $akhirrawat      = $this->input->post('akhirrawat');
        $feedback      = $this->input->post('feedback');

        $datasjp       = array(
            'id_pengajuan'     => $id_pengajuan,
            //'id_puskesmas'     => $id_puskesmas,
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
        $id_sjp = $this->db->insert_id(); //$this->db->insert_id();

        // $id_sjp1 = $this->M_SJP->id_sjp();
        // foreach ($id_sjp1 as $key => $value) {
        //     $id_sjp = $value['id_sjp'];
        // }

        $kd_diagnosa = $this->input->post('repeater-group'); //echo $kd_diagnosa;die; 
        // var_dump($kd_diagnosa);die;
        $dataDiagnosa = array();

        foreach ($kd_diagnosa as $key) {
            if ($key['diagnosa'] == 'Pilih Diagnosa' || empty($key['diagnosa'])) {
                $penyakit = $key['diagnosalainnya'];
            } else {
                $penyakit = $key['diagnosa'];
            }
            $dataDiagnosa[] = array(
                'id_sjp'      => $id_sjp,
                'id_penyakit' => $penyakit
            );
        }
        $this->db->insert_batch('diagnosa', $dataDiagnosa);
        //helper_log("add", "Permohonan Dikirim" ,$id_pengajuan,  $jenisizin, $id_puskesmas); 
        // var_dump($dataDiagnosa);die;


        // $config['upload_path'] = './assets/dokumen/'; //path folder
        // $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        // $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        // $this->load->library('upload',$config);

        $nama_persyaratan = $this->input->post('nama_persyaratan');
        $dokumen = $this->input->post('dokumen');
        $persyaratan = array();
        for ($i = 0; $i < count($nama_persyaratan); $i++) {

            $_FILES['file']['name']     = $_FILES['dokumen']['name'][$i];
            $_FILES['file']['type']     = $_FILES['dokumen']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['dokumen']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['dokumen']['error'][$i];
            $_FILES['file']['size']     = $_FILES['dokumen']['size'][$i];
            // File upload configuration
            $uploadPath = 'uploads/dokumen/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                // Uploaded file data
                // $feedback      = $this->input->post('feedback');
                $fileData = $this->upload->data();
                $persyaratan[] = array(
                    'id_jenis_izin'  => $jenisizin,
                    'attachment'     => $fileData['file_name'],
                    // 'feedback'       => $feedback,
                    'id_pengajuan'   => $id_pengajuan,
                    'id_persyaratan' => $nama_persyaratan[$i],
                );
            }


            //     if(!$this->upload->do_upload( 'dokumen')){
            //     $this->upload->display_errors();
            //     }else{
            //     echo "Berhasil diupload";
            //     };die;
        }
        if (!empty($persyaratan)) {
            // Insert files data into the database
            $this->db->insert_batch('attachment', $persyaratan);

            // Upload status message

        }

        // $this->db->insert_batch('attachment',$persyaratan);
        // // var_dump($persyaratan);die;
        redirect(site_url('Dinsos/permohonan_baru_dinsos'));


        // $this->load->view('input_pasien');
        // $path = "";
        //      $data = array(
        //          "page" => $this->load("Input Pasien", $path) ,
        //          "content" => $this->load->view('input_pasien', false, true)
        //      );

        //      $this->load->view('template/default_template', $data);
    }


    // public function perset(){
    //     $path = "";
    //     $data['page'] = $this->load("Permohonan Baru", $path);
    //     //$d['pengajuan'] = $this->M_SJP->select_all_new();
    //     $data['content'] = $this->load->view('permohonan_baru', false ,true);
    //     $this->load->view('template/default_template', $data);

    // }
    public function getnewdatapermohonan_dinsos()
    {
        $id_jenissjp = 3;
        $id_statuspengajuan = 2;
        $datadinsos = $this->M_SJP->select_all_new_dinsos($id_jenissjp, $id_statuspengajuan);
        $result = [
            'data' => $datadinsos,
            'draw' => '',
            'recordsFiltered' => '',
            'recordsTotal' => '',
            'query' => $this->db->last_query(),
        ];
        echo json_encode($result);
    }
    public function survey()
    {
        $path = "";
        $data['page'] = $this->load("Survey", $path);
        $d['pengajuan'] = $this->M_SJP->select_all_survey();
        $d['survey'] = $this->M_SJP->variabel_survey();
        $d['count_jawaban'] = $this->M_SJP->count_jawaban();
        $data['content'] = $this->load->view('survey', $d, true);
        //var_dump($data['count_jawaban']) ;die;
        // var_dump($d['survey']);die;
        //echo count($d['survey']);die;
        // echo $d['survey'];
        $this->load->view('template/default_template', $data);
    }

    public function cetak_sjp()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Cetak SJP", $path),
            "content" => $this->load->view('cetak_sjp', false, true)
        );

        $this->load->view('template/default_template', $data);
    }
    public function sjp()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("SJP", $path),
            "content" => $this->load->view('sjp', false, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function getpersetujuandatasjp_dinsos()
    {
        $id_jenissjp = 3;
        $id_statuspengajuan = 2;
        $datadinsos = $this->M_SJP->getpersetujuandatasjp_dinsos($id_jenissjp, $id_statuspengajuan);
        $result = [
            'data' => $datadinsos,
            'draw' => '',
            'recordsFiltered' => '',
            'recordsTotal' => '',
            'query' => $this->db->last_query(),
        ];
        echo json_encode($result);
    }
    public function detail_survey($id_sjp)
    {
        $path = "";
        $data['page'] = $this->load("Detail Survey", $path);
        $data['pengajuan'] = $this->M_SJP->select_all_by_id($id_sjp);
        $data['count_jawaban'] = $this->M_SJP->count_jawaban();
        $var1 = $this->M_SJP->select_survey_variable($id_sjp, '1');
        foreach ($var1 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan1'] = "-";
            } else {
                $data['catatan1'] = $value->keterangan;
            }
            $data['jawaban1'] = $value->jawaban;
            $data['isi1'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var2 = $this->M_SJP->select_survey_variable($id_sjp, '2');
        foreach ($var2 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan2'] = "-";
            } else {
                $data['catatan2'] = $value->keterangan;
            }
            $data['jawaban2'] = $value->jawaban;
            $data['isi2'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var3 = $this->M_SJP->select_survey_variable($id_sjp, '3');
        foreach ($var3 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan3'] = "-";
            } else {
                $data['catatan3'] = $value->keterangan;
            }
            $data['jawaban3'] = $value->jawaban;
            $data['isi3'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var4 = $this->M_SJP->select_survey_variable($id_sjp, '4');
        foreach ($var4 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan4'] = "-";
            } else {
                $data['catatan4'] = $value->keterangan;
            }
            $data['jawaban4'] = $value->jawaban;
            $data['isi4'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var5 = $this->M_SJP->select_survey_variable($id_sjp, '5');
        foreach ($var5 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan5'] = "-";
            } else {
                $data['catatan5'] = $value->keterangan;
            }
            $data['jawaban5'] = $value->jawaban;
            $data['isi5'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var6 = $this->M_SJP->select_survey_variable($id_sjp, '6');
        foreach ($var6 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan6'] = "-";
            } else {
                $data['catatan6'] = $value->keterangan;
            }
            $data['jawaban6'] = $value->jawaban;
            $data['isi6'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var7 = $this->M_SJP->select_survey_variable($id_sjp, '7');
        foreach ($var7 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan7'] = "-";
            } else {
                $data['catatan7'] = $value->keterangan;
            }
            $data['jawaban7'] = $value->jawaban;
            $data['isi7'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var8 = $this->M_SJP->select_survey_variable($id_sjp, '8');
        foreach ($var8 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan8'] = "-";
            } else {
                $data['catatan8'] = $value->keterangan;
            }
            $data['jawaban8'] = $value->jawaban;
            $data['isi8'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var9 = $this->M_SJP->select_survey_variable($id_sjp, '9');
        foreach ($var9 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan9'] = "-";
            } else {
                $data['catatan9'] = $value->keterangan;
            }
            $data['jawaban9'] = $value->jawaban;
            $data['isi9'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var10 = $this->M_SJP->select_survey_variable($id_sjp, '10');
        foreach ($var10 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan10'] = "-";
            } else {
                $data['catatan10'] = $value->keterangan;
            }
            $data['jawaban10'] = $value->jawaban;
            $data['isi10'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var11 = $this->M_SJP->select_survey_variable($id_sjp, '11');
        foreach ($var11 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan11'] = "-";
            } else {
                $data['catatan11'] = $value->keterangan;
            }
            $data['jawaban11'] = $value->jawaban;
            $data['isi11'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var12 = $this->M_SJP->select_survey_variable($id_sjp, '12');
        foreach ($var12 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan12'] = "-";
            } else {
                $data['catatan12'] = $value->keterangan;
            }
            $data['jawaban12'] = $value->jawaban;
            $data['isi12'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var13 = $this->M_SJP->select_survey_variable($id_sjp, '13');
        foreach ($var13 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan13'] = "-";
            } else {
                $data['catatan13'] = $value->keterangan;
            }
            $data['jawaban13'] = $value->jawaban;
            $data['isi13'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var14 = $this->M_SJP->select_survey_variable($id_sjp, '14');
        foreach ($var14 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan14'] = "-";
            } else {
                $data['catatan14'] = $value->keterangan;
            }
            $data['jawaban14'] = $value->jawaban;
            $data['isi14'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $var15 = $this->M_SJP->select_survey_variable($id_sjp, '15');
        foreach ($var15 as $key => $value) {
            if ($value->keterangan == '') {
                $data['catatan15'] = "-";
            } else {
                $data['catatan15'] = $value->keterangan;
            }
            $data['jawaban15'] = $value->jawaban;
            $data['isi15'] = $this->M_SJP->select_opsi_ceklist($value->id_opsi_ceklist);
        }

        $data['content'] = $this->load->view('detail_survey', $data, true, false);
        $this->load->view('template/default_template', $data);
    }
    public function pengantar_puskesmas()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Pengantar Puskesmas", $path),
            "content" => $this->load->view('pengantar_puskesmas', false, true)
        );

        $this->load->view('template/default_template', $data);
    }
    public function pengajuan_sjp()
    {
        $path = "";
        $datax = array(
            'datapermohonan' => $this->M_SJP->select_pengajuan_sjp()
        );
        $data = array(
            "page"    => $this->load("Pengajuan SJP", $path),
            "content" => $this->load->view('pengajuan_sjp', $datax, true)
        );

        $this->load->view('template/default_template', $data);
    }
    public function siap_survey($id_sjp, $id_pengajuan)
    {
        $path = "";
        $data['page']         = $this->load("Siap Survey", $path);
        $data['pengajuan']    = $this->M_SJP->select_all_by_id($id_sjp);
        $data['survey']       = $this->M_SJP->variabel_survey();
        $data['opsi']         = $this->M_SJP->select_opsi_ceklist();
        $data['id_sjp']       = $id_sjp;
        $data['id_pengajuan'] = $id_pengajuan;
        $data['content']      = $this->load->view('siap_survey', $data, true, false);
        // var_dump($data['opsi']);die;

        $this->load->view('template/default_template', $data);
    }

    public function proses_survey($id_sjp, $id_pengajuan)
    {
        $tanggalsurvey = $this->input->post('tanggal_survey');
        $surveyor      = $this->input->post('surveyor');
        $status_pengajuan = $this->input->post('statussurvey');
        $opsi          = $this->input->post('opsi');
        $ceklistsurvey = $this->input->post('ceklist_survey');
        $catatan       = $this->input->post('catatan');
        $bobot         = $this->input->post('bobot');
        $id_puskesmas = 1;
        $datainsert    = array();
        // echo count($ceklistsurvey);die;
        $index = 0; // Set index array awal dengan 0
        foreach ($ceklistsurvey as $ceklistsurvey) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($datainsert, array(
                'id_ceklist_survey'   => $ceklistsurvey,
                'id_sjp'              => $id_sjp,
                'id_opsi_ceklist'     => $opsi[$index],
                'jawaban'             => $bobot[$index],
                'id_puskesmas'        => $id_puskesmas

            ));

            $index++;
        }
        $this->db->insert_batch('survey', $datainsert);
        //             echo '<pre>';
        // print_r($datainsert);
        // echo '</pre>';
        $sumjawaban = array_sum($bobot);
        //            var_dump($datainsert);
        // var_dump($ceklistsurvey);
        // echo $surveyor;


        // $data15 = array (
        //     'id_ceklist_survey' => '15',
        //     'id_sjp' => $input['id_sjp'],
        //     'id_opsi_ceklist' => $input['15'],
        //     'keterangan'=> $input['keterangan15'],
        //     'jawaban' => $jawaban15
        // );



        $data_sjp = array(
            'tanggal_survey'    => $tanggalsurvey,
            'surveyor'          => $surveyor,
            'keterangan_survey' => $catatan,
            // 'status_survey'     => $status_survey
        );
        $this->M_SJP->update_survey_sjp($data_sjp, $id_sjp);

        $data_pengajuan = array('id_status_pengajuan' =>  $status_pengajuan); //ubah status menjadi diajukan
        if ($status_pengajuan == 7) {
            $data_pengajuan['tanggal_selesai'] = $tanggalsurvey;
        }
        $this->M_SJP->update_id_status_pengajuan($data_pengajuan, $id_pengajuan);
        // if ($sumjawaban >= 12) {
        //       $data_pengajuan = array('id_status_pengajuan' => '3'); //ubah status menjadi diajukan
        //       $this->M_SJP->update_id_status_pengajuan($data_pengajuan, $id_pengajuan);
        //   }else{
        //        $data_pengajuan = array('id_status_pengajuan' => '2'); //ubah status menjadi diajukan
        //        $this->M_SJP->update_id_status_pengajuan($data_pengajuan, $id_pengajuan);
        //    }
        // var_dump($data_sjp);die;

        // $data_pengajuan = array('id_status_pengajuan' => '3');
        // $this->M_SJP->update_id_status_pengajuan($data_pengajuan,$input['id_pengajuan']);

        // $this->M_SJP->insert_survey($data1);
        // $this->M_SJP->insert_survey($data2);
        // $this->M_SJP->insert_survey($data3);
        // $this->M_SJP->insert_survey($data4);
        // $this->M_SJP->insert_survey($data5);
        // $this->M_SJP->insert_survey($data6);
        // $this->M_SJP->insert_survey($data7);
        // $this->M_SJP->insert_survey($data8);
        // 


        //$this->M_SJP->insert_survey($data9);
        // $this->M_SJP->insert_survey($data10);
        // $this->M_SJP->insert_survey($data11);
        // $this->M_SJP->insert_survey($data12);
        // $this->M_SJP->insert_survey($data13);
        // $this->M_SJP->insert_survey($data14);
        // $this->M_SJP->insert_survey($data15);
        // $this->M_SJP->update_survey_sjp($data_sjp,$input['id_sjp']);

        redirect('Home/pengajuan', 'refresh');
    }
    public function getbobot()
    {
        $idopsi = $this->input->post("idopsi");
        $bobot = $this->M_SJP->getbobot($idopsi);
        echo json_encode($bobot);
    }

    public function daftar_klaim()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Daftar Klaim", $path),
            "content" => $this->load->view('daftar_klaim', false, true)
        );

        $this->load->view('template/default_template', $data);
    }
    public function entry_klaim()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Entry Klaim", $path),
            "content" => $this->load->view('entry_klaim', false, true)
        );

        $this->load->view('template/default_template', $data);
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

    public function UserManagement()
    {
        if ($this->session->userdata('level') != 1) {
            redirect('Dinsos/pengajuan_dinsos', 'refresh');
            exit();
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

            if ($this->db->insert('user', $data)) {
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
            if ($this->db->update('user')) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show mb-1 mt-1"><button type="button" class="close" data-dismiss="alert">&times;</button>User BERHASIL diedit!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning fade show mb-1 mt-1">User GAGAL diedit!</div>');
            }
        }

        // Hapus
        if ($this->input->get("delete") !== null) {
            $id_user    = $this->input->get("delete");
            $this->db->where("id_user =", $id_user);
            if ($this->db->delete('user')) {
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
            if ($this->db->insert('level', $data)) {
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

            if ($this->db->insert('instansi', $data)) {
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
            "page"    => $this->load("User Management", $path),
            "content" => $this->load->view('user_management', $data, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function AddUser()
    {
        if ($this->session->userdata('level') != 1) {
            redirect('Dinsos/pengajuan_dinsos', 'refresh');
            exit();
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
        } else if ($instansi == 3) {
            $data["nama_join"] = $this->M_SJP->getPuskesmas();
        }

        $data = array(
            "page"    => $this->load("Add User", $path),
            "content" => $this->load->view('add_user', $data, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function editUser($id)
    {
        if ($this->session->userdata('level') != 1) {
            redirect('Dinsos/pengajuan_dinsos', 'refresh');
            exit();
        }
        $this->load->library('encryption');
        if (empty($id)) {
            redirect($this->instansi() . 'UserManagement', 'refresh');
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
        } else if ($instansi == 3) {
            $data["nama_join"] = $this->M_SJP->getPuskesmas();
        }

        // var_dump($data[0]);die;

        $path = "";
        $data = array(
            "page"    => $this->load("Add User", $path),
            "content" => $this->load->view('edit_user', $data, true)
        );

        $this->load->view('template/default_template', $data);
    }

    private function instansi()
    {
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

    public function getDataUser()
    {
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

    public function getDataUserDinkes()
    {
        if ($this->input->post() !== Null) {
            $level      = $this->input->post("level");
            $instansi   = $this->input->post("instansi");
            $status     = $this->input->post("status");
            $cari       = $this->input->post("cari");
            $data       = $this->M_SJP->getAllUserDinkes($level, $instansi, $status, $cari);
        } else if ($this->input->get() !== Null) {
            $level      = $this->input->get("level");
            $instansi   = $this->input->get("instansi");
            $status     = $this->input->get("status");
            $cari       = $this->input->get("cari");
            $data       = $this->M_SJP->getAllUserDinkes($level, $instansi, $status, $cari);
        } else {
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

    public function pengajuan_dinsos()
    {
        $data = array(
            'datapermohonan' => $this->M_SJP->select_persetujuan_sjp_kayankesru(),
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan(),
            'controller'        => $this->instansi()
        );
        $path = "";
        $data = array(
            "page"    => $this->load("Pengajuan dinsos", $path),
            "content" => $this->load->view('pengajuan_dinsos', $data, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function getalldatapermohonan_dinsos()
    {
        $id_jenissjp = 3;

        if ($this->input->post() !== Null) {
            $puskesmas  = $this->input->post("puskesmas");
            $rs         = $this->input->post("rs");
            $status     = $this->input->post("status");
            $cari       = $this->input->post("cari");
            $data       = $this->M_SJP->view_permohonansjp_dinsos($id_jenissjp, $puskesmas, $rs, $status, $cari);
        } else {
            $data       = $this->M_SJP->view_permohonansjp_dinsos($id_jenissjp);
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

    public function permohonan_baru_dinsos()
    {
        $data = array(
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan(),
            'controller'        => $this->instansi()
        );
        $path = "";
        $data['page'] = $this->load("Permohonan Baru", $path);
        //$d['pengajuan'] = $this->M_SJP->select_all_new();
        $data['content'] = $this->load->view('permohonan_baru_dinsos', $data, true);
        $this->load->view('template/default_template', $data);
    }

    public function persetujuan_sjp_dinsos()
    {
        $path = "";
        $data = array(
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan(),
            'controller'        => $this->instansi()
        );

        $data = array(
            "page"    => $this->load("Persetujuan SJP", $path),
            "content" => $this->load->view('persetujuan_sjp_dinsos', $data, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function download_file_pdf($file_name)
    {
        $file = 'uploads/dokumen/' . $file_name;
        force_download($file, NULL);
    }
    // ////////////////////////////////////////////////////////////////////////////////////////////////////
    // MAHDI - (Maaf, biar gampang kebaca)
    // ////////////////////////////////////////////////////////////////////////////////////////////////////
}
