<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->model('M_SJP');
		$this->load->model('M_login');
		$this->load->library('encryption');
		// auth_menu();
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
		$path = "";
		$data = array(
			"page" 		=> $this->load("Login", $path),
			"content" 	=> $this->load->view('login', false, true)
		);

		// Hapus Data Session || Handling Error
		$this->session->set_userdata('authenticated', false);
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('instansi');
		$this->session->unset_userdata('id_join');
		$this->load->view('template/login_template', $data);
	}

	public function proses_login()
	{
		if ($this->session->userdata('login_data')) {
			$session_data = $this->session->userdata('login_data');
			$username = $session_data['username'];
			$password = $session_data['password'];
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
		}

		$token = $this->input->post('g-recaptcha-response');

		$secret = "6LdRtyAsAAAAAKavFzlyOyHXQ33DR2X3alLWjjv_";
		$verify_url = "https://www.google.com/recaptcha/api/siteverify";


		$data = [
			"secret"   => $secret,
			"response" => $token,
			"remoteip" => $this->input->ip_address()
		];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $verify_url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($response, true);

		if (empty($result["success"]) || $result["success"] !== true) {
			$this->session->set_flashdata("gagalcaptcha", "Captcha gagal. Silakan coba lagi.");
			redirect("Auth/", "refresh");
			return;
		}

		
		$user = $this->M_login->readBy($username);
		$ip = $this->input->ip_address();
		$limitTime = date("Y-m-d H:i:s", strtotime("-5 minutes"));
		$userId = $user ? $user->id_user : null;

		$failUser = $userId
			? $this->db->where("user_id", $userId)->where("created_at >", $limitTime)->count_all_results("log_login")
			: 0;

		$failIP = $this->db->where("ip_address", $ip)->where("created_at >", $limitTime)->count_all_results("log_login");

		if ($failUser >= 5 || $failIP >= 5) {
			$this->session->set_flashdata('login_error', 
				'Terlalu banyak percobaan login gagal. Silakan coba lagi setelah 5 menit.');
			redirect('Account/', 'refresh');
			return;
		}

		if (!$user) {
			$this->session->set_flashdata('pesan', 
				'<div class="alert alert-warning fade show mb-1">Username tidak ditemukan!</div>');
			redirect('Auth/', 'refresh');
			return;
		}

		if ($password != $this->encryption->decrypt($user->password)) {
			$this->db->insert("log_login", [
				"user_id"   => $userId,
				"ip_address"=> $ip
			]);
			$this->session->set_flashdata('pesan', 
				'<div class="alert alert-warning fade show mb-1">Password salah!</div>');
			redirect('Auth/', 'refresh');
			return;
		}

		if ($user->is_active != 1) {
			$this->session->set_flashdata('pesan', 
				'<div class="alert alert-warning fade show mb-1">Akun anda sudah tidak aktif.</div>');
			redirect('Auth/', 'refresh');
			return;
		}

		$this->session->set_userdata([
			'authenticated' => true,
			'id_user'       => $user->id_user,
			'username'      => $user->username,
			'nama'          => $user->nama,
			'level'         => $user->level,
			'instansi'      => $user->id_instansi,
			'id_join'       => $user->id_join
		]);

		helper_log("login", "Berhasil Login", $user->id_instansi);

		switch ($user->id_instansi) {
			case "1": redirect('Dinkes/persetujuan_sjp_kayankesru'); break;
			case "2": redirect('Rs/'); break;
			case "3": redirect('Home/'); break;
			case "4": redirect('Dinsos/'); break;
			case "6": redirect('Kelurahan/'); break;
			case "7": redirect('Home/'); break;
			case "8": redirect('Dinsos/'); break;
			default:  redirect('Dinsos/'); break;
		}
	}


	function logout()
	{
		$instansi = $this->instansi();
		if ($this->session->userdata('username') == "") {
			redirect($instansi, 'refresh');
		} else {
			helper_log("logout", "Berhasil Logout", $this->session->userdata('instansi'));
			$this->session->set_userdata('authenticated', false);
			$this->session->unset_userdata('id_user');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('nama');
			$this->session->unset_userdata('password');
			$this->session->unset_userdata('level');
			$this->session->unset_userdata('instansi');
			$this->session->unset_userdata('id_join');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success fade show mb-1">Anda berhasil Logout !</div>');
			// echo "<script>alert('Anda berhasil keluar');</script>";
			redirect('Auth/', 'refresh');
		}
	}

	private function instansi()
	{
		$id_instansi 	= $this->session->userdata('instansi');
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
				$controller = "Kelurahan/";
				break;
			case 7:
				$controller = "Home/";
				break;
			default:
				$controller = "Auth/";
		}
		return $controller;
	}

	public function blocked()
	{
		$instansi = $this->instansi();
		echo "<center><h1>Akses di Blokir!!</h1> <br> <a href='" . base_url($instansi) . "'>Kembali</a></center>";
	}
}

/* End of file Auth.php */
/* Location: .//tmp/fz3temp-2/Auth.php */