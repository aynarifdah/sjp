<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function cek_nik()
    {
    $nik = $this->input->post('nik');

    $this->load->model('M_sitpas');
    $data = $this->M_sitpas->cek_nik($nik);

    // 1. DATA TIDAK DITEMUKAN
    if (!$data || count($data) == 0) {
        echo json_encode([
            "status" => "not_found",
            "message" => "Data tidak ditemukan"
        ]);
        return;
    }

    $row = $data[0];
    $desil = intval($row['desil']);

    // 2. DESIL 1 - 5 (VALID)
    if ($desil >= 1 && $desil <= 5) {
        echo json_encode([
            "status" => "desil_valid",
            "message" => "Pasien termasuk penerima manfaat jaminan kesehatan kota Depok (Desil 1 - 5).",
            "data" => $row
        ]);
        return;
    }

    // 3. DESIL 6 - 10 (BUKAN PENERIMA MANFAAT)
    echo json_encode([
        "status" => "desil_rejected",
        "message" => "Pasien bukan termasuk penerima manfaat jaminan kesehatan kota Depok (Desil 6 - 10).",
        "data" => $row
    ]);
}

}
