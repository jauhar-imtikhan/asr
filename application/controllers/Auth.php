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
                            $s = date('G:i:s') . ' WIB';
                            $params = array(
                                'userid' => $user['user_id'],
                                'level' => $user['level'],
                                'jam' => $s,
                                'nama' => $user['nama_depan'],
                                'picture' => '',
                                'email' => $user['email'],
                                'method' => 'db',
                                'alamat' => $user['alamat'],
                                'nowa' => $user['nowa']
                            );
                            if ($user['level'] == '1') {
                                $this->session->set_userdata($params);
                                $this->session->set_flashdata('login', 'berhasil');
                                redirect('dashboard/admin');
                            } else if ($user['level'] == '2') {
                                $this->session->set_userdata($params);
                                $this->session->set_flashdata('login', 'berhasil');
                                redirect('dashboard/toko');
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
            $rand = rand(0, 10000);
            $name = $userInfo->name;
            $email_user = $userInfo->email;
            $picture = $userInfo->picture;
            date_default_timezone_set('Asia/Jakarta');
            $s = date('G:i:s') . ' WIB';
            $params = array(
                'userid' => $rand,
                'level' => '2',
                'nama' => $name,
                'picture' => $picture,
                'email' => $email_user,
                'jam' => $s,
                'method' => 'google'
            );
            $this->session->set_userdata($params);
            redirect('dashboard/toko');
        }
    }

    public function registrasi()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|matches[password]');
        $this->form_validation->set_rules(
            'no',
            'No Wa',
            'trim|required|min_length[11]',
            array('min_length[11]', 'Minimal 11 angka')
        );
        $this->form_validation->set_rules('aggre', 'Terms', 'required');

        $this->form_validation->set_message('required', '{field} Harus Diisi');
        $this->form_validation->set_message('valid_email', '{field} Harus Mengandung Karakter @');
        $this->form_validation->set_message('matches', '{field} Tidak Sama Dengan Password');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pages/auth/register');
        } else {
            $token = base64_encode(random_bytes(32));
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $conf_pass = $this->input->post('password2');
            $no_tlp = $this->input->post('no');
            $agree = $this->input->post('aggre');
            $namadepan = explode(" ", $nama);
            $time = time();
            $us = [
                'nama_depan' => $namadepan[0],
                'nama_belakang' => $namadepan[1],
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'level' => 2,
                'status' => 0,
                'agree' => $agree,
                'nowa' => $no_tlp
            ];

            $user_token = [
                'token' => $token,
                'email' => $email,
                'date_created' => $time
            ];
            $this->db->insert('token', $user_token);
            $this->db->insert('user', $us);
            $this->_sendemail($token, 'verifikasi');
            redirect('auth');
        }
    }

    private function _sendemail($token, $type)
    {
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com', // atau smptp lainnya                
            'smtp_user' => 'sahidfurniture0@gmail.com',  // Email gmail admin aplikasi
            'smtp_pass'   => 'eqceqohibzglrhgb',  // Password Gmail atau Sandi Aplikasi Gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->from('sahidfurniture0@gmail.com', 'Verifikasi Akun ASR Furniture');
        $this->email->to($this->input->post('email'));
        $verification = array(
            'verification_link' => site_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token)
        );
        $message = $this->load->view('extras/verifikasiemail', $verification, TRUE);
        if ($type == "verifikasi") {
            $this->email->subject('Selamat Datang Di Website ASR Furniture');
            $this->email->message($message);
            $this->email->send();
        } elseif ($type == "forgot") {
            $this->email->subject('Email Notifikasi Reset Password');
            $this->email->message('<h3>Link Reset Password Akan Expired Setelah 5 Menit</h3> Klik Link Di Bawah Untuk Reset Password : ' . '<br/>' . '<a href="' . site_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . ' ">RESET PASSWORD</a>');
            $this->email->send();
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $time = time();
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('token', ['token' => $token])->row_array();
            if ($user_token) {
                if ($time - $user_token['date_created'] < (300)) {
                    $this->db->update('user', ['status' => 1]);
                    $this->db->delete('token', ['token' => $token]);
                    $this->session->set_flashdata('msg', '<div class="alert alert-success">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                       Berhasil Aktivasi Akun Silahkan Login!
                </div>');
                    redirect('auth');
                } else {
                    $this->db->delete('token', ['token' => $token]);
                    $this->db->delete('user', ['email' => $email]);
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        Gagal Aktivasi Akun, Token Expired Silahkan Melakukan Pendaftaran Ulang!
                </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger">
               
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    Gagal Aktivasi Akun, Email Belum Terdaftar!
               
            </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('msg', '< class="alert alert-danger">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                Gagal Aktivasi Akun, Token Salah!
        </div>');
        }
    }

    public function logout()
    {
        $params = array('userid', 'level', 'nama', 'picture', 'email', 'jam');
        $this->session->unset_userdata($params);
        redirect('auth');
    }

    public function terms()
    {
        $this->load->view('pages/terms/terms');
    }
}
