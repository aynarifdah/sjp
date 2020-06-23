<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check extends CI_Controller
{
    // COPYRIGHT BY GILANG PERMANA PUTRA //
    // INSTAGRAM : @gprmnp_ //
    // **** Don't delete it, or your life will be unsafe **** //
    function __construct()
    {
        parent::__construct();
        $this
            ->load
            ->model('M_login');
        $this
            ->load
            ->helper('url');
    }

    private function load($title = '', $datapath = '')
    {
    }
    public function index()
    {
        
        $path = "";
        $data = array(
            "page" => $this->load("Perwal", $path),
            // "content" =>$this->load->view('login', false, true)
        );

        $this->load->view('login', $data);
    }
    //MENGECEK USERNAME DAN PASSWORD DARI DATABASE
    public function cek_login()
    {
            // var_dump($this
            //     ->input
            //     ->post());
            $username = $this
                ->input
                ->post('username');
            $password = md5($this
                ->input
                ->post('password'));
            $data = $this
                ->M_login
                ->readBy($username, $password);
            if (isset($data->username) && isset($data->password))
            {
                if ($username === $data->username && $password === $data->password)
                {
                    if ($data->level === '1') {
                        $newdata = array(
                            'id_user' => $data->id ,
                            'username' => $data->username,
                            'password' => $data->password,
                            'level' => $data->level,
                            // 'id_opd' => $data->id_opd,
                        );
                        $this
                        ->session
                        ->set_userdata($newdata);
                        // print_r($newdata);die();
                        redirect('Dinkes/', 'refresh');
                    }
                    elseif ($data->level === '2'){
                        $newdata = array(
                            'id_user' => $data->id ,
                            'username' => $data->username,
                            'password' => $data->password,
                            'level' => $data->level,
                            // 'id_opd' => $data->id_opd,
                        );
                        $this
                        ->session
                        ->set_userdata($newdata);
                        // print_r($newdata);die();
                        redirect('Dinsos/index', 'refresh');
                        } 
                    } else
                    elseif ($data->level === '3'){
                        $newdata = array(
                            'id_user' => $data->id ,
                            'username' => $data->username,
                            'password' => $data->password,
                            'level' => $data->level,
                            // 'id_opd' => $data->id_opd,
                        );
                        $this
                        ->session
                        ->set_userdata($newdata);
                        // print_r($newdata);die();
                        redirect('Puskesmas/index', 'refresh');
                        } 
                    } else
                    elseif ($data->level === '4'){
                        $newdata = array(
                            'id_user' => $data->id ,
                            'username' => $data->username,
                            'password' => $data->password,
                            'level' => $data->level,
                            // 'id_opd' => $data->id_opd,
                        );
                        $this
                        ->session
                        ->set_userdata($newdata);
                        // print_r($newdata);die();
                        redirect('RS/index', 'refresh');
                        } 
                    } else
                {
                    echo "<script>alert('USERNAME atau PASSWORD salah!!')</script>";
                    redirect('/', 'refresh');
                    echo $username;
                    echo $password;
                }
                    
                }
                else
                {
                    echo "<script>alert('USERNAME atau PASSWORD salah!!')</script>";
                    redirect('/', 'refresh');
                    echo $password;
                    echo $username;
                }
        }

    //UNTUK LOGOUT DAN MENGHAPUS SESSION LOGIN
    public function logout()
    {   
        // echo "<script>alert('Berhasil Logout')</script>";
        $this
            ->session
            ->sess_destroy();
        redirect('/', 'refresh');
    }

    // public function update_status_chat(){
    //     $id_pengajuan = $this->input->post('id_pengajuan');
    //     $send_to = $this->input->post('send_to');

    //     $query = $this->db->query("UPDATE chat SET status_chat='read' where id_pengajuan='$id_pengajuan' AND send_to='$send_to' ");
    //     if ($query === true) {
    //         echo true;
    //     }else{
    //         echo false;
    //     }

    // }
}

