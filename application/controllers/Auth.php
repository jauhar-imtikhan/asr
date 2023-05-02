<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{
    public function index()
    {
        check_already_login();
        require 'vendor/autoload.php';
        $client = new Google_Client();
        $client->setClientId('602864832294-dp4k5vn9n0gqfctnh0dup3052lgvbeic.apps.googleusercontent.com');
        $client->setClientSecret('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');
        $client->setRedirectUri('http://localhost:3000/asr/auth');
        $client->addScope('email');
        $client->addScope('profile');

        $this->load->library('form_validation');
        $this->load->model('User_model');
        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        $user = $this->User_model->getbyid($email);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');

        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_message('valid_email', '{field} harus mengandung @gmail.com/Sejenisnya!');
        $this->form_validation->set_message('min_length', '{field} minimal 3 karekter');
        if (!isset($_GET['code'])) {
            $authUrl = $client->createAuthUrl();
            $data['login_button'] = '<a href="' . $authUrl . '" class="btn btn-block btn-social btn-danger "><i class="fa fa-google"></i> Login Menggunakan Google</a>';
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('pages/auth/login', $data);
            } else {
                if ($user) {
                    if ($user['status'] == 1) {
                        if (password_verify($pass, $user['password'])) {
                            date_default_timezone_set('Asia/Jakarta');
                            $s = date('i');
                            $params = array(
                                'userid' => $user['user_id'],
                                'level' => $user['level'],
                                'jam' => $s,
                                'nama' => $user['nama_depan'],
                                'picture' => 'img.jpg',
                                'email' => $user['email'],
                            );
                            if ($user['level'] == '1') {
                                $this->session->set_userdata($params);
                                $this->session->set_flashdata('login', 'berhasil');
                                redirect('home');
                            } else if ($user['level'] == '2') {
                                $this->session->set_userdata($params);
                                $this->session->set_flashdata('login', 'berhasil');
                                redirect('toko');
                            }
                        } else {
                            $this->session->set_flashdata('msg', ' <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Maaf!</strong> Password Salah, Silahkan Coba Lagi
                        </div>');
                            $this->load->view('pages/auth/login');
                        }
                    } else {
                        $this->session->set_flashdata('msg', ' <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Maaf!</strong> Akun Anda Belum Aktif, Silahkan Melakukan Aktivasi Akun Dahulu
                    </div>');
                        $this->load->view('pages/auth/login');
                    }
                } else {
                    $this->session->set_flashdata('msg', ' <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Maaf!</strong> Silahkan Melakukan Pendaftaran Dahulu
                </div>');
                    $this->load->view('pages/auth/login');
                }
            }
        } else {
            $client->authenticate($_GET['code']);
            $accessToken = $client->getAccessToken();
            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();

            $name = $userInfo->name;
            $email_user = $userInfo->email;
            $picture = $userInfo->picture;
            date_default_timezone_set('Asia/Jakarta');
            $s = date('i');
            $params = array(
                'userid' => $accessToken,
                'level' => 2,
                'nama' => $name,
                'picture' => $picture,
                'email' => $email_user,
                'jam' => $s
            );
            $this->session->set_userdata($params);
            $data['picture'] = $picture;
            $this->session->set_flashdata('foto', $picture);
            redirect('home');
        }
    }





    public function logout()
    {
        $params = array('userid', 'level', 'nama', 'picture', 'email', 'jam');
        $this->session->unset_userdata($params);
        redirect('auth');
    }
}
