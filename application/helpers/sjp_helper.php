<?php

function is_login(){
	$CI = get_instance();
	if ($CI->session->userdata('username') AND $CI->session->userdata('id_user')) {
		$level 		= $CI->session->userdata('level');
		$instansi 	= $CI->session->userdata('instansi');

		$result = $CI->db->get_where('user', ['level' => $level, 'id_instansi' => $instansi])->num_rows();
		if ($result < 1) {
			redirect('Auth/','refresh');
		}
	} else {
		redirect('Auth/','refresh');
	}
}

function auth_menu(){
	$CI = get_instance();
	if ($CI->session->userdata('username') AND $CI->session->userdata('id_user')) {
		$id_instansi 	= $CI->session->userdata('instansi');

		switch ($id_instansi) {
		    case 1:
		        $controller = "Dinkes";
		        break;
		    case 2:
		        $controller = "Rs";
		        break;
		    case 3:
		        $controller = "Home";
		        break;
		    case 4:
		        $controller = "Dinsos";
		        break;
		    case 6:
		        $controller = "Kelurahan";
		        break;
		    case 7:
		        $controller = "Home";
		        break;
		    default:
		        $controller = "Auth";
		}		
		if ($CI->uri->segment(1) != $controller) {
			redirect('Auth/blocked');
		}
	}




}