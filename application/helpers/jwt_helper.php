<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

if (!function_exists('generate_jwt_token')) {

    function generate_jwt_token($user)
    {
        $CI =& get_instance();
        $key = $CI->config->item('encryption_key');
        $payload = array(
            "user_id" => $user->id_user,
            "username" => $user->username,
            "nama" => $user->nama,
            "level" => $user->level,
            "instansi" => $user->id_instansi,
            "id_join" => $user->id_join,
            "iat" => time(), // Waktu pembuatan token
            "exp" => time() + (60 * 60 * 6) // Waktu kadaluarsa token (6 jam)
        );

        $token = JWT::encode($payload, $key, 'HS256');
        return $token;
    }
}
