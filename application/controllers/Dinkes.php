<?php

use Dompdf\Options;

class Dinkes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('tanggal');
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


    // TEST 02-02-2021

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
            'getForUpdateFile' => $this->M_SJP->getForUpdateFile($id_pengajuan),
            'topik'      => $this->M_SJP->diagnosa(),
            // 'getdokumenpersyaratan' => $this->M_SJP->getdokumenpersyaratan($id_pengajuan, 1),
            'dokumen'    => $this->M_SJP->dokumen_persyaratan(),
            'rumahsakit' => $this->M_SJP->rumahsakit(),
            'kelas_rawat' => $this->M_SJP->kelas_rawat(),
            // test
            'detail'       => $this->M_SJP->detail_permohonansjp($idsjp, $id_instansi, $id_join),
            'id_pengajuan' => $id_pengajuan,
            'testDiagnosa' => $this->M_SJP->testDiagnosa($idsjp),
            'diagnosa'   => $this->M_SJP->diagpasien($idsjp)
        ];
        // var_dump($data["diagnosa"]);
        // die;

        $path = "";
        $data = array(
            "page"    => $this->load("edit data pasien", $path),
            "content" => $this->load->view('edit_data_pasien', $data, true)
        );

        $this->load->view('template/default_template', $data);
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
            $dataDiagnosa = array();
            $diagnosaLainnya = '';
            foreach ($kd_diagnosa as $key) {
                if ($key['diagnosa'] == 'Pilih Diagnosa' || empty($key['diagnosa'])) {
                    $penyakit = $key['diagnosalainnya'];
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

            if (!empty($dataDiagnosa)) {
                // $this->db->set($dataDiagnosa[0]);
                $this->db->where('id_sjp', $idsjp);
                $this->db->update('diagnosa', $dataDiagnosa[0]);
            }



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

                    // Set preference
                    $config['upload_path'] = 'uploads/dokumen/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                    $config['max_size'] = '5000'; // max_size in kb
                    $config['file_name'] = $_FILES['dokumen']['name'][$i];

                    //Load upload library
                    $this->load->library('upload', $config);

                    // Useful if you auto-load the class
                    $this->upload->initialize($config);

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
                    // else {
                    //     echo $this->upload->display_errors();
                    //     die();
                    // }
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
        // $level = $this->session->userdata('level');
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
        $id_puskesmas =  $data['datapermohonan'][0]['id_puskesmas'];
        $data['anggaran'] = $this->M_SJP->anggaran_pasien();
        $data['penyakit'] = $this->M_SJP->diagpasien($idsjp);
        $data['riwayatpengajuan'] = $this->M_SJP->riwayatsjpasien($idsjp);
        $data['datapasien'] = $this->M_SJP->datapasien($nik->nik);
        $data['feedback'] = $this->M_SJP->feedback_dinkes($idsjp);
        $data['id_sjp'] = $idsjp;
        $data['kethasilsurvey'] = $this->M_SJP->kethasilsurvey($idsjp, $id_puskesmas);
        $data['getdokumenpersyaratan'] = $this->M_SJP->getdokumenpersyaratan($id_pengajuan, $id_jenis_izin);
        $data['level'] = $level;
        $data['controller'] = $this->instansi();

        // var_dump($data['feedback']);
        // die;
        $data['content'] = $this->load->view('detail_pengajuan', $data, true, false);
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
        redirect('Dinkes/pengajuan_sjp', 'refresh');
    }

    public function persetujuan_sjp_kayankesru()
    {
        $path = "";
        $id_status_pengajuan = 5;
        $datax = array(
            'datapermohonan' => $this->M_SJP->select_persetujuan_sjp_kayankesru($id_status_pengajuan),
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan()
        );
        $data = array(
            "page"    => $this->load("Persetujuan SJP kayankesru", $path),
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

    public function detail_pengajuan_klaim($idsjp)
    {
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
        $data['content'] = $this->load->view('detail_pengajuan_klaim', $data, true, false);
        $this->load->view('template/default_template', $data);
    }
    public function updatestatbayar()
    {
        //$id_sjp = $this->input->get('get');
        if (!empty($this->input->get('get'))) {
            $idsjp = explode(",", $this->input->get('get'));
        } else {
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
            "page"    => $this->load("entry klaim", $path),
            "content" => $this->load->view('entry_pembayaran_klaim', $datay, true)
        );

        $this->load->view('template/default_template', $data);
    }
    public function proses_update_bayar()
    {
        $id_sjp = $this->input->post('id_sjp');
        $tanggal_bayar = $this->input->post('tanggalbayar');
        $nomortagihan   = $this->input->post('nomor_tagihan');
        $nominalklaim   = $this->input->post('nominal_klaim');
        $catatanklaim   = $this->input->post('catatan_klaim');
        $dataklaim = array();
        $index = 0; // Set index array awal dengan 0
        foreach ($id_sjp as $key) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($dataklaim, array(
                'id_sjp'      => $key,
                'tanggal_pembayaran'   => $tanggal_bayar,
                'status_klaim'    => 4,
            ));
            $index++;
        }
        $this->db->update_batch('sjp', $dataklaim, 'id_sjp');
        redirect('Dinkes/pengajuan_klaim/4', 'refresh');
    }
    public function rekapitulasi_sjp()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Rekapitulasi SJP", $path),
            "content" => $this->load->view('rekapitulasi_Sjp', false, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function input_feedback()
    {
        $feedback_dinkes = $this->input->post('feedback');
        $id_sjp = $this->input->post('id_sjp');
        $datafeedback = array(
            'feedback_dinkes' => $feedback_dinkes,
        );

        $updatefeedback = $this->M_SJP->input_feedback($datafeedback, $id_sjp);
        // var_dump($updatefeedback);
        // die;
        echo json_encode($updatefeedback);
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
        $data = array(
            'title' => 'Laporan Excel Pembiayaan',
            'dataklaim' => $this->M_SJP->getdatapengajuanklaim($id_status_klaim),
            'penyakit' => $this->M_SJP->diagpasien(),
        );
        $this->load->view('laporan_excel_pembiayaan', $data);
    }



    // ////////////////////////////////////////////////////////////////////////////////////////////////////
    // MAHDI - (Maaf, biar gampang kebaca)
    // ////////////////////////////////////////////////////////////////////////////////////////////////////

    public function index()
    {
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

        // var_dump($d['distribusi']);
        // die;
        // var_dump(json_encode($this->M_SJP->chartJenisRawat()));die;

        $data = array(
            "page"    => $this->load("Dashboard", $path),
            "content" => $this->load->view('dashboard', $d, true)
        );

        $this->load->view('template/default_template', $data);
    }


    public function Filter()
    {
        $bulan      = $this->input->post('bulan');
        $tahun      = $this->input->post('tahun');
        $kecamatan  = $this->input->post('kecamatan');
        $kelurahan  = $this->input->post('kelurahan');
        $orderDistribusi = $this->input->post('orderDistribusi');

        $anggaran_tahun     = $this->M_SJP->anggaran($bulan, $tahun, $kecamatan, $kelurahan);
        $nominal_pembiayaan = $this->M_SJP->nominal_pembiayaan($bulan, $tahun, $kecamatan, $kelurahan);
        // $sisa_anggaran      = $anggaran_tahun[0]["nominal_anggaran"] - $nominal_pembiayaan[0]['nominal'];

        $data = [
            'jumlah_sjp'            => $this->M_SJP->jumlah_sjp($bulan, $tahun, $kecamatan, $kelurahan),
            'anggaran_tahun'        => $anggaran_tahun,
            // 'sisa_anggaran'         => $sisa_anggaran,
            'nominal_pembiayaan'    => $nominal_pembiayaan,
            'total_pasien'          => $this->M_SJP->total_pasien($bulan, $tahun, $kecamatan, $kelurahan),
            'distribusi'            => $this->M_SJP->distribusi($bulan, $tahun, $kecamatan, $kelurahan, $orderDistribusi),
            'jumlah_kunjungan_bulan' => $this->M_SJP->jumlah_kunjungan_bulan($bulan, $tahun, $kecamatan, $kelurahan),
            'trend_pasien'          => json_decode($this->M_SJP->trend_pasien($bulan, $tahun, $kecamatan, $kelurahan)),
            'jenis_rawat'           => $this->M_SJP->jenis_rawat($bulan, $tahun, $kecamatan, $kelurahan),
            'chartJenisRawat'       => $this->M_SJP->chartJenisRawat($bulan, $tahun, $kecamatan, $kelurahan)
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

    public function getDiagnosa()
    {

        $Kd_diagnosa = $this->input->post('id');
        $diagnosa    = $this->M_SJP->diagnosa2($Kd_diagnosa);
        echo json_encode($diagnosa);
    }

    // From Function Lama
    public function getalldatapermohonan()
    {
        if ($this->input->post() !== Null) {
            $puskesmas  = $this->input->post("puskesmas");
            $mulai  = $this->input->post("mulai");
            $rs         = $this->input->post("rs");
            $status     = $this->input->post("status");
            $cari       = $this->input->post("cari");
            $datasjp    = $this->M_SJP->select_pengajuan_sjp_all(Null, $puskesmas, $rs, $status, $cari, $mulai);
        } else {
            $datasjp = $this->M_SJP->select_pengajuan_sjp_all();
        }
        $total = $this->total();

        $result = [
            'draw' => '', // $_POST['draw']
            'recordsFiltered' => '',
            'recordsTotal' => '',
            // 'query' => $this->db->last_query(),
            'data' => $datasjp
        ];
        // var_dump($result);
        // die;
        echo json_encode($result);
    }

    // public function count_all()
    // {
    //     $this->db->from('permohonan_pengajuan');
    //     return $this->db->count_all_results();
    // }

    public function total()
    {
        $query = $this->db->select("COUNT(*) as num")->get("permohonan_pengajuan");
        $result = $query->row();
        if (isset($result)) return $result->num;
        return 0;
    }

    public function pengajuanall()
    {
        $level = $this->session->userdata('level');
        $datax = array(
            'level'             => $level,
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan(),
            'controller'        => $this->instansi()
        );

        $path = "";
        $data = array(
            "page"    => $this->load("Pengajuan", $path),
            "content" => $this->load->view('pengajuanall', $datax, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function pengajuan_sjp()
    {
        // $id_status_pengajuan = 3;
        $path = "";
        $datax = array(
            'datapermohonan' => $this->M_SJP->select_pengajuan_sjp(),
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan()
        );
        $data = array(
            "page"    => $this->load("Pengajuan SJP", $path),
            "content" => $this->load->view('dinkes/pengajuan_sjp', $datax, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function getpersetujuansjpdinas()
    {
        if ($this->input->post() !== Null) {
            $puskesmas  = $this->input->post("puskesmas");
            $mulai  = $this->input->post("mulai");
            $rs         = $this->input->post("rs");
            $status     = $this->input->post("status");
            $cari       = $this->input->post("cari");
            $data       = $this->M_SJP->getpersetujuansjpdinas($puskesmas, $rs, $status, $cari, $mulai);
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

    public function disetujui_sjp()
    {
        // $id_status_pengajuan = 3;
        $path = "";
        $datax = array(
            'datapermohonan' => $this->M_SJP->select_disetujui_sjp(),
            'puskesmas'         => $this->M_data->getPuskesmas(),
            'rs'                => $this->M_data->getRS(),
            'statuspengajuan'   => $this->M_data->getStatusPengajuan()
        );
        $data = array(
            "page"    => $this->load("Pengajuan SJP", $path),
            "content" => $this->load->view('dinkes/disetujui_sjp', $datax, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function getdisetujuisjpdinas()
    {
        if ($this->input->post() !== Null) {
            $puskesmas  = $this->input->post("puskesmas");
            $mulai  = $this->input->post("mulai");
            $rs         = $this->input->post("rs");
            $status     = $this->input->post("status");
            $cari       = $this->input->post("cari");
            $data       = $this->M_SJP->getpersetujuansjpdinas($puskesmas, $rs, $status, $cari, $mulai);
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

    public function pengajuan_klaim($id_status_klaim = null)
    {
        // $product_id = $this->uri->segment(3);
        $datax = array(
            'status_klaim'      => $id_status_klaim,
            'rs'                => $this->M_data->getRS(),
            'statusklaim'       => $this->M_data->getStatusKlaim()
        );
        $path = "";
        $data = array(
            "page"    => $this->load("Pengajuan klaim", $path),
            "content" => $this->load->view('pengajuan_klaim', $datax, true)
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
            $data            = $this->M_SJP->getdatapengajuanklaim($id_status_klaim, $mulai, $akhir, $rs, $status, $cari);
        } else {
            $id_status_klaim = $this->input->post('status_klaim');
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

    public function daftar_pembiayaan()
    {
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
            "page"    => $this->load("Daftar pembiayaan", $path),
            "content" => $this->load->view('daftar_pembiayaan', $datay, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function UserManagement()
    {
        if ($this->session->userdata('level') != 1) {
            redirect('Dinkes', 'refresh');
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
    public function AddPejabat()
    {

        $path = "";
        $data = array(
            "page"    => $this->load("add_pejabat", $path),
            "content" => $this->load->view('add_pejabat', false, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function tambah_pejabat()
    {
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

    public function AddUser()
    {
        if ($this->session->userdata('level') != 1) {
            redirect('Dinkes', 'refresh');
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
            redirect('Dinkes', 'refresh');
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
        }else if ($instansi == 6) {
            $data["nama_join"] = $this->M_SJP->getKelurahan();
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
            'query' => $this->db->last_query()
            // 'token' => $this->security->get_csrf_hash()
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

    public function getKelurahan()
    {
        $KecId = $this->input->post('id');
        $kel   = $this->M_SJP->wilayah_kelurahan('kelurahan', $KecId);
        echo json_encode($kel);
    }

    public function logCetak()
    {
        $idUser         = $this->input->post("idUser");
        $idInstansi     = $this->input->post("idInstansi");
        $pengajuan      = $this->input->post("pengajuan");
        $type           = $this->input->post("type");
        $desc           = $this->input->post("desc");
        helper_log($type, $desc, $idInstansi, $pengajuan);
    }

    public function approvesjp($idsjp, $id_pengajuan)
    {
        $tanggalsurat = $this->input->post('tgl_persetujuan');
        $statuspersetujuan = $this->input->post('status_pengajuan');
        $nomor_surat = '401/' . $idsjp . '/' . $id_pengajuan . '.' . date_format(date_create($tanggalsurat), "dmy") . '/ Yankesru dan PK';
        $datasjp = array(
            'tanggal_surat'     =>  $tanggalsurat,
            'nomor_surat'       =>  $nomor_surat,
            'id_user_menyetujui' => $this->session->userdata('id_user')
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
        redirect('Dinkes/persetujuan_sjp_kayankesru', 'refresh');
    }

    public function updateStatusPengajuanDinkes($id_pengajuan, $id_status_pengajuan)
    {
        $data = [
            'id_status_pengajuan' => $id_status_pengajuan
        ];

        $where = [
            'id_pengajuan' => $id_pengajuan
        ];

        $this->db->where($where);
        $this->db->update('permohonan_pengajuan', $data);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function getRs()
    {
        $id = $this->input->post('id');
        $rs = $this->M_SJP->getRs();
        echo json_encode($rs);
    }

    public function getPuskesmas()
    {
        $id  = $this->input->post('id');
        $pus = $this->M_SJP->getPuskesmas();
        echo json_encode($pus);
    }

    public function getLurah()
    {
        $id  = $this->input->post('id');
        $kel = $this->M_SJP->getKelurahan();
        echo json_encode($kel);
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

    public function CetakTest($id_sjp)
    {
        // setlocale(LC_ALL, 'in_ID');
        $sjp = $this->M_SJP->detail_cetak($id_sjp);
        // var_dump($sjp);
        // die;
        $diagpasien = $this->M_SJP->diagpasien($id_sjp);
        $diag = implode(', ', array_column($diagpasien, 'namadiag'));
        $img = base_url('/assets/uploads/cap.png');
        $img_kop = base_url('/assets/images/kop_surat.png');
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

        // $this->dompdf->stream("CetakTest_.pdf", ['Attachment' => 0]);
        $output = $this->dompdf->output();
        $time = date('His');
        $location = './pdfTemporary/sjp_'.$time.'.pdf';
        file_put_contents($location, $output);

		


        $username = 'esign';
        $password = 'qwerty';
        $url = "103.113.30.81/api/sign/pdf";
        $file = './pdfTemporary/sjp_'.$time.'.pdf';

        

        $headers = array("Content-Type:multipart/form-data");
        $postfields = array(
        	'file' => curl_file_create($file,'application/pdf'),
        	'imageTTD' => curl_file_create($ttd,'image/jpeg'),
        	'nik' => '0803202100007062',
        	'passphrase' => '!Bsre1221*',
        	'page' => '1',
        	'tampilan' => 'visible',
        	'image' => 'true',
        	'linkQR' => 'https://google.com',
        	'xAxis' => '800',
        	'yAxis' => '100',
        	'width' => '300',
        	'height' => '250'
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

        curl_close($ch);
         if($error != ""){
        	var_dump($error);
        	die();
        }
        unlink('./pdfTemporary/sjp_'.$time.'.pdf');

        header("Content-Type: application/pdf");
		echo $resp;
        
    }

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
                <td>' . date_format(date_create($sjp[0]->mulai_rawat), "d-m-Y") . ' s/d Selesai perawatan'   . '</td>
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
      <br><br><br><br><br><br><br><br>
      <div class="footer" style="margin-bottom:0">
      <center><p><em>Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik yang diterbitkan oleh Balai<br> Sertifikasi Elektronik (BSrE), Badan Siber dan Sandi Negara.</em></p></center>
      </div>

      </body></html>';
        return $html;
    }

    // ////////////////////////////////////////////////////////////////////////////////////////////////////
    // MAHDI - (Maaf, biar gampang kebaca)
    // ////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Waktu_pengajuan()
    {
        $path = "";
        $data = array(
            "page"    => $this->load("Waktu Pengajuan", $path),
            "content" => $this->load->view('Dinkes/waktu_pengajuan', false, true)
        );

        $this->load->view('template/default_template', $data);
    }

    public function parameter_waktu_pengajuan()
    {
        $data       = $this->M_SJP->parameter_waktu_pengajuan();

        $result = [
            'data' => $data,
            'draw' => '',
            'recordsFiltered' => '',
            'recordsTotal' => '',
            'query' => $this->db->last_query(),
        ];
        echo json_encode($result);
    }

    public function edit_parameter_waktu($id)
    {
        $path = "";
        $data['waktu'] = $this->M_SJP->detail_waktu_pengajuan($id);

        $data = array(
            "page"    => $this->load("Edit Waktu", $path),
            "content" => $this->load->view('edit_waktu_pengajuan', $data, true)
        );
        $this->load->view('template/default_template', $data);
    }

    public function update_parameter_waktu()
    {
        $id = $this->input->post('id');
        $data = array(
            'waktu_buka' =>  $this->input->post('waktu_buka'),
            'waktu_tutup' =>  $this->input->post('waktu_tutup')
        );
        $this->db->where('id', $id);
        $this->db->update('jam_pengajuan', $data);
        redirect('Dinkes/Waktu_pengajuan', 'refresh');
    }
}
