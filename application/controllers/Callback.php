<?php 
	
    defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Callback extends CI_Controller {
    
        public function __construct() {
            parent::__construct();
            $this->load->model('M_Login');
            $this->load->library('encryption');
        }

        public function index() {
            $cookie = $this->decryptToken();
            // var_dump($cookie);
            // die();
            $username = $cookie->username;
            $password = $cookie->password;
            $level = $cookie->kd_role;
            $namalevel = $cookie->nama_role;
            $instansi = $cookie->kd_org;
            $user = $this->M_Login->readBy($username);
            if (empty($user)) {
                    $data_user = array(
                        'nama' => $cookie->name,
                        'username' => $cookie->username,
                        'password' => $this->encryption->encrypt($cookie->password),
                        'level' => $level,
                        'id_instansi' => $instansi
                    );
        
                    $this->db->insert('user', $data_user);
                
            }else{
                $dataUpdate = array(
                    'level' => $level,
                    'id_instansi' => $instansi
                );
                $this->db->where('username', $username);
                $this->db->update('user', $dataUpdate);
            }
            $session_data = array(
                'username' => $cookie->username,
                'password' => $cookie->password
            );
            $this->session->set_userdata('login_data', $session_data);
            redirect('Auth/proses_login');
        }

        public function decryptToken() {
            $token = $_GET['token'];
            $iv = $_GET['client_id'];
            $key = $_GET['key'];
            $ciphering = "aes-256-cbc";
            $output = openssl_decrypt(base64_decode($token), $ciphering, $key, 0, $iv);
            return json_decode($output);
        }
    }