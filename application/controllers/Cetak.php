<?php


Class Cetak extends CI_Controller{


    function __construct() {
        parent::__construct();
        // $this->load->library('jiojmoim');
        // var_dump($this->load->library('pdf'));die;
        $this->load->library('Pdf');
        $this->load->model('M_SJP');
        is_login();
        // membuat halaman baru
        
    }

    private function load($title = '', $datapath = '')
    {
        $page = array(
            "head"    => $this->load->view('template/head', array("title" => $title), true),
            "main_js" => $this->load->view('template/main_js', false, true),
            "footer"  => $this->load->view('template/footer', false, true)
        );
        return $page;
    }
    
    function index(){


    }


    function cetak_sjp($id_sjp){
        $pdf = new PDF1();
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','',16);
        $pdf->Image(base_url('assets/img/logo_dinkes.jpg'),20,5,-190);
        // mencetak string 
        $pdf->Cell(220,7,'PEMERINTAH KOTA DEPOK',0,1,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(220,7,'DINAS KESEHATAN',0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(220,7,'Jl. Margonda Raya No. 54, Gedung DIBALEKA II Lt. 3 DEPOK 16431',0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(220,7,'Telp / Fax : (021) 29402281',0,1,'C');
        $pdf->Line(20, 45, 190, 45);
        $pdf->Line(20, 46, 190, 46);
        $sjp = $this->M_SJP->select_all_by_id($id_sjp);
        foreach ($sjp as $sjp) {
            // $data = echo "
            //     <table border = '0'>
            //     <tr>
            //     <th>Nama Pasien</th><td>:<td><td>".$sjp->nama_pasien."</td>
            //     </tr>
            //     </table>
            // ";
            // echo "<table border = '0'>";
            // echo "<tr>";
            // echo "<th>Nama Pasien</th><td>:<td><td>".$sjp->nama_pasien."</td>";
            // echo "</tr>";
            // echo "</table>";
            date_default_timezone_set("Asia/Jakarta");
            $tanggal_surat = date_format(date_create($sjp->tanggal_surat),"d F Y");
            $pdf->Cell(165,10,"",0,1,'R');
            $pdf->Cell(180,10,"Depok, $tanggal_surat",0,1,'R');
            $pdf->Cell(180,0,"Kepada Yth.",0,1,'R');
            

            $pdf->Cell(180,10,"Direktur ".$sjp->nm_rs,0,1,'R');
            $pdf->Cell(180,0,"Di Tempat",0,1,'R');
            $pdf->Cell(10,0,"",0,0,'R');
            $pdf->Cell(100,0,"Nomor  : ".$sjp->nomor_surat,0,1,'L');
            $pdf->Cell(10,0,"",0,0,'R');
            $pdf->Cell(100,10,"Lamp    : 1 berkas",0,1,'L');
            $pdf->Cell(10,0,"",0,0,'R');
            $pdf->Cell(100,0,"Hal        : Surat Jaminan Pelayanan",0,1,'L');

            $pdf->Cell(165,15,"",0,1,'R');
            $pdf->Cell(10,0,"",0,0,'R');
            $pdf->Cell(100,0,"Dari hasil penelitian kami atas surat-surat dari :",0,1,'L');

            $pdf->Cell(165,8,"",0,1,'R');
            $pdf->Cell(20,0,"",0,0,'R');
            // $pdf->Cell(100,0,$sjp->nama_pasien,0,1,'L');
            // echo "<table border = '0'>";
            // echo "<tr>";
            // echo "<th>Nama Pasien</th><td>:<td><td>".$sjp->nama_pasien."</td>";
            // echo "</tr>";
            // echo "</table>";
            $pdf->Cell(100,0,"Nama Pasien                         : ".$sjp->nama_pasien,0,1,'L');


            $tanggal_lahir1 = date('d F Y', strtotime($sjp->tanggal_lahir));

            $pdf->Cell(165,7,"",0,1,'R');
            $pdf->Cell(20,0,"",0,0,'R');
            $pdf->Cell(100,0,"Tanggal Lahir                         : ".$tanggal_lahir1,0,1,'L');

            $pdf->Cell(165,7,"",0,1,'R');
            $pdf->Cell(20,0,"",0,0,'R');
            $pdf->Cell(100,0,"Jenis Kelamin                        : ".$sjp->jkpasien,0,1,'L');


            $pdf->Cell(165,7,"",0,1,'R');
            $pdf->Cell(20,0,"",0,0,'R');
            $pdf->Cell(100,0,"Tgl. Mulai Rawat                    : ".date_format(date_create($sjp->mulai_rawat),"d F Y"),0,1,'L');

            $pdf->Cell(165,7,"",0,1,'R');
            $pdf->Cell(20,0,"",0,0,'R');
            $pdf->Cell(100,0,"Alamat                                   : ".$sjp->alamatpasien,0,1,'L');

            $pdf->Cell(165,8,"",0,1,'R');
            $pdf->Cell(10,0,"",0,0,'R');
            $pdf->Cell(100,0,"Ternyata pasien tersebut memenuhi syarat :",0,1,'L');

            $pdf->Cell(165,8,"",0,1,'R');
            $pdf->Cell(20,0,"",0,0,'R');
            $pdf->Cell(100,0,"Dirawat di                              : ".$sjp->nama_kelas,0,1,'L');

            // $pdf->Cell(165,7,"",0,1,'R');
            // $pdf->Cell(20,0,"",0,0,'R');
            // $pdf->Cell(100,0,"Scanning                             :     -",0,1,'L');

            // $pdf->Cell(165,7,"",0,1,'R');
            // $pdf->Cell(20,0,"",0,0,'R');
            // $pdf->Cell(100,0,"USG                                    :   -",0,1,'L');

            // $pdf->Cell(165,7,"",0,1,'R');
            // $pdf->Cell(20,0,"",0,0,'R');
            // $pdf->Cell(100,0,"Lain-Lain                               :  -",0,1,'L');


            $diagpasien = $this->M_SJP->diagpasien($id_sjp);
            $namadiag = array ();

            foreach ($diagpasien as $key) {
                array_push($namadiag,$key['namadiag']);
            }
            $diagnosa = implode(" , ",$namadiag);
            //echo $diagnosa;die;
            //var_dump($namadiag);die;
            //
            $pdf->Cell(165,7,"",0,1,'R');
            $pdf->Cell(20,0,"",0,0,'R');
            $pdf->Cell(45,0,"Diagnosa sementara             : ".$diagnosa,0,0,'L');
            // $pdf->MultiCell(100,5,"$diagnosa     ",0,'L');

            $pdf->Cell(165,7,"",0,1,'R');
            $pdf->Cell(20,0,"",0,0,'R');
            
           // echo $akhir_rawat;die;
            if ($sjp->jenis_rawat == 'Rawat Inap') {
                $akhir_rawat = date( "Y-m-d", strtotime( $sjp->mulai_rawat." +2 week" ) );
            }else{
                $akhir_rawat = date( "Y-m-d", strtotime( $sjp->mulai_rawat." +1 month" ) );
            }
            $jaminan = date_format(date_create($sjp->mulai_rawat),"d F Y")." s/d ".date_format(date_create($akhir_rawat),"d F Y");
            $pdf->Cell(100,0,"Diberikan jaminan                  : ".$jaminan,0,1,'L');


            $pdf->Cell(165,7,"",0,1,'R');
            $pdf->Cell(20,0,"",0,0,'R');
            $pdf->Cell(45,0,"Jaminan                                 : ".$sjp->nama_jenis,0,0,'L');

            // $pdf->MultiCell(100,5,"Pembiayaan Jaminan Kesehatan Maskin Diluar Kuota PBI Jaminan Kesehatan    ",0,'L');


            $pdf->Cell(165,5,"",0,1,'R');
            $pdf->Cell(10,0,"",0,0,'R');
            $pdf->MultiCell(180,5,"Atas biaya Pemerintah Kota Depok dengan ketentuan yang berlaku. Biaya tersebut agar diajukan oleh Rumah Sakit secara kolektif sebelum tanggal 10 pada bulan berikutnya.",0,'L');

            $pejabat = $this->M_SJP->pejabat(1);
            foreach ($pejabat as $key => $value) {
                $jabatan = $value['jabatan'];
                $nama = $value['nama_pejabat'];
                $nip = $value['nip'];
            }
            $pdf->Cell(165,8,"",0,1,'R');
            $pdf->Cell(55,10,"",0,0,'R');
            $pdf->MultiCell(180,5,"$jabatan.",0,'C');


            $pdf->Cell(165,28,"",0,1,'R');
            $pdf->Cell(55,10,"",0,0,'R');
            $pdf->MultiCell(180,5,"$nama.",0,'C');

            $pdf->Cell(165,0,"",0,1,'R');
            $pdf->Cell(55,10,"",0,0,'R');
            $pdf->MultiCell(180,5,"NIP  : $nip.",0,'C');
        }



        $pdf->Output();
    }

    function cetak_survey_sjp($id_sjp){

        $pdf = new PDF1();
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','',16);
        $pdf->Image(base_url('assets/img/logo_dinkes.jpg'),20,5,-190);
        // mencetak string 
        $pdf->Cell(220,7,'PEMERINTAH KOTA DEPOK',0,1,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(220,7,'DINAS KESEHATAN',0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(220,7,'Jl. Margonda Raya No. 54, Gedung DIBALEKA II Lt. 3 DEPOK 16431',0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(220,7,'Telp / Fax : (021) 29402281',0,1,'C');
        $pdf->Line(20, 45, 190, 45);
        $pdf->Line(20, 46, 190, 46);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(30,13,'',0,1);
        $pdf->SetFont('Arial','',10);
        $sjp = $this->M_SJP->select_all_by_id($id_sjp);
        $id_puskesmas = 1;
        $gethasilsurvey = $this->M_SJP->gethasilsurvey($id_puskesmas, $id_sjp);
        $hasilsurvey = array();

        foreach ($gethasilsurvey as $gethasilsurvey) {
            $hasilsurvey[] = $gethasilsurvey['jawaban'];
        }
        $counthasil = count($hasilsurvey);
        $sumjawaban = array_sum($hasilsurvey);
        foreach ($sjp as $key => $value) {
            $tanggal_survey = date('d F Y', strtotime($value->tanggal_survey));
            $pdf->Cell(10,6,'',0,0);
            $pdf->Cell(30,6,'Nama Pasien',0,0);
            $pdf->Cell(0,6,":   $value->nama_pasien",0,0);
            $pdf->Cell(30,6,'',0,1);
            $pdf->Cell(10,6,'',0,0);
            $pdf->Cell(30,6,'Alamat',0,0);
            $pdf->Cell(0,6,":   $value->alamatpasien",0,0);
            $pdf->Cell(30,6,'',0,1);
            $pdf->Cell(10,6,'',0,0);
            $pdf->Cell(30,6,'Tanggal Survey',0,0);
            $pdf->Cell(0,6,":   $tanggal_survey",0,0);
            $pdf->Cell(30,6,'',0,1);
            $pdf->Cell(10,6,'',0,0);
            $pdf->Cell(30,6,'Surveyor',0,0);
            $pdf->Cell(0,6,":   $value->surveyor",0,0);
            $pdf->Cell(30,6,'',0,1);
            $pdf->Cell(10,6,'',0,0);
            $pdf->Cell(30,6,'Status Pengajuan ',0,0);
            $pdf->Cell(0,6,":   $value->status_pengajuan",0,0);
            $pdf->Cell(30,6,'',0,1);
            $pdf->Cell(10,6,'',0,0);
            $pdf->Cell(30,6,'Hasil Survey',0,0);
            $pdf->Cell(0,6,":   $sumjawaban / $counthasil",0,0);
            $pdf->Cell(30,6,'',0,1);
            $pdf->Cell(10,6,'',0,0);
            $pdf->Cell(30,6,'Catatan Survey',0,0);
            $pdf->Cell(0,6,":   $value->keterangan_survey",0,0);
        }

        $datasurvey =  $this->M_SJP->kethasilsurvey($id_puskesmas, $id_sjp);

        $pdf->Cell(10,8,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Ln();

        $x_axis=$pdf->getx();
            $c_width=20;// cell width 
            $c_height=9;// cell height
            $text="aim success ";// content 
            $pdf->vcell(15,$c_height,20,'No.','C');// pass all values inside the cell 
            $x_axis=$pdf->getx();// now get current pdf x axis value
            $pdf->vcell(80,$c_height,$x_axis,'   Variabel','L');
            $x_axis=$pdf->getx();
            $pdf->vcell(75,$c_height,$x_axis,'   Isi','L');
            $x_axis=$pdf->getx();

            
            if (!empty($datasurvey)) {
                $no = 1;
                foreach ($datasurvey as $key) {
                                // baris 1
                    $pdf->SetFont('Arial','',10);
                    $pdf->Ln();
                    $x_axis=$pdf->getx();
            $c_width=20;// cell width 
            $c_height=9;// cell height
            $text="aim success ";// content 
            $pdf->vcell(15,$c_height,20,$no++,'C');// pass all values inside the cell 
            $x_axis=$pdf->getx();// now get current pdf x axis value
            $pdf->vcell(80,$c_height,$x_axis,$key['ceklist_survey'],'L');
            $x_axis=$pdf->getx();
            $pdf->vcell(75,$c_height,$x_axis,$key['keterangan'],'L');
            
        }
    }
    $pdf->Output();


}
}


