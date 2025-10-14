<?php
use Dompdf\Options;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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
        // $this->load->library('JWT');
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
        // $urltoken = "http://sitpas.depok.go.id/kds/Decrypt";

        

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

    // public function Dashboard()
    // {
    //     $path = "";
    //     $data = array(
    //         "page"    => $this->load("Dashboard", $path),
    //         "content" => $this->load->view('dashboard', false, true)
    //     );

    //     $this->load->view('template/default_template', $data);
    // }

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
        // foreach ($jam_pengajuan as $key) {
        //     if ($hari == 'Saturday' || $hari == 'Sunday' || $jam >= $key["waktu_tutup"] || $jam < $key["waktu_buka"]) {
        //         $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        //                 Jadwal Tambah Pengajuan Dapat dilakukan Pada Hari Senin s/d Jumat (' . date('H:i', strtotime($key["waktu_buka"])) . ' - ' . date('H:i', strtotime($key["waktu_tutup"])) . ' WIB)!
        //                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //                 <span aria-hidden="true">&times;</span>
        //             </button></div>');
        //         redirect('Home/pengajuan');
        //     } else {
                $data = array(
                    'topik'      => $this->M_SJP->diagnosa(),
                    'dokumen'    => $this->M_SJP->dokumen_persyaratan(),
                    'kecamatan'  => $this->M_SJP->wilayah('kecamatan'),
                    'rumahsakit' => $this->M_SJP->rumahsakit(),
                    'kelas_rawat' => $this->M_SJP->kelas_rawat(),
                    'jenisjaminan' => $this->M_SJP->jenisjaminan(),
                    'statuspernikahan' => $this->M_SJP->statuspernikahan(),
                    'statushubungan' => $this->M_SJP->statushubungan(),
                    'jkn' => $this->M_SJP->jkn(),
                );

                $path = "";
                $data = array(
                    "page" => $this->load("Input Pasien", $path),
                    "content" => $this->load->view('input_pasien', $data, true)
                );

                $this->load->view('template/default_template', $data);
        //     }
        // }
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
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_pemohon', 'Nama Pemohon', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat_pasien', 'Alamat Pasien', 'required');
        $this->form_validation->set_rules('alamat_pemohon', 'Alamat Pemohon', 'required');
        $this->form_validation->set_rules('email_pemohon', 'Email Pemohon', 'required');
        $this->form_validation->set_rules('email_pasien', 'Email Pasien', 'required');
        $this->form_validation->set_rules('kd_kecamatan_pasien', 'Kecamatan Pasien', 'required');
        $this->form_validation->set_rules('nama_rumah_sakit', 'Rumah Sakit', 'required');
        $this->form_validation->set_rules('jenisjaminan', 'Jenis Jaminan', 'required');
        $this->form_validation->set_rules('kelas_rawat', 'Kelas Rawat', 'required');
        $this->form_validation->set_rules('mulairawat', 'Mulai Rawat', 'required');
        $this->form_validation->set_rules('akhirrawat', 'Akhir Rawat', 'required');
        $this->form_validation->set_rules('diagnosa', 'Diagnosa', 'required');
        $this->form_validation->set_rules('kd_topik', 'Diagnosa', 'required');

        if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('message', 
            '<div class="alert alert-danger text-center">Harap lengkapi semua kolom wajib diisi.</div>'
        );
        redirect('Home/permohonan_sjp'); 
        return; 
        }
        
        $id_puskesmas    = $this->getIdPuskesmas($this->session->userdata('id_join'));
        $nama_pemohon            = $this->input->post('nama_pemohon');
        $jeniskelamin1   = $this->input->post('jenis_kelamin_pemohon');
        $alamat1         = $this->input->post('alamat_pemohon');
        $rt1             = $this->input->post('rt_pemohon');
        $rw1             = $this->input->post('rw_pemohon');
        $jkn             = $this->input->post('status_jkn');
        $kelurahan1      = $this->input->post('kd_kelurahan_pemohon');
        $kecamatan1      = $this->input->post('kd_kecamatan_pemohon');
        $telepon1        = $this->input->post('telepon_pemohon');
        $whatsapp1       = $this->input->post('whatsapp_pemohon');
        $email1          = $this->input->post('email_pemohon');
        $statushubungan  = $this->input->post('status_hubungan');
        // $pemohonpengajuan  = $this->input->post('pemohon_pengajuan');
        //$feedback        = $this->input->post('feedback_dokumen');
        $jenisizin       = 1; //jenis izin sjp dibuat default 
        $datapermohonan  = array(
            'nama_pemohon'  => $nama_pemohon,
            'jenis_kelamin' => $jeniskelamin1,
            'nama_jkn'              => $jkn,
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
            // 'pemohon_pengajuan'            => $pemohonpengajuan,
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
        $kk           = $this->input->post('kk');
        $kis           = $this->input->post('kis');
        $statuspernikahan  = $this->input->post('statuspernikahan');
        $rs_lainnya  = $this->input->post('rs_lainnya');
        $status_jkn    = $this->input->post('status_jkn');
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
        // $jenisjaminan    = 4;
        $jkn            = $this->input->post('status_jkn');
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
            'no_kk'            => $kk,
            'no_kis'           => $kis,
            'id_pernikahan'    => $statuspernikahan,
            'rs_lainnya'       => $rs_lainnya,
            'id_jkn'           => $jkn,
            'status_jkn'       => $status_jkn,
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
            'create_by'  => $this->session->userdata('id_user'),
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

        $kd_diagnosa = $this->input->post('repeater-group');

        
        $valid_diagnosa = true;
        if (empty($kd_diagnosa) || !is_array($kd_diagnosa)) {
            $valid_diagnosa = false;
        } else {
            foreach ($kd_diagnosa as $index => $item) {
                
                $kd_topik_val = isset($item['kd_topik']) ? trim($item['kd_topik']) : '';
                $diagnosa_val = isset($item['diagnosa']) ? trim($item['diagnosa']) : '';
                $diagnosa_lain = isset($item['diagnosalainnya']) ? trim($item['diagnosalainnya']) : '';

                
                if ($kd_topik_val === '' || $kd_topik_val === 'Pilih Topik' ||
                    ($diagnosa_val === '' || $diagnosa_val === 'Pilih Diagnosa') &&
                    $diagnosa_lain === '') {
                    $valid_diagnosa = false;
                    break;
                }
            }
        }

        if (!$valid_diagnosa) {
            
            $this->session->set_flashdata('error', 'Diagnosa dan Topik wajib diisi pada setiap baris. Pastikan setidaknya memilih Diagnosa atau mengisi Diagnosa Lainnya.');
            redirect('Rs/permohonan_sjp');
            return; 
        }

        // === kalau valid, jalankan proses penyimpanan seperti semula ===
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

            $this->load->library('image_lib');
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

                $configer =  array(
                    'image_library'   => 'gd2',
                    'source_image'    =>  $fileData['full_path'],
                    'maintain_ratio'  =>  TRUE,
                    'width'           =>  750,
                    'height'          =>  750,
                    'quality'         =>  80
                );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();

            }else {
                // Uploaded file data

                $fileData      = $this->upload->data();
                $persyaratan[] = array(
                    'id_jenis_izin'  => $jenisizin,
                    'attachment'     => '',
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
        // var_dump($persyaratan);
        // die();

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
        $ket_miskin         = $this->input->post('ket_miskin');
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
            'kemiskinan' => $ket_miskin,
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
        if (!empty($this->input->get('get'))) {
            $idsjp = explode(",", $this->input->get('get'));
        } else {
            $idsjp = '';
        }

        //echo count($idsjp);die;
        $id_rumah_sakit = 1;

        $data_claims = array();
        foreach ($idsjp as $key => $value) {
            $data_claims[$key] = $this->M_SJP->view_permohonanklaim_pkm(null, null, Null, Null, Null, Null, Null, $value)[0];
        }
        if (empty($data_claims)) {
            redirect('Home/draft_klaim_puskesmas');
        } else {
            $datay = array(
                'dataklaim' => $data_claims,
                'penyakit'  => $this->M_SJP->diagpasien(),
            );

            // var_dump($datay['dataklaim']);
            // die;

            $path = "";
            $data = array(
                "page"    => $this->load("entry klaim", $path),
                "content" => $this->load->view('entry_klaim', $datay, true)
            );

            $this->load->view('template/default_template', $data);
        }
    }


    // ////////////////////////////////////////////////////////////////////////////////////////////////////
    // MAHDI - (Maaf, biar gampang kebaca)
    // ////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Dashboard(){
        $path = "";
        $anggaran_tahun     = $this->M_SJP->anggaran();
        $nominal_pembiayaan = $this->M_SJP->nominal_pembiayaan();
        // $sisa_anggaran      = $anggaran_tahun[0]["nominal_anggaran"] - $nominal_pembiayaan[0]['nominal'];

        $d = [
            'kecamatan'         => $this->M_SJP->wilayah('kecamatan'),
            'tahun'             => $this->M_SJP->tahun(),
            // 'bulan'             => $this->M_SJP->bulan(),
            'jumlah_sjp'        => $this->M_SJP->jumlah_sjp(),
            // 'anggaran_tahun'    => $anggaran_tahun[0]["nominal_anggaran"],
            // 'sisa_anggaran'     => $sisa_anggaran,
            'nominal_pembiayaan' => $nominal_pembiayaan[0]['nominal'],
            'total_pasien'       => $this->M_SJP->total_pasien(),
            'distribusi'         => json_encode($this->M_SJP->distribusi()),
            'jumlah_kunjungan_bulan' => json_encode($this->M_SJP->jumlah_kunjungan_bulan()),
            'trend_pasien'      => $this->M_SJP->trend_pasien(),
            'jenis_rawat'      => $this->M_SJP->jenis_rawat(),
            'chartJenisRawat'   => json_encode($this->M_SJP->chartJenisRawat()),
            'controller'        => $this->instansi()
        ];

        // var_dump($d['distribusi']);
        // die;
        // var_dump(json_encode($this->M_SJP->chartJenisRawat()));die;

        $data = array(
            "page"    => $this->load("Dashboard", $path),
            "content" => $this->load->view('dashboard_pkm', $d, true)
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
            'trend_pasien'          => $this->M_SJP->trend_pasien($bulan,$tahun,$kecamatan,$kelurahan),
            'jenis_rawat'           => $this->M_SJP->jenis_rawat($bulan,$tahun,$kecamatan,$kelurahan),
            'chartJenisRawat'       => $this->M_SJP->chartJenisRawat($bulan,$tahun,$kecamatan,$kelurahan)
        ];

        // var_dump($data["jumlah_kunjungan_bulan"]);die;
        // header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function orderDistribusi()
    {
        $bulan      = $this->input->post('bulan');
        $tahun      = $this->input->post('tahun');
        $kecamatan  = $this->input->post('kecamatan');
        $kelurahan  = $this->input->post('kelurahan');
        $orderDistribusi = $this->input->post('orderDistribusi');
        $data = [
            'distribusi' => json_encode($this->M_SJP->distribusi($bulan, $tahun, $kecamatan, $kelurahan, $orderDistribusi))
        ];
        echo $data["distribusi"];
    }
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
            case 7:
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

    public function permohonan_baru($uhc = null)
    {
        $path = "";
        $data = array(
            'uhc'               => $uhc,
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
            $uhc  = $this->input->post("uhc");
            $puskesmas  = $this->input->post("puskesmas");
            $mulai  = $this->input->post("mulai");
            $rs         = $this->input->post("rs");
            $status     = $this->input->post("status");
            $cari       = $this->input->post("cari");
            $data       = $this->M_SJP->view_permohonansjp_pus(2, $puskesmas, $rs, $status, $cari, $id_instansi, $id_join, $mulai, $uhc);
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
            $domisili           = $this->input->post('domisili');
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
            $countfiles = count($_FILES['dokumen']['name']);
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
                    $config['max_size'] = '20000'; // max_size in kb
                    // $config['file_name'] = $_FILES['dokumen']['name'][$i];
                    $config['file_name'] = $new_name_image;


                    //Load upload library
                    $this->load->library('image_lib');
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

    public function view_pdf($id_pengajuan, $id_persyaratan, $id_sjp)
    {

        $data['getdokumenpersyaratan'] = $this->M_SJP->getSingledokumenpersyaratan($id_pengajuan, $id_persyaratan);
        
        $level = $this->session->userdata('level');
        $data['level'] = $level;
        $data['controller'] = $this->instansi();
        $data['pengajuan_sjp'] = $this->M_SJP->getSinglePengajuan($id_sjp, $id_pengajuan);
        // var_dump($data['pengajuan_sjp']);die;
        
        $path = "";
        $data['page'] = $this->load("View PDF", $path);
        $data['content'] = $this->load->view('view_pdf', $data, true, false);
        $this->load->view('template/default_template', $data);
    }

    public function view_pdfRs($id_pengajuan, $file)
    {
        $level = $this->session->userdata('level');
        $data['level'] = $level;
        $data['controller'] = $this->instansi();
        
        $data['pengajuan_sjp'] = $this->M_SJP->getSingleSjpRs($id_pengajuan);
        $data['pengajuan_sjpNamaFile'] = $this->M_SJP->getSingleSjpRsNamaFile($id_pengajuan, $file);
        $data['pengajuan_sjpFileResume'] = $this->M_SJP->getSingleSjpRsFileResume($id_pengajuan, $file);
        $data['pengajuan_sjpOtherFiles'] = $this->M_SJP->getSingleSjpRsOtherFiles($id_pengajuan, $file);

        // var_dump($data['pengajuan_sjp']);die;
        // $data['riwayatpengajuan'] = $this->M_SJP->riwayatsjpasien($idsjp);
        
        $path = "";
        $data['page'] = $this->load("View PDF", $path);
        $data['content'] = $this->load->view('view_pdfRs', $data, true, false);
        $this->load->view('template/default_template', $data);
    }

    public function diajukan_sjp()
    {
        $path = "";
        $data = array(
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan(),
            'controller'        => $this->instansi()
        );
        $data = array(
            "page"    => $this->load("Diajukan SJP", $path),
            "content" => $this->load->view('diajukan_pkm', $data, true)
        );

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
        die;
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

    public function getKategoriPenerima()
    {
        $total = $this->input->post('totalakumulatif');
        $kategori = $this->M_SJP->getKategoriPenerima((float)$total);
        echo json_encode($kategori);
    }

    public function CetakTest($id_sjp)
    {
        $sjp = $this->M_SJP->detail_cetak($id_sjp);
        // var_dump($sjp);
        // die;
        $diagpasien = $this->M_SJP->diagpasien($id_sjp);
        $diag = implode(', ', array_column($diagpasien, 'namadiag'));
        $img = base_url('/assets/uploads/cap.png');
        $img_kop = './assets/images/kop_surat.png';
        // $ttd = base_url('assets/images/ettd.jpeg');
        $ttd = './assets/images/ettd.jpeg';

        $this->load->library('dompdf_gen');
        $option = new Options();

        $paper_size = 'A4';
        $orientation = 'portrait';
        $html = $this->drawpdf_tte($img, $img_kop, $ttd, $diag, $sjp);
        $option->set('defaultFont', 'Arial');
        // $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->set_option('isRemoteEnabled', TRUE);
        $this->dompdf->render();

        // Kalo mau pake tte di comment
        // $this->dompdf->stream("CetakTest_.pdf", ['Attachment' => 0]);
        $output = $this->dompdf->output();
        $time = date('His');
        $location = './pdfTemporary/sjp_'.$time.'.pdf';
        file_put_contents($location, $output);

        


        $username = 'test';
        $password = 'test#2023';
        $url = "103.113.30.81/api/sign/pdf";
        $file = './pdfTemporary/sjp_'.$time.'.pdf';

        

        $headers = array("Content-Type:multipart/form-data");
        $postfields = array(
            'file' => curl_file_create($file,'application/pdf'),
            'imageTTD' => curl_file_create($ttd,'image/jpeg'),
            'nik' => '0803202100007062',
            'passphrase' => 'Hantek1234.!',
            'page' => '1',
            'tampilan' => 'visible',
            'image' => 'true',
            'linkQR' => 'https://google.com',
            'xAxis' => '600',
            'yAxis' => '117',
            'width' => '277',
            'height' => '227'
            );
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_USERPWD => $username . ":" . $password,
            // CURLOPT_HEADER => true,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_RETURNTRANSFER => true
        ); 
        curl_setopt_array($ch, $options);
        $resp = curl_exec($ch);
        $error = curl_error($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


        // var_dump($error);
        // die();
        curl_close($ch);

        //////HIDE SEMENTARA KARENA AKUN TTE BELUM DIPERPANJANG////////////
        if($httpCode != 200){

            unlink('./pdfTemporary/sjp_'.$time.'.pdf');
        	$responseData = json_decode($resp);


        	$response = array(
                'pesan'          => 'Gagal',
	            'status_code' => $responseData->status,
	            'deskripsi_status' => $responseData->error
	        );

            if ($responseData != null) {
                $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));

            } else {
                echo json_encode(['error' => 'Error decoding JSON response.']);
            }

            $this->db->insert('log_tte', $response);

            // $this->session->set_flashdata('pesan', '<script>alert("TTE gagal")</script>');
            // redirect('Dinkes/detail_pengajuan/' . $id_sjp . '/' . $sjp[0]->id_pengajuan);
        }else{
            
            unlink('./pdfTemporary/sjp_'.$time.'.pdf');
        	
        	$response = array(
                'pesan'          => 'Berhasil',
	            'status_code' => 200,
	            'deskripsi_status' => 'OK (Sucessful)'
	        );
            $this->db->insert('log_tte', $response);

            // Set the filename for the download
            $filename = 'cetakSJP_signed.pdf';

            // Send the appropriate headers
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $filename . '"');
            echo $resp;

        }
        
    }

    //Ketika blm ada akun tte//
    public function drawpdf($img, $img_kop, $ttd, $diag, $sjp)
    {

        $html =
            '<html><head>
        <meta charset="utf-8">
        <title>Surat Jaminan Pelayanan</title>
        <style>
        @font-face 
        {
            font-family: Arial;
            font-style: normal;
            font-weight: normal;
            src: url(/application/third_party/dompdf/lib/fonts/arial.ttf) format("truetype"));
        }
        body {
          font-family: Arial;
          font-size: 14px;
          margin-top:0px;
          margin-left:10px;
        }
        
        #kop {
          margin-bottom:30px;
        }
        .a { display: inline-block; width: 70px; font-size:14px;}
        .b { display: inline-block; width: 20px; font-size:14px;}
        .c { display: inline-block; width: 300px; font-size:14px;}

        table {
        border-collapse: collapse;
        width: 100%;
        }
        th, td {
        text-align: left;
        padding: 5px;
        }

        .content {
            font-family: Arial !important;
            font-size: 14px;
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
        table {
            border-collapse:separate; 
            border-spacing: 0 0.6em;
          }

        .a, .b, .c
        {
            font-size:14px;
        }

        .tanggal
        {
            margin-left: 490px;
        }

        .keterangan
        {
            position: relative;
            width: 700px;
            height: 70px;
        }

        .kiri
        {
            position: absolute;
            width: 390px;
            height: auto;
        }
        .kanan
        {
            position: absolute;
            top: 5px;
            left: 490px;
            width: 200px;
            height: 60px;
        }

        .breakword
        {
            overflow-wrap:break-word !important;
            word-wrap:break-word;
        }

        #hal
        {
            margin-top: 14px;
        }
        .info
        {
            text-indent: 50px;
        }
        .footer
        {
            font-style: italic;
            text-align: center;
        }


    
        </style>
      </head>
      <body>
        <img src=' . $img_kop . ' alt="" id="kop" width="100%">
           
        <div class="tanggal">Depok, ' . format_indo(date("Y-m-d", strtotime($sjp[0]->tanggal_surat))) . '</div>
        <br><br>

        <div class="keterangan">
            <div class="kiri">
                <span class="a">Nomor</span> <span class="b">:</span><span class="c">' . $sjp[0]->nomor_surat . '</span><br>
                <span class="a">Lamp</span> <span class="b">:</span><span class="c">1 (satu) berkas</span><br>
                <div id="hal"><span class="a">Hal</span> <span class="b">:</span> <span class="c">Surat Jaminan Pelayanan</span></div>
            </div>
            
            
            <div class="kanan">
                Kepada :<br>
                <span class="breakword">Yth. Direktur ' . wordwrap($sjp[0]->nama_rumah_sakit, 18, "<br>\n") . '</span><br>
                Di Tempat
            </div>
        </div>
  
      <br><br>
      <div class="row">
        <div class="col-lg-12">

          Dari hasil penelitian kami atas surat-surat dari :
          <br>
            <table class="table table-borderless table-sm">
              <tbody>
                <tr>
                  <td style="width: 30%">Nama Pasien</td>
                  <td style="width: 5%">:</td>
                  <td>' . strtoupper($sjp[0]->nama_pasien) . '</td>
                </tr>
                
                <tr>
                  <td style="width: 30%">Tanggal Lahir</td>
                  <td style="width: 5%">:</td>
                  <td>' . date_format(date_create($sjp[0]->tanggal_lahir), "d-m-Y") . '</td>
                </tr>
                
                <tr>
                  <td style="width: 30%">Jenis Kelamin</td>
                  <td style="width: 5%">:</td>
                  <td>' . strtoupper($sjp[0]->jkpasien) . '</td>
                </tr>
                
                <tr>
                  <td style="width: 30%">Tgl. Mulai Rawat</td>
                  <td style="width: 5%">:</td>
                  <td>' . date_format(date_create($sjp[0]->mulai_rawat), "d-m-Y") . '</td>
                </tr>
                
                <tr>
                  <td style="width: 30%">Alamat</td>
                  <td style="width: 5%">:</td>
                  <td>' . $sjp[0]->alamatpasien . '</td>
                </tr>
                <tr>
                  <td style="width: 30%">Domisili</td>
                  <td style="width: 5%">:</td>
                  <td>' . $sjp[0]->domisili . '</td>
                </tr>
              </tbody>
            </table><br>
      
          Ternyata pasien tersebut memenuhi syarat :
          <br>
           <table class="table table-borderless table-sm">
            <tbody>
              <tr>
                <td  style="width: 30%">Dirawat di</td>
                <td style="width: 5%">:</td>
                <td>' . $sjp[0]->nama_kelas . '</td>
              </tr>
              <tr>
                <td  style="width: 30%">Dilakukan</td>
                <td style="width: 5%">:</td>
                <td>' . $sjp[0]->jenis_rawat . '</td>
              </tr>
              
              <tr>
                <td  style="width: 30%">Diagnosa sementara</td>
                <td style="width: 5%">:</td>
                <td>' . $diag . '</td>
              </tr>
              <tr>
                <td  style="width: 30%">Diberikan jaminan</td>
                <td style="width: 5%">:</td>
                <td>' . date_format(date_create($sjp[0]->mulai_rawat), "d-m-Y") . ($sjp[0]->jenis_rawat == 'Rawat Inap' ? ' s/d Selesai Perawatan' : ($sjp[0]->jenis_rawat == 'Rawat Jalan' ? ' s/d Dua Minggu Setelah tanggal Diterbitkan' : '-')) . '</td>
              </tr>
              <tr>
                <td  style="width: 30%">Lain-lain</td>
                <td style="width: 5%">:</td>
                <td></td>
              </tr>
              <tr>
                <td style="width: 30%">Jaminan</td>
                <td style="width: 5%">:</td>
                <td>' . wordwrap($sjp[0]->nama_jenis, 55, "<br>\n") . '</td>
              </tr>
              <tr>
                <td style="width: 30%">Batas Maksimal Pagu</td>
                <td style="width: 5%">:</td>
                <td>'.
                    ($sjp[0]->domisili == 'Depok' ? 'Rp. 75.000.000' : ($sjp[0]->domisili == 'Luar Depok' ? 'Rp. 25.000.000' : 'Depok : Rp. 75.000.000 <br> Luar Depok : Rp. 25.000.000'))
                 . '</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="info">
      <p>Atas biaya Pemerintah Kota Depok dengan ketentuan yang berlaku. Biaya tersebut agar diajukan oleh<br> Rumah Sakit secara kolektif sebelum tanggal 10 pada bulan berikutnya.</p>
      </div>

      </body></html>';
        return $html;
    }

    public function getToken()
    {
        $url = "http://192.168.19.9/api/authenticate?email=diskominfo.dw@depok.go.id&password=diskominfodepok";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $error_msg = curl_error($curl);
        curl_close($curl);
        $json_response = json_decode($response);

        return $json_response;

    }

    // public function ValidasiDTKSbyNIK($nik)
    // {
    //     $gettoken = $this->getToken();

    //     $auth = $gettoken->token;
        
    //     $url = "http://192.168.19.9/api/Kependudukan/CekNik?Nik=" . $nik;
    //     $data_api = array(
    //         "Auth" => $auth,
    //         "JenisApi" => 'Cek Nik Dtks'
    //     );
    //     $fields_string = http_build_query($data_api);
    //     $curl = curl_init();
    //     curl_setopt($curl, CURLOPT_URL, $url);
    //     curl_setopt($curl, CURLOPT_POST, 1);
    //     curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //     $response = curl_exec($curl);
    //     $error_msg = curl_error($curl);
    //     curl_close($curl);
    //     $json_response = json_decode($response);
    //     echo json_encode($json_response);
    // }


    public function getTokenApi() {

        date_default_timezone_set('Asia/Jakarta');
        $timestamp = time();
        $url = 'http://sitpas.depok.go.id/kds/Decrypt';
        
        $data = array(
            'cid' => 'admin-kds',
            'client_name' => 'kartu-depok',
            'timestamp' => $timestamp
        );
        
        $payload = json_encode($data);

        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
        );

        $result = curl_exec($ch);

        return $result;

    }

    public function getSitpasApi() {

        $token = $this->getTokenApi();

        // Initialize cURL
        $ch = curl_init();

        $nik = $_GET["nik"];
    
        curl_setopt($ch, CURLOPT_URL, 'http://sitpas.depok.go.id/kds/KDSApi/DTKSWilayah?nik='. $nik .'&kecamatan=&kelurahan=&tahun=&bulan=&nama=&layanan&status=&limit=1&offset=');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'cid: admin-kds',
            'signature: ' . $token
        ]);

        $response = curl_exec($ch);
        $decodedResponse = json_decode($response, true);

        if ($decodedResponse["message"] == "No Content") {
            $decodedData = "Nik Tidak Terdaftar";
            curl_close($ch);
            print_r($decodedData);
            die;
        } else {
            $decodedResponse = json_decode($response, true);

            if ($decodedResponse !== null && isset($decodedResponse['data'])) {
                $jwtKey = 'Th15!15@53cr9t#K3y';
                $decodedData = JWT::decode($decodedResponse['data'], new Key($jwtKey, 'HS256'));

                curl_close($ch);

                echo '<pre>';
                print_r($decodedData);
                print_r($decodedData->{0}->nama);
                echo '<pre>';
                die;
            }
        }

        echo json_encode($decodedData);
    }

    public function draft_klaim_puskesmas($id_status_klaim = Null)
    {
        // $id_rumah_sakit = 1;
        $datay = array(
            'status_klaim'      => $id_status_klaim,
            'dataklaim'         => $this->M_SJP->getdatapengajuanklaim_puskesmas(),
            'statusklaim'       => $this->M_data->getStatusKlaim(),
            //'dataklaim'         => $this->M_SJP->view_permohonanklaim_rs($id_rumah_sakit),
            'penyakit'          => $this->M_SJP->diagpasien(),
            'controller'        => $this->instansi(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan()
        );

        $path = "";
        $data = array(
            "page"    => $this->load("Draft klaim", $path),
            "content" => $this->load->view('draft_klaim_puskesmas', $datay, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function view_permohonanklaim_pkm()
    {

        // $id_rumah_sakit = 1;
        // echo $id_instansi;die;
        if ($this->input->post() !== Null) {
            $id_instansi = $this->session->userdata("instansi");
            $id_join     = $this->session->userdata("id_join");
            // echo $id_instansi;die;
            $mulai           = $this->input->post("mulai");
            $akhir           = $this->input->post("akhir");
            $pkm              = $this->input->post("pkm");
            $status          = $this->input->post("status");
            $cari            = $this->input->post("cari");
            $data            = $this->M_SJP->view_permohonanklaim_pkm($mulai, $akhir, $pkm, $status, $cari, $id_instansi, $id_join, null);
            // echo $data;die;
            // $data            = $this->M_SJP->getdatapengajuanklaim($id_status_klaim,$mulai,$akhir,$rs,$status,$cari);
        } else {
            $data            = $this->M_SJP->view_permohonanklaim_pkm($id_rumah_sakit);
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

    public function edit_claim()
    {
        // var_dump($this->input->post());
        // die;
        $idsjp = explode(",", $this->input->post('result'));
        $tanggal_tagihan = $this->input->post('tanggal_tagihan');
        $nomor_tagihan = $this->input->post('nomor_tagihan');
        $nominal_klaim = explode(",", $this->input->post('nominal_klaim'));
        $catatan_klaim = explode(",", $this->input->post('catatan_klaim'));
        $claimData = array();
        $index = 0;
        // var_dump($idsjp);
        // die;
        foreach ($idsjp as $key) {
            array_push($claimData, array(
                'id_sjp'      => $key,
                'nomor_tagihan'   => $nomor_tagihan,
                'tanggal_tagihan' => $tanggal_tagihan,
                'nominal_klaim'   => $nominal_klaim[$index],
                'catatan_klaim'   => $catatan_klaim[$index],
                'status_klaim'    => null,
                'status_edit'    => 0,
            ));
            $index++;
        }

        $this->db->update_batch('sjp', $claimData, 'id_sjp');

        $dataImage      = array();
        for ($i = 0; $i < 1; $i++) {

            for ($j = 0; $j < 3; $j++) {

                $_FILES['file']['name']     = $_FILES['files']['name'][$j];
                $_FILES['file']['type']     = $_FILES['files']['type'][$j];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$j];
                $_FILES['file']['error']    = $_FILES['files']['error'][$j];
                $_FILES['file']['size']     = $_FILES['files']['size'][$j];
                $uploadPath = 'uploads/dokumen/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {

                    $fileData      = $this->upload->data();

                    $file1 = 3 * $i + 0;
                    $file2 = 3 * $i + 0 + 1;
                    $file3 = 3 * $i + 0 + 2;
                    // $this->db->set('namafile', $fileData['file_name']);
                    // $this->db->where('id_sjp', $idsjp[$i]);
                    // $this->db->update('sjp');

                    // $this->db->update('sjp', $dataImage, 'id_sjp');
                    if ($j == $file1) {
                        $dataImage[] = array(
                            'namafile' => $fileData['file_name'],
                            'id_sjp'   => $idsjp[$i]
                        );
                    } elseif ($j == $file2) {
                        $dataImage[] = array(
                            'file_resume' => $fileData['file_name'],
                            'id_sjp'   => $idsjp[$i]
                        );
                    } elseif ($j == $file3) {
                        $dataImage[] = array(
                            'other_files' => $fileData['file_name'],
                            'id_sjp'   => $idsjp[$i]
                        );
                    }
                }
                $this->db->update_batch('sjp', $dataImage, 'id_sjp');
            }
        }
    }

    public function proses_entry_klaim()
    {
        $id_sjp = $this->input->post('id_sjp');
        $tanggaltagihan = $this->input->post('tanggal_tagihan');
        $nomortagihan   = $this->input->post('nomor_tagihan');
        $nominalklaim   = $this->input->post('nominal_klaim');
        $catatanklaim   = $this->input->post('catatan_klaim');
        $dataklaim = array();
        $index = 0; // Set index array awal dengan 0
        foreach ($id_sjp as $key) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($dataklaim, array(
                'id_sjp'      => $key,
                'nomor_tagihan'   => $nomortagihan,
                'tanggal_tagihan' => $tanggaltagihan,
                'nominal_klaim'   => $nominalklaim[$index],
                'catatan_klaim'   => $catatanklaim[$index],
                'status_klaim'    => 2,
                'status_edit'     => 1
            ));
            $index++;
        }
        $this->db->update_batch('sjp', $dataklaim, 'id_sjp');


        $dok = count($_FILES['dokumen']['name']);
        $persyaratan      = array();
        for ($i = 0; $i < count($id_sjp); $i++) {

            for ($j = 0; $j < $dok; $j++) {

                $getInfoPasien = $this->db->get_where('sjp', ['id_sjp' => $id_sjp[$i]])->row_array();
                $nik = $getInfoPasien['nik'];
                $nama_pasien = strtolower(preg_replace('/\s+/', '', $getInfoPasien['nama_pasien']));

                $_FILES['file']['name']     = $_FILES['dokumen']['name'][$j];
                $_FILES['file']['type']     = $_FILES['dokumen']['type'][$j];
                $_FILES['file']['tmp_name'] = $_FILES['dokumen']['tmp_name'][$j];
                $_FILES['file']['error']    = $_FILES['dokumen']['error'][$j];
                $_FILES['file']['size']     = $_FILES['dokumen']['size'][$j];

                $name_file = $_FILES['file']['name'];
                $file_name_pieces = strtolower(preg_replace('/\s+/', '', $name_file));
                $new_name_image = $nik . '' . $nama_pasien . '' . $file_name_pieces;

                // File upload configuration
                $uploadPath = 'uploads/dokumen/';
                $config['file_name'] = $new_name_image;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                // $config['encrypt_name'] = TRUE;

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                //var_dump($this->upload->initialize($config));die;
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data

                    $fileData      = $this->upload->data();

                    $file1 = 3 * $i + 0;
                    $file2 = 3 * $i + 0 + 1;
                    $file3 = 3 * $i + 0 + 2;
                    $file4 = 3 * $i + 0 + 3;

                    if ($j == $file1) {
                        $persyaratan[] = array(
                            'namafile' => $fileData['file_name'],
                            'id_sjp'   => $id_sjp[$i],
                        );
                    } elseif ($j == $file2) {
                        $persyaratan[] = array(
                            'file_resume' => $fileData['file_name'],
                            'id_sjp'   => $id_sjp[$i],
                        );
                    } elseif ($j == $file3) {
                        $persyaratan[] = array(
                            'other_files' => $fileData['file_name'],
                            'id_sjp'   => $id_sjp[$i],
                        );
                    } elseif ($j == $file4) {
                        $persyaratan[] = array(
                            'ket_pasien' => $fileData['file_name'],
                            'id_sjp'   => $id_sjp[$i],
                        );
                    }
                }
                $this->db->update_batch('sjp', $persyaratan, 'id_sjp');
            }
        }


        redirect('Home/daftar_klaim_pkm', 'refresh');
    }

    public function daftar_klaim_pkm($id_status_klaim = null)
    {

        //$id_status_klaim = 3;
        $datay = array(
            'status_klaim'      => $id_status_klaim,
            'dataklaim' => $this->M_SJP->getdatapengajuanklaim_puskesmas(),
            'penyakit' => $this->M_SJP->diagpasien(),
            'controller' => $this->instansi(),
            'rs'                => $this->M_data->getRS(),
            'statusklaim'       => $this->M_data->getStatusKlaim()
        );
        //var_dump($datay['dataklaim']);die;
        $path = "";
        $data = array(
            "page"    => $this->load("Daftar klaim", $path),
            "content" => $this->load->view('daftar_klaim_pkm', $datay, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function getdatapengajuanklaim()
    {
        if ($this->input->post() !== Null) {
            $id_status_klaim = $this->input->post('status_klaim');
            $mulai           = $this->input->post("mulai");
            $akhir           = $this->input->post("akhir");
            $pkm              = $this->input->post("pkm");
            $status          = $this->input->post("status");
            $cari            = $this->input->post("cari");
            $data            = $this->M_SJP->getdatapengajuanklaim_puskesmas($id_status_klaim, $mulai, $akhir, $pkm, $status, $cari);
        } else {
            $data            = $this->M_SJP->getdatapengajuanklaim_puskesmas($id_status_klaim);
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

    public function Edit_klaim_pengajuan($idsjp, $id_pengajuan)
    {
        $this->db->select('nik');
        $this->db->from('sjp');
        $this->db->where('id_sjp', $idsjp);
        $nik = $this->db->get()->row();
        $path = "";
        $dataKlaim = [
            'id_sjp' => $idsjp,
            'id_pengajuan' => $id_pengajuan,
            'riwayatpengajuan' => $this->M_SJP->riwayatsjpasien($idsjp),
        ];
        // var_dump($dataKlaim['riwayatpengajuan']);
        // die;
        $data = array(
            "page" => $this->load("Edit Klaim Pengajuan", $path),
            "content" => $this->load->view('edit_klaim_pengajuan', $dataKlaim, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function proses_edit_klaim_pengajuan($id_sjp, $id_pengajuan)
    {
        $nomor_tagihan = $this->input->post('nomor_tagihan');
        $nominal_klaim = $this->input->post('nominal_klaim');
        $data = [
            'nomor_tagihan' => $nomor_tagihan,
            'nominal_klaim' => $nominal_klaim
        ];
        $this->M_SJP->editSJP($id_sjp, $data);

        $dokumen = $this->input->post('dokumen_hidden');
        $countfiles = count($dokumen);
        $dataFiles = [];
        for ($i = 0; $i < $countfiles; $i++) {
            for ($j = 0; $j < 4; $j++) {
                if (!empty($_FILES['dokumen']['name'][$j])) {
                    $_FILES['file']['name'] = $_FILES['dokumen']['name'][$j];
                    $_FILES['file']['type'] = $_FILES['dokumen']['type'][$j];
                    $_FILES['file']['tmp_name'] = $_FILES['dokumen']['tmp_name'][$j];
                    $_FILES['file']['error'] = $_FILES['dokumen']['error'][$j];
                    $_FILES['file']['size'] = $_FILES['dokumen']['size'][$j];

                    // Set preference
                    $config['upload_path'] = 'uploads/dokumen/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                    $config['max_size'] = '50000'; // max_size in kb
                    $config['file_name'] = $_FILES['dokumen']['name'][$j];

                    //Load upload library
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    // File upload
                    if ($this->upload->do_upload('file')) {

                        $filename      = $this->upload->data();
                        if ($j == 0) {
                            $dataFiles[] = array(
                                'namafile' => $filename['file_name'],
                                'id_sjp'   => $id_sjp
                            );
                        } elseif ($j == 1) {
                            $dataFiles[] = array(
                                'file_resume' => $filename['file_name'],
                                'id_sjp'   => $id_sjp
                            );
                        } elseif ($j == 2) {
                            $dataFiles[] = array(
                                'other_files' => $filename['file_name'],
                                'id_sjp'   => $id_sjp
                            );
                        } elseif ($j == 3) {
                            $dataFiles[] = array(
                                'ket_pasien' => $filename['file_name'],
                                'id_sjp'   => $id_sjp
                            );
                        }
                        $this->db->update_batch('sjp', $dataFiles, 'id_sjp');
                    }
                }
            }
        }

        redirect('Home/daftar_klaim_pkm');
    }

    public function pengajuan_ulang($idsjp, $id_pengajuan)
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
            'jenisjaminan' => $this->M_SJP->jenisjaminan(),

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
            "page"    => $this->load("Pengajuan Ulang", $path),
            "content" => $this->load->view('pengajuan_ulang', $data, true)
        );

        $this->load->view('template/default_template', $data);
    }


    // Sementara hide upload gambar Rifqy 2 November 2023
    // public function input_pengajuan_ulang()
    // {
    //     $id_puskesmas    = $this->getIdPuskesmas($this->session->userdata('id_join'));
    //     $nama_pemohon    = $this->input->post('nama_pemohon');
    //     $jeniskelamin1   = $this->input->post('jenis_kelamin_pemohon');
    //     $alamat1         = $this->input->post('alamat_pemohon');
    //     $rt1             = $this->input->post('rt_pemohon');
    //     $rw1             = $this->input->post('rw_pemohon');
    //     $kelurahan1      = $this->input->post('kd_kelurahan_pemohon');
    //     $kecamatan1      = $this->input->post('kd_kecamatan_pemohon');
    //     $telepon1        = $this->input->post('telepon_pemohon');
    //     $whatsapp1       = $this->input->post('whatsapp_pemohon');
    //     $email1          = $this->input->post('email_pemohon');
    //     $statushubungan  = $this->input->post('status_hubungan');
    //     $pemohonpengajuan  = $this->input->post('pemohon_pengajuan');
    //     $jenisizin       = 1; //jenis izin sjp dibuat default 
    //     $datapermohonan  = array(
    //         'nama_pemohon'  => $nama_pemohon,
    //         'jenis_kelamin' => $jeniskelamin1,
    //         'alamat'        => $alamat1,
    //         'rt'            => $rt1,
    //         'rw'            => $rw1,
    //         'kd_kelurahan'  => $kelurahan1,
    //         'kd_kecamatan'  => $kecamatan1,
    //         'telepon'       => $telepon1,
    //         'whatsapp'      => $whatsapp1,
    //         'email'         => $email1,
    //         'status_hubungan'       => $statushubungan,
    //         'jenis_izin'            => $jenisizin,
    //         'pemohon_pengajuan'            => $pemohonpengajuan,

    //     );

    //     $this->db->insert('permohonan_pengajuan', $datapermohonan);
    //     $id_pengajuan = $this->db->insert_id();

    //     $nik           = $this->input->post('nik');
    //     $status_jkn    = $this->input->post('status_jkn');
    //     $nama_pasien   = $this->input->post('nama_pasien');
    //     $jeniskelamin  = $this->input->post('jenis_kelamin_pasien');
    //     $tempatlahir   = $this->input->post('tempat_lahir');
    //     $tanggallahir  = $this->input->post('tanggal_lahir');
    //     $pekerjaan     = $this->input->post('pekerjaan');
    //     $golongandarah = $this->input->post('golongan_darah');
    //     $alamat        = $this->input->post('alamat_pasien');
    //     $rt            = $this->input->post('rt_pasien');
    //     $rw            = $this->input->post('rw_pasien');
    //     $kelurahan     = $this->input->post('kd_kelurahan_pasien');
    //     $kecamatan     = $this->input->post('kd_kecamatan_pasien');
    //     $telepon       = $this->input->post('telepon_pasien');
    //     $whatsapp      = $this->input->post('whatsapp_pasien');
    //     $email         = $this->input->post('email_pasien');
    //     $jenisrawat    = $this->input->post('jenis_rawat');
    //     $rumahsakit    = $this->input->post('nama_rumah_sakit');
    //     $kelas_rawat     = $this->input->post('kelas_rawat');
    //     $jenisjaminan    = $this->input->post('jenisjaminan');
    //     $domisili       = $this->input->post('domisili');
    //     $mulairawat      = $this->input->post('mulairawat');
    //     $akhirrawat      = $this->input->post('akhirrawat');
    //     $feedback      = $this->input->post('feedback');
    //     $feedback_dinkes  = $this->input->post('feedback_dinkes');

    //     // test 02-05-2021
    //     $tanggallahir = date_format(date_create($tanggallahir), "Y-m-d");
    //     $mulairawat = date_format(date_create($mulairawat), "Y-m-d");
    //     $akhirrawat = date_format(date_create($akhirrawat), "Y-m-d");
    //     // test 02-05-2021
    //     $datasjp       = array(
    //         'id_pengajuan'     => $id_pengajuan,
    //         'id_puskesmas'     => $id_puskesmas,
    //         'id_rumah_sakit'   => $rumahsakit,
    //         'nik'              => $nik,
    //         'status_jkn'       => $status_jkn,
    //         'nama_pasien'      => $nama_pasien,
    //         'jenis_kelamin'    => $jeniskelamin,
    //         'tempat_lahir'     => $tempatlahir,
    //         'tanggal_lahir'    => $tanggallahir,
    //         'pekerjaan'        => $pekerjaan,
    //         'golongan_darah'   => $golongandarah,
    //         'alamat'           => $alamat,
    //         'rt'               => $rt,
    //         'rw'               => $rw,
    //         'kd_kelurahan'     => $kelurahan,
    //         'kd_kecamatan'     => $kecamatan,
    //         'telepon'          => $telepon,
    //         'whatsapp'         => $whatsapp,
    //         'email'            => $email,
    //         'jenis_rawat'      => $jenisrawat,
    //         'jenis_sjp'         => $jenisjaminan,
    //         'domisili'          => $domisili,
    //         'kelas_rawat'      => $kelas_rawat,
    //         'mulai_rawat'      => $mulairawat,
    //         'selesai_rawat'    => $akhirrawat,
    //         'feedback'         => $feedback,
    //         'feedback_dinkes'  => $feedback_dinkes,
    //     );

    //     $this->db->insert('sjp', $datasjp);
    //     $id_sjp = $this->db->insert_id();
        
    //     $kd_diagnosa = $this->input->post('repeater-group'); 

    //     $dataDiagnosa = array();
    //     $diagnosaLainnya = '';
    //     $penyakit = '';
    //     foreach ($kd_diagnosa as $key) {
    //         if ($key['diagnosa'] == 'Pilih Diagnosa' || empty($key['diagnosa'])) {
    //             $diagnosaLainnya = $key['diagnosalainnya'];
    //         } else {
    //             $penyakit = $key['diagnosa'];
    //             $diagnosaLainnya = $key['diagnosalainnya'];
    //         }
    //         $dataDiagnosa[] = array(
    //             'id_sjp'      => $id_sjp,
    //             'id_penyakit' => $penyakit,
    //             'penyakit' => $diagnosaLainnya
    //         );
    //     }
    //     $this->db->insert_batch('diagnosa', $dataDiagnosa);

    //     $nama_persyaratan = $this->input->post('id_persyaratan');
        
    //     $dokumen          = $this->input->post('dokumen');
    //     $file_old          = $this->input->post('file_old');

    //     $pasien = $this->input->post('nama_pasien');
    //     $persyaratan      = array();
    //     for ($i = 0; $i < count($nama_persyaratan); $i++) {

    //         $_FILES['file']['name']     = $_FILES['dokumen']['name'][$i];
    //         $_FILES['file']['type']     = $_FILES['dokumen']['type'][$i];
    //         $_FILES['file']['tmp_name'] = $_FILES['dokumen']['tmp_name'][$i];
    //         $_FILES['file']['error']    = $_FILES['dokumen']['error'][$i];
    //         $_FILES['file']['size']     = $_FILES['dokumen']['size'][$i];

    //         $name_file = $_FILES['file']['name'];
    //         $file_name_pieces = strtolower(preg_replace('/\s+/', '', $name_file));
    //         $new_nama_pasien = strtolower(preg_replace('/\s+/', '', $pasien));
    //         $new_name_image = time() . '_' . $nik . '_' . $new_nama_pasien . '_' . $file_name_pieces;
            
    //         // File upload configuration
    //         $uploadPath = 'uploads/dokumen/';
    //         $config['upload_path'] = $uploadPath;
    //         $config['file_name'] = $new_name_image;
    //         // $config['encrypt_name'] = TRUE;
    //         $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';

    //         // Load and initialize upload library

    //         $this->load->library('image_lib');
    //         $this->load->library('upload', $config);
    //         $this->upload->initialize($config);
    //         if ($this->upload->do_upload('file')) {
    //             // Uploaded file data
    //             $fileData      = $this->upload->data();
    //             // if ($fileData['file_name'] == null) {
    //             //     $file = $file_old[$i];
    //             // }else{
    //             //     $file = $fileData['file_name'];
    //             // }

    //             // var_dump($file);
    //             // die();

                
    //             $persyaratan[] = array(
    //                 'id_jenis_izin'  => $jenisizin,
    //                 'attachment'     => $fileData['file_name'],
    //                 //'feedback'       => $feedback,
    //                 'id_pengajuan'   => $id_pengajuan,
    //                 'id_persyaratan' => $nama_persyaratan[$i],
    //             );

    //             $configer =  array(
    //                 'image_library'   => 'gd2',
    //                 'source_image'    =>  $fileData['full_path'],
    //                 'maintain_ratio'  =>  TRUE,
    //                 'width'           =>  750,
    //                 'height'          =>  750,
    //                 'quality'         =>  80
    //             );
    //             $this->image_lib->clear();
    //             $this->image_lib->initialize($configer);
    //             $this->image_lib->resize();

    //         }else {
    //             // Uploaded file data

    //             $fileData      = $this->upload->data();
    //             $persyaratan[] = array(
    //                 'id_jenis_izin'  => $jenisizin,
    //                 'attachment'     => '',
    //                 //'feedback'       => $feedback,
    //                 'id_pengajuan'   => $id_pengajuan,
    //                 'id_persyaratan' => $nama_persyaratan[$i],
    //             );
    //         }
    //     }
    //     if (!empty($persyaratan)) {
    //         $this->db->insert_batch('attachment', $persyaratan);
    //     }
    //     redirect(site_url('Home/permohonan_baru'));

    // }

     public function input_pengajuan_ulang()
    {
        $id_puskesmas    = $this->getIdPuskesmas($this->session->userdata('id_join'));
        $nama_pemohon    = $this->input->post('nama_pemohon');
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
        $pemohonpengajuan  = $this->input->post('pemohon_pengajuan');
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
            'pemohon_pengajuan'            => $pemohonpengajuan,

        );

        $this->db->insert('permohonan_pengajuan', $datapermohonan);
        $id_pengajuan = $this->db->insert_id();

        $nik           = $this->input->post('nik');
        $status_jkn    = $this->input->post('status_jkn');
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
            'status_jkn'       => $status_jkn,
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
        );

        $this->db->insert('sjp', $datasjp);
        $id_sjp = $this->db->insert_id();
        
        $kd_diagnosa = $this->input->post('repeater-group'); 

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
        }
        $this->db->insert_batch('diagnosa', $dataDiagnosa);

        $nama_persyaratan = $this->input->post('id_persyaratan');
        
        $dokumen          = $this->input->post('dokumen');
        $file_old          = $this->input->post('file_old');

        $pasien = $this->input->post('nama_pasien');
        $persyaratan      = array();
        for ($i = 0; $i < count($nama_persyaratan); $i++) {        
            
            $persyaratan[] = array(
                'id_jenis_izin'  => $jenisizin,
                'attachment'     => $dokumen[$i],
                //'feedback'       => $feedback,
                'id_pengajuan'   => $id_pengajuan,
                'id_persyaratan' => $nama_persyaratan[$i],
            );
        }
        if (!empty($persyaratan)) {
            $this->db->insert_batch('attachment', $persyaratan);
        }
        redirect(site_url('Home/permohonan_baru'));

    }

    public function CetakPreview($id_sjp)
    {
        // setlocale(LC_ALL, 'in_ID');
        $sjp = $this->M_SJP->detail_cetak($id_sjp);
        // var_dump($sjp);
        // die;
        $diagpasien = $this->M_SJP->diagpasien($id_sjp);
        $diag = implode(', ', array_column($diagpasien, 'namadiag'));
        $img = base_url('/assets/uploads/cap.png');
        $img_kop = './assets/images/kop_surat.png';
        // $ttd = base_url('assets/images/ettd.jpeg');
        $ttd = './assets/images/ettd.jpeg';

        // print_r($idtest);
        // $this->load->view('dinkes/cetak');
        // var_dump(date('d M Y', strtotime($sjp[0]->tanggal_surat)));
        // die;

        $this->load->library('dompdf_gen');
        $option = new Options();

        $paper_size = 'A4';
        $orientation = 'portrait';
        $html = $this->drawpdf($img, $img_kop, $ttd, $diag, $sjp);
        $option->set('defaultFont', 'Arial');
        // $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->set_option('isRemoteEnabled', TRUE);
        $this->dompdf->render();

        // Kalo mau pake tte di comment
        $this->dompdf->stream("cetakSJP_Preview.pdf", ['Attachment' => 0]);
        $output = $this->dompdf->output();
    }

    public function drawpdf_tte($img, $img_kop, $ttd, $diag, $sjp)
    {

        $html =
            '<html><head>
        <meta charset="utf-8">
        <title>Surat Jaminan Pelayanan</title>
        <style>
        @font-face 
        {
            font-family: Arial;
            font-style: normal;
            font-weight: normal;
            src: url(/application/third_party/dompdf/lib/fonts/arial.ttf) format("truetype"));
        }
        body {
          font-family: Arial;
          font-size: 14px;
          margin-top:0px;
          margin-left:10px;
        }
        
        #kop {
          margin-bottom:30px;
        }
        .a { display: inline-block; width: 70px; font-size:14px;}
        .b { display: inline-block; width: 20px; font-size:14px;}
        .c { display: inline-block; width: 300px; font-size:14px;}

        table {
        border-collapse: collapse;
        width: 100%;
        }
        th, td {
        text-align: left;
        padding: 5px;
        }

        .content {
            font-family: Arial !important;
            font-size: 14px;
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
        table {
            border-collapse:separate; 
            border-spacing: 0 0.6em;
          }

        .a, .b, .c
        {
            font-size:14px;
        }

        .tanggal
        {
            margin-left: 490px;
        }

        .keterangan
        {
            position: relative;
            width: 700px;
            height: 70px;
        }

        .kiri
        {
            position: absolute;
            width: 390px;
            height: auto;
        }
        .kanan
        {
            position: absolute;
            top: 5px;
            left: 490px;
            width: 200px;
            height: 60px;
        }

        .breakword
        {
            overflow-wrap:break-word !important;
            word-wrap:break-word;
        }

        #hal
        {
            margin-top: 14px;
        }
        .info
        {
            text-indent: 50px;
        }
        .footer
        {
            font-style: italic;
            text-align: center;
        }


    
        </style>
      </head>
      <body>
        <img src=' . $img_kop . ' alt="" id="kop" width="100%">
           
        <div class="tanggal">Depok, ' . format_indo(date("Y-m-d", strtotime($sjp[0]->tanggal_surat))) . '</div>
        <br><br>

        <div class="keterangan">
            <div class="kiri">
                <span class="a">Nomor</span> <span class="b">:</span><span class="c">' . $sjp[0]->nomor_surat . '</span><br>
                <span class="a">Lamp</span> <span class="b">:</span><span class="c">1 (satu) berkas</span><br>
                <div id="hal"><span class="a">Hal</span> <span class="b">:</span> <span class="c">Surat Jaminan Pelayanan</span></div>
            </div>
            
            
            <div class="kanan">
                Kepada :<br>
                <span class="breakword">Yth. Direktur ' . wordwrap($sjp[0]->nama_rumah_sakit, 18, "<br>\n") . '</span><br>
                Di Tempat
            </div>
        </div>
  
      <br><br>
      <div class="row">
        <div class="col-lg-12">

          Dari hasil penelitian kami atas surat-surat dari :
          <br>
            <table class="table table-borderless table-sm">
              <tbody>
                <tr>
                  <td style="width: 30%">Nama Pasien</td>
                  <td style="width: 5%">:</td>
                  <td>' . strtoupper($sjp[0]->nama_pasien) . '</td>
                </tr>
                
                <tr>
                  <td style="width: 30%">Tanggal Lahir</td>
                  <td style="width: 5%">:</td>
                  <td>' . date_format(date_create($sjp[0]->tanggal_lahir), "d-m-Y") . '</td>
                </tr>
                
                <tr>
                  <td style="width: 30%">Jenis Kelamin</td>
                  <td style="width: 5%">:</td>
                  <td>' . strtoupper($sjp[0]->jkpasien) . '</td>
                </tr>
                
                <tr>
                  <td style="width: 30%">Tgl. Mulai Rawat</td>
                  <td style="width: 5%">:</td>
                  <td>' . date_format(date_create($sjp[0]->mulai_rawat), "d-m-Y") . '</td>
                </tr>
                
                <tr>
                  <td style="width: 30%">Alamat</td>
                  <td style="width: 5%">:</td>
                  <td>' . $sjp[0]->alamatpasien . '</td>
                </tr>
                <tr>
                  <td style="width: 30%">Domisili</td>
                  <td style="width: 5%">:</td>
                  <td>' . $sjp[0]->domisili . '</td>
                </tr>
              </tbody>
            </table><br>
      
          Ternyata pasien tersebut memenuhi syarat :
          <br>
           <table class="table table-borderless table-sm">
            <tbody>
              <tr>
                <td  style="width: 30%">Dirawat di</td>
                <td style="width: 5%">:</td>
                <td>' . $sjp[0]->nama_kelas . '</td>
              </tr>
              <tr>
                <td  style="width: 30%">Dilakukan</td>
                <td style="width: 5%">:</td>
                <td>' . $sjp[0]->jenis_rawat . '</td>
              </tr>
              
              <tr>
                <td  style="width: 30%">Diagnosa sementara</td>
                <td style="width: 5%">:</td>
                <td>' . $diag . '</td>
              </tr>
              <tr>
                <td  style="width: 30%">Diberikan jaminan</td>
                <td style="width: 5%">:</td>
                <td>' . date_format(date_create($sjp[0]->mulai_rawat), "d-m-Y") . ($sjp[0]->jenis_rawat == 'Rawat Inap' ? ' s/d Selesai Perawatan' : ($sjp[0]->jenis_rawat == 'Rawat Jalan' ? ' s/d Dua Minggu' : '-')) . '</td>
              </tr>
              <tr>
                <td  style="width: 30%">Lain-lain</td>
                <td style="width: 5%">:</td>
                <td></td>
              </tr>
              <tr>
                <td style="width: 30%">Jaminan</td>
                <td style="width: 5%">:</td>
                <td>' . wordwrap($sjp[0]->nama_jenis, 55, "<br>\n") . '</td>
              </tr>
              <tr>
                <td style="width: 30%">Batas Maksimal Pagu</td>
                <td style="width: 5%">:</td>
                <td>'.
                    ($sjp[0]->domisili == 'Depok' ? 'Rp. 75.000.000' : ($sjp[0]->domisili == 'Luar Depok' ? 'Rp. 25.000.000' : 'Depok : Rp. 75.000.000 <br> Luar Depok : Rp. 25.000.000'))
                 . '</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="info">
      <p>Atas biaya Pemerintah Kota Depok dengan ketentuan yang berlaku. Biaya tersebut agar diajukan oleh<br> Rumah Sakit secara kolektif sebelum tanggal 10 pada bulan berikutnya.</p>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br><br><br><br><br><br>
      <div class="footer" style="margin-bottom:0">
      <center><p><em>Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik yang diterbitkan oleh Balai<br> Sertifikasi Elektronik (BSrE), Badan Siber dan Sandi Negara.</em></p></center>
      </div>

      </body></html>';
        return $html;
    }

    public function inputStatusPassphrase()
    {
        // Prepare a response
        $response = array(
            'pesan' => 'Gagal',
            'status_code' => 2031,
            'deskripsi_status' => 'Passphrase anda salah'
        );

        $this->db->insert('log_tte', $response);

        // Send the response as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function cekPassphraseTTE($id_sjp)
    {
        $sjp = $this->M_SJP->cek_logTTE($id_sjp);

        if (empty($sjp)) {
            $response = array(
                'pesan' => 'File belum ditandatangani',
                'code' => '400'
            );
        }else{
            $response = array(
                'pesan' => 'File sudah ditandatangani',
                'code' => '200'
            );
        }

        // Send the response as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function permohonan_diajukan($uhc = null)
    {
        $path = "";
        $data = array(
            'uhc'               => $uhc,
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan(),
            'controller'        => $this->instansi()
        );
        $data['page'] = $this->load("UHC Diajukan", $path);
        //$d['pengajuan'] = $this->M_SJP->select_all_new();
        $data['content'] = $this->load->view('diajukan_pkm', $data, true);
        $this->load->view('template/default_template', $data);
    }

    public function getdiajukandata()
    {
        $id_instansi = $this->input->post("id_instansi");
        $id_join     = $this->input->post("id_join");
        if ($this->input->post() !== Null) {
            $puskesmas  = $this->input->post("puskesmas");
            $mulai  = $this->input->post("mulai");
            $rs         = $this->input->post("rs");
            $status     = $this->input->post("status");
            $cari       = $this->input->post("cari");
            $data       = $this->M_SJP->view_permohonansjp_pus(4, $puskesmas, $rs, $status, $cari, $id_instansi, $id_join, $mulai);
        } else {
            $data       = $this->M_SJP->view_permohonansjp_pus(4, Null, Null, 2);
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

    public function ditolak_uhc($uhc = null)
    {
        $path = "";
        $data = array(
            'uhc'               => $uhc,
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan(),
            'controller'        => $this->instansi()
        );
        $data['page'] = $this->load("UHC Diajukan", $path);
        //$d['pengajuan'] = $this->M_SJP->select_all_new();
        $data['content'] = $this->load->view('ditolak_pkm', $data, true);
        $this->load->view('template/default_template', $data);
    }

    public function getditolakdatauhc()
    {
        $id_instansi = $this->input->post("id_instansi");
        $id_join     = $this->input->post("id_join");
        if ($this->input->post() !== Null) {
            $uhc  = $this->input->post("uhc");
            $puskesmas  = $this->input->post("puskesmas");
            $mulai  = $this->input->post("mulai");
            $rs         = $this->input->post("rs");
            $status     = $this->input->post("status");
            $cari       = $this->input->post("cari");
            $data       = $this->M_SJP->view_permohonansjp_pus(7, $puskesmas, $rs, $status, $cari, $id_instansi, $id_join, $mulai, $uhc);
        } else {
            $data       = $this->M_SJP->view_permohonansjp_pus(7, Null, Null, 2);
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



}






// <?php

// namespace App\Http\Controllers;

// use Firebase\JWT\JWT;
// use Firebase\JWT\Key;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
// use Illuminate\Routing\Controller as BaseController;

// class UserController extends BaseController
// {

//     private $baseurl = 'http://sitpas.depok.go.id/kds/';

//     private function getJumlahDataByLayanan($token, $layanan)
//     {
//         $ch = curl_init();

//         curl_setopt($ch, CURLOPT_URL, $this->baseurl . 'KDSApi/DTKSWilayah');
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, [
//             'cid: admin-kds',
//             'signature: '.$token
//         ]);

//         $response = curl_exec($ch);
//         $decodedResponse = json_decode($response, true);

//         if ($decodedResponse !== null) {
//             $jwtKey = 'Th15!15@53cr9t#K3y';
//             $decodedData = JWT::decode($decodedResponse["data"], new Key($jwtKey, 'HS256'));
//             return collect($decodedData)->where('layanan', $layanan)->count();
//         }

//         return 0;
//     }

//     private function getTanggalPengajuanTerbaruDanTerlama($token)
//     {
//         $ch = curl_init();

//         curl_setopt($ch, CURLOPT_URL, $this->baseurl . 'KDSApi/DTKSWilayah');
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, [
//             'cid: admin-kds',
//             'signature: '.$token
//         ]);

//         $response = curl_exec($ch);
//         $decodedResponse = json_decode($response, true);

//         if ($decodedResponse !== null) {
//             $jwtKey = 'Th15!15@53cr9t#K3y';
//             $decodedData = JWT::decode($decodedResponse["data"], new Key($jwtKey, 'HS256'));

//             $dataByLayanan = collect($decodedData);

//             $tanggalPengajuanTerbaru = $dataByLayanan->max('tanggal_pengajuan');
//             $tanggalPengajuanTerlama = $dataByLayanan->min('tanggal_pengajuan');

//             return [
//                 'tanggal_pengajuan_terbaru' => $tanggalPengajuanTerbaru,
//                 'tanggal_pengajuan_terlama' => $tanggalPengajuanTerlama
//             ];
//         }

//         return [
//             'tanggal_pengajuan_terbaru' => null,
//             'tanggal_pengajuan_terlama' => null
//         ];
//     }



//     public function home()
//     {
//         // Mengatur zona waktu menjadi Asia/Jakarta
//         date_default_timezone_set('Asia/Jakarta');
//         $timestamp = time();

//         $ch = curl_init();

//         curl_setopt($ch, CURLOPT_URL, $this->baseurl . 'Decrypt');
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
//             'cid' => 'admin-kds',
//             'client_name' => 'kartu-depok',
//             'timestamp' => $timestamp
//         ]));

//         $response = curl_exec($ch);
//         $token = $response;

        
//         $tanggalterbaru = $this->getTanggalPengajuanTerbaruDanTerlama($token);

//         $tanggal = ($tanggalterbaru != null) ? date("d M Y", strtotime($tanggalterbaru['tanggal_pengajuan_terbaru'])) : '-';

//         // Pelayanan Kesehatan Gratis
//         $jmlpbi = $this->getJumlahDataByLayanan($token, 'Pelayanan Kesehatan Gratis');

//         // Santunan Kematian
//         $jmlsk = $this->getJumlahDataByLayanan($token, 'Santunan Kematian');

//         // Beasiswa Berprestasi
//         $jmlpendidikan = $this->getJumlahDataByLayanan($token, 'Bantuan Sosial Siswa Miskin');

//         // Bantuan Rumah Tidak Layak Huni
//         $jml = $this->getJumlahDataByLayanan($token, 'Bantuan Rumah Tidak Layak Huni');

//         return view('home', compact('Berita', 'galeri', 'exlink', 'jml', 'jmlsk','jmlpbi', 'jmlpendidikan', 'tanggal'));
//     }

//     public function cek_dtks_single(){

//         $key = 'Th15!15@53cr9t#K3y';

//         $snik = '';
//         $snama = '';
//         $slayanan = '';

//         if (isset($_GET['layanan'])) {
//             $slayanan = rawurlencode($_GET['layanan']);
//         }
        
//         if (isset($_GET['nik'])){
//             $snik = $_GET['nik'];
//         }

//             if (isset($_GET['kt'])){
//                 if($_GET['cari'] != ''){
//                     if($_GET['kt'] == 'nama'){
//                     $snama = $_GET['cari'];
//                 }
                
//                 if($_GET['kt'] == 'nik'){
//                     $snik = $_GET['cari'];
//                 }
//             }
//         }

//         // Mengatur zona waktu menjadi Asia/Jakarta
//         date_default_timezone_set('Asia/Jakarta');
//         $timestamp = time();
//         $tanggal = date('d M Y', $timestamp);

//         $response = Http::post($this->baseurl . 'Decrypt', [
//             'cid' => 'admin-kds',
//             'client_name' => 'kartu-depok',
//             'timestamp' => $timestamp
//         ]);

//         $token = $response->body();

//         // Pencarian NIK
//         $response = Http::withHeaders([
//             'cid' => 'admin-kds',
//             'signature' => $token
//         ])->get($this->baseurl . "KDSApi/DTKSWilayah?nama=$snama&nik=$snik&kecamatan=&kelurahan=&tahun=&bulan=&limit=&offset=&layanan=$slayanan&status=");


//         $jumlahtotal = 0;
//         $disetujui = 0;
//         $diproses = 0;
        
//         if (isset($response['data']) && $response['data'] != null) {
//             // $key = 'Th15!15@53cr9t#K3y';
//             $result = JWT::decode($response['data'], new Key($key, 'HS256'));

//             $kecamatan = $result;
//             $result = !empty($result) ? json_encode($result) : '';

//             if ($slayanan != '') {
//                 $responseData = ($result != null) ? json_decode($result, true) : [];

//                 $filteredDataDisetujui = array_filter($responseData, function ($item) {
//                     return $item['status'] === 'Disetujui';
//                 });

//                 $filteredDataDiproses = array_filter($responseData, function ($item) {
//                     return $item['status'] !== 'Disetujui' && $item['status'] !== 'Ditolak';
//                 });
            
//                 $diproses = count($filteredDataDiproses);

//                 $disetujui = count($filteredDataDisetujui);

//                 $jumlahtotal = $response['total_records'] ?? 0;
//             }
            

//             // Membuat collection dari data kecamatan
//             $kecamatanCollection = collect($kecamatan);

//             // Menghapus duplikat berdasarkan kecamatan
//             $uniqueKecamatanCollection = $kecamatanCollection->unique('kecamatan');

//             // Mengubah kembali ke array
//             $kecamatan = $uniqueKecamatanCollection->values()->toArray();
//         } else {
//             $result = [];
//             $jumlahtotal = 0;
//             $disetujui = $diproses = '-';
//             $kecamatan = $result;
//             $uniqueKecamatan = [];
//         }

//         $resultArray = json_decode($result, true);

//         $groupedData = [];

//         foreach ($resultArray as $res) {
//             $kecamatanresult = $res['kecamatan'];
//             $kelurahanresult = $res['kelurahan'];

//             if (!isset($groupedData[$kecamatanresult])) {
//                 $groupedData[$kecamatanresult] = [];
//             }

//             if (!isset($groupedData[$kecamatanresult][$kelurahanresult])) {
//                 $groupedData[$kecamatanresult][$kelurahanresult] = [
//                     'jumlah_disetujui' => 0,
//                     'jumlah_diproses' => 0,
//                 ];
//             }

//             if ($res['status'] === 'Disetujui') {
//                 $groupedData[$kecamatanresult][$kelurahanresult]['jumlah_disetujui']++;
//             } elseif ($res['status'] !== 'Disetujui' && $res['status'] !== 'Ditolak') {
//                 $groupedData[$kecamatanresult][$kelurahanresult]['jumlah_diproses']++;
//             }
//         }

//         return view('informasi-dtks.cek-dtks-single',compact('snik', 'slayanan','kecamatan','result', 'jumlahtotal', 'disetujui', 'diproses', 'groupedData'));
//     }
// }
