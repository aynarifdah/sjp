<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();           // Load database
        $this->load->library('form_validation'); // Load form validation
        $this->load->library('encryption');     // Load encryption
        $this->load->library('session');        // Load session
        $this->load->helper('url');
        $this->load->model('M_login');
    }

    public function index()
    {
        // Jika sudah login, redirect
        if ($this->session->userdata('authenticated')) {
            redirect('Home');
        }

        $this->load->view('register');
    }

    public function proses_register()
    {
        // Validasi input
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger fade show mb-1">' . validation_errors() . '</div>'
            );
            redirect('Auth');
            return;
        }

        // Get input
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $nama = $this->input->post('nama');

        // Encrypt password
        $encrypted_password = $this->encryption->encrypt($password);

        // Insert user
        $data = [
            'nama' => $nama,
            'username' => $username,
            'password' => $encrypted_password,
            'level' => 1, // Default level user biasa
            'id_instansi' => 1,
            'id_join' => 0, // Default join id
            'is_active' => 1, // Belum aktif, perlu approval admin
        ];

        // Use Query Builder's insert method
        $this->db->insert('user', $data);

        // Success message
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success fade show mb-1">Registrasi berhasil! Akun Anda menunggu persetujuan admin.</div>'
        );

        redirect('Register');
    }
}