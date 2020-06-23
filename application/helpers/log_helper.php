<?php

function helper_log($tipe="",$str=Null,$id_instansi=Null,$id_pengajuan=Null,$id_jenis=NUll)
{
	$CI =& get_instance();
	if (strtolower($tipe) == "login") {
		$log_tipe = 0;
	}
	elseif (strtolower($tipe) == "logout") {
		$log_tipe = 1;
	}
	elseif (strtolower($tipe) == "add") {
		$log_tipe = 2;
	}
	elseif (strtolower($tipe) == "update") {
		$log_tipe = 3;
	} elseif (strtolower($tipe) == "print") {
		$log_tipe = 4;
	}else{
		$log_tipe = 5;
	}

	$log['log_user'] 		= $CI->session->userdata('id_user');
	$log['id_instansi'] 	= $CI->session->userdata('instansi');
	$log['log_pengajuan'] 	= $id_pengajuan;
	$log['log_jenis'] 		= $id_jenis;
	$log['log_tipe'] 		= $log_tipe;
	$log['log_desc'] 		= $str;
	// var_dump($log);die;
	$CI->load->model('M_log');
	$CI->M_log->save_log($log);
}

?>