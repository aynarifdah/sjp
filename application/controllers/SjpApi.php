<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class SjpApi extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
        $this->load->model('M_Api');
        $this->load->helper('jwt');
        $this->config->load('config');
        $this->load->library('encryption');
    }

    public function AuthLogin_post()
    {
        $username = $this->post('Username');
        $password = $this->post('Password');

        $user = $this->M_login->readBy($username);

        if (empty($user)) {
            $this->response(
                [
                    'Message' => 'Username tidak ditemukan !',
                    'Status' => RestController::HTTP_NOT_FOUND,
                    'Data' => null
                ],
                RestController::HTTP_NOT_FOUND
            );
        } else {
            if ($password == $this->encryption->decrypt($user->password)) {
                if ($user->is_active == 1) {
                    $token = generate_jwt_token($user);
                    $this->response(
                        [
                            'Message' => 'Login berhasil',
                            'Status' => RestController::HTTP_OK,
                            'Data' => [
                                'Token' => $token,
                                'User' => [
                                    'Username' => $user->username,
                                    'Name' => $user->nama,
                                    'Exp' => time() + (60 * 60 * 6)
                                ],
                            ]
                        ],
                        RestController::HTTP_OK
                    );
                } else {
                    $this->response(
                        [
                            'Message' => 'Akun Anda tidak aktif.',
                            'Status' => RestController::HTTP_UNAUTHORIZED,
                            'Data' => null
                        ],
                        RestController::HTTP_UNAUTHORIZED
                    );
                }
            } else {
                $this->response(
                    [
                        'Message' => 'Password salah',
                        'Status' => RestController::HTTP_UNAUTHORIZED,
                        'Data' => null
                    ],
                    RestController::HTTP_UNAUTHORIZED
                );
            }
        }
    }

    public function StatusPengajuan_post()
    {
        $nik = $this->input->post('Nik');

        $authorization_header = $this->input->get_request_header('Authorization');

        if (!$authorization_header || !preg_match('/Bearer\s(\S+)/', $authorization_header, $matches)) {
            $this->response([
                'Message' => 'Token tidak disediakan atau format tidak valid',
                'Status' => RestController::HTTP_UNAUTHORIZED,
                'Data' => null
            ], RestController::HTTP_UNAUTHORIZED);
        }

        $token = $matches[1];
        $secretKey = $this->config->item('encryption_key');

        if (!$token) {
            $this->response([
                'Message' => 'Token tidak tersedia',
                'Status' => RestController::HTTP_UNAUTHORIZED,
                'Data' => null
            ], RestController::HTTP_UNAUTHORIZED);
        }

        try {
            $decoded_token = JWT::decode($token, new Key($secretKey, 'HS256'));
            $user = $this->M_login->readBy($decoded_token->username);

            if (empty($user)) {
                $this->response(
                    [
                        'Message' => 'Authentifikasi Gagal!',
                        'Status' => RestController::HTTP_NOT_FOUND,
                        'Data' => null
                    ],
                    RestController::HTTP_NOT_FOUND
                );
            } else {
                if (isset($decoded_token->exp) && time() > $decoded_token->exp) {
                    $this->response([
                        'Message' => 'Token telah kadaluarsa',
                        'Status' => RestController::HTTP_UNAUTHORIZED,
                        'Data' => null
                    ], RestController::HTTP_UNAUTHORIZED);
                }
    
                $data = $this->M_Api->cekstatus($nik);
                $count = $data['total_data'];
                $pengajuan = $data['pengajuan'];
    
                
                if ($data === false) {
                    $this->response([
                        'Message' => 'Terjadi kesalahan saat mengambil data',
                        'Status' => RestController::HTTP_NOT_FOUND,
                        'Data' => null
                    ], RestController::HTTP_NOT_FOUND);
                }
                
                if ($data['total_data'] > 0) {
                    $response_data = [
                        'Message' => 'Berhasil',
                        'Status' => RestController::HTTP_OK,
                        'Data' => [
                            'Pengajuan' => $pengajuan,
                            'Total' => $count,
                        ],
                    ];
                } else {
                    $response_data = [
                        'Message' => 'Data tidak ditemukan',
                        'Status' => RestController::HTTP_OK,
                        'Data' => [
                            'Pengajuan' => null,
                            'Total' => 0,
                        ],
                    ];
                }
    
                $this->response($response_data, RestController::HTTP_OK);
            }
        } catch (Exception $e) {
            $this->response([
                'Message' => 'Token tidak valid',
                'Status' => RestController::HTTP_UNAUTHORIZED,
                'Data' => null
            ], RestController::HTTP_UNAUTHORIZED);
        }
    }


}
