
<?php
use Dompdf\Options;

class API extends CI_Controller
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
    
    public function ValidasiDTKSbyNIK()
    {
        // $gettoken = $this->getToken();

        // $auth = $gettoken->token;
        
        $url = "http://sitpas.depok.go.id/kds/KDSApi/";
        // $urltoken = "http://sitpas.depok.go.id/kds/Decrypt";

        date_default_timezone_set('Asia/Jakarta');
        $timestamp = time();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url . 'Decrypt');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'cid' => 'admin-kds',
            'client_name' => 'kartu-depok',
            'timestamp' => $timestamp
        ]));

        $response = curl_exec($ch);
        var_dump($response);

        // $fields_string = http_build_query($data_api);
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_POST, 1);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // $response = curl_exec($curl);
        // $error_msg = curl_error($curl);
        // curl_close($curl);
        // $json_response = json_decode($response);
        // echo json_encode($json_response);
    }
}