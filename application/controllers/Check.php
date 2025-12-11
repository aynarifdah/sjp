<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check extends CI_Controller
{
    // COPYRIGHT BY GILANG PERMANA PUTRA //
    // INSTAGRAM : @gprmnp_ //
    // **** Don't delete it, or your life will be unsafe **** //

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
        $this->load->helper('url');
    }

    private function load($title = '', $datapath = '')
    {
        // Implementation needed
        return $title;
    }

    public function index()
    {
        $path = "";
        $data = array(
            "page" => $this->load("Perwal", $path),
        );

        $this->load->view('login', $data);
    }

    //MENGECEK USERNAME DAN PASSWORD DARI DATABASE
    public function cek_login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $data = $this->M_login->readBy($username, $password);

        if (isset($data->username) && isset($data->password)) {
            if ($username === $data->username && $password === $data->password) {
                // Set session data
                $newdata = array(
                    'id_user' => $data->id,
                    'username' => $data->username,
                    'password' => $data->password,
                    'level' => $data->level,
                );
                $this->session->set_userdata($newdata);

                // Redirect based on user level
                switch ($data->level) {
                    case '1':
                        redirect('Dinkes/', 'refresh');
                        break;
                    case '2':
                        redirect('Dinsos/index', 'refresh');
                        break;
                    case '3':
                        redirect('Puskesmas/index', 'refresh');
                        break;
                    case '4':
                        redirect('RS/index', 'refresh');
                        break;
                    default:
                        $this->session->sess_destroy();
                        echo "<script>alert('Level user tidak valid!');</script>";
                        redirect('/', 'refresh');
                        break;
                }
            } else {
                echo "<script>alert('USERNAME atau PASSWORD salah!!');</script>";
                redirect('/', 'refresh');
            }
        } else {
            echo "<script>alert('USERNAME atau PASSWORD salah!!');</script>";
            redirect('/', 'refresh');
        }
    }

    //UNTUK LOGOUT DAN MENGHAPUS SESSION LOGIN
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }

    // OPTIONAL: Update status chat
    // public function update_status_chat()
    // {
    //     $id_pengajuan = $this->input->post('id_pengajuan');
    //     $send_to = $this->input->post('send_to');

    //     $this->db->where('id_pengajuan', $id_pengajuan);
    //     $this->db->where('send_to', $send_to);
    //     $query = $this->db->update('chat', array('status_chat' => 'read'));
    //     
    //     echo json_encode(array('success' => $query));
    // }
}

