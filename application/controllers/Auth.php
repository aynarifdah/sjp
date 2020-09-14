<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

	public function __construct(){
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->helper('text');
	    $this->load->model('M_SJP');
	    $this->load->model('M_login');
	    $this->load->library('encryption');
	    // auth_menu();
	}

	    //FUNGSI UNTUK MEMBUAT TEMPLATE
	private function load($title = '', $datapath = ''){
	    $page = array(
	        "head"    => $this->load->view('template/head', array("title" => $title), true),
	        "header"  => $this->load->view('template/header', false, true),
	        "sidebar" => $this->load->view('template/sidebar', false, true),
	        "main_js" => $this->load->view('template/main_js', false, true),
	        "footer"  => $this->load->view('template/footer', false, true)
	    );
	    return $page;
	}

	public function index(){
	    $path = "";
	    $data = array(
	        "page" 		=> $this->load("Login", $path) ,
	        "content" 	=> $this->load->view('login', false, true)
	    );

	    // Hapus Data Session || Handling Error
	    $this->session->set_userdata('authenticated',false);
	    $this->session->unset_userdata('id_user');
	    $this->session->unset_userdata('username');
	    $this->session->unset_userdata('nama');
	    $this->session->unset_userdata('password');
	    $this->session->unset_userdata('level');
		$this->session->unset_userdata('instansi');
	    $this->session->unset_userdata('id_join');
	    $this->load->view('template/login_template', $data);
	}

	public function proses_login(){
	    $username 	= $this->input->post('username');
	    $password 	= $this->input->post('password'); 
	    $user 		= $this->M_login->readBy($username);
	    // var_dump($user);die;
          //  echo  $this->encryption->encrypt($password);die; 
          // echo "<br><br>";
            // echo $this->encryption->decrypt($user->password);
           // echo $password;die;
	    if(empty($user)){ 
	        $this->session->set_flashdata('message', '<div class="alert alert-warning fade show mb-1">Username tidak ditemukan !</div>'); 
	        redirect('Auth/', 'refresh');
	    } else {
	        if($password == $this->encryption->decrypt($user->password)){
	            $session = array(
	                'authenticated' =>	true, 
	                'id_user' 		=>	$user->id_user, 
	                'username'		=>	$user->username,  
	                'nama'    		=>	$user->nama,
	                'password'		=>	$user->nama, 
	                'level'   		=>	$user->level,
	                'instansi'		=>	$user->id_instansi,
	                'id_join'		=>	$user->id_join
	            );
	            $this->session->set_userdata($session);
	            helper_log("login","Berhasil Login",$user->id_instansi);
	            switch ($user->id_instansi) {
	                case "1":
	                    redirect('Dinkes/', 'refresh');
	                    break;
	                case "2":
	                    redirect('Rs/', 'refresh'); 
	                    break;
	                case "3":
	                    redirect('Home/', 'refresh'); 
	                    break;
	                case "4":
	                    redirect('Dinsos/', 'refresh'); 
	                    break;
	                case "5":
	                    redirect('Masyarakat/', 'refresh'); 
	                    break;
	                default:
	                    echo "Error!";
	            }
	        } else {
	            $this->session->set_flashdata('message', '<div class="alert alert-warning fade show mb-1">Password salah</div>'); 
	            redirect('Auth/', 'refresh');
	        }
	    }
	}

	function logout(){
		$instansi = $this->instansi();
	  	if($this->session->userdata('username')==""){	
		   	redirect($instansi, 'refresh');
		} else{
		    helper_log("logout","Berhasil Logout",$this->session->userdata('instansi'));
		    $this->session->set_userdata('authenticated',false);
		    $this->session->unset_userdata('id_user');
		    $this->session->unset_userdata('username');
		    $this->session->unset_userdata('nama');
		    $this->session->unset_userdata('password');
		    $this->session->unset_userdata('level');
		    $this->session->unset_userdata('instansi');
		    $this->session->unset_userdata('id_join');
		    $this->session->set_flashdata('message', '<div class="alert alert-success fade show mb-1">Anda berhasil Logout !</div>'); 
		    // echo "<script>alert('Anda berhasil keluar');</script>";
		    redirect('Auth/', 'refresh');
		}
	}

	private function instansi(){
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
		    default:
		        $controller = "Auth/";
		}
		return $controller;
	}

	public function blocked(){
		$instansi = $this->instansi();
		echo "<center><h1>Akses di Blokir!!</h1> <br> <a href='".base_url($instansi) ."'>Kembali</a></center>";
	}

}

/* End of file Auth.php */
/* Location: .//tmp/fz3temp-2/Auth.php */