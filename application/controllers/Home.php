<?php

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
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
            "sidebar" => $this->load->view('template/sidebar', false, true),
            "main_js" => $this->load->view('template/main_js', false, true),
            "footer"  => $this->load->view('template/footer', false, true)
        );
        return $page;
    }
    public function index()
    {
        redirect('Home/pengajuan', 'refresh');
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
        // var_dump($user);die;
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
                    'level'   => $user->level,
                    'instansi'   => $user->instansi
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

    public function gethasilsurvey()
    {
        $id_puskesmas = $this->getIdPuskesmas($this->session->userdata('id_join'));
        $id_sjp = $this->input->post('id_sjp');
        $data = $this->M_SJP->gethasilsurvey($id_sjp, $id_puskesmas);
        echo json_encode($data);
    }



    public function permohonan_sjp()
    {
        $jam = date('H:i:s');
        $hari = date('H:i:s');

        $jam_pengajuan = $this->M_data->getJamPengajuan();
        foreach ($jam_pengajuan as $key) {
            if ($hari == 'Saturday' || $hari == 'Sunday' || $jam >= $key["waktu_tutup"] || $jam < $key["waktu_buka"]) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        Jadwal Tambah Pengajuan Dapat dilakukan Pada Hari Senin s/d Jumat (' . date('H:i', strtotime($key["waktu_buka"])) . ' - ' . date('H:i', strtotime($key["waktu_tutup"])) . ' WIB)!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></div>');
                redirect('Home/pengajuan');
            } else {
                $data = array(
                    'topik'      => $this->M_SJP->diagnosa(),
                    'dokumen'    => $this->M_SJP->dokumen_persyaratan(),
                    'kecamatan'  => $this->M_SJP->wilayah('kecamatan'),
                    'rumahsakit' => $this->M_SJP->rumahsakit(),
                    'kelas_rawat' => $this->M_SJP->kelas_rawat(),
                    'jenisjaminan' => $this->M_SJP->jenisjaminan(),
                );

                $path = "";
                $data = array(
                    "page" => $this->load("Input Pasien", $path),
                    "content" => $this->load->view('input_pasien', $data, true)
                );

                $this->load->view('template/default_template', $data);
            }
        }
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
        // var_dump($diagnosa);
        // die;
    }



    public function getIdPuskesmas($puskesmas_id)
    {
        $id_puskesmas = $this->M_SJP->getByPuskesmasId($puskesmas_id);
        return $id_puskesmas;
    }

    public function input_pasien()
    {
        $id_puskesmas    = $this->getIdPuskesmas($this->session->userdata('id_join'));
        $nama_pemohon            = $this->input->post('nama_pemohon');
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
        $datapermohonan  = array(
            'nama_pemohon'  => $nama_pemohon,
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
        // var_dump($datapermohonan['status_hubungan']);
        // die;
        $this->db->insert('permohonan_pengajuan', $datapermohonan);
        $id_pengajuan = $this->db->insert_id();
        // $id_pengajuan1 = $this->M_SJP->id_pengajuan();
        // foreach ($id_pengajuan1 as $key => $value) {
        //     $id_pengajuan = $value['id_pengajuan'];
        // }

        $nik           = $this->input->post('nik');
        $nama_pasien   = $this->input->post('nama_pasien');
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
        $domisili       = $this->input->post('domisili');
        $mulairawat      = $this->input->post('mulairawat');
        $akhirrawat      = $this->input->post('akhirrawat');
        $feedback      = $this->input->post('feedback');
        $feedback_dinkes  = $this->input->post('feedback_dinkes');

        // test 02-05-2021
        $tanggallahir = date_format(date_create($tanggallahir), "Y-m-d");
        $mulairawat = date_format(date_create($mulairawat), "Y-m-d");
        $akhirrawat = date_format(date_create($akhirrawat), "Y-m-d");
        // test 02-05-2021
        $datasjp       = array(
            'id_pengajuan'     => $id_pengajuan,
            'id_puskesmas'     => $id_puskesmas,
            'id_rumah_sakit'   => $rumahsakit,
            'nik'              => $nik,
            'nama_pasien'      => $nama_pasien,
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
            'domisili'          => $domisili,
            'kelas_rawat'      => $kelas_rawat,
            'mulai_rawat'      => $mulairawat,
            'selesai_rawat'    => $akhirrawat,
            'feedback'         => $feedback,
            'feedback_dinkes'  => $feedback_dinkes,
            // 'nama_rumah_sakit' => $rumahsakit,
        );
        // var_dump($datasjp);
        // die;
        $this->db->insert('sjp', $datasjp);
        $id_sjp = $this->db->insert_id();
        //$this->db->insert_id();
        // var_dump($id_sjp);
        // die;

        // $id_sjp1 = $this->M_SJP->id_sjp();
        // foreach ($id_sjp1 as $key => $value) {
        //     $id_sjp = $value['id_sjp'];
        // }

        $kd_diagnosa = $this->input->post('repeater-group'); //echo $kd_diagnosa;die; 
        // var_dump($kd_diagnosa[0]['kd_topik']);
        // die;
        // var_dump($kd_diagnosa['diagnosa']);
        // die;

        $dataDiagnosa = array();
        $diagnosaLainnya = '';
        $penyakit = '';
        foreach ($kd_diagnosa as $key) {
            if ($key['diagnosa'] == 'Pilih Diagnosa' || empty($key['diagnosa'])) {
                $diagnosaLainnya = $key['diagnosalainnya'];
            } else {
                $penyakit = $key['diagnosa'];
                $diagnosaLainnya = $key['diagnosalainnya'];
            }
            $dataDiagnosa[] = array(
                'id_sjp'      => $id_sjp,
                'id_penyakit' => $penyakit,
                'penyakit' => $diagnosaLainnya
            );
            // var_dump($dataDiagnosa);
            // die;
        }
        $this->db->insert_batch('diagnosa', $dataDiagnosa);
        //helper_log("add", "Permohonan Dikirim" ,$id_pengajuan,  $jenisizin, $id_puskesmas); 
        // var_dump($dataDiagnosa);die;


        // $config['upload_path'] = './assets/dokumen/'; //path folder
        // $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        // $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        // $this->load->library('upload',$config);

        $nama_persyaratan = $this->input->post('nama_persyaratan');
        // var_dump($nama_persyaratan);
        // die;
        $dokumen          = $this->input->post('dokumen');
        // var_dump($_FILES['dokumen']);
        // die;
        $pasien = $this->input->post('nama_pasien');
        $persyaratan      = array();
        for ($i = 0; $i < count($nama_persyaratan); $i++) {

            $_FILES['file']['name']     = $_FILES['dokumen']['name'][$i];
            $_FILES['file']['type']     = $_FILES['dokumen']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['dokumen']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['dokumen']['error'][$i];
            $_FILES['file']['size']     = $_FILES['dokumen']['size'][$i];

            $name_file = $_FILES['file']['name'];
            $file_name_pieces = strtolower(preg_replace('/\s+/', '', $name_file));
            $new_nama_pasien = strtolower(preg_replace('/\s+/', '', $pasien));
            $new_name_image = time() . '_' . $nik . '_' . $new_nama_pasien . '_' . $file_name_pieces;
            // var_dump($new_name_image);
            // die;
            // File upload configuration
            $uploadPath = 'uploads/dokumen/';
            $config['upload_path'] = $uploadPath;
            $config['file_name'] = $new_name_image;
            // $config['encrypt_name'] = TRUE;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';

            // Load and initialize upload library

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            //var_dump($this->upload->initialize($config));die;
            if ($this->upload->do_upload('file')) {
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
            // var_dump($persyaratan);
            // die;
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
        //var_dump($persyaratan);die;
        redirect(site_url('Home/permohonan_baru'));


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
        $jam = date('H:i:s');
        $hari = date('H:i:s');

        $jam_survey = $this->M_data->getJamSurvey();
        foreach ($jam_survey as $key) {
            if ($hari == 'Saturday' || $hari == 'Sunday' || $jam >= $key["selesai_survey"] || $jam < $key["waktu_survey"]) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        Jadwal Survey Tempat Tinggal Dapat dilakukan Pada Hari Senin s/d Jumat (' . date('H:i', strtotime($key["waktu_survey"])) . ' - ' . date('H:i', strtotime($key["selesai_survey"])) . ' WIB)!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></div>');
                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            } else {
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
        }
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
        $id_puskesmas = $this->getIdPuskesmas($this->session->userdata('id_join'));
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
            redirect('Home/pengajuan', 'refresh');
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

            $this->db->where("id_user =", $id_user);
            $data = [
                'id_user'   => $id_user,
                'nama'      => $nama,
                'username'  => $username,
                'password'  => $password,
                'level'     => $level,
                'id_instansi'  => $instansi
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
            redirect('Home/pengajuan', 'refresh');
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
            redirect('Home/pengajuan', 'refresh');
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
            case 6:
                $controller = "Home/";
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

    public function pengajuan()
    {
        $data = array(
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan()
        );
        $path = "";
        $data = array(
            "page"    => $this->load("Pengajuan", $path),
            "content" => $this->load->view('pengajuan', $data, true)
        );

        $this->load->view('template/default_template', $data);
    }


    public function getalldatapermohonan()
    {
        $id_instansi = $this->input->post("id_instansi");
        $id_join     = $this->input->post("id_join");

        $id_jenissjp = 3;

        if ($this->input->post() !== Null) {
            $puskesmas  = $this->input->post("puskesmas");
            $mulai  = $this->input->post("mulai");
            $rs         = $this->input->post("rs");
            $status     = $this->input->post("status");
            $cari       = $this->input->post("cari");
            $data       = $this->M_SJP->view_permohonansjp_pus(null, $puskesmas, $rs, $status, $cari, $id_join, $id_instansi, $mulai);
        } else {
            $data       = $this->M_SJP->getpersetujuansjpdinas($id_jenissjp);
        }

        $result = [
            'data' => $data,
            'draw' => '',
            'recordsFiltered' => '',
            'recordsTotal' => '',
            // 'query' => $this->db->last_query(),
        ];
        echo json_encode($result);
    }

    public function hapussjp($id_sjp, $id_pengajuan)
    {
        $this->M_SJP->delete_pengajuan($id_pengajuan);
        $this->M_SJP->delete_sjp($id_sjp);
        // $this->M_SJP->delete_attachment($id_pengajuan);
        $this->M_SJP->delete_diagnosa($id_sjp);
        $this->M_SJP->delete_survey($id_sjp);
        redirect('Home/pengajuan');
    }

    public function permohonan_baru()
    {
        $path = "";
        $data = array(
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan(),
            'controller'        => $this->instansi()
        );
        $data['page'] = $this->load("Permohonan Baru", $path);
        //$d['pengajuan'] = $this->M_SJP->select_all_new();
        $data['content'] = $this->load->view('permohonan_baru', $data, true);
        $this->load->view('template/default_template', $data);
    }

    public function getnewdatapermohonan()
    {
        $id_instansi = $this->input->post("id_instansi");
        $id_join     = $this->input->post("id_join");
        if ($this->input->post() !== Null) {
            $puskesmas  = $this->input->post("puskesmas");
            $mulai  = $this->input->post("mulai");
            $rs         = $this->input->post("rs");
            $status     = $this->input->post("status");
            $cari       = $this->input->post("cari");
            $data       = $this->M_SJP->view_permohonansjp_pus(2, $puskesmas, $rs, $status, $cari, $id_instansi, $id_join, $mulai);
        } else {
            $data       = $this->M_SJP->view_permohonansjp_pus(2, Null, Null, 2);
        }

        // $datapus = $this->M_SJP->select_all_new($id_puskesmas, $id_jenissjp);
        $result = [
            'data' => $data,
            'draw' => '',
            'recordsFiltered' => '',
            'recordsTotal' => '',
            'query' => $this->db->last_query(),
        ];
        echo json_encode($result);
    }

    public function detail_pengajuan($idsjp, $id_pengajuan)
    {
        if ($this->input->post("btnEditInfo") !== Null) {
            // Informasi Pemohon | Tabel permohonan pengajuan
            $nama                  = $this->input->post('nama_pemohon');
            $jenisKelaminPemohon   = $this->input->post('jenis_kelamin_pemohon');
            $teleponpemohon        = $this->input->post('teleponpemohon');
            $whatsappemohon        = $this->input->post('whatsappemohon');
            $emailpemohon          = $this->input->post('emailpemohon');
            $status_hubungan       = $this->input->post('status_hubungan');
            $alamatPemohon         = $this->input->post('alamatpemohon');
            $rtPemohon             = $this->input->post('rtpemohon');
            $rwPemohon             = $this->input->post('rwpemohon');
            $kecamatanPemohon      = $this->input->post('kd_kecamatanpemohon');
            $kelurahanPemohon      = $this->input->post('kd_kelurahanpemohon');

            $data_pemohon = [
                'nama_pemohon'      => $nama,
                'jenis_kelamin'     => $jenisKelaminPemohon,
                'telepon'           => $teleponpemohon,
                'whatsapp'          => $whatsappemohon,
                'email'             => $emailpemohon,
                'status_hubungan'   => $status_hubungan,
                'alamat'            => $alamatPemohon,
                'rt'                => $rtPemohon,
                'rw'                => $rwPemohon,
                'kd_kecamatan'      => $kecamatanPemohon,
                'kd_kelurahan'      => $kelurahanPemohon
            ];

            // var_dump($data_pemohon);
            // die;

            $id_pp = $this->input->post("id_pp");
            $this->M_SJP->editPermohonanPengajuan($id_pp, $data_pemohon);
            // var_dump($this->M_SJP->editPermohonanPengajuan($id_pp, $data_pemohon));

            // Informasi Pasien | Tabel sjp
            $nikPasien          = $this->input->post('nikpasien');
            $domisili          = $this->input->post('domisili');
            $nama_pasien        = $this->input->post('nama_pasien');
            $jenisKelaminPasien = $this->input->post("jenis_kelamin_pasien");
            $tempatLahirPasien  = $this->input->post("tempat_lahir_pasien");
            $tanggalLahirPasien = $this->input->post("tanggal_lahir_pasien");
            $pekerjaanPasien    = $this->input->post("pekerjaanpasien");
            $golDarahPasien     = $this->input->post("golongan_darah_pasien");
            $alamatPasien       = $this->input->post("alamatpasien");
            $rtPasien           = $this->input->post("rtpasien");
            $rwpasien           = $this->input->post("rwpasien");
            $kecPasien          = $this->input->post("kd_kecamatanpasien");
            $kelPasien          = $this->input->post("kd_kelurahanpasien");
            $telPasien          = $this->input->post("teleponpasien");
            $whatsapPasien      = $this->input->post("whatsappasien");
            $emailPasien        = $this->input->post("emailpasien");
            $namaRS             = $this->input->post("nama_rumah_sakit");
            $jenisRawat         = $this->input->post("jenis_rawat");
            $kelasRawat         = $this->input->post("kelas_rawat");
            $mulaiRawatPasien   = $this->input->post("mulairawat");
            $akhirRawatPasien   = $this->input->post("akhirrawat");
            $feedback           = $this->input->post("feedback");

            $jenisizin       = 1;
            // test 05-02-2021
            $tanggalLahirPasien = date_format(date_create($tanggalLahirPasien), "Y-m-d");
            $mulaiRawatPasien = date_format(date_create($mulaiRawatPasien), "Y-m-d");
            $akhirRawatPasien = date_format(date_create($akhirRawatPasien), "Y-m-d");
            // test 05-02-2021

            $data_pasien = [
                'nik'               => $nikPasien,
                'domisili'          => $domisili,
                'nama_pasien'       => $nama_pasien,
                'jenis_kelamin'     => $jenisKelaminPasien,
                'tempat_lahir'      => $tempatLahirPasien,
                'tanggal_lahir'     => $tanggalLahirPasien,
                'pekerjaan'         => $pekerjaanPasien,
                'golongan_darah'    => $golDarahPasien,
                'whatsapp'          => $whatsapPasien,
                'telepon'           => $telPasien,
                'email'             => $emailPasien,
                'id_rumah_sakit'    => $namaRS,
                'jenis_rawat'       => $jenisRawat,
                'kelas_rawat'       => $kelasRawat,
                'mulai_rawat'       => $mulaiRawatPasien,
                'selesai_rawat'     => $akhirRawatPasien,
                'alamat'            => $alamatPasien,
                'rt'                => $rtPasien,
                'rw'                => $rwpasien,
                'kd_kecamatan'      => $kecPasien,
                'kd_kelurahan'      => $kelPasien,
                'feedback'          => $feedback
            ];

            // var_dump($data_pasien);
            // die;
            $id_sjp = $this->input->post("id_sjp");
            $this->M_SJP->editSJP($id_sjp, $data_pasien);
            // var_dump($this->M_SJP->editSJP($id_sjp, $data_pasien));
            // die;



            // DIAGNOSA
            $kd_diagnosa = $this->input->post('repeater-group');
            // var_dump($kd_diagnosa);
            // die;
            $dataDiagnosa = array();
            $penyakit = '';
            $diagnosaLainnya = '';
            foreach ($kd_diagnosa as $key) {
                if ($key['diagnosa'] == 'Pilih Diagnosa' || empty($key['diagnosa'])) {
                    $diagnosaLainnya = $key['diagnosalainnya'];
                } else {
                    $penyakit = $key['diagnosa'];
                    $diagnosaLainnya = $key['diagnosalainnya'];
                }

                // var_dump($penyakit);
                // die;
                $dataDiagnosa[] = array(
                    'id_sjp'      => $id_sjp,
                    'id_penyakit' => $penyakit,
                    'penyakit' => $diagnosaLainnya
                );
            }

            // var_dump($dataDiagnosa);
            // die;

            if (!empty($dataDiagnosa)) {
                // $this->db->set($dataDiagnosa[0]);
                $this->db->where('id_sjp', $idsjp);
                $this->db->update('diagnosa', $dataDiagnosa[0]);
            }

            // $diagnosaLama = $this->input->post("diagnosa");
            // $diagnosaLainnya = $this->input->post("diagnosalainnya");

            // if($diagnosaLainnya != ) {
            //     this->db->update(diagnosa baru)
            // }

            // if(daignosa baru != '') {
            //     $this->db->insert_batch('diagnosa', $dataDiagnosa);
            // }

            // DIAGNOSA




            // ==========================PERSYARATAN=========================
            $dokumen = $this->input->post('dokumen');
            $id_persyaratan = $this->input->post('id_persyaratan');
            $countfiles = count(array($id_persyaratan));
            $data = [];
            for ($i = 0; $i < $countfiles; $i++) {

                if (!empty($_FILES['dokumen']['name'][$i])) {
                    // Define new $_FILES array - $_FILES['file']
                    $_FILES['file']['name'] = $_FILES['dokumen']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['dokumen']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['dokumen']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['dokumen']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['dokumen']['size'][$i];

                    $name_file = $_FILES['file']['name'];
                    $file_name_pieces = strtolower(preg_replace('/\s+/', '', $name_file));
                    $new_nama_pasien = strtolower(preg_replace('/\s+/', '', $nama_pasien));
                    $new_name_image = time() . '_' . $nikPasien . '_' . $new_nama_pasien . '_' . $file_name_pieces;


                    // Set preference
                    $config['upload_path'] = 'uploads/dokumen/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                    $config['max_size'] = '5000'; // max_size in kb
                    // $config['file_name'] = $_FILES['dokumen']['name'][$i];
                    $config['file_name'] = $new_name_image;


                    //Load upload library
                    $this->load->library('upload', $config);

                    // File upload
                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $filename = $uploadData['file_name'];

                        $data = [
                            'attachment' => $filename,
                        ];

                        $this->db->where('id_pengajuan', $id_pengajuan);
                        $this->db->where('id_persyaratan', $id_persyaratan[$i]);
                        $this->db->update('attachment', $data);
                    }
                }
            }



            // ==========================PERSYARATAN=========================

            // var_dump($data);
            // die;
        }

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

        // Tanggal Menyetujui
        $data['tanggalMenyetujui'] = $this->M_SJP->getTanggalMenyetujui($idsjp);

        $data['datapermohonan'] = $this->M_SJP->detail_permohonansjp($idsjp, $id_instansi, $id_join, $id_pengajuan);
        // print_r($data['datapermohonan']);
        $id_puskesmas =  $data['datapermohonan'][0]['id_puskesmas'];
        // echo($id_puskesmas);die;
        $data['anggaran'] = $this->M_SJP->anggaran_pasien();

        $data['penyakit'] = $this->M_SJP->diagpasien($idsjp);
        $data['riwayatpengajuan'] = $this->M_SJP->riwayatsjpasien($idsjp);
        $data['datapasien'] = $this->M_SJP->datapasien($nik->nik);
        $data['id_sjp'] = $idsjp;
        $data['kethasilsurvey'] = $this->M_SJP->kethasilsurvey($idsjp, $id_puskesmas);
        $data['getdokumenpersyaratan'] = $this->M_SJP->getdokumenpersyaratan($id_pengajuan, $id_jenis_izin);
        // var_dump($data['penyakit']);
        // die;
        $data['level'] = $level;
        $data['controller'] = $this->instansi();
        $data['content'] = $this->load->view('detail_pengajuan', $data, true, false);
        $this->load->view('template/default_template', $data);
    }

    public function persetujuan_sjp()
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
            "content" => $this->load->view('persetujuan_sjp', $data, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function getpersetujuandatasjp()
    {
        $id_instansi = $this->input->post("id_instansi");
        $id_join     = $this->input->post("id_join");
        // $datapus = $this->M_SJP->getpersetujuandatasjp($id_puskesmas, $id_jenissjp);

        if ($this->input->post() !== Null) {
            $puskesmas  = $this->input->post("puskesmas");
            $mulai  = $this->input->post("mulai");
            $rs         = $this->input->post("rs");
            $status     = $this->input->post("status");
            $cari       = $this->input->post("cari");
            $data       = $this->M_SJP->view_permohonansjp_pus(6, $puskesmas, $rs, $status, $cari, $id_join, $id_instansi, $mulai);
        } else {
            $data       = $this->M_SJP->view_permohonansjp_pus(6, Null, Null, 6);
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

    public function edit_data_pasien($idsjp, $id_pengajuan)
    {
        $id_instansi = $this->session->userdata("instansi");
        $id_join     = $this->session->userdata("id_join");
        if (empty($idsjp) || empty($id_pengajuan)) {
            redirect($this->instansi() . 'UserManagement', 'refresh');
        }
        $this->load->library('encryption');
        $data = [
            "level"      => $this->M_data->getLevel(),
            'instansi'   => $this->M_data->getInstansi(),
            'controller' => $this->instansi(),
            'kecamatan'  => $this->M_SJP->wilayah('kecamatan'),
            // test
            'topik'      => $this->M_SJP->diagnosa(),
            'diagnosa'   => $this->M_SJP->diagpasien($idsjp),
            'getForUpdateFile' => $this->M_SJP->getForUpdateFile($id_pengajuan),
            // 'getdokumenpersyaratan' => $this->M_SJP->getdokumenpersyaratan($id_pengajuan, 1),
            'dokumen'    => $this->M_SJP->dokumen_persyaratan(),
            'rumahsakit' => $this->M_SJP->rumahsakit(),
            'kelas_rawat' => $this->M_SJP->kelas_rawat(),
            // test
            'detail'       => $this->M_SJP->detail_permohonansjp($idsjp, $id_instansi, $id_join),
            'id_pengajuan' => $id_pengajuan,
            'testDiagnosa' => $this->M_SJP->testDiagnosa($idsjp)
        ];

        // var_dump($data['topik']);
        // var_dump($data['diagnosa']);
        // die;


        $path = "";
        $data = array(
            "page"    => $this->load("edit data pasien", $path),
            "content" => $this->load->view('edit_data_pasien', $data, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function download_dokumen()
    {
        $data = [
            'controller' => $this->instansi(),
            'files' => $this->M_SJP->getFiles()
        ];

        $path = "";
        $data = array(
            "page"    => $this->load("Download Dokumen", $path),
            "content" => $this->load->view('download_dokumen', $data, true)
        );
        $this->load->view('template/default_template', $data);
    }

    public function download($id)
    {
        if (!empty($id)) {
            $this->load->helper('download');
            $fileInfo = $this->M_SJP->getFiles($id);
            //file path
            $file = 'uploads/files/' . $fileInfo['file_name'];
            //download file from directory
            force_download($file, NULL);
        }
    }


    public function download_file_pdf($file_name)
    {
        $file = 'uploads/dokumen/' . $file_name;
        force_download($file, NULL);
    }
}
