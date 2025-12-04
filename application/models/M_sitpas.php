<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sitpas extends CI_Model {

    private $decrypt_url = "http://sitpas.depok.go.id/kds/Decrypt";
    private $sitpas_url   = "http://sitpas.depok.go.id/kds/KDSApi/DTKSWilayah";

    public function get_signature()
    {
        $payload = array(
            "cid" => "admin-kds",
            "client_name" => "kartu-depok",
            "timestamp" => time()
        );

        $ch = curl_init($this->decrypt_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true)['signature'] ?? null;
    }

    public function cek_nik($nik)
    {
        $signature = $this->get_signature();

        if (!$signature) {
            return null;
        }

        $headers = array(
            "cid: admin-kds",
            "signature: $signature"
        );

        $url = $this->sitpas_url . "?nik=" . $nik;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ['error' => $error];
        }

        return json_decode($result, true);
    }
}
